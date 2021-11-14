package main

import (
	"log"
	"net/http"
	"person/api"

	_ "github.com/go-sql-driver/mysql"
)

func main() {

	router := api.MyRoutes()
	log.Println("Servidor en funcionamiento...")
	log.Fatal(http.ListenAndServe(":9000", router))
}
