<?php
include 'class/requests.php';
$req = new request();
//$data = $req -> request_all_data();
//print_r($data);
// $dude = $req -> request_by_curp("HOIU871004HOCWMPD7");
// print_r($dude);

$datos['NombreCompleto'] = "Joe biden gaming";
$datos['CURP'] = "GAMINGCURP";
$datos['Nombre'] = "JOE";
$datos['Paterno'] = "Biden";
$datos['Materno'] = "mama";
$datos['Telefono'] = "11111111111";
$datos['Celular'] = "2222222222";
$datos['Email'] = "n@mail.com";
$datos['Nivel'] = "01";
$datos['Municipio'] = "01";
$datos['Asunto'] = "01";

$result = $req ->insert_data($datos);
$data = $req -> request_by_curp($datos['CURP']);
$new_id = end($data)['Id'];
echo $new_id;
$req ->Get_PDF($datos['CURP'],$new_id);



// $result = $req ->delete_data("GAMINGCURP","204");
// print_r($result);


// $upda['NombreCompleto'] = "donnie gming";
// $upda['CURP'] = "LOSINGSHIT";
// $upda['Nombre'] = "Donald";
// $upda['Paterno'] = "West";
// $upda['Materno'] = "Trump";
// $upda['Telefono'] = "11111111111";
// $upda['Celular'] = "2222222222";
// $upda['Email'] = "n@mail.com";
// $upda['Nivel'] = "01";
// $upda['Municipio'] = "01";
// $upda['Asunto'] = "01";

// $result = $req ->update_data("LOSINGSHIT","101",$upda);
// print_r($result);

            // $action = "Consultar_ID";

            // if ($action == "Consultar_ID") {
            //     $curp = 'ZXQL280630MASDWTK6';
            //     $ticket = $req -> request_by_curp($curp);
            //     print_r($ticket);
            //     if ($ticket != "Not found") {
            //         echo "<table id='tabla' border='2'><br>";
            //         echo "<tr>";
            //         echo "<th>Número</th>";
            //         echo "<th>Nombre Completo</th>";
            //         echo "<th>CURP</th>";
            //         echo "<th>Nombre</th>";
            //         echo "<th>Paterno</th>";
            //         echo "<th>Materno</th>";
            //         echo "<th>Telefono</th>";
            //         echo "<th>Celular</th>";
            //         echo "<th>Email</th>";
            //         echo "<th>Nivel</th>";
            //         echo "<th>Municipio</th>";
            //         echo "<th>Asunto</th>";
            //         echo "</tr>";
            //         echo "<tr>";
            //         echo "<td>" . $ticket['Id'] . "</td>";
            //         echo "<td>" . $ticket['NombreCompleto'] . "</td>";
            //         echo "<td>" . $ticket['CURP'] . "</td>";
            //         echo "<td>" . $ticket['Nombre'] . "</td>";
            //         echo "<td>" . $ticket['Paterno'] . "</td>";
            //         echo "<td>" . $ticket['Materno'] . "</td>";
            //         echo "<td>" . $ticket['Telefono'] . "</td>";
            //         echo "<td>" . $ticket['Celular'] . "</td>";
            //         echo "<td>" . $ticket['Email'] . "</td>";
            //         echo "<td>" . $ticket['Nivel'] . "</td>";
            //         echo "<td>" . $ticket['Municipio'] . "</td>";
            //         echo "<td>" . $ticket['Asunto'] . "</td>";
            //         echo "</tr>";
            //         echo "</table>";
            //     } else {
            //         echo "<br>";
            //         echo "No existe el registro";
            //     }
            // } elseif ($action == "Traer_todos") {
            //     $list = $req->request_all_data();
            //     echo "<table id='tabla' border='2'><br>";
            //     echo "<tr>";
            //     echo "<th>Número</th>";
            //     echo "<th>Nombre Completo</th>";
            //     echo "<th>CURP</th>";
            //     echo "<th>Nombre</th>";
            //     echo "<th>Paterno</th>";
            //     echo "<th>Materno</th>";
            //     echo "<th>Telefono</th>";
            //     echo "<th>Celular</th>";
            //     echo "<th>Email</th>";
            //     echo "<th>Nivel</th>";
            //     echo "<th>Municipio</th>";
            //     echo "<th>Asunto</th>";
            //     echo "</tr>";

            //     for ($i = 1; $i < count($list); $i++) {
            //         echo "<tr>";
            //         echo "<td>" . $list[$i]['Id']            . "</td>";
            //         echo "<td>" . $list[$i]['NombreCompleto'] . "</td>";
            //         echo "<td>" . $list[$i]['CURP']          . "</td>";
            //         echo "<td>" . $list[$i]['Nombre']        . "</td>";
            //         echo "<td>" . $list[$i]['Paterno']       . "</td>";
            //         echo "<td>" . $list[$i]['Materno']       . "</td>";
            //         echo "<td>" . $list[$i]['Telefono']      . "</td>";
            //         echo "<td>" . $list[$i]['Celular']       . "</td>";
            //         echo "<td>" . $list[$i]['Email']         . "</td>";
            //         echo "<td>" . $list[$i]['Nivel']         . "</td>";
            //         echo "<td>" . $list[$i]['Municipio']     . "</td>";
            //         echo "<td>" . $list[$i]['Asunto']       . "</td>";
            //         echo "</tr>";
            //     }
            //     echo "</table>";
            // }
            

// $req = new request();

// $req ->Get_PDF("LUVH510331MPLGFGM5","2")



?>