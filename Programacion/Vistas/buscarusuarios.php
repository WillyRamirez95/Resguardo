<?php
session_start();
require "../../___backend\classfunction\__conexion.php";
$conn = conexion::conectar();

if(isset($_POST['dato'])){
$valorbuscado = $_POST['dato'];
}
if(isset($_POST['campoid'])){
$campoid = $_POST['campoid'];
}

if(isset($valorbuscado)){
    
    if($campoid=="nombre"){
        if($valorbuscado=="*"){
            $param = array("",7);
        }else{
            $param = array($valorbuscado,1);
        }
    }elseif($campoid=="apellido"){
        $param = array($valorbuscado,2);
    }elseif($campoid=="perfil"){
        if($valorbuscado=="0"){
        die();
        }
        $param = array($valorbuscado,3);
    }elseif($campoid=="estado"){
        if($valorbuscado=="2"){die();}
        $param = array($valorbuscado,4);
    }elseif($campoid=="aprobacion"){
        if($valorbuscado=="2"){die();}
        $param = array($valorbuscado,5);
    }else{
        echo "<p class='error'>No se encontaron coincidencias</p>";
        die();
    }

    if(isset($param)){
        $stmt = sqlsrv_prepare($conn,"exec sp_usuarios_busqueda @parametro=?,@tipo=?",$param); 
        if(sqlsrv_execute($stmt)===true){ ?>
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
                        <?php while($row = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)):?>
                        <tr>
                            <td name="ID"><?php echo $row['ID'] ?></td>
                            <td><?php echo $row['NOMBRES'] ?></td>
                            <td><?php echo $row['APELLIDOS'] ?></td>
                            <td><?php echo $row['CORREO'] ?></td>
                            <td><?php echo $row['USUARIO'] ?></td>
                            <!-- <td style="width:50px;overflow: hidden"><?php echo $row['PASSWORD'] ?></td> -->
                            <!-- <td><?php echo $row['PERFILID'] ?></td> -->
                            <!-- <td><?php echo $row['HABILITADO'] ?></td> -->
                            <!-- <td><?php echo $row['APROBADO'] ?></td> -->
                            <td style="text-align:center">
                                <a href="usuarios-UPDT?id=<?php echo $row['ID'];?>" target="iframeEditor" class="editar btn"
                                    class="editar" onclick="mostrariframe()">Editar</a> |
                                <a href="../programacion/vistas/eliminarusuario?id=<?php echo $row['ID'];?>"
                                    class="eliminar btn" onclick="return confirm('¿Estas seguro de eliminar el usuario?')">Eliminar</a>
                            </td>
                        </tr>
                        <?php endwhile;?>
                    </tbody>
                </table>
            </div>
        <?php }else{ ?>
            
            <p class="error">No se encontaron coincidencias</p>
        <?php }?>
<?php }else{?>
<script>$('.contenedor-usuarios').remove();</script>
<?php } 
}?>