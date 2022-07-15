<?php
session_start();
require "___backend/classfunction/__functions.php";
$RetornoDatosPost = __FunctionUsuarios::__RegistrarUsuario();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <script src="JS/jquery-3.6.0.min.js"></script>
    <title>Registrarse Reguardo</title>
</head>

<body>
    <header class="titulo">
        <h1>REGISTRARSE</h1>
    </header>
    <div class="formulario">
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
        
            <?php 
                if(isset($_SESSION['RespuestaRegistroUsuario'])){
                    echo $_SESSION['RespuestaRegistroUsuario'];
                }elseif (isset($_SESSION['RespuestaRegistroUsuarioerror'])){
                    echo $_SESSION['RespuestaRegistroUsuarioerror'];
                }
                ?>

            <div class="contenedor">
                <label for="">Nombre:</label>
                <input type="text" class="textbox" name="nombre" placeholder="Ingrese su nombre"
                    value="<?php if(isset($_SESSION['RespuestaRegistroUsuarioerror'])){echo $RetornoDatosPost[0];} ?>"
                    required>
                <br>
                <label for="">Apellido:</label>
                <input type="text" class="textbox" name="apellido" placeholder="Ingrese su apellido"
                    value="<?php if(isset($_SESSION['RespuestaRegistroUsuarioerror'])){echo $RetornoDatosPost[1];} ?>"
                    required>
                <br>
                <label for="">Correo:</label>
                <input type="text" class="textbox" name="correo" placeholder="correo electronico (opcional)"
                    value="<?php if(isset($_SESSION['RespuestaRegistroUsuarioerror'])){echo $RetornoDatosPost[2];} ?>">
                <br>
                <label for="">Perfil:</label>
                <select name="perfil" id="tipousuario" style="width:100%;padding: 5px"
                    value="<?php if(isset($_SESSION['RespuestaRegistroUsuarioerror'])){echo $RetornoDatosPost[3];}?>">
                    <option value="0" <?php if(isset($_SESSION['RespuestaRegistroUsuarioerror'])){if($RetornoDatosPost[3]=="0"){
                        {echo "selected";}
                    };}?>>Seleccione un perfil</option>
                    <option value="1" <?php if(isset($_SESSION['RespuestaRegistroUsuarioerror'])){if($RetornoDatosPost[3]=="1"){
                        {echo "selected";}
                    };}?>>Administrador</option>
                    <option value="2" <?php if(isset($_SESSION['RespuestaRegistroUsuarioerror'])){if($RetornoDatosPost[3]=="2"){
                        {echo "selected";}
                    };}?>>Gestor</option>
                    <option value="3" <?php if(isset($_SESSION['RespuestaRegistroUsuarioerror'])){if($RetornoDatosPost[3]=="3"){
                        {echo "selected";}
                    };}?>>Inventario</option>
                </select>
                <br>
                <label for="">Usuario:</label>
                <input type="text" class="textbox" name="usuario" placeholder="Ingrese el nombre de usuario"
                    value="<?php if(isset($_SESSION['RespuestaRegistroUsuarioerror'])){echo $RetornoDatosPost[4];}?>"
                    required>
                <br>
                <label for="">Contraseña:</label>
                <input type="password" class="textbox" name="password" id="pass1" placeholder="Contraseña"
                    onkeyup="validarclave()" autocomplete
                    value="<?php if(isset($_SESSION['RespuestaRegistroUsuarioerror'])){echo $RetornoDatosPost[5];} ?>"
                    required>
                <br>
                <label for="">Confirmar contraseña:</label>
                <input type="password" class="textbox" name="password2" id="pass2" placeholder="Confirmar contraseña"
                    onkeyup="validarclave()" autocomplete
                    value="<?php if(isset($_SESSION['RespuestaRegistroUsuarioerror'])){echo $RetornoDatosPost[6];} ?>"
                    required>
                <br>
                <span style="font-size:11px; color:darkcyan">Todo nuevo usuario deberá ser aprobado por el
                    administrador</span>
                <br>

                <input type="submit" value="Registrarse" class="bt-registrarse" name="registrarse" id="btregistarse">
                <br>
            </div>
        </form>

        <p class="resultado errorclave" id="valpass"></p>

        <div class="iniciarsesion">
            <a href="index">Iniciar sesión</a>
        </div>
    </div>
    <script src="JS/registrarse.js">

    </script>
</body>

</html>