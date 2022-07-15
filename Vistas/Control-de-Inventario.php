<?php
session_start();
include_once "../___Backend/classfunction/__functions.php";
__functioncontrolinventario::__Refresh();
__functionsession::__SessionValidarLogin($_SESSION['IDusuario']);
$pag = __functioncontrolinventario::__paginacion();
__functioncontrolinventario::__EliminarRegisto();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/vistas/CI.css">
    <script src="../js/jquery-3.6.0.min.js"></script>
    <title>Control de inventario</title>
</head>

<body>
    <h3>CONTROL DE INVENTARIO</h1>

        <div class="funciones">
            <div class="opciones">
                <a href="control-de-inventarioAdd" id="add">Registrar nuevo</a>
                <a href="control-de-inventarioSEARCH" id="busqueda">Buscar registro</a>
            </div>
            <div class="navegacion">
                <span>Navegación: </span>
                <form action="control-de-inventario?paginacion.php" method="POST">
                    <a href="control-de-inventario?paginacion=prev">Prev</a>
                    <input type="number" max="50" min="1" name="cantidad-registros" id="cregistro" class="count-reg"
                        value="<?php if(!isset($_SESSION['totalregistro'])){echo "25";}else{echo $_SESSION['totalregistro'];} ?>">
                    <a href="control-de-inventario?paginacion=next">Next</a>
                </form>
            </div>
        </div>
        <hr>
        <div class="respuesta-flotante">
            <!-- <p> Lorem ipsum dolor sit, amet consectetur adipisicing elit. Numquam laboriosam esse eius molestias voluptatum explicabo at praesentium repellat laudantium, harum quo autem ullam a, fugiat vel possimus maxime excepturi ad!</p> -->
            <?php 
            if(isset($_SESSION['RespuestaQuery'])){
                echo $_SESSION['RespuestaQuery'];
                unset($_SESSION['RespuestaQuery']);   
            };
            ?>
        </div>

        <div class="contenedor-tabla">
            <table class="table-content">
                <thead class="table-head">
                    <th>SOLICITUD</th>
                    <th>CLIENTE</th>
                    <th>CUENTA</th>
                    <th>SOLICITANTE</th>
                    <th>WORKORDER</th>
                    <th>FECHA_CORREO</th>
                    <th>ACTIVITY</th>
                    <th>INICIO_INV.</th>
                    <th>FIN_INV.</th>
                    <th>INVENTARIO</th>
                    <th>CARGA</th>
                    <th>PERIODO</th>
                    <th>CIERRE</th>
                    <th>EDITAR</th>
                </thead>
                <tbody class="table-body">
                    <?php $row = __functioncontrolinventario::__mostrarregistros();
                        foreach( $row as $registrosci){?>
                    <tr <?php if($registrosci->ESTADOID == "0"){ echo "class='anulado'";}?>
                        title="Observación:<?php echo $registrosci->OBSERVACION."\n";?>Nombre de archivo:<?php echo $registrosci->NOMBRE_ARCHIVO."\n";?>Cantidad Cajas:<?php echo $registrosci->CANTIDAD_CAJAS."\n";?>Cantidad Files:<?php echo $registrosci->CANTIDAD_ITEM."\n";?>Dias:<?php echo $registrosci->DIAS;?>">
                        <td><?php echo $registrosci->NRO_SOLICITUD; ?></td>
                        <td><?php echo $registrosci->CLIENTE; ?></td>
                        <td><?php echo $registrosci->CUENTA; ?></td>
                        <td><?php echo $registrosci->SOLICITANTE; ?></td>
                        <td><?php echo $registrosci->WORKORDER; ?></td>
                        <td><?php echo $registrosci->FECHA_DE_CORREO;?></td>
                        <td><?php echo $registrosci->PROCESO; ?></td>
                        <td><?php echo $registrosci->INICIO_INV; ?></td>
                        <td><?php echo $registrosci->FIN_INV; ?></td>
                        <td><?php echo $registrosci->ESTADO; ?></td>
                        <td><?php echo $registrosci->ESTADOCRG; ?></td>
                        <td><?php echo $registrosci->PERIODO; ?></td>
                        <td><?php echo $registrosci->CIERRE; ?></td>
                        <td style="text-align:center;">
                            <?php $permisos_x_usuario = __functioncontrolinventario::__permisosCI($_SESSION['perfil'],$registrosci->ID);?>
                        </td>
                    </tr>
                    <?php };?>
        </div>
        </table>
        </div>


        <script src="../JS/control-de-inventario.js"></script>
</body>

</html>