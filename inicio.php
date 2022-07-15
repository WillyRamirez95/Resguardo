<?php
session_start();
require "___Backend/classfunction/__functions.php";
// echo $_SERVER['HTTPS'];
__functionsession::__SessionPaginaInicio($_SESSION['IDusuario']);
__FunctionUsuarios::__ActualizarClave();
$modulos=__FunctionUsuarios::__ModulosPorPerfil();
__FunctionUsuarios::__CerrarSesion();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/inicio.css">
    <script src="js/jquery-3.6.0.min.js"></script>
    <title>Resguardo</title>
</head>

<body>
    <nav class="nav-bar">
        <ul class="element">
            <li class="titulo">
                <a href="#" class="web">Resguardo Polyfiles</a>
                <?= $modulos?>
            </li>
            <li class="usuario">
                <a href="#" class="name">[Bienvenido: <?php echo $_SESSION['username']; ?>]</a>
            </li>
        </ul>
    </nav>
    <div class="block">
        <img src="img/1600200277-82-polysistemas-s-a-c.jpg" alt="" style="display:block;margin:auto">
    </div>
    <div class="contenedor" style="display:none">
        <iframe src="" frameborder="0" class="content-iframe" id="iframe1" name="iframepage">
        </iframe>
    </div>
    <script src="JS/nav.js"></script>
</body>

</html>