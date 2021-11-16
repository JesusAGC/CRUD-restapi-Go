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
          aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link" href="http://localhost/ProyectoP2/Registro.php"> Insertar </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="http://localhost:9000/%22%3EActualizar"> </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="http://localhost/ProyectoP2/Borrado.php"> Eliminar</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="http://localhost/ProyectoP2/Consultar.php"> Consultar por Curp y número de ticket <span class="sr-only">(current) </span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="http://localhost/ProyectoP2/Editar.php"> Editar</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="http://localhost/ProyectoP2/login.php#">Cerrar Sesión</a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
    <title>Consultas</title>
    <style>
body {
    background-color: #e2e2e0;
}
</style>
</head>


<body>
<div id="contenedor">
<h1 style="text-align: center;" >Consulta de turnos</h1>
    <h4 style="text-align: center;"> Nota: Aquí se puede consultar la existencia de registros.</h4>
        <br>
        <center>
            <form action="#" method="GET">
                <input type="text" minlength="18" maxlength="18" name="curp" placeholder="CURP del registro" required>
                <button name="action" type="submit" value="Consultar_ID">Consultar Ticket</button>
            </form>
            <br>
            <form action="#" method="GET">
                <button name="action" type="submit" value="Traer_todos">Traer todos los registros</button>
            </form>
            <?php
            include "class/requests.php";

            $req = new request();


            if (isset($_GET['action'])){
                $action = $_GET['action'];
            if ($action == "Consultar_ID") {
                $curp = $_GET['curp'];
                $ticket = $req -> request_by_curp($curp);
                if ($ticket != "Not found") {
                    echo "<table id='tabla' border='2'><br>";
                    echo "<tr>";
                    echo "<th>Número</th>";
                    echo "<th>Nombre Completo</th>";
                    echo "<th>CURP</th>";
                    echo "<th>Nombre</th>";
                    echo "<th>Paterno</th>";
                    echo "<th>Materno</th>";
                    echo "<th>Telefono</th>";
                    echo "<th>Celular</th>";
                    echo "<th>Email</th>";
                    echo "<th>Nivel</th>";
                    echo "<th>Municipio</th>";
                    echo "<th>Asunto</th>";
                    echo "</tr>";
                    for ($i = 0; $i < count($ticket); $i++) {
                        echo "<tr>";
                        echo "<td>" . $ticket[$i]['Id']            . "</td>";
                        echo "<td>" . $ticket[$i]['NombreCompleto'] . "</td>";
                        echo "<td>" . $ticket[$i]['CURP']          . "</td>";
                        echo "<td>" . $ticket[$i]['Nombre']        . "</td>";
                        echo "<td>" . $ticket[$i]['Paterno']       . "</td>";
                        echo "<td>" . $ticket[$i]['Materno']       . "</td>";
                        echo "<td>" . $ticket[$i]['Telefono']      . "</td>";
                        echo "<td>" . $ticket[$i]['Celular']       . "</td>";
                        echo "<td>" . $ticket[$i]['Email']         . "</td>";
                        echo "<td>" . $ticket[$i]['Nivel']         . "</td>";
                        echo "<td>" . $req ->get_municipio($ticket[$i]['Municipio'])     . "</td>";
                        echo "<td>" . $req ->get_asunto($ticket[$i]['Asunto'])         . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<br>";
                    echo "No existe el registro";
                }
            } elseif ($action == "Traer_todos") {
                $list = $req->request_all_data();
                echo "<table id='tabla' border='2'><br>";
                echo "<tr>";
                echo "<th>Número</th>";
                echo "<th>Nombre Completo</th>";
                echo "<th>CURP</th>";
                echo "<th>Nombre</th>";
                echo "<th>Paterno</th>";
                echo "<th>Materno</th>";
                echo "<th>Telefono</th>";
                echo "<th>Celular</th>";
                echo "<th>Email</th>";
                echo "<th>Nivel</th>";
                echo "<th>Municipio</th>";
                echo "<th>Asunto</th>";
                echo "</tr>";

                for ($i = 0; $i < count($list); $i++) {
                    echo "<tr>";
                    echo "<td>" . $list[$i]['Id']            . "</td>";
                    echo "<td>" . $list[$i]['NombreCompleto'] . "</td>";
                    echo "<td>" . $list[$i]['CURP']          . "</td>";
                    echo "<td>" . $list[$i]['Nombre']        . "</td>";
                    echo "<td>" . $list[$i]['Paterno']       . "</td>";
                    echo "<td>" . $list[$i]['Materno']       . "</td>";
                    echo "<td>" . $list[$i]['Telefono']      . "</td>";
                    echo "<td>" . $list[$i]['Celular']       . "</td>";
                    echo "<td>" . $list[$i]['Email']         . "</td>";
                    echo "<td>" . $list[$i]['Nivel']         . "</td>";
                    echo "<td>" . $req ->get_municipio($list[$i]['Municipio'])     . "</td>";
                    echo "<td>" . $req ->get_asunto($list[$i]['Asunto'])       . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
        }
            ?>

        </center>

        </DIV>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
