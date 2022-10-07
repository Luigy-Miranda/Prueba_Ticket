<?php
include_once 'Ticket.php';

$id = $_GET['id'];
$data = Tickets::consulta_ticket($id);


if(isset($_POST['save'])){
        $name = $_POST['nombre'];
        $fecha = $_POST['fecha'];
        $asunto = $_POST['asunto'];
        $descrip = $_POST['descrip'];
        $soporte=$_POST['soporte'];
        $coment=$_POST['comentario'];
        $response = Tickets::update_ticket($id,$name,$fecha,$asunto,$descrip,$soporte,$coment);
        header('location: index.php');
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Luigy Miranda</title>
<link rel="stylesheet"
    href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
    integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7"
    crossorigin="anonymous">
</head>
<body>
<div class="container">
<h1>Modificacion del Ticket #<?php echo $id;?></h1>
    <form action="" method="post">
        <label>Persona solicitante:</label>
        <input type="text" class="form-control" name="nombre" value="<?php echo $data['nombre']; ?>">
        <br>
        <label>Fecha:</label>
        <input type="text" class="form-control"  name="fecha" value="<?php echo $data['fecha']; ?>">
        <br>
        <label>Asunto:</label>
        <input type="text" class="form-control" name="asunto" value="<?php echo $data['asunto']; ?>">
        <br>
        <label>Descripcion:</label>
        <br>
        <input type="text" class="form-control" name="descrip" value="<?php echo $data['descrip']; ?>">
        <br>
        <label>Soporte:</label>
        <br>
        <input type="text" class="form-control" name="soporte" value="<?php echo $data['soporte']; ?>">
        <br>
        <label>Comentario:</label>
        <br>
        <textarea
            class="form-control"
            name="comentario"
            cols="20"
            rows="5"
            style="resize: none;"
        >
            <?php echo $data['comentario']; ?>        
        </textarea>
        <br>
        <input type="hidden" name="profile_id" value="<?php echo $id ?>">
        <input type="submit" name="save" value="Guardar cambios">
        <input type="submit" name="cancel" value="Cancelar">
    </form>
</div>
</body>
</html>