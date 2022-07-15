<?php
session_start();
$usuario = $_SESSION['IDusuario'];
if (!isset($usuario)) {
    header('location: ../index');
}elseif(isset($usuario)){
    if($_SESSION['perfil']<>"1"){
        header('location: ../index');
        die();
    }
}

// require "../programacion/conexion.php";
// $stmt = sqlsrv_query($conn, 'exec sp_ca_select');
require "..\___backend\classfunction\__functions.php";
$actividad = __functioncontrolactividades::ListarPendientes();



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../js/jquery-3.6.0.min.js?v=<?php echo time(); ?>"></script>
    <link rel="stylesheet" href="../CSS/vistas/CA.css?v=<?php echo time(); ?>">
    <title>Document</title>
</head>

<body>
    <h3 id="titulo">CONTROL DE ACTIVIDADES</h3>
    <!-- <hr> -->
    <br>
    <?php if(isset($_SESSION['respuestaRealizado'])){?>
    <div class="respuesta realizado">
        <?php echo $_SESSION['respuestaRealizado'];
        unset($_SESSION['respuestaRealizado']); ?>
    </div>
    <?php }elseif(isset($_SESSION['respuestaError'])){?>
    <div class="respuesta error">
        <?php echo $_SESSION['respuestaError'];
        unset($_SESSION['respuestaError']); ?>
    </div>
    <?php }    ?>
    <div class="conteneder-controlactividades">
        <table id="tb-ca">
            <thead>
                <th>ID</th>
                <th>CLIENTE</th>
                <th>OBSERVACIÓN</th>
                <th>NOMBRE_ARCHIVO</th>
                <th>ESTADO INVENTARIO</th>
                <th>ESTADO CARGA</th>
                <th>FECHA DE CARGA</th>
                <th>ACTIVIDAD</th>
            </thead>
            <tbody>
                    <?php foreach($actividad as $actividades): ?>
                <tr>
                    <td><?php echo $actividades->ID;?></td>
                    <td><?php echo $actividades->LEVEL1;?></td>
                    <td style="width:100px; text-overflow:ellipsis"><?php echo $actividades->OBSERVACION;?></td>
                    <td><?php echo $actividades->NOMBRE_ARCHIVO;?></td>
                    <td><?php echo $actividades->ESTADO_INV;?></td>
                    <td><?php echo $actividades->ESTADO_CRG;?></td>
                    <td><?php echo $actividades->FECHA_CARGA;?></td>
                    <td><a href="../programacion/vistas/finalizar-ca?id=<?php echo $actividades->ID;?>" onclick="return confirm('Seguro que deseas continuar?')">Finalizar</a></td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
        <script src="../js/view-function.js"></script>
        <script>
            $('#titulo').on('click',function(){
                location.reload();
            })
        </script>
    </div>
</body>

</html>