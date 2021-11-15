package structs

type Ticket struct {
	Id             string `json:ID`
	NombreCompleto string `json:Nombre_Completo`
	CURP           string `json:CURP`
	Nombre         string `json:Nombre`
	Paterno        string `json:Paterno`
	Materno        string `json:Materno`
	Telefono       string `json:Telefono`
	Celular        string `json:Celular`
	Email          string `json:Email`
	Nivel          string `json:Nivel`
	Municipio      string `json:Municipio`
	Asunto         string `json:Asunto`
}
