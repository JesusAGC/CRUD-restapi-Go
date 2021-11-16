package api

import (
	"bytes"
	"encoding/gob"
	"encoding/json"
	"fmt"
	"io/ioutil"
	"net/http"
	"person/database"
	models "person/models"
	"strings"

	"github.com/gorilla/mux"
	"github.com/gorilla/sessions"
	"golang.org/x/crypto/bcrypt"
)

var store = sessions.NewCookieStore([]byte("t0p-s3cr3t"))

func MyRoutes() *mux.Router {
	router := mux.NewRouter().StrictSlash(true)
	router.HandleFunc("/", GetAllTickets).Methods("GET")
	router.HandleFunc("/", CreateTicket).Methods("POST")
	router.HandleFunc("/ticket/{curp}", GetTicketByCURP).Methods("GET")
	router.HandleFunc("/pdf/{curp}/{id}", GetPDF).Methods("GET")
	router.HandleFunc("/ticket/{curp}/{id}", UpdateTicket).Methods("PUT")
	router.HandleFunc("/ticket/{curp}/{id}", DeleteTicket).Methods("DELETE")
	// router.HandleFunc("/logout", loginGetHandler).Methods("GET")
	router.HandleFunc("/login", LoginPostHandler).Methods("POST")
	//router.HandleFunc("/login", LoginGetHandler).Methods("GET")
	router.HandleFunc("/logout", logout).Methods("GET")
	router.HandleFunc("/register", RegisterPostHandler).Methods("POST")
	//router.HandleFunc("/register", RegisterGetHandler).Methods("GET")
	// router.HandleFunc("/test", testGetHandler).Methods("GET")

	// router.HandleFunc("/secret", secret).Methods("GET")

	return router
}

// function to insert a new ticket inside our database.
func CreateTicket(w http.ResponseWriter, r *http.Request) {
	// first check if the session exists and if don't redirect to login page.
	session, _ := store.Get(r, "session")
	_, ok := session.Values["username"]
	if !ok {
		http.Redirect(w, r, "/login", http.StatusFound)
		return
	}
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

	fmt.Println("CURP: " + ticket.CURP)

	fmt.Println("personDB es: ", ticketDB)

	if ticketDB == nil {

		err := database.Insert(ticket)
		if err != nil {
			fmt.Println(err)
		}

		w.WriteHeader(http.StatusCreated)
		json.NewEncoder(w).Encode(ticket)
		fmt.Print("Se guardo el ticket")

	} else if ticketDB[0].CURP == ticket.CURP {
		err := database.Insert(ticket)
		if err != nil {
			fmt.Println(err)
		}
		w.WriteHeader(http.StatusCreated)
		json.NewEncoder(w).Encode(ticket)
		fmt.Print("Curp ya registrado, se pidio otro ticket")

	} else {
		w.WriteHeader(http.StatusNotAcceptable)
		json.NewEncoder(w).Encode("ERROR: the ticket is already created")
	}

}

// function to obtain all tickets inside our database.
func GetAllTickets(w http.ResponseWriter, r *http.Request) {
	session, _ := store.Get(r, "session")
	_, ok := session.Values["username"]
	if !ok {
		http.Redirect(w, r, "/login", http.StatusFound)
		return
	}
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
func GetTicketByCURP(w http.ResponseWriter, r *http.Request) {
	session, _ := store.Get(r, "session")
	_, ok := session.Values["username"]
	if !ok {
		http.Redirect(w, r, "/login", http.StatusFound)
		return
	}
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

	if ticketDB == nil {
		w.WriteHeader(http.StatusNotFound)
		json.NewEncoder(w).Encode("Not found")

	} else {
		w.WriteHeader(http.StatusOK)
		json.NewEncoder(w).Encode(ticketDB)
	}

}

// function to update any ticket only using his curp.
func UpdateTicket(w http.ResponseWriter, r *http.Request) {
	session, _ := store.Get(r, "session")
	_, ok := session.Values["username"]
	if !ok {
		http.Redirect(w, r, "/login", http.StatusFound)
		return
	}
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
	session, _ := store.Get(r, "session")
	_, ok := session.Values["username"]
	if !ok {
		http.Redirect(w, r, "/login", http.StatusFound)
		return
	}
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
	} else {
		w.WriteHeader(http.StatusAccepted)
		json.NewEncoder(w).Encode("Deleted succesfully")
	}

}

