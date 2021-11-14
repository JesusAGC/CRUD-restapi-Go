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
	router.HandleFunc("/", GetAllPersons).Methods("GET")
	router.HandleFunc("/", CreatePerson).Methods("POST")
	router.HandleFunc("/person/{curp}", GetPersonByCurp).Methods("GET")
	router.HandleFunc("/person/{curp}", UpdatePerson).Methods("PUT")
	router.HandleFunc("/person/{curp}", DeletePerson).Methods("DELETE")

	return router
}

// function to insert a new person inside our database.
func CreatePerson(w http.ResponseWriter, r *http.Request) {
	w.Header().Set("Content-Type", "application/json")
	// Allowing CORS to any server requests.
	w.Header().Set("Access-Control-Allow-Origin", "*")
	// Specifying HTTP methods allowed.
	w.Header().Set("Access-Control-Allow-Methods", "GET")
	w.Header().Set("Access-Control-Allow-Headers", "Content-Type")

	requestBody, _ := ioutil.ReadAll(r.Body)
	var person models.Person

	json.Unmarshal(requestBody, &person)

	personDB, _ := database.GetByCurp(person.Curp)

	fmt.Println("personDB es: ", personDB)

	if personDB.Curp == "" {

		err := database.Insert(person)
		if err != nil {
			fmt.Println(err)
		}

		w.WriteHeader(http.StatusCreated)
		json.NewEncoder(w).Encode(person)

	} else {
		w.WriteHeader(http.StatusNotAcceptable)
		json.NewEncoder(w).Encode("ERROR: the user is already created with that curp")
	}

}

// function to obtain all persons inside our database.
func GetAllPersons(w http.ResponseWriter, r *http.Request) {
	w.Header().Set("Content-Type", "application/json")
	// Allowing CORS to any server requests.
	w.Header().Set("Access-Control-Allow-Origin", "*")
	// Specifying HTTP methods allowed.
	w.Header().Set("Access-Control-Allow-Methods", "GET")
	w.Header().Set("Access-Control-Allow-Headers", "Content-Type")

	persons, err := database.GetAllData()
	if err != nil {
		fmt.Println(err)
	}

	json.Marshal(persons)
	json.NewEncoder(w).Encode(persons)
}

// function to find a person by his curp.
func GetPersonByCurp(w http.ResponseWriter, r *http.Request) {
	w.Header().Set("Content-Type", "application/json")
	// Allowing CORS to any server requests.
	w.Header().Set("Access-Control-Allow-Origin", "*")
	// Specifying HTTP methods allowed.
	w.Header().Set("Access-Control-Allow-Methods", "GET")
	w.Header().Set("Access-Control-Allow-Headers", "Content-Type")

	requestBody, _ := ioutil.ReadAll(r.Body)
	var person models.Person
	// get URL curp parameter
	curp := mux.Vars(r)["curp"]

	json.Unmarshal(requestBody, &person)
	personDB, err := database.GetByCurp(curp)
	if err != nil {
		fmt.Println(err)
	}

	if personDB.Curp == "" {
		w.WriteHeader(http.StatusNotFound)
		json.NewEncoder(w).Encode("Not found")

	} else {
		w.WriteHeader(http.StatusOK)
		json.NewEncoder(w).Encode(personDB)
	}

}

// function to update any person only using his curp.
func UpdatePerson(w http.ResponseWriter, r *http.Request) {
	w.Header().Set("Content-Type", "application/json")
	// Allowing CORS to any server requests.
	w.Header().Set("Access-Control-Allow-Origin", "*")
	// Specifying HTTP methods allowed.
	w.Header().Set("Access-Control-Allow-Methods", "GET")
	w.Header().Set("Access-Control-Allow-Headers", "Content-Type")

	// get URL curp parameter
	curp := mux.Vars(r)["curp"]

	personDB, _ := database.GetByCurp(curp)

	if personDB.Curp == "" {
		w.WriteHeader(http.StatusNotFound)
		json.NewEncoder(w).Encode("Not found")

	} else {
		requestBody, _ := ioutil.ReadAll(r.Body)
		var person models.Person

		json.Unmarshal(requestBody, &person)

		err := database.Update(person, curp)
		if err != nil {
			fmt.Println(err)
		}
		w.WriteHeader(http.StatusOK)
		json.NewEncoder(w).Encode(personDB)
	}
}

// function to delete a person by his curp.
func DeletePerson(w http.ResponseWriter, r *http.Request) {
	w.Header().Set("Content-Type", "application/json")
	// Allowing CORS to any server requests.
	w.Header().Set("Access-Control-Allow-Origin", "*")
	// Specifying HTTP methods allowed.
	w.Header().Set("Access-Control-Allow-Methods", "GET")
	w.Header().Set("Access-Control-Allow-Headers", "Content-Type")

	// get URL curp parameter
	curp := mux.Vars(r)["curp"]

	err := database.Delete(curp)
	if err != nil {
		w.WriteHeader(http.StatusNotFound)
		json.NewEncoder(w).Encode("Not found")
	}

	w.WriteHeader(http.StatusAccepted)
	json.NewEncoder(w).Encode("Deleted succesfully")

}
