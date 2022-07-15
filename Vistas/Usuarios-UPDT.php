<?php
session_start();
include_once "../___Backend/classfunction/__functions.php";
__functionsession::__SessionPaginaUsuarios($_SESSION['IDusuario']);
$row = __functionusuarios::__ActionUser();
$rperfil = __functionusuarios::__Perfiles();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/vistas/user.css">
    <script src="../JS/jquery-3.6.0.min.js?v=<?php echo time(); ?>"></script>

    <title>Actualizacion de Usuario</title>
</head>

<body>
    <?php if(isset($_SESSION['ErrorUsuarioActualizar'])){
            echo $_SESSION['ErrorUsuarioActualizar'];
            unset($_SESSION['ErrorUsuarioActualizar']);
         } ?>
    <div class="contenedor form">

        <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
            <div class="fila">
                <div class="columna">
                    <label for="">Nombre:</label>
                    <input type="text" name="nombre" value="<?php echo  $row['NOMBRES'];  ?>" required>
                </div>
                <div class="columna">
                    <label for="">Apellido:</label>
                    <input type="text" name="apellido" value="<?php echo $row['APELLIDOS']; ?>" required>
                </div>
            </div>
            <div class="fila">
                <div class="columna">
                    <label for="">Usuario:</label>
                    <input type="text" name="usuario" value="<?php echo $row['USUARIO']; ?>" required>
                </div>
                <div class="columna">
                    <label for="">Contraseña:</label>
                    <input type="password" name="password" value="<?php echo $row['DECRYPT']; ?>" autocomplete="off"
                        required>
                </div>
            </div>
            <div class="fila">
                <div class="columna">
                    <label for="">Correo:</label>
                    <input type="text" name="correo" value="<?php echo $row['CORREO']; ?>">
                </div>
                <div class="columna">
                    <label for="">Perfil:</label>
                    <select name="perfil" id="perfil">
                        <?php foreach($rperfil as $datos){?>
                        <option value="<?php echo $datos['ID'];?>" <?php if($datos['ID']==$row['PERFILID']){
                            echo "selected='selected'";} ?>>
                            <?php echo $datos['TIPO_PERFIL'] ?>
                        </option>
                        <?php }; ?>
                    </select>
                </div>

            </div>
            <div class="fila">
                <div class="columna">
                    <label for="">Estado:</label>
                    <select name="estado" id="estado">
                        <option value="0" <?php if($row['HABILITADO']==0){echo "selected";} ?>>Inactivo</option>
                        <option value="1" <?php if($row['HABILITADO']==1){echo "selected";} ?>>Activo</option>
                    </select>
                </div>
                <div class="columna">
                    <label for="">Aprobación:</label>
                    <!-- <input type="text" name="aprobacion"
                        value="<?php if(isset($_POST['aprobacion'])){ echo $aprobacion;}else{echo $row['APROBADO'];} ?>"> -->
                    <select name="aprobacion" id="aprobacion">
                        <option value="0" <?php if($row['APROBADO']==0){echo "selected='selected'";}?>>Pendiente
                        </option>
                        <option value="1" <?php if($row['APROBADO']==1){echo "selected='selected'";}?>>Aprobado</option>
                    </select>
                </div>

            </div>

            <br>
            <input type="submit" value="Guardar cambios" name="editar" class="bt-guardar">

        </form>

    </div>
</body>

</html>