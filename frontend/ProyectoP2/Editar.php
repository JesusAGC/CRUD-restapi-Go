<!DOCTYPE html>

  <head>
  <link rel="stylesheet" type="text/css" href="css/mystyle.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="http://localhost/ProyectoP2/Registro.php"
                >Insertar </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="http://localhost:9000/%22%3EActualizar"> </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="http://localhost/ProyectoP2/Borrado.php"
              >Eliminar</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="http://localhost/ProyectoP2/Consultar.php"
                >Consultar por Curp y número de ticket</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link" href="http://localhost/ProyectoP2/Editar.php"
                >Editar <span class="sr-only">(current) </span></a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link" href="http://localhost/ProyectoP2/login.php#">Cerrar Sesión</a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
    <title>Edición de turno</title>
    <style>
body {
    background-color: #e2e2e0;
}
</style>
  </head>

  <body>
    
<div id="contenedor">
<div>
      <img src="img/logo_sedu.png" alt="logo" width="100" height="100" style="float: left;">
      <h1 style="position: relative; text-align:center; top:25px; bottom:50px;">Editar Turno</h1>
    </div>
    <form action="#" method="post" onsubmit="return validar();" accept-charset="utf-8">
      <br>
      <br>
      <table>
        <tr>
        <td colspan="1">
      <label>ID del turno</label>
      <input type="text" min="0" name="f_id" id="f_id" placeholder="Ingrese ID del turno" required="true" oninvalid="this.setCustomValidity('Debe ingresar ID del turno');" oninput="setCustomValidity('');">
      </td>
      <td>
      <label>CURP del turno</label>
      <input type="text" min="0" name="f_curpo" id="f_curpo" placeholder="Ingrese CURP del turno" required="true" oninvalid="this.setCustomValidity('Debe ingresar CURP del turno');" oninput="setCustomValidity('');">
      </td>
      </table>
      <table>
        <tr>
          <td colspan="2">

            <label>Nombre completo de quien realizará el trámite:</label>
            <input type="text" name="f_nombrec" id="f_nombrec" placeholder="Ingrese nombre completo" required="true" oninvalid="this.setCustomValidity('Debe ingresar su nombre');" oninput="setCustomValidity('');">
          </td>
          <td>
            <label>CURP:</label>
            <input type="text" name="f_curp" id="f_curp" placeholder="Ingrese Curp" required="true" oninvalid="this.setCustomValidity('Debe ingresar su CURP');" oninput="setCustomValidity('');" maxlength="18">
          </td>
        </tr>
        <tr>
          <td>
            <label>Nombre:</label>
            <input type="text" name="f_nombre" id="f_nombre" placeholder="Ingrese nombre" required="true" oninvalid="this.setCustomValidity('Debe ingresar su nombre');" oninput="setCustomValidity('');">
          </td>
          <td>
            <label>Paterno:</label>
            <input type="text" name="f_paterno" id="f_paterno" placeholder="Ingrese apellido paterno" required="true" oninvalid="this.setCustomValidity('Debe ingresar su apellido paterno');" oninput="setCustomValidity('');">
          </td>
          <td>
            <label>Materno:</label>
            <input type="text" name="f_materno" id="f_materno" placeholder="Ingrese apellido materno" oninvalid="this.setCustomValidity('Debe ingresar su apellido materno');" oninput="setCustomValidity('');">
          </td>
        </tr>
        <tr>
          <td>
            <label>Teléfono:</label>
            <input type="tel" name="f_telefono" id="f_telefono"  placeholder="Ingrese teléfono" required="true" oninvalid="this.setCustomValidity('Debe ingresar su celular. Ingrese los 10 dígitos que son parte del número sin espacios, guiones o paréntesis.');" oninput="setCustomValidity('');" minlength="10" maxlength="10">
          </td>
          <td>
            <label>Celular:</label>
            <input type="tel" name="f_celular" id="f_celular" placeholder="Ingrese celular" required="true" oninvalid="this.setCustomValidity('Debe ingresar su celular. Ingrese los 10 dígitos que son parte del número sin espacios, guiones o paréntesis.');" oninput="setCustomValidity('');" minlength="10" maxlength="10">
          </td>
          <td>
            <label>E-mail:</label>
            <input type="email" name="f_correo" id="f_correo" placeholder="Ingrese correo" required="true" oninvalid="this.setCustomValidity('Debe ingresar su email de manera correcta');" oninput="setCustomValidity('');">
          </td>
        </tr>
        <tr>
          <td colspan="3">
            <label>¿Nivel al que desea ingresar o que ya cursa el alumno?</label>
            <select name="f_nivel" id="f_nivel" required="true" oninvalid="this.setCustomValidity('Debe ingresar curso');" oninput="setCustomValidity('');">
              <option value=""> Seleccione: </option>
              <option value="01"> 1 </option>
              <option value="02"> 2 </option>
              <option value="03"> 3 </option>
              <option value="04"> 4 </option>
              <option value="05"> 5 </option>
              <option value="06"> 6 </option>
              <option value="07"> 1 Secundaria</option>
              <option value="08"> 2 Secundaria</option>
              <option value="09"> 3 Secundaria</option>
            </select>
          </td>

        </tr>
        <tr>
          <td colspan="3">
            <label>Municipio donde desea estudie el alumno:</label>
            <select name="f_municipio" id="f_municipio" required="true" oninvalid="this.setCustomValidity('Debe seleccionar municipio');" oninput="setCustomValidity('');">
              <option value=""> Seleccione: </option>
              <option value="01">  Abasolo </option>
              <option value="02">  Acuña </option>
    <option value="03">  Allende </option>
    <option value="04">  Arteaga </option>
    <option value="05">  Candela </option>
    <option value="06">  Castaños </option>
    <option value="07">  Cuatro Ciénegas </option>
    <option value="08">  Escobedo </option>
    <option value="09">  Francisco I. Madero </option>
    <option value="010"> Frontera </option>
    <option value="011"> General Cepeda </option>
    <option value="012"> Guerrero </option>
    <option value="013"> Hidalgo </option>
    <option value="014"> Jiménez </option>
    <option value="015"> Juárez </option>
    <option value="016"> Lamadrid </option>
    <option value="017"> Matamoros </option>
    <option value="018"> Monclova </option>
    <option value="019"> Morelos </option>
    <option value="020"> Múzquiz </option>
    <option value="021"> Nadadores </option>
    <option value="022"> Nava </option>
    <option value="023"> Ocampo </option>
    <option value="024"> Parras </option>
    <option value="025"> Piedras Negras </option>
    <option value="026"> Progreso </option>
    <option value="027"> Ramos Arizpe </option>
    <option value="028"> Sabinas </option>
    <option value="029"> Sacramento </option>
    <option value="030"> Saltillo </option>
    <option value="031"> San Buenaventura </option>
    <option value="032"> San Juan de Sabinas </option>
    <option value="033"> San Pedro </option>
    <option value="034"> Sierra Mojada </option>
    <option value="035"> Torreón </option>
    <option value="036"> Viesca </option>
    <option value="037"> Villa Unión </option>
    <option value="038"> Zaragoza </option>
            </select>
          </td>
        </tr>
        <tr>
          <td colspan="3">
            <label>Seleccione el asunto que va a tratar:</label>
            <select name="f_asunto" id="f_asunto" required="true" oninvalid="this.setCustomValidity('Debe seleccionar asunto a tratar');" oninput="setCustomValidity('');">
              <option value=""> Seleccione: </option>
              <option value="01"> Inscripción </option>
              <option value="02"> Solicitar cambio de escuela </option>
              <option value="03"> Reportar alguna situación </option>
              <option value="04"> Otro... </option>
            </select>
          </td>

        </tr>
        <tr>

          <td colspan="3" style="text-align: center;">
            <input type="submit" name="turno_submit" value="Guardar Cambios">

          </td>
        </tr>

      </table>

    </form>

    <?php
  include "class/requests.php";

    if (isset($_POST['turno_submit'])) {
      $ID = isset($_POST["f_id"]) ? $ID = strtoupper($_POST["f_id"]) : $ID = null;
      $nombrec = isset($_POST["f_nombrec"]) ? $nombrec = strtoupper($_POST["f_nombrec"]) : $nombrec = null;
      $curp = isset($_POST["f_curp"]) ? $curp = strtoupper($_POST["f_curp"]) : $curp = null;
      $nombre = isset($_POST["f_nombre"]) ? $nombre = strtoupper($_POST["f_nombre"]) : $nombre = null;
      $paterno = isset($_POST["f_paterno"]) ? $paterno = strtoupper($_POST["f_paterno"]) : $paterno = null;
      $materno = isset($_POST["f_materno"]) ? $materno = strtoupper($_POST["f_materno"]) : $materno = null;
      $telefono = isset($_POST["f_telefono"]) ? $telefono = strtoupper($_POST["f_telefono"]) : $telefono = null;
      $celular = isset($_POST["f_celular"]) ? $celular = strtoupper($_POST["f_celular"]) : $celular = null;
      $mail = isset($_POST["f_correo"]) ? $mail = strtoupper($_POST["f_correo"]) : $mail = null;
      $nivel = isset($_POST["f_nivel"]) ? $nivel = strtoupper($_POST["f_nivel"]) : $nivel = null;
      $municipio = isset($_POST["f_municipio"]) ? $municipio = strtoupper($_POST["f_municipio"]) : $municipio = null;
      $asunto = isset($_POST["f_asunto"]) ? $asunto = strtoupper($_POST["f_asunto"]) : $asunto = null;

      $curpo = isset($_POST["f_curpo"]) ? $curpo = strtoupper($_POST["f_curpo"]) : $curpo = null;

      $ticket['NombreCompleto'] = $nombrec;
      $ticket['CURP'] = $curp;
      $ticket['Nombre'] = $nombre;
      $ticket['Paterno'] = $paterno;
      $ticket['Materno'] = $materno;
      $ticket['Telefono'] = $telefono;
      $ticket['Celular'] = $celular;
      $ticket['Email'] = $mail;
      $ticket['Nivel'] = $nivel;
      $ticket['Municipio'] = $municipio;
      $ticket['Asunto'] = $asunto;
      
      $req = new request();
      $editado = $req -> update_data($curpo,$ID,$ticket);
      if ($editado == "Not found") {
        
        $msg =  "No existe el registro, verifique el ID.";
        echo "<script type='text/javascript'>alert('$msg');</script>";
      } elseif ($editado['CURP'] = $curp) {

        $msg =  "Se actualizó el registro de manera correcta";
        echo "<script type='text/javascript'>alert('$msg');</script>";
      } else {

        $msg =  "No se pudo actualizar el registro";
        echo "<script type='text/javascript'>alert('$msg');</script>";
      }

    }

    ?>
  </body>
</div>
<script src="javascript/funciones.js"></script>

</html>