package structs

import "time"

// struct is like a class but in Golang
// this will be our object to handle the data
type Aspirante struct {
	ID            int       `json:"id"`
	Rfc           string    `json:"rfc"`
	Nombres       string    `json:"nombres"`
	Paterno       string    `json:"paterno"`
	Materno       string    `json:"materno"`
	Empresa       string    `json:"empresa"`
	Telefono      int       `json:"telefono"`
	Correo        string    `json:"correo"`
	FechaRegistro time.Time `json:"fecha_registro"`
}
