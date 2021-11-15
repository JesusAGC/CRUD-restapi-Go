package database

import (
	"database/sql"
	"errors"
	"fmt"
	models "person/models"
)

func DbConnection() (db *sql.DB, e error) {
	dbDriver := "mysql"
	dbUser := "user1"
	dbPass := "1234"
	dbName := "registro_tickets"
	db, err := sql.Open(dbDriver, dbUser+":"+dbPass+"@tcp(127.0.0.1:3306)/"+dbName+"?parseTime=true")
	if err != nil {
		fmt.Println(err)
		return nil, err
	}
	return db, nil
}

func Insert(t models.Ticket) error {
	db, err := DbConnection()
	if err != nil {
		return err
	}

	defer db.Close()

	//Preparamos para prevenir inyecciones SQL
	prepareQuery, err := db.Prepare("INSERT INTO Tickets (NombreCompleto, CURP, Nombre, Paterno, Materno, Telefono, Celular, Email, Nivel, Municipio, Asunto) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);")
	if err != nil {
		return err
	}

	defer prepareQuery.Close()

	// ejecutar sentencia, un valor por cada '?'
	_, err = prepareQuery.Exec(t.NombreCompleto, t.CURP, t.Nombre, t.Paterno, t.Materno, t.Telefono, t.Celular, t.Email, t.Nivel, t.Municipio, t.Asunto)
	if err != nil {
		return err
	}

	fmt.Println("Se insertó correctamente")
	return nil
}

func GetAllData() ([]models.Ticket, error) {

	tickets := []models.Ticket{}
	db, err := DbConnection()
	if err != nil {
		fmt.Println("No se pudo conectar")
		return nil, err
	}

	defer db.Close()
	// checar todo lo que lleve id
	rows, err := db.Query("SELECT ID, NombreCompleto, CURP, Nombre, Paterno, Materno, Telefono, Celular, Email, Nivel, Municipio, Asunto FROM Tickets;")
	if err != nil {
		return nil, err
	}

	defer rows.Close()

	// Aquí vamos p "mapear" lo que traiga la consulta en el ciclo de más abajo
	var t models.Ticket

	for rows.Next() {
		err = rows.Scan(&t.Id, &t.NombreCompleto, &t.CURP, &t.Nombre, &t.Paterno, &t.Materno, &t.Telefono, &t.Celular, &t.Email, &t.Nivel, &t.Municipio, &t.Asunto)
		if err != nil {
			return nil, err
		}

		tickets = append(tickets, t)
	}

	return tickets, nil
}

// get by curp.
func GetByCurp(curp string) (models.Ticket, error) {
	var t models.Ticket

	db, err := DbConnection()
	if err != nil {
		return t, err
	}

	defer db.Close()

	query := fmt.Sprintf(`SELECT ID, NombreCompleto, CURP, Nombre, Paterno, Materno, Telefono, Celular, Email, Nivel, Municipio, Asunto	FROM Tickets where CURP ='%s'`, curp)

	rows, err := db.Query(query)
	if err != nil {
		return t, err
	}

	defer rows.Close()

	for rows.Next() {
		err = rows.Scan(&t.Id, &t.NombreCompleto, &t.CURP, &t.Nombre, &t.Paterno, &t.Materno, &t.Telefono, &t.Celular, &t.Email, &t.Nivel, &t.Municipio, &t.Asunto)
		if err != nil {
			return t, err
		}
	}

	return t, nil
}

func GetByCurpAndID(id string, curp string) (models.Ticket, error) {
	var t models.Ticket

	db, err := DbConnection()
	if err != nil {
		return t, err
	}

	defer db.Close()

	query := fmt.Sprintf(`SELECT CURP, NombreCompleto, CURP, Nombre, Paterno, Materno, Telefono, Celular, Email, Nivel, Municipio, Asunto FROM Tickets where ID ='%s' and CURP = '%s'`, id, curp)

	rows, err := db.Query(query)
	if err != nil {
		return t, err
	}

	defer rows.Close()

	for rows.Next() {
		err = rows.Scan(&t.Id, &t.NombreCompleto, &t.CURP, &t.Nombre, &t.Paterno, &t.Materno, &t.Telefono, &t.Celular, &t.Email, &t.Nivel, &t.Municipio, &t.Asunto)
		if err != nil {
			return t, err
		}
	}

	return t, nil
}

func Update(t models.Ticket, id string, curp string) error {

	db, err := DbConnection()
	if err != nil {
		return err
	}

	// checar si agregar la info de este objeto o no
	// agregar condicionales con los diferentes datos
	_, err = GetByCurpAndID(id, curp)
	if err != nil {
		return err
	}

	defer db.Close()

	query := fmt.Sprintf(`UPDATE Tickets SET NombreCompleto=?, CURP=?, Nombre=?, Paterno=?, Materno=?, Telefono=?, Celular=?, Email=?, Nivel=?, Municipio=?, Asunto=? WHERE CURP ='%s' AND ID = '%s'`, curp, id)
	prepareQuery, err := db.Prepare(query)
	if err != nil {
		return err
	}
	defer prepareQuery.Close()

	_, err = prepareQuery.Exec(&t.NombreCompleto, &t.CURP, &t.Nombre, &t.Paterno, &t.Materno, &t.Telefono, &t.Celular, &t.Email, &t.Nivel, &t.Municipio, &t.Asunto)
	if err != nil {
		return err
	}
	fmt.Println("Se modificó correctamente")

	return nil

}

func Delete(curp string, id string) error {
	db, err := DbConnection()
	if err != nil {
		return err
	}

	defer db.Close()

	prepareQuery, err := db.Prepare("DELETE FROM Tickets WHERE CURP = ? AND ID = ?")
	if err != nil {
		return err
	}
	defer prepareQuery.Close()

	res, err2 := prepareQuery.Exec(curp, id)
	if err2 != nil {
		return err2
	}

	rows, err2 := res.RowsAffected()
	if err2 != nil {
		return err2
	}

	if rows == 0 {
		mistake := errors.New("no rows affected")
		return mistake
	}

	fmt.Println("Se ha eliminado exitosamente La persona con curp: ", curp)
	return nil
}
