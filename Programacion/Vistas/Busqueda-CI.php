<?php
session_start();
// require "../conexion.php";
require "../../___backend/classfunction/__functions.php";
// $acciones = __functioncontrolinventario::__permisosCI($_SESSION['perfil'],$_SESSION['IDusuario']);
$conn = conexion::conectar();
$valorbuscado = $_POST['buscar'];
$tbusqueda = $_POST['campo'];

$perfil = $_SESSION['perfil']; 

if($valorbuscado <>"%" && $valorbuscado<> null){
    if($tbusqueda=="dato"){
        $param=array(1,$valorbuscado);
        $stmt = sqlsrv_query($conn,'exec SP_CI_SEARCH @tipobusqueda=?, @dato=?',$param);
    }elseif($tbusqueda=="cliente"){
        $param=array(2,$valorbuscado);
        $stmt = sqlsrv_query($conn,'exec SP_CI_SEARCH @tipobusqueda=?, @dato=?',$param);
    }elseif($tbusqueda=="solicitante"){
        $param=array(3,$valorbuscado);
        $stmt = sqlsrv_query($conn,'exec SP_CI_SEARCH @tipobusqueda=?, @dato=?',$param);
    }elseif($tbusqueda=="workorder") {
        $param=array(4,$valorbuscado);
        $stmt = sqlsrv_query($conn,'exec SP_CI_SEARCH @tipobusqueda=?, @dato=?',$param);
    }elseif($tbusqueda=="fecha"){
        $param=array(5,$valorbuscado);
        $stmt = sqlsrv_query($conn,'exec SP_CI_SEARCH @tipobusqueda=?, @dato=?',$param);
    }
    

    if($stmt === false){      
        
?>
<br>
<p class="count-coincidencias-cero">Coincidencias encontradas: 0</p>

<?php die( print_r( sqlsrv_errors(), true));
 }else{?>
<!-- <div id="resultado-busqueda"> -->
<br>
<!-- <p class="count-coincidencias">Coincidencias encontradas: <?php echo $conteo; ?></p> -->
<br>
<table class="table-content">
    <thead class="table-head">
        <th>SOLICITUD</th>
        <th>CLIENTE</th>
        <th>CUENTA</th>
        <th>SOLICITANTE</th>
        <th>WORKORDER</th>
        <th>FECHA_CORREO</th>
        <th>ACTIVITY</th>
        <th>INICIO_INV.</th>
        <th>FIN_INV.</th>
        <th>ESTADO_INV</th>
        <th>ESTADO_CRG</th>
        <th>PERIODO</th>
        <th>CIERRE</th>
        <th>EDITAR</th>
    </thead>
    <tbody class="table-body">
        <?php while($row = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)): ?>
        <tr <?php if($row['ESTADO'] == "Anulado"){ echo "class='anulado'";}?>
            title="Observación:<?php echo $row['OBSERVACION']."\n";?>Nombre de archivo:<?php echo $row['NOMBRE_ARCHIVO']."\n";?>Cantidad Cajas:<?php echo $row['CANTIDAD_CAJAS']."\n";?>Cantidad Files:<?php echo $row['CANTIDAD_ITEM']."\n";?>Dias:<?php echo $row['DIAS'];?>">
            <td><?php echo $row['NRO_SOLICITUD']; ?></td>
            <td><?php echo $row['CLIENTE']; ?></td>
            <td><?php echo $row['CUENTA']; ?></td>
            <td><?php echo $row['SOLICITANTE']; ?></td>
            <td><?php echo $row['WORKORDER']; ?></td>
            <td><?php echo $row['FECHA DE CORREO'];?></td>
            <td><?php echo $row['PROCESO']; ?></td>
            <td><?php echo $row['INICIO_INV']; ?></td>
            <td><?php echo $row['FIN_INV']; ?></td>
            <td><?php echo $row['ESTADO']; ?></td>
            <td><?php echo $row['ESTADOCRG']; ?></td>
            <td><?php echo $row['PERIODO']; ?></td>
            <td><?php echo $row['CIERRE']; ?></td>
            <td style="text-align:center;">
                <?php __functioncontrolinventario::__permisosCI($_SESSION['perfil'],$row['ID']); ?>
            </td>
        </tr>
        <?php endwhile;
                            sqlsrv_close($conn);
                            // sqlsrv_free_stmt();
                        ?>
    </tbody>
</table>
<?php  }
}else{?>

<script>
$('#resultado-busqueda').remove()
</script>
<?php }    ?>