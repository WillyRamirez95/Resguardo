<?php 
session_start();
require "../../___backend\classfunction\__conexion.php";
$conn = conexion::conectar();
if($_GET['id']){
    $param = array($_GET['id'],$_SESSION['IDusuario'],'');
    $stmt = sqlsrv_prepare($conn,'exec SP_CA_UPDATE_FIN @id=?,@usuario=?,@obs=?',$param);
    
    if(sqlsrv_execute($stmt)===true){
        $_SESSION['respuestaRealizado']= " Registro actualizado correctamente.";
        header("location: ../../vistas/control-de-actividades.php");
    }else{
        die($_SESSION['respuestaRealizado'] = array(sqlsrv_errors(),true));
    }
}else{
    header("location: ../vistas/control-de-actividades.php");
}

