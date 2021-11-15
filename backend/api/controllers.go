package api

import (
	"encoding/json"
	"fmt"
	"io/ioutil"
	"net/http"
	"person/database"
	models "person/models"

	"github.com/gorilla/mux"
)

func MyRoutes() *mux.Router {
	router := mux.NewRouter().StrictSlash(true)
	router.HandleFunc("/", GetAllTickets).Methods("GET")
	router.HandleFunc("/", CreateTicket).Methods("POST")
	router.HandleFunc("/ticket/{curp}", GetTicketBYCURP).Methods("GET")
	router.HandleFunc("/ticket/{curp}/{id}", UpdateTicket).Methods("PUT")
	router.HandleFunc("/ticket/{curp}/{id}", DeleteTicket).Methods("DELETE")

	return router
}

// function to insert a new ticket inside our database.
func CreateTicket(w http.ResponseWriter, r *http.Request) {
	w.Header().Set("Content-Type", "application/json")
	// Allowing CORS to any server requests.
	w.Header().Set("Access-Control-Allow-Origin", "*")
	// Specifying HTTP methods allowed.
	w.Header().Set("Access-Control-Allow-Methods", "GET")
	w.Header().Set("Access-Control-Allow-Headers", "Content-Type")

	requestBody, _ := ioutil.ReadAll(r.Body)
	var ticket models.Ticket

	json.Unmarshal(requestBody, &ticket)

	ticketDB, _ := database.GetByCurp(ticket.CURP)

	fmt.Println("personDB es: ", ticketDB)

	if ticketDB.CURP == "" {

		err := database.Insert(ticket)
		if err != nil {
			fmt.Println(err)
		}

		w.WriteHeader(http.StatusCreated)
		json.NewEncoder(w).Encode(ticket)

	} else {
		w.WriteHeader(http.StatusNotAcceptable)
		json.NewEncoder(w).Encode("ERROR: the user is already created with that curp")
	}

}

// function to obtain all tickets inside our database.
func GetAllTickets(w http.ResponseWriter, r *http.Request) {
	w.Header().Set("Content-Type", "application/json")
	// Allowing CORS to any server requests.
	w.Header().Set("Access-Control-Allow-Origin", "*")
	// Specifying HTTP methods allowed.
	w.Header().Set("Access-Control-Allow-Methods", "GET")
	w.Header().Set("Access-Control-Allow-Headers", "Content-Type")

	tickets, err := database.GetAllData()
	if err != nil {
		fmt.Println(err)
	}

	json.Marshal(tickets)
	json.NewEncoder(w).Encode(tickets)
}

// function to find a ticket by his curp.
func GetTicketBYCURP(w http.ResponseWriter, r *http.Request) {
	w.Header().Set("Content-Type", "application/json")
	// Allowing CORS to any server requests.
	w.Header().Set("Access-Control-Allow-Origin", "*")
	// Specifying HTTP methods allowed.
	w.Header().Set("Access-Control-Allow-Methods", "GET")
	w.Header().Set("Access-Control-Allow-Headers", "Content-Type")

	requestBody, _ := ioutil.ReadAll(r.Body)
	var ticket models.Ticket
	// get URL curp parameter
	curp := mux.Vars(r)["curp"]

	json.Unmarshal(requestBody, &ticket)
	ticketDB, err := database.GetByCurp(curp)
	if err != nil {
		fmt.Println(err)
	}

	if ticketDB.CURP == "" {
		w.WriteHeader(http.StatusNotFound)
		json.NewEncoder(w).Encode("Not found")

	} else {
		w.WriteHeader(http.StatusOK)
		json.NewEncoder(w).Encode(ticketDB)
	}

}

// function to update any ticket only using his curp.
func UpdateTicket(w http.ResponseWriter, r *http.Request) {
	w.Header().Set("Content-Type", "application/json")
	// Allowing CORS to any server requests.
	w.Header().Set("Access-Control-Allow-Origin", "*")
	// Specifying HTTP methods allowed.
	w.Header().Set("Access-Control-Allow-Methods", "GET")
	w.Header().Set("Access-Control-Allow-Headers", "Content-Type")

	// get URL curp parameter
	curp := mux.Vars(r)["curp"]
	id := mux.Vars(r)["id"]

	ticketDB, _ := database.GetByCurpAndID(id, curp)

	if ticketDB.CURP == "" {
		w.WriteHeader(http.StatusNotFound)
		json.NewEncoder(w).Encode("Not found")

	} else {
		requestBody, _ := ioutil.ReadAll(r.Body)
		var ticket models.Ticket

		json.Unmarshal(requestBody, &ticket)

		err := database.Update(ticket, id, curp)
		if err != nil {
			fmt.Println(err)
		}
		w.WriteHeader(http.StatusOK)
		json.NewEncoder(w).Encode(ticketDB)
	}
}

// function to delete ticket by his curp.
func DeleteTicket(w http.ResponseWriter, r *http.Request) {
	w.Header().Set("Content-Type", "application/json")
	// Allowing CORS to any server requests.
	w.Header().Set("Access-Control-Allow-Origin", "*")
	// Specifying HTTP methods allowed.
	w.Header().Set("Access-Control-Allow-Methods", "GET")
	w.Header().Set("Access-Control-Allow-Headers", "Content-Type")

	// get URL curp parameter
	curp := mux.Vars(r)["curp"]
	id := mux.Vars(r)["id"]

	err := database.Delete(curp, id)
	if err != nil {
		w.WriteHeader(http.StatusNotFound)
		json.NewEncoder(w).Encode("Not found")
	}

	w.WriteHeader(http.StatusAccepted)
	json.NewEncoder(w).Encode("Deleted succesfully")

}
