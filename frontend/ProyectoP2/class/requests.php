<?php
include "class_ticket_turno.php";
class request{
    public function request_all_data()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://localhost:9000/'); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($ch, CURLOPT_HEADER, 0); 
        $data = curl_exec($ch); 
        curl_close($ch); 
        $ndata = json_decode($data,true);
        return $ndata;

    }
    public function request_by_curp($curp){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://localhost:9000/ticket/'.$curp); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($ch, CURLOPT_HEADER, 0); 
        $data = curl_exec($ch); 
        curl_close($ch); 
        $ndata = json_decode($data,true);
        return $ndata;

    }
    public function insert_data($data)
    {
        $ch = curl_init();
        $info = json_encode($data);
        curl_setopt($ch, CURLOPT_URL, "http://localhost:9000/");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $info);
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }



    public function update_data($curp, $id, $data)
    {

        $ch = curl_init('http://localhost:9000/ticket/' . $curp . '/' . $id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $response = curl_exec($ch);

        return json_decode($response,true);
    }

    public function delete_data($curp, $id){
        $url = 'http://localhost:9000/ticket/' . $curp . '/' . $id;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);  
        curl_close($ch);
        return json_decode($result);
    }

    public function Get_PDF($curp, $id){
        $ch = curl_init('http://localhost:9000/pdf/' . $curp . '/' . $id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($ch, CURLOPT_HEADER, 0); 
        $data = curl_exec($ch); 
        curl_close($ch); 
        $pdf_decoded = base64_decode($data);
        $pdf = fopen ('ticket.pdf','w');
        fwrite ($pdf,$pdf_decoded);
        fclose ($pdf);

    }
    public function login($usuario, $password)
    {
        $data["username"] = $usuario;
        $data["password"] = $password;
        $ch = curl_init();
        $info = json_encode($data);
        curl_setopt($ch, CURLOPT_URL, "http://localhost:9000/login%22");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $info);
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function register($usuario, $password)
    {
        $data["username"] = $usuario;
        $data["password"] = $password;
        $ch = curl_init();
        $info = json_encode($data);
        curl_setopt($ch, CURLOPT_URL, "http://localhost:9000/register%22");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $info);
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function get_municipio($id){
        $Municipios = array(
            "01"=> "Abasolo",
            "02"=> "Acuña",
            "03"=> "Allende",
            "04"=> "Arteaga",
            "05"=> "Candela",
            "06"=> "Castaños",
            "07"=> "Cuatro Ciénegas",
            "08"=> "Escobedo",
            "09"=> "Francisco I. Madero",
            "010"=> "Frontera",
            "011"=> "General Cepeda",
            "012"=> "Guerrero",
            "013"=> "Hidalgo",
            "014"=> "Jiménez",
            "015"=> "Juárez",
            "016"=> "Lamadrid",
            "017"=> "Matamoros",
            "018"=> "Monclova",
            "019"=> "Morelos",
            "020"=> "Múzquiz",
            "021"=> "Nadadores",
            "022"=> "Nava",
            "023"=> "Ocampo",
            "024"=> "Parras",
            "025"=> "Piedras Negras",
            "026"=> "Progreso",
            "027"=> "Ramos Arizpe",
            "028"=> "Sabinas",
            "029"=> "Sacramento",
            "030"=> "Saltillo",
            "031"=> "San Buenaventura",
            "032"=> "San Juan de Sabinas",
            "033"=> "San Pedro",
            "034"=> "Sierra Mojada",
            "035"=> "Torreón",
            "036"=> "Viesca",
            "037"=> "Villa Unión",
            "038"=> "Zaragoza",
        );
        return $Municipios[$id];
    }
    public function get_asunto($id){
        $Asuntos = array(
            "01"=> "Inscripcion",
            "02"=> "Solicitar cambio de escuela",
            "03"=> "Reportar alguna situación",
            "04"=> "Otro...",
        );
        return $Asuntos[$id];

    }
}

?>