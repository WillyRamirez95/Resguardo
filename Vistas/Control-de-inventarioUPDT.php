<?php
session_start();
require_once "../___Backend/classfunction/__functions.php";
__functionsession::__SessionValidarLogin($_SESSION['IDusuario']);
$row = __functioncontrolinventario::__MostrarRegistroModificar();
__functioncontrolinventario::__ModificarRegistro();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../CSS/vistas/CI-ADD.css">
    <script src="../js/jquery-3.6.0.min.js"></script>
</head>

<body>
    <h3>ACTUALIZAR REGISTRO *<?php echo $row['NRO_SOLICITUD'] ?>*</h3>
    <div class="content-add">
        <?php if(isset($_SESSION['RespuestaQuery'])){?>
        <h4 class="error"><?php echo $_SESSION['RespuestaQuery'];?></h4>
        <br>
        <?php }  ?>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
            <div class="contenedor uno">
                <div class="columna">
                    <label for="">Cliente:</label>
                    <input type="text" class="lectura" name="cliente" value="<?php echo $row['CLIENTE'] ?>" readonly>
                </div>
                <div class="columna">
                    <label for="">Cuenta:</label>
                    <input type="text" class="lectura" name="cuenta" value="<?php echo $row['CUENTA'] ?>" readonly>
                </div>
            </div>

            <div class="contenedor dos">
                <div class="columna">
                    <label for="">Solicitante</label>
                    <input type="text" name="solicitante" value="<?php echo $row['SOLICITANTE'] ?>">
                </div>
                <div class="columna">
                    <label for="">WorkOrder</label>
                    <input type="text" name="workorder" value="<?php echo $row['WORKORDER'] ?>">
                </div>
            </div>

            <div class="contenedor tres">
                <div class="columna">
                    <label for="">Fecha de correo:</label>
                    <input type="date" name="fechacorreo" class="fecha"
                        value="<?php echo $row['FECHA_DE_CORREO'];?>">
                </div>
                <div class="columna">
                    <label for="">Actividad:</label>
                    <select name="actividad" value="<?php echo $row['ACTIVIDADES']?>">
                        <option value="1">CHECK</option>
                        <option value="2">INV</option>
                    </select>
                </div>
                <div class="columna">
                    <label for="">Fecha de recepción:</label>
                    <input type="date" name="fecharecepcion" class="fecha"
                        value="<?php echo $row['FECHA_RECEPCION']?>">
                </div>
            </div>

            <div class="contenedor cuatro">
                <div class="columna">
                    <label for="">Servicio:</label>
                    <input type="text" name="servicio" value="<?php echo $row['SERVICES']?>">
                </div>
                <div class="columna">
                    <label for="">Inicio inventario</label>
                    <input type="date" name="inicioinv" class="fecha"
                        value="<?php echo $row['INICIO_INV'] ?>">
                </div>
                <div class="columna">
                    <label for="">Fin de inventario</label>
                    <input type="date" name="fininv" class="fecha"
                        value="<?php echo $row['FIN_INV'] ?>">
                </div>
            </div>

            <div class="contenedor cinco">
                <div class="columna">
                    <label for="">Estado de inventario:</label>
                    <input type="text" value="<?php echo $row['ESTADO']?>" readonly>
                </div>
                <div class="columna">
                    <label for="">Cantidad de cajas:</label>
                    <input type="text" name="cantcajas" value="<?php echo $row['CANTIDAD_CAJAS']?>">
                </div>
                <div class="columna">
                    <label for="">Cantidad de items:</label>
                    <input type="text" name="cantfiles" value="<?php echo $row['CANTIDAD_ITEM']?>">
                </div>
            </div>
            <div class="contenedor seis">
                <div class="columna">
                    <label for="">Dias:</label>
                    <input type="text" name="dias" value="<?php echo $row['DIAS']?>">
                </div>
                <div class="columna">
                    <label for="">Nombre de archivo:</label>
                    <input type="text" name="nombrearchivo" value="<?php echo $row['NOMBRE_ARCHIVO']?>">
                </div>
                <div class="columna">
                    <label for="">Estado de registro</label>
                    <select name="estadoregistro" id="er">
                        <option value="1" <?php if($row['ESTADOID']=="1"){echo "selected";} ?>>Activo</option>
                        <option value="0" <?php if($row['ESTADOID']=="0"){echo "selected";} ?>>Anulado</option>
                    </select>
                </div>
            </div>

            <div class="contenedor siete">
                <div class="columna">
                    <label for="">Observación:</label>
                    <textarea type="text" name="observacion"><?php echo $row['OBSERVACION']?></textarea>
                </div>
            </div>

            <br>
            <input type="submit" value="Actualizar" class="btregistrar" name="update">
            <a href="control-de-inventario">Regresar al inicio.</a>
    </div>
    </form>
    <br>
</body>

</html>