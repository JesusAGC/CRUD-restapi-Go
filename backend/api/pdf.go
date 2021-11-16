package api

import (
	"bytes"
	models "person/models"
	"time"

	"github.com/jung-kurt/gofpdf"
)

func CreatePDF(t models.Ticket) ([]byte, error) {
	println("CURP:  " + t.CURP)
	pdf := gofpdf.New("P", "pt", "Letter", "")
	pdf.SetMargins(10, 10, 10)
	pdf.AliasNbPages("")
	pdf.SetFont("Arial", "", 18)
	pdf.AddPage()
	pdf.CellFormat(592, 18, "TICKET DE CITA", "", 1, "C", false, 0, "")
	pdf.CellFormat(592, 18, "FOLIO: "+t.Id, "", 1, "C", false, 0, "")
	pdf.Ln(-1)
	pdf.Line(pdf.GetX(), pdf.GetY(), 602, pdf.GetY())
	pdf.Ln(-1)
	pdf.MultiCell(592, 18, "Blvd. Francisco Coss y Av. Magisterio s/n, Unidad Campo Redondo 25000 Saltillo, Coah.", "", "C", false)
	pdf.CellFormat(592, 18, "TELEFONO: (844) 411-8812 ext. 3110 / 3111", "", 1, "C", false, 0, "")
	pdf.CellFormat(592, 18, "https://www.seducoahuila.gob.mx/", "", 1, "C", false, 0, "")
	pdf.Ln(-1)
	pdf.Line(pdf.GetX(), pdf.GetY(), 602, pdf.GetY())
	pdf.Ln(-1)
	dt := time.Now()
	pdf.CellFormat(592, 18, "Fecha de solicitud: "+dt.Format("2006-01-02 15:04:05"), "", 1, "C", false, 0, "")
	pdf.Ln(-1)
	pdf.CellFormat(592, 18, "Nombre Completo: "+t.NombreCompleto, "", 1, "L", false, 0, "")
	pdf.CellFormat(592, 18, "Nombre: "+t.Nombre, "", 1, "L", false, 0, "")
	pdf.CellFormat(592, 18, "Apellido Paterno: "+t.Paterno, "", 1, "L", false, 0, "")
	pdf.CellFormat(592, 18, "Apellido Materno: "+t.Materno, "", 1, "L", false, 0, "")
	pdf.CellFormat(592, 18, "Telefono: "+t.Telefono, "", 1, "L", false, 0, "")
	pdf.CellFormat(592, 18, "Celular: "+t.Celular, "", 1, "L", false, 0, "")
	pdf.CellFormat(592, 18, "Email: "+t.Email, "", 1, "L", false, 0, "")
	pdf.CellFormat(592, 18, "Nivel: "+Niveles[t.Nivel], "", 1, "L", false, 0, "")
	pdf.CellFormat(592, 18, "Municipio: "+MunMap[t.Municipio], "", 1, "L", false, 0, "")
	pdf.CellFormat(592, 18, "Asunto: "+Asuntos[t.Asunto], "", 1, "L", false, 0, "")
	pdf.Ln(-1)
	pdf.Line(pdf.GetX(), pdf.GetY(), 602, pdf.GetY())
	pdf.Ln(-1)
	// createQR()
	// pdf.Image("New.jpeg", 246, pdf.GetY(), 100, 100, false, "", 0, "")

	// err2 := pdf.OutputFileAndClose("test_2.pdf")
	// if err2 != nil {
	// 	println(err2)
	// }
	var buff bytes.Buffer
	err := pdf.Output(&buff)
	if err != nil {
		print(err.Error())
		return nil, err
	}

	return buff.Bytes(), nil

}

// func createQR() {
// 	qrc, err := qrcode.New("https://www.seducoahuila.gob.mx/", qrcode.WithBgColorRGBHex("#000000"))
// 	if err != nil {
// 		fmt.Printf("could not generate QRCode: %v", err)
// 	}

// path to create and save the new qr-image
// if err := qrc.Save("./New.jpeg"); err != nil {
// 	fmt.Printf("could not save image: %v", err)
// }

//fmt.Println("The code was succesfully created!")
// }

var MunMap = map[string]string{
	"01":  "Abasolo",
	"02":  "Acuña",
	"03":  "Allende",
	"04":  "Arteaga",
	"05":  "Candela",
	"06":  "Castaños",
	"07":  "Cuatro Ciénegas",
	"08":  "Escobedo",
	"09":  "Francisco I. Madero",
	"010": "Frontera",
	"011": "General Cepeda",
	"012": "Guerrero",
	"013": "Hidalgo",
	"014": "Jiménez",
	"015": "Juárez",
	"016": "Lamadrid",
	"017": "Matamoros",
	"018": "Monclova",
	"019": "Morelos",
	"020": "Múzquiz",
	"021": "Nadadores",
	"022": "Nava",
	"023": "Ocampo",
	"024": "Parras",
	"025": "Piedras Negras",
	"026": "Progreso",
	"027": "Ramos Arizpe",
	"028": "Sabinas",
	"029": "Sacramento",
	"030": "Saltillo",
	"031": "San Buenaventura",
	"032": "San Juan de Sabinas",
	"033": "San Pedro",
	"034": "Sierra Mojada",
	"035": "Torreón",
	"036": "Viesca",
	"037": "Villa Unión",
	"038": "Zaragoza",
}
var Niveles = map[string]string{
	"01": "Primero de primaria",
	"02": "Segundo de primaria",
	"03": "Tercero de primaria",
	"04": "Cuarto de primaria",
	"05": "Quinto de primaria",
	"06": "Sexto de primaria",
	"07": "Primero de secundaria",
	"08": "Segundo de secundaria",
	"09": "Tercero de secundaria",
}

var Asuntos = map[string]string{
	"01": "Inscripcion",
	"02": "Solicitar cambio de escuela",
	"03": "Reportar alguna situación",
	"04": "Otro...",
}
