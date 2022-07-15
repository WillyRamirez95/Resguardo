<?php

class conexion{
    // public $conn;
    public static function conectar(){
        $serverName = "localhost"; 
        $connectionInfo = array( "Database"=>"RESGUARDO2", "UID"=>"resguardo", "PWD"=>"Oneil2022"); //0n3il2022
        $conn = sqlsrv_connect( $serverName, $connectionInfo);
        
        if($conn == false)
            // die(FormatErrors(sqlsrv_errors()));
                die(var_dump(sqlsrv_errors()));
        return $conn;

    }

    // public static function ListarPendientes(){
    //     $conexion = conexion::conectar();
    //     $stmt = sqlsrv_query($conexion,"exec sp_ca_select");
    //     $actividades = [];
    //     while($actividad = sqlsrv_fetch_object($stmt)){
    //         array_push($actividades,$actividad);
    //     }
    //     return $actividades;
    // }
}

