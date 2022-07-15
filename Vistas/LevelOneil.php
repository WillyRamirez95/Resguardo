<?php
session_start();
require "../___backend\classfunction\__conexion.php";
$conn = conexion::conectar();

// include "logica/Select_LO.php";

if (!isset($_SESSION['IDusuario'])) {
    header('location: ../index');
}elseif(isset($usuario)){
    if($_SESSION['perfil']<>"1"){
        die(header('location: ../index'));
    }
}
$usuario = $_SESSION['IDusuario'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../CSS/vistas/LO.css">
    <script src="../js/jquery-3.6.0.min.js"></script>
</head>

<body>
    <h4>LEVEL ONEIL</h4>
    <div class="filtro">
        <div class="fila">
            <div class="columna">
                <label for="">Búsqueda general:</label>
                <input id="buscar" class="buscar" type="text" name="buscar"
                    onkeyup="buscarlevel($('#buscar').val(),this.id);">
            </div>
        </div>
        <div class="fila">
            <div class="columna">
                <label for="">Level1:</label>
                <input id="level1" class="buscar" type="text" name="level1"
                    onkeyup="buscarlevel($('#level1').val(),this.id);">
            </div>
            <div class="columna">
                <label for="">Level2:</label>
                <input id="level2" class="buscar" type="text" name="level2"
                    onkeyup="buscarlevel($('#level2').val(),this.id);">
            </div>
            <div class="columna">
                <label for="">Level3:</label>
                <input id="level3" class="buscar" type="text" name="level3"
                    onkeyup="buscarlevel($('#level3').val(),this.id);">
            </div>
        </div>
        <br>
        <hr>
        <div class="fila">
            <span class="text-nuevoreg">Nuevo registro (+)</span>
        </div>

        <form id="addlevel" action="<?php $_SERVER['PHP_SELF']?>" method="POST" style="display:none">
            <div class="fila">
                <div class="columna">
                    <label for="">Código de cliente:</label>
                    <input id="codcliente" class="buscar" type="text" name="codcliente">
                </div>
                <div class="columna">
                    <label for="">Level1:</label>
                    <input id="level1" class="buscar" type="text" name="level1">
                </div>
                <div class="columna">
                    <label for="">Level2:</label>
                    <input id="level2" class="buscar" type="text" name="level2">
                </div>

            </div>
            <div class="fila">
                <div class="columna">
                    <label for="">Level3:</label>
                    <input id="level3" class="buscar" type="text" name="level3">
                </div>
                <div class="columna">
                    <label for="">Referencia:</label>
                    <input id="referencia" class="buscar" type="text" name="referencia">
                </div>
                <div class="columna">
                    <label for="">Descripción:</label>
                    <input id="descripcion" class="buscar" type="text" name="descripcion">
                </div>
            </div>
            <div class="fila">
                <div class="columna">
                    <label for="">Coordinador:</label>
                    <!-- <input id="coordinador" class="buscar" type="text" name="coordinador"> -->
                    <select name="gestor" id="gestor">
                        <option value="0">[seleccionar]</option>
                        <?php 
                        $stmt = sqlsrv_query($conn,"exec SP_GESTOR_SELECT");
                    if($stmt===false){
                        if( ($errors = sqlsrv_errors() ) != null) {
                            foreach( $errors as $error ) {
                                echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
                                echo "code: ".$error[ 'code']."<br />";
                                echo "message: ".$error[ 'message']."<br />";
                            }
                        }
                    }else{
                        while($row = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){?>
                        <option value="<?php echo $row['id']?>"> <?php echo $row['gestor']?> </option>
                    <?php };
                    }
                    ?>
                    </select>
                </div>
                <div class="columna">
                    <label for="">Cantidad de días:</label>
                    <input id="cantdias" class="buscar" type="text" name="cantdias">
                </div>
                <div class="columna">
                    <input type="submit" name="registrar" value="Registrar" class="bt-registrar">
                    <!-- <button class="bt-registrar" name="registrar">Registrar</button> -->
                </div>
            </div>
        </form>
        <?php 
            if(isset($_POST['registrar'])){
                if(empty($_POST['codcliente'])){ $cc = NULL;}else{$cc=$_POST['codcliente'];};
                $l1 = $_POST['level1'];
                $l2 = $_POST['level2'];
                $l3 = $_POST['level3'];
                $r = $_POST['referencia'];
                $d = $_POST['descripcion'];
                $g = $_POST['gestor'];
                $cd = $_POST['cantdias'];
                $param = array($cc,$l1,$l2,$l3,$r,$d,$g,$cd,$usuario);
                $stmt = sqlsrv_query($conn,"exec SP_CLIENTE_INSERT @ccliente=?, @l1=?,@l2=?,@l3=?, @ref=?, @desc=?, @g=?, @cd=?, @ureg=?",$param);

                if($stmt === false){
                    die(print_r(sqlsrv_errors(),true));
                }
                echo "<p class='registro-level'>se registro el cliente satisfactoriamente</p>";

            }
        ?>
    </div>



    <div id="resultado-busqueda">

    </div>

    <script src="../js/leveloneil.js"></script>
</body>

</html>