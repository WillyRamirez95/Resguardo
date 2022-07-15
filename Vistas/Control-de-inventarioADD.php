<?php
session_start();
require "../___backend/classfunction/__functions.php";
__functionsession::__SessionValidarLogin($_SESSION['IDusuario']);
__functioncontrolinventario::__AgregarRegistro();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../CSS/vistas/CI-ADD.css?v=<?php echo time(); ?>">
    <script src="../js/jquery-3.6.0.min.js?v=<?php echo time(); ?>"></script>

</head>

<body>


    <div class="content-add">
        <h3>NUEVO REGISTRO</h3>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" id="form1">

            <div class="contenedor uno">
                <div class="columna">
                    <label for="">Cliente:</label>
                    <input type="text" name="cliente" id="cliente" onkeyup="buscarahora($('#cliente').val(),this.id)" required placeholder="Ingrese datos para realizar la búsqueda">
                </div>
                <div class="columna">
                    <label for="">Cuenta:</label>
                    <input type="text" name="cuenta" id="cuenta" readonly>
                </div>
                <input type="text" id="idcliente" name="idcliente" style="display:none" readonly></input>
            </div>

            <div class="contenedor dos">
                <div class="columna">
                    <label for="">Solicitante</label>
                    <input type="text" name="solicitante" required>
                </div>
                <div class="columna">
                    <label for="">WorkOrder</label>
                    <input type="text" name="workorder" required>
                </div>
            </div>

            <div class="contenedor tres">
                <div class="columna">
                    <label for="">Fecha de correo:</label>
                    <input type="date" name="fechacorreo" class="fecha">
                </div>
                <div class="columna">
                    <label for="">Actividad:</label>
                    <select name="actividad" id="">
                        <option value="1">CHECK</option>
                        <option value="2">INV</option>
                    </select>
                </div>
                <div class="columna">
                    <label for="">Fecha de recepción:</label>
                    <input type="date" name="fecharecepcion" class="">
                </div>
            </div>
            <div class="contenedor cuatro">
                <div class="columna">
                    <label for="">Servicio:</label>
                    <input type="text" name="servicio" required>
                </div>
                <div class="columna">
                    <label for="">Inicio inventario</label>
                    <input type="date" name="inicioinv" class="fecha">
                </div>
                <div class="columna">
                    <label for="">Fin de inventario</label>
                    <input type="date" name="fininv" class="fecha">
                </div>
            </div>
            <div class="contenedor cinco">
                <div class="columna">
                    <label for="">Estado de inventario:</label>
                    <select name="estadoinv" id="">
                        <option value="Ingresada" selected>Ingresada </option>
                        <option value="En proceso">En proceso</option>
                        <option value="Finalizada">Finalizada</option>
                    </select>
                </div>
                <div class="columna">
                    <label for="">Cantidad de cajas:</label>
                    <input type="text" name="cantcajas">
                </div>
                <div class="columna">
                    <label for="">Cantidad de items:</label>
                    <input type="text" name="cantfiles">
                </div>
            </div>
            <div class="contenedor seis">
                <div class="columna">
                    <label for="">Dias:</label>
                    <input type="text" name="dias">
                </div>
                <div class="columna">
                    <label for="">Nombre de archivo:</label>
                    <input type="text" name="nombrearchivo">
                </div>
            </div>
            
            <div class="contenedor siete">
                <div class="columna">
                    <label for="">Observación:</label>
                    <textarea type="text" name="observacion"></textarea>
                </div>
            </div>

            <br>
            <input type="submit" value="Registrar" class="btregistrar" name="registrarci">
            <a href="control-de-inventario">Regresar al inicio.</a>
        </form>
    </div>


    <div id="resultado-busqueda"></div>

    <br>
    <script src="../JS/Control-de-inventario.js"></script>

</body>


</html>