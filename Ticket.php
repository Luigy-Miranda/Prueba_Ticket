<?php
class Tickets{
    
	function conexion_base(){
        //Conectar a la base de datos
        $hostname="localhost";
        $username="root";
        $password="";
        $dbname="ticket";
        $mysqli = new mysqli($hostname,$username, $password,$dbname);
        if ($mysqli->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        }
        return $mysqli;
    }
    
	function consulta_ticket_all(){
		$usertable="tickets";
        $array_data = array();
		$conexion = Tickets::conexion_base();
		$query="SELECT * FROM $usertable";
		$rs = $conexion->query($query);

        while ($row = mysqli_fetch_array($rs)) {
            $array_set = array(
                "id" => $row['id'],
                "nombre" => $row['name'],
                "fecha" => $row['fecha'],
                "asunto" => $row['asunto'],
                "descrip" => $row['descrip'],
                "soporte" => $row['soporte'],
                "comentario" => $row['comentario']
            );
            array_push($array_data, $array_set);
        }
        //var_dump($array_data);

		return $array_data;	
    }
	function consulta_ticket($id){
		$usertable="tickets";
        $array_data = array();
		$conexion = Tickets::conexion_base();
		$query="SELECT * FROM $usertable WHERE id = '$id'";
		$rs = $conexion->query($query);

        while ($row = mysqli_fetch_array($rs)) {
            $array_data = array(
                "id" => $row['id'],
                "nombre" => $row['name'],
                "fecha" => $row['fecha'],
                "asunto" => $row['asunto'],
                "descrip" => $row['descrip'],
                "soporte" => $row['soporte'],
                "comentario" => $row['comentario']
            );
        }
        //var_dump($array_data);

		return $array_data;	
    }
    function consulta_ticket_fecha($val1,$val2){
		$usertable="tickets";
        $array_data = array();
		$conexion = Tickets::conexion_base();
		$query="SELECT * FROM $usertable WHERE fecha BETWEEN '$val1' AND '$val2' ORDER BY fecha DESC";
		$rs = $conexion->query($query);

        while ($row = mysqli_fetch_array($rs)) {
            $array_data = array(
                "id" => $row['id'],
                "nombre" => $row['name'],
                "fecha" => $row['fecha'],
                "asunto" => $row['asunto'],
                "descrip" => $row['descrip'],
                "soporte" => $row['soporte'],
                "comentario" => $row['comentario']
            );
        }
		return $array_data;	
    }

    function consulta_ticket_solicitante($buscar_name){
		$usertable="tickets";
        $array_data = array();
		$conexion = Tickets::conexion_base();
		$query="SELECT * FROM $usertable WHERE name like '%$buscar_name%'";
		$rs = $conexion->query($query);

        while ($row = mysqli_fetch_array($rs)) {
            $array_data = array(
                "id" => $row['id'],
                "nombre" => $row['name'],
                "fecha" => $row['fecha'],
                "asunto" => $row['asunto'],
                "descrip" => $row['descrip'],
                "soporte" => $row['soporte'],
                "comentario" => $row['comentario']
            );
        }
		return $array_data;	
    }
	function new_ticket($name,$fecha,$asunto,$descrip,$soporte,$coment){
        $array_data = array();
		$conexion = Tickets::conexion_base();
        $query="INSERT INTO  tickets(name, fecha, asunto, descrip, soporte, comentario) VALUES ('$name','$fecha','$asunto','$descrip','$soporte','$coment')";

		$rs = $conexion->query($query);
        if($rs){
            $mensaje = '
            <div class="alert alert-success" role="alert">
                Nuevo ticket
            </div>';
        }else{
            $mensaje = '
            <div class="alert alert-warning" role="alert">
                Ticket fallido
            </div>';
        }
        return $mensaje;

    }
    function update_ticket($id,$name,$fecha,$asunto,$descrip,$soporte,$coment){
		$conexion = Tickets::conexion_base();
        $query="UPDATE tickets set name = '" .$name. "', fecha = '" .$fecha."'
        , asunto = '" .$asunto."', descrip = '".$descrip."', soporte = '".$soporte."'
        , comentario = '".$coment."' WHERE id ='".$id."' ";

		$rs = $conexion->query($query);

    }
    
   
}



?>