<?php
session_start();
include "../../___backend\classfunction\__conexion.php";
$conn = conexion::conectar();
$valorbuscado = $_POST['buscar'];
$id = $_POST['campoid'];
if(!empty($valorbuscado) ){
     if($id=="buscar"|| $id=="cliente"){
         if($valorbuscado=="todos"||$valorbuscado=="*"){
            $tb = 0;
         }else{
            $tb =4;
         }
    }elseif($id=="level1"){
        $tb = 1;
     }elseif($id=="level2"){
        $tb = 3;
     }elseif($id=="level3"){
        $tb = 3;
    }
    $param =array($valorbuscado,$tb);
    $stmt = sqlsrv_prepare($conn,'exec sp_cliente_select @descrip=?, @tb=?',$param);
    
    if(sqlsrv_execute($stmt)===true){
        $conteo = sqlsrv_num_rows($stmt);
    }else{
        echo "error en la consulta";
    }

?>
<div id="resultado">
    <h3 id="titulo-filtro">CLIENTES</h3>
    <p class="count-coincidencias">Coincidencias encontradas: <?php echo $conteo; ?></p>
    <table id="table-filtro">
        <thead>
            <tr>
                <th>ID</th>
                <th>COD. CLIENTE</th>
                <th>LEVEL1</th>
                <th>LEVEL2</th>
                <th>LEVEL3</th>
                <th>REFERENCIA</th>
                <th>DESCRIPCIÓN</th>
                <!-- <th>updt</th> -->
            </tr>
        </thead>
        <tbody>
            <?php while($row =sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)):  ?>
            <tr class="registrocuenta">
                <td class="idcliente"><?php echo $row['ID'] ?></td>
                <td class="cod"><?php echo $row['COD_CLIENTE'] ?></td>
                <td class="cliente"><?php echo $row['LEVEL1'] ?></td>
                <td><?php echo $row['LEVEL2'] ?></td>
                <td><?php echo $row['LEVEL3'] ?></td>
                <td class="referencia"><?php echo $row['REFERENCIA'] ?></td>
                <td><?php echo $row['DESCRIPCION'] ?></td>
                <?php if(isset($_SESSION['IDusuario']) && $_SESSION['IDusuario']=="1"){ ?>
                <td class="edit-1"><a href="../Level-OneilUPDT.php">Editar</a></td>
                <?php };?>
            </tr>
            <?php endwhile;?>
        </tbody>
    </table>
    <br>
</div>
<?php }else{?>
<!-- if(empty($valorbuscado)) -->
<script>
$('#resultado').remove();
// console.log("no proceso nada")
</script>
<?php };?>