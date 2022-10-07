<?php
require_once 'Ticket.php';
/*  @autor Luigy Miranda   */
$data = Tickets::consulta_ticket_all();

if(isset($_POST['enviar'])){
    if(isset($_POST['nombre']) && isset($_POST['fecha']) && isset($_POST['asunto']) && isset($_POST['incidencia'])){
        if($_POST['nombre'] !='' && $_POST['fecha']!='' && $_POST['asunto']!='' && $_POST['incidencia']!=''){
            $name = $_POST['nombre'];
            $fecha = $_POST['fecha'];
            $asunto = $_POST['asunto'];
            $descrip = $_POST['incidencia'];
            $soporte='';
            $coment='';
            $msg = Tickets::new_ticket($name,$fecha,$asunto,$descrip,$soporte,$coment);
            echo $msg;
        }
    }
}
if(isset($_POST['enviar_solicitante'])){
    $buscar_name = $_POST['nombre_solicitante'];
    $data = Tickets::consulta_ticket_solicitante($buscar_name);
    ///var_dump($data);
}else{
    if(isset($_POST['fecha_inicio']) && isset($_POST['fecha_final'])){
        $val1 = $_POST['fecha_inicio'];
        $val2 = $_POST['fecha_final'];
        $data = Tickets::consulta_ticket_fecha($val1,$val2);
      }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Luigy Miranda</title>
</head>
<body class="container">
    <h3>Ticket de atencion</h3>
    <h4>Busqueda</h4>
    <div class="d-flex justify-content-end"> 
        <form  action="" method="post" class="container">
            <label class="form-label">Desde</label>
            <input class="form-control me-2" type="date" id="fecha_inicio" name="fecha_inicio" value="<?php echo date("Y-m-d");?>"></br>
            <label class="form-label">Hasta</label>
            <input class="form-control me-2" type="date" id="fecha_final" name="fecha_final" value="<?php echo date("Y-m-d");?>" >
            <div class="form-group">
                <button type="submit" id="submit" class="btn btn-primary">Buscar</button>
            </div>
            </br>
            <label class="form-label">Buscar por persona solicitante</label>
            <input class="form-control me-2" type="text" name="nombre_solicitante" placeholder="Nombre de persona solicitante" >
            <button type="submit" name="enviar_solicitante" class="btn btn-primary">Buscar solicitante</button>
        </form>
        <form class="container" action="" method="post">
            <div class="mb-3">
                <label  class="form-label">Nombre del usuario</label>
                <input type="text" name="nombre" class="form-control" >
            </div>
            <div class="mb-3">
                <label class="form-label">Fecha</label>
                <input type="date" name="fecha"  value="<?php echo date("Y-m-d");?>"  class="form-control" id="datetime">
            </div>
            <div class="mb-3 ">
                <label class="form-label">Asunto</label>
                <input type="text" class="form-control" name="asunto" placeholder="Escribe un asunto">
            </div>
            <div class="mb-3 ">
                <label for="exampleInputPassword1" class="form-label">Incidencia</label>
                <input type="text" class="form-control" name="incidencia" placeholder="Escribe una incidencia">
            </div>
            <button type="submit" name="enviar" class="btn btn-primary">Nuevo Ticket</button>
        </form>
        <table class="table ">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Asunto</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Soporte</th>
                    <th scope="col">Comentario</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(isset($_POST['enviar_solicitante']) || (isset($_POST['fecha_inicio']) && isset($_POST['fecha_final']))){
                    if(empty($data)){
                        echo '<tr>';
                        echo '<td>No hay resultados...</td>';
                        echo '</tr>';
                    }else{
                        echo '<tr>';
                        echo '<td>'.$data['nombre'].'</td>';
                        echo '<td>'.$data['fecha'].'</td>';
                        echo '<td>'.$data['asunto'].'</td>';
                        echo '<td>'.$data['descrip'].'</td>';
                        echo '<td>'.$data['soporte'].'</td>';
                        echo '<td>'.$data['comentario'].'</td>';
                        echo '<td>';
                        echo '<a href="modificar.php?id='.$data['id'].'">Modificar</a></br>';
                        echo '</td>';
                        echo '</tr>';
                    }

                }else{
                    foreach($data as $item)
                    {   
                        echo '<tr>';
                        echo '<td>'.$item['nombre'].'</td>';
                        echo '<td>'.$item['fecha'].'</td>';
                        echo '<td>'.$item['asunto'].'</td>';
                        echo '<td>'.$item['descrip'].'</td>';
                        echo '<td>'.$item['soporte'].'</td>';
                        echo '<td>'.$item['comentario'].'</td>';
                        echo '<td>';
                        echo '<a href="modificar.php?id='.$item['id'].'">Modificar</a></br>';
                        echo '</td>';
                        echo '</tr>';
                    } 
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