func GetPDF(w http.ResponseWriter, r *http.Request) {
	w.Header().Set("Content-Type", "application/json")
	// Allowing CORS to any server requests.
	w.Header().Set("Access-Control-Allow-Origin", "*")
	// Specifying HTTP methods allowed.
	w.Header().Set("Access-Control-Allow-Methods", "GET")
	w.Header().Set("Access-Control-Allow-Headers", "Content-Type")
	curp := mux.Vars(r)["curp"]
	id := mux.Vars(r)["id"]
	ticketdb, err := database.GetByCurpAndID(id, curp)
	if err != nil {
		w.WriteHeader(http.StatusNotFound)
		json.NewEncoder(w).Encode("Not found")
	} else {
		data, err3 := CreatePDF(ticketdb)
		if err3 != nil {
			w.WriteHeader(http.StatusNoContent)
			json.NewEncoder(w).Encode("Encode failure")
		} else {
			w.WriteHeader(http.StatusAccepted)
			json.NewEncoder(w).Encode(data)
		}

	}
}

func HashPassword(password string) (string, error) {
	bytes, err := bcrypt.GenerateFromPassword([]byte(password), 14)
	return string(bytes), err
}

func RegisterPostHandler(w http.ResponseWriter, r *http.Request) {
	requestBody, err := ioutil.ReadAll(r.Body)
	if err != nil {
		fmt.Println(err.Error())
	}

	var user models.User
	json.Unmarshal(requestBody, &user)

	// if user.Username != "admin" && user.Password != "12345678" {
	//     w.WriteHeader(http.StatusNotAcceptable)
	//     json.NewEncoder(w).Encode("The credentials are incorrect")
	//     return
	// }

	session, err := store.Get(r, "session")
	session.Values["username"] = user.Username
	// checar esto
	hash, _ := HashPassword(user.Password)
	fmt.Println(hash)
	session.Values["password"] = hash
	session.Save(r, w)
	http.Redirect(w, r, "/login", http.StatusFound)
}

func GetBytes(key interface{}) ([]byte, error) {
	var buf bytes.Buffer
	enc := gob.NewEncoder(&buf)
	err := enc.Encode(key)
	if err != nil {
		return nil, err
	}
	return buf.Bytes(), nil
}
func CheckPasswordHash(password, hash string) bool {
	err := bcrypt.CompareHashAndPassword([]byte(hash), []byte(password))
	return err == nil
}

func LoginPostHandler(w http.ResponseWriter, r *http.Request) {
	requestBody, err := ioutil.ReadAll(r.Body)

	var user models.User
	json.Unmarshal(requestBody, &user)

	session, err := store.Get(r, "session")
	hash := session.Values["password"]
	hashArr, err := GetBytes(hash)
	if err != nil {
		fmt.Println("error convirtiendo")
		return
	}
	// newBash := hash.Bytes()
	// s := string(hash)
	s2 := string(hashArr)
	newHash := s2[4:]
	newHash = strings.TrimSpace(newHash)
	// fmt.Println("hash string es: ", s)
	// fmt.Println("el newHash srting es:\n", newHash)
	// fmt.Println("password ingresada:\n", user.Password)
	match := CheckPasswordHash(user.Password, newHash)
	fmt.Println("Match:   ", match)

	if !match {
		fmt.Println("Error: not found")
		json.NewEncoder(w).Encode("Error: ingrese de nuevo las credenciales")
		return
	}

	usernameCookie := session.Values["username"]
	usernameCookie = usernameCookie.(string)

	if usernameCookie != user.Username {
		fmt.Println("Error: not found")
		json.NewEncoder(w).Encode("Error: ingrese de nuevo las credenciales")
		return
	}

	session.Values["username"] = user.Username
	// session.Values["password"] = user.Password
	session.Save(r, w)
	http.Redirect(w, r, "/", http.StatusFound)
}

func logout(w http.ResponseWriter, r *http.Request) {
	session, _ := store.Get(r, "session")
	// removing session
	session.Options.MaxAge = -1
	err := session.Save(r, w)
	if err != nil {
		fmt.Println("failed to delete session", err)
		return
	}

	http.Redirect(w, r, "http://localhost:80/ProyectoP2/login.php", http.StatusFound)
}
