<!DOCTYPE html>
<head>
<link rel="stylesheet" type="text/css" href="css/mystyle.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<div>
      <nav id="my-navbar" class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Ticket de turno</a>
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ">
            <li class="nav-item active">
              <a class="nav-link" href="http://localhost/ProyectoP2/Registro.php"
                >Insertar </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="http://localhost:9000/%22%3EActualizar"> </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="http://localhost/ProyectoP2/Borrado.php"
              >Eliminar <span class="sr-only">(current) </span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="http://localhost/ProyectoP2/Consultar.php"
                >Consultar por Curp y número de ticket</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link" href="http://localhost/ProyectoP2/Editar.php"
                >Editar</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link" href="http://localhost/ProyectoP2/login.php#">Cerrar Sesión</a>
            </li>
          </ul>
        </div>
      </nav>
    </div>

    <title>Borrado</title>
    <style>
body {
    background-color: #e2e2e0;
}
</style>
</head>

<body>
<div id="contenedor">
    <br>
<h1 style="text-align: center;" >Borrado de turnos</h1>
    <br>
    <center>
        <form action="" method="GET">
            <input type="number" min="1" name="id" placeholder="ID del registro" required>
            <input type="text" minlength="18" maxlength="18" name="curp" placeholder="CURP del registro" required>
            <button name="action" type="submit" value="Eliminar">Eliminar registro</button>
        </form>
        <br>
        </DIV>
    </body>
        <?php
        include "class/requests.php";

        if (isset($_GET['action'])){
        
        $req = new request();

        $id = $_GET['id'];
        $curp = $_GET['curp'];
        if (isset($_GET['action'])) {

            $borrado = $req->delete_data($curp, $id);
            if ($borrado == "Deleted succesfully") {
                $msg = "El registro fue eliminado correctamente.";
                echo "<script type='text/javascript'>alert('$msg');</script>";
            } 
            elseif ($borrado == "Not found") {
                $msg = "El registro que se quiere borrar no existe, verifique los datos.";
                echo "<script type='text/javascript'>alert('$msg');</script>";
            } 
            else {
                $msg = "El registro no pudo ser eliminado.";
                echo "<script type='text/javascript'>alert('$msg');</script>";
                
            }
        }
    }
?>