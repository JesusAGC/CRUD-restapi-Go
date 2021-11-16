<link rel="stylesheet" type="text/css" href="css/loginstyle.css">
<?php

include "class/requests.php";
$req = new request();

$nombrec = isset($_POST["f_nombrec"]) ? $nombrec=strtoupper($_POST["f_nombrec"]) : $nombrec=null;
$curp = isset($_POST["f_curp"]) ? $curp=strtoupper($_POST["f_curp"]) : $curp=null;
$nombre = isset($_POST["f_nombre"]) ? $nombre=strtoupper($_POST["f_nombre"]) : $nombre=null;
$paterno = isset($_POST["f_paterno"]) ? $paterno=strtoupper($_POST["f_paterno"]) : $paterno=null;
$materno = isset($_POST["f_materno"]) ? $materno=strtoupper($_POST["f_materno"]) : $materno=null;
$telefono = isset($_POST["f_telefono"]) ? $telefono=strtoupper($_POST["f_telefono"]) : $telefono=null;
$celular = isset($_POST["f_celular"]) ? $celular=strtoupper($_POST["f_celular"]) : $celular=null;
$mail = isset($_POST["f_correo"]) ? $mail=strtoupper($_POST["f_correo"]) : $mail=null;
$nivel = isset($_POST["f_nivel"]) ? $nivel=strtoupper($_POST["f_nivel"]) : $nivel=null;
$municipio = isset($_POST["f_municipio"]) ? $municipio=strtoupper($_POST["f_municipio"]) : $municipio=null;
$asunto = isset($_POST["f_asunto"]) ? $asunto=strtoupper($_POST["f_asunto"]) : $asunto=null;


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

$Insertado = $req->insert_data($ticket);
if ($Insertado != "ERROR: the user is already created with that curp"){
    print_r("<br>");
    print_r("Se guardó: el registro");
    $data = $req -> request_by_curp($ticket['CURP']);
    $new_id = end($data)['Id'];
    $req ->Get_PDF($ticket['CURP'],$new_id);
}
else {
    print_r("<br>");
    print_r("No se insertó el registro");
}
?>
<html>
    <button <a href = "ticket.pdf" download> Descargue su comprobante, de click aqui</a></button>
</html>
