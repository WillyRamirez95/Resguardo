<?php
session_start();
header("Content-Type: text/html;charset=utf-8");
require "../___backend\classfunction\__conexion.php";
$conn = conexion::conectar();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/vistas/periodo.css">
    <script src="../JS/jquery-3.6.0.min.js"></script>
    <title>Periodos</title>
</head>

<body>

    <div class="contenedor">
        <div class="izquierda">
            <div class="formulario">
                <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
                    <div class="filas flexible">
                        <label for="">ID:</label>
                        <input type="text" name="idcliente" id="idcliente" readonly>
                    </div>
                    <div class="filas">
                        <label for="">Cliente:</label>
                        <input type="text" name="cliente" id="cliente" readonly>
                    </div>

                    <div class="filas ">
                        <label for="">Corte:</label>
                        <select name="idperiodo" id="corte">
                            <option value="0">[Seleccionar]</option>
                            <?php $stmt=sqlsrv_query($conn,"exec sp_tipo_periodo");
                            if( $stmt === false ) {
                                die( print_r( sqlsrv_errors(), true));
                            }
                            while($row = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){ ?>
                            <option value="<?php echo $row['id']; ?>"> <?php echo $row['corte']; ?></option>
                            <?php };
                             sqlsrv_free_stmt($stmt);?>
                        </select>
                    </div>
                    <div class="filas">
                        <label for="">Observación:</label>
                        <input type="text" name="obs" id="obs">
                    </div>

                    <button class="bt-registrar" name="registrar">Registrar</button>
                </form>
            </div>

            <?php 
            if(isset($_POST['registrar'])){

                $cliente = $_POST['cliente'];
                $periodo = $_POST['idperiodo'];
                $idcliente = $_POST['idcliente'];
                $obs = $_POST['obs'];

                if(empty($cliente)||empty($periodo)||empty($idcliente)){
                    echo "<span class='Error respuesta'>Completar todos los datos</span>";
                }else{
                    // echo $cliente.' '.$periodo.' '.$idcliente.' '.$obs;
                    $param = array ($cliente,$periodo,$obs);
                    $stmt = sqlsrv_query($conn,'exec SP_PERIODOS_INSERT @cliente=?,@tp=?,@obs=?',$param);
                    if($stmt === false){
                        // print_r( sqlsrv_errors(), true);
                        echo "<span class='Error respuesta'>Se presento un error al registrar.</span>";
                    }else{
                        echo "<span class='Correcto respuesta'>Se registro correctamente.</span>";
                    }
                }
            }

            if(isset($_POST['actualizar'])){

                $idcliente = $_POST['idcliente'];
                $periodo = $_POST['idperiodo'];
                $obs = $_POST['obs'];

                if(empty($idcliente)||empty($periodo)){
                    echo "<span class='Error respuesta'>Completar todos los datos</span>";
                }else{
                    $param = array ($idcliente,$periodo,$obs);
                    $stmt = sqlsrv_query($conn,'exec SP_PERIODO_UPDATE @id=?,@periodo=?,@obs=?',$param);
                    if($stmt === false){
                        echo "<span class='Error respuesta'>Se presento un error al modificar.</span>";
                    }else{
                        echo "<span class='Correcto respuesta'>Se modifico el registro correctamente.</span>";
                    }
                }
            }
            ?>

            <hr>

            <div class="level">
                <table class="tabla" id="tablapendientes">
                    <?php 
                        $stmt = sqlsrv_query($conn,"exec sp_cliente_level1");
                        if( $stmt === false ) {
                            // print_r( sqlsrv_errors(), true);
                            echo "<span class='Error respuesta'>Se encontro un error al mostrar los registros</span>";
                        }else{ ?>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>CODIGO</th>
                            <th>CLIENTE</th>
                            <th>DESCRIPCIÓN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){ ?>
                        <tr>
                            <td class="id"><?php echo $row['ID'] ?></td>
                            <td class="codigo"><?php echo $row['COD_CLIENTE'] ?></td>
                            <td class="cliente"><?php echo $row['LEVEL1'] ?></td>
                            <td class="descripcion"><?php echo $row['DESCRIPCION'] ?></td>
                        </tr>
                        <?php } sqlsrv_free_stmt($stmt);}?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="derecha">
            <div class="result">
                <div class="titulo">
                    <h4>REGISTRO DE PERIODOS POR CLIENTE</h4>
                </div>
                <div class="overflow">
                    <table class="tabla" id="tablaregistrados">
                        <?php 
                        $stmt = sqlsrv_query($conn,"exec sp_periodos");
                        if( $stmt === false ) {
                            // print_r( sqlsrv_errors(), true);
                            echo "<span class='Error respuesta'>Se encontro un error al mostrar los registros</span>";
                        }else{ ?>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>CLIENTE</th>
                                <th>CORTE</th>
                                <th>FECHA INICIO</th>
                                <th>FECHA FIN</th>
                                <th>OBSERVACIÓN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){ ?>
                            <tr>
                                <td class="idtr"><?php echo $row['ID'] ?></td>
                                <td class="clientetr"><?php echo $row['CLIENTE'] ?></td>
                                <td><?php echo $row['CORTE'] ?></td>
                                <td><?php echo $row['FECHA_INI'] ?></td>
                                <td><?php echo $row['FECHA_FIN'] ?></td>
                                <td class="obs"><?php echo $row['OBSERVACION'] ?></td>

                            </tr>
                            <?php } sqlsrv_free_stmt($stmt);}?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/periodos.js"></script>

</body>

</html>