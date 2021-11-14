package database

import (
	"database/sql"
	"fmt"
	models "person/models"
)

func DbConnection() (db *sql.DB, e error) {
	dbDriver := "mysql"
	dbUser := "root"
	dbPass := "example"
	dbName := "personas_db"
	db, err := sql.Open(dbDriver, dbUser+":"+dbPass+"@tcp(127.0.0.1:3306)/"+dbName+"?parseTime=true")
	if err != nil {
		fmt.Println(err)
		return nil, err
	}
	return db, nil
}

func Insert(p models.Person) error {
	db, err := DbConnection()
	if err != nil {
		return err
	}

	defer db.Close()

	//Preparamos para prevenir inyecciones SQL
	prepareQuery, err := db.Prepare("INSERT INTO personas (curp, nombre, paterno, materno, sexo, fecha_nac, estado, municipio, genero) VALUES(?,?,?,?,?,?,?,?,?)")
	if err != nil {
		return err
	}

	defer prepareQuery.Close()

	// ejecutar sentencia, un valor por cada '?'
	_, err = prepareQuery.Exec(p.Curp, p.Nombre, p.Paterno, p.Materno, p.Sexo, p.FechaNac, p.Estado, p.Municipio, p.Genero)
	if err != nil {
		return err
	}

	fmt.Println("Se insertó correctamente")
	return nil
}

func GetAllData() ([]models.Person, error) {

	personas := []models.Person{}
	db, err := DbConnection()
	if err != nil {
		fmt.Println("No se pudo conectar")
		return nil, err
	}

	defer db.Close()
	// checar todo lo que lleve id
	rows, err := db.Query("SELECT curp, nombre, paterno, materno, sexo, fecha_nac, estado, municipio, genero FROM personas")
	if err != nil {
		return nil, err
	}

	defer rows.Close()

	// Aquí vamos p "mapear" lo que traiga la consulta en el ciclo de más abajo
	var p models.Person

	for rows.Next() {
		err = rows.Scan(&p.Curp, &p.Nombre, &p.Paterno, &p.Materno, &p.Sexo, &p.FechaNac, &p.Estado, &p.Municipio, &p.Genero)
		if err != nil {
			return nil, err
		}

		personas = append(personas, p)
	}

	return personas, nil
}

// get by curp.
func GetByCurp(curp string) (models.Person, error) {
	var p models.Person

	db, err := DbConnection()
	if err != nil {
		return p, err
	}

	defer db.Close()

	query := fmt.Sprintf(`SELECT curp, nombre, paterno, materno, sexo, fecha_nac, estado, municipio, genero FROM personas HAVING curp='%s'`, curp)

	rows, err := db.Query(query)
	if err != nil {
		return p, err
	}

	defer rows.Close()

	for rows.Next() {
		err = rows.Scan(&p.Curp, &p.Nombre, &p.Paterno, &p.Materno, &p.Sexo, &p.FechaNac, &p.Estado, &p.Municipio, &p.Genero)
		if err != nil {
			return p, err
		}
	}

	return p, nil
}

func Update(p models.Person, curp string) error {

	db, err := DbConnection()
	if err != nil {
		return err
	}

	// checar si agregar la info de este objeto o no
	// agregar condicionales con los diferentes datos
	_, err = GetByCurp(curp)
	if err != nil {
		return err
	}

	defer db.Close()

	query := fmt.Sprintf(`UPDATE personas SET  nombre = ?, paterno = ?, materno = ?, sexo = ?, fecha_nac = ?, estado = ?, municipio = ?, genero = ? WHERE curp ='%s'`, curp)
	prepareQuery, err := db.Prepare(query)
	if err != nil {
		return err
	}
	defer prepareQuery.Close()

	_, err = prepareQuery.Exec(p.Nombre, p.Paterno, p.Materno, p.Sexo, p.FechaNac, p.Estado, p.Municipio, p.Genero)
	if err != nil {
		return err
	}
	fmt.Println("Se modificó correctamente")

	return nil

}

func Delete(curp string) error {
	db, err := DbConnection()
	if err != nil {
		return err
	}

	defer db.Close()

	prepareQuery, err := db.Prepare("DELETE FROM personas WHERE curp = ?")
	if err != nil {
		return err
	}
	defer prepareQuery.Close()

	_, err = prepareQuery.Exec(curp)
	if err != nil {
		return err
	}

	fmt.Println("Se ha eliminado exitosamente La persona con curp: ", curp)
	return nil
}
