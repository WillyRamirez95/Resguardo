<?php 
session_start();
// require "../programacion/conexion.php";
require_once "../___Backend/classfunction/__functions.php";
__functionsession::__SessionValidarLogin($_SESSION['IDusuario']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/vistas/CI-search.css">
    <script src="../js/jquery-3.6.0.min.js"></script>
    <title>Document</title>
</head>

<body>

<div class="content-add">
        <h3>FILTRAR REGISTRO</h3>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" id="form1">

            <div class="contenedor uno">
                <div class="columna">
                    <label for="">Campo de búsqueda:</label>
                    <input type="text" name="dato" class="campobusqueda" id="dato" placeholder="Ingrese el dato a buscar (id, fecha, solicitante, wo, solicitud, etc." onkeyup="Busquedapersonalizada($('#dato').val(),this.id);">
                    <span class="comentario">El dato ingresado se buscará en todos los campos de forma exacta, sin embargo, puedes emplear el elemento de comodin "%" tanto al inicio y/o final del dato ingresado, ejemplo: %dato buscado%.
                        Tomar en cuenta que a mayor cantidad de registro en coincidencia el resultado podria tardar en mostrarse.
                    </span>
                </div>
            </div>
            <span class="more">Mostrar mas campos de búsqueda (+)</span>
            <br>
            <div class="contenedor oculto">
                <div class="columna">
                    <label for="">Cliente - Referencia</label>
                    <input type="text" name="cliente" class="campobusqueda" id="cliente" onkeyup="Busquedapersonalizada($('#cliente').val(),this.id);" >
                </div>
                <div class="columna">
                    <label for="">Solicitante</label>
                    <input type="text" name="solicitante"  class="campobusqueda" id="solicitante" onkeyup="Busquedapersonalizada($('#solicitante').val(),this.id);" >
                </div>
                <div class="columna">
                    <label for="">Workorder</label>
                    <input type="text" name="workorder"  class="campobusqueda" id="workorder" onkeyup="Busquedapersonalizada($('#workorder').val(),this.id);" >
                </div>
                <div class="columna">
                    <label for="">Fecha</label>
                    <input type="date" name="fecha"  class="campobusqueda" id="fecha" onchange="Busquedapersonalizada($('#fecha').val(),this.id);" >
                </div>
            </div>
        </form>
    </div>


    <div id="datos-busqueda"></div>

    <br>


    <a href="control-de-inventario" style="color:blue">Regresar</a>
    <script src="../JS/control-de-inventario.js"></script>
</body>

</html>