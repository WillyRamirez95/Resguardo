<?php

session_start();
require "___backend\classfunction\__functions.php";
__FunctionUsuarios::__IniciarSession();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Resguardo</title>
    <link rel="stylesheet" href="CSS/login.css">
</head>

<body>
    <!-- oncontextmenu="return false" onkeydown="return false" -->
    <header class="titulo">
        <h1>LOGIN</h1>
    </header>
    <div class="formulario">
        <form method="POST" action="<?php $_SERVER['PHP_SELF'];?>">
            <?php if(isset($_SESSION['logsesion'])){ ?>
            <br>
            <div class="Message">
                <p><?php echo  $_SESSION['logsesion'];?></p>
            </div>
            <?php }; unset($_SESSION['logsesion']);?>
            <?php 
                if(isset($_SESSION['RespuestaRegistroUsuario'])){
                    echo $_SESSION['RespuestaRegistroUsuario'];
                    unset($_SESSION['RespuestaRegistroUsuario']);   
                }elseif (isset($_SESSION['RespuestaRegistroUsuarioerror'])){
                    echo $_SESSION['RespuestaRegistroUsuarioerror'];
                    unset($_SESSION['RespuestaRegistroUsuarioerror']);
                }
                ?>

            <div class="contenedor">
                <label for="">Usuario:</label>
                <input type="text" class="textbox" name="user"
                    value="<?php if(isset($_SESSION['error'])){echo $_POST['user'];}?>" placeholder="Usuario">
                <br>
                <label for="">Contraseña:</label>
                <input type="password" class="textbox" name="password"
                    value="<?php if(isset($_SESSION['error'])){echo $_POST['password'];}?>" placeholder="Contraseña">
                <br>
                <input type="submit" value="Iniciar sesión" class="bt-ingresar" name="loguear">
                <?php unset($_SESSION['error']) ?>
            </div>

        </form>

        <div class="registrarse">
            <a href="registrarse">Registrate aquí</a>
        </div>


    </div>
</body>

</html>