package structs

import "time"

type Person struct {
	Curp      string    `json:"curp"`
	Nombre    string    `json:"nombre"`
	Paterno   string    `json:"paterno"`
	Materno   string    `json:"materno"`
	Sexo      string    `json:"sexo"`
	FechaNac  time.Time `json:"fecha_nac"`
	Estado    string    `json:"estado"`
	Municipio int       `json:"municipio"`
	Genero    string    `json:"genero"`
}
