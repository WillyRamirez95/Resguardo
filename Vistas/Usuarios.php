<?php 
session_start();
include_once "../___Backend/classfunction/__functions.php";
__functionsession::__SessionPaginaUsuarios($_SESSION['IDusuario']);
$dato = __functionusuarios::__perfiles();
$filausuario = __functionusuarios::__MostrarUsuarios();
$actionuser = __functionusuarios::__ActionUser();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/vistas/user.css">
    <script src="../JS/jquery-3.6.0.min.js"></script>
    <title>Usuarios</title>
</head>

<body>
    <div class="filtro">
        <span class="">Búsqueda de usuarios</span>
        <div class="fila">
            <div class="columna">
                <label for="">Nombre:</label>
                <input type="text" id="nombre" name="nombre" onkeyup="buscarusuarios($('#nombre').val(),this.id)">
            </div>
            <div class="columna">
                <label for="">Apellido:</label>
                <input type="text" id="apellido" name="apellido" onkeyup="buscarusuarios($('#apellido').val(),this.id)">
            </div>
        </div>
        <div class="fila">
            <div class="columna">
                <label for="">Perfil:</label>
                <select name="perfil" id="perfil" name="perfil" onchange="buscarusuarios($('#perfil').val(),this.id)">
                    <option value="0">Seleccionar</option>
                    <!-- $rst = sqlsrv_query($conn,"sp_perfil"); -->
                    <?php foreach($dato as $datos){;?>
                    <option value="<?php echo $datos['ID']?>"><?php echo $datos['TIPO_PERFIL']; ?></option>
                    <?php };?>
                </select>
            </div>
            <div class="columna">
                <label for="">Estado:</label>
                <select name="estado" id="estado" name="estado" onchange="buscarusuarios($('#estado').val(),this.id)">
                    <option value="2" selected>Seleccionar</option>
                    <option value="0">Inactivo</option>
                    <option value="1">Activo</option>
                </select>
            </div>
            <div class="columna">
                <label for="">Aprobación:</label>
                <select name="aprobacion" id="aprobacion" name="aprobacion"
                    onchange="buscarusuarios($('#aprobacion').val(),this.id)">
                    <option value="2" selected>Seleccionar</option>
                    <option value="0">Pendiente</option>
                    <option value="1">Aprobado</option>
                </select>
            </div>
        </div>
    </div>
    <br>
    <?php if(isset($_SESSION['EliminarUsuario'])){
            echo $_SESSION['EliminarUsuario'];
            unset($_SESSION['EliminarUsuario']);}?>
    <div id="resultado-busqueda">
        <div class="contenedor-usuarios">
            <table id="tabla-usuarios">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Correo</th>
                        <th>Usuario</th>
                        <th style="width:100px">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($filausuario as $usuarios){?>
                    <tr>
                        <td name="ID"><?php echo $usuarios->ID ?></td>
                        <td><?php echo $usuarios->NOMBRES ?></td>
                        <td><?php echo $usuarios->APELLIDOS ?></td>
                        <td><?php echo $usuarios->CORREO ?></td>
                        <td><?php echo $usuarios->USUARIO ?></td>
                        <td style="text-align:center">
                            <a href="usuarios-updt?accion=update&id=<?php echo $usuarios->ID;?>" target="iframeEditor"
                                class="editar btn" class="editar" onclick="mostrariframe()">Editar</a> |
                            <a href="usuarios?accion=delete&id=<?php echo $usuarios->ID;?>" class="eliminar btn"
                                onclick="return confirm('¿Estas seguro de eliminar el usuario?')">Eliminar</a>
                        </td>
                    </tr>
                    <?php };?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="contenedor-if">
        <div class="contenedor-cerrar">
            <button id="cerrarif">X</button>
        </div>
        <hr>
        <div class="iframe">
            <iframe id="iframeusuario" name="iframeEditor" frameborder="0" src="#"></iframe>
        </div>
    </div>
    <script src="../JS/Usuarios.js"></script>
</body>

</html>