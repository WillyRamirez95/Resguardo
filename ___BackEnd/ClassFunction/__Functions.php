<?php
// session_start();
include_once "__conexion.php";

class __FunctionUsuarios extends conexion{
    public $usuario; public $nombre; public $apellido; public $estado;
    public $tipousuario; public $password; public $correo; public $tipobusqueda; public $datobusqueda;

    public static function __MostrarUsuarios(){
        $conexion = conexion::conectar();
        $param = array('',7);
        $stmt = sqlsrv_query($conexion,"exec sp_usuarios_busqueda @parametro=?,@tipo=?",$param);
        $usuarios = [];
        while($usuario = sqlsrv_fetch_object($stmt)){
            array_push($usuarios, $usuario);
        }
        return $usuarios;
    }

    public static function __BuscarUsuarioSQL($datobusqueda,$tipobusqueda){
        $conexion = conexion::conectar();
        $param = array($datobusqueda,7);
        $stmt = sqlsrv_query($conexion, "exec sp_usuarios_busqueda @parametro=?,@tipo=?",$param);
        $usuarios = [];
        while($usuario = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
            array_push($usuarios, $usuario);
        }
        return $usuarios;
    }

    public static function __ActionUser(){
        $conexion = conexion::conectar();

        if(isset($_POST['editar'])){
            if(isset($_POST['editar'])){
                $idusuario = $_GET['id'];
                $nombre = $_POST['nombre'];
                $apellidos = $_POST['apellido'];
                $usuario = $_POST['usuario'];
                $password = $_POST['password'];
                $correo = $_POST['correo'];
                $perfil = $_POST['perfil'];
                $estado = $_POST['estado'];
                $aprobacion = $_POST['aprobacion'];
                $fechaactualizacion = date('Y-m-d h:i:s', time());
                $usuariosession = $_SESSION['IDusuario'];

                $param =array($idusuario,$usuario,$password,$nombre,$apellidos,$correo,$perfil,$estado,$aprobacion,$usuariosession);
                $stmt = sqlsrv_prepare($conexion,"exec sp_usuarios_actualizar @id=?,@usuario=?,@password=?,@nombre=?,
                @apellidos=?,@correo=?,@perfilid=?,@habilitado=?,@aprobado=?,@usuario_ac=?",$param);

                if(sqlsrv_execute($stmt)===true){
                    $_SESSION['ErrorUsuarioActualizar'] = "<p class='resultado conforme'>Cambios realizados correctamente.</p>";
                }else{
                    $_SESSION['ErrorUsuarioActualizar'] = "<p class='resultado error'>Ocurrio un error durante la actualizacion del usuario, comuniquese con el área Oneil.</p>";
                }
                
                $param = array($idusuario);
                $stmt = sqlsrv_query($conexion,"exec sp_usuarios_busqueda @parametro=?,@tipo=6",$param);
                $row = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);

                return $row;
            }
        }

        if(isset($_GET['accion'])&&isset($_GET['id'])){
            $accion = $_GET['accion'];
            $id =$_GET['id'];

            if($accion == "update"){
                $idusuario = $_GET['id'];

                $param = array($idusuario);
                $stmt = sqlsrv_query($conexion,"exec sp_usuarios_busqueda @parametro=?,@tipo=6",$param);
                $usuarios =[];
                $row = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);

                return $row;

            }elseif($accion =="delete"){
                $param = array($_GET['id']);
                $stmt = sqlsrv_prepare($conexion,"exec SP_USUARIOS_ELIMINAR @id=?",$param);
                if(sqlsrv_execute($stmt) === true){
                    $_SESSION['EliminarUsuario'] = "<p class='conforme'>Se elimino el registro correctamente.</p>";
                }else{
                    $_SESSION['EliminarUsuario'] = "<p class='error'>Ocurrio un error en la eliminación.</p>";
                }
                header ("location: ../../vistas/usuarios.php");
            }
        }
       
    }

    public static function __Perfiles(){
        $conexion = conexion::conectar();
        $stmt = sqlsrv_query($conexion,"exec sp_perfil");
        $datos = [];
        while($rst = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
            array_push($datos,$rst);
        }
        return $datos;
    }

    public static function __ActualizarClave(){
        if(isset($_POST['act-pass'])){
            $conexion = conexion::conectar();
            $param=array($_SESSION['IDusuario'],$_POST['nuevo_password']);
            $stmt = sqlsrv_prepare($conexion,"exec sp_usuarios_cambio_clave @id=?,@password=?",$param);
            
            if(sqlsrv_execute($stmt)===true){
                echo "<script>alert('Se realizo el cambio de contraseña, se realizara la actualización de la ventana')</script>";
            }else{
                echo "<script>alert('ocurrio un error')</script>";
            }
        }
    }

    public static function __IniciarSession(){
        if (isset($_SESSION['IDusuario'])) {
            header('location: inicio');
        }else{
            if(isset($_POST['loguear'])){
                $conexion = conexion::conectar();
                $user = $_POST['user'];
                $clave = $_POST['password'];
                
                $param = array($user);
                // $existencia = sqlsrv_query();
                $stmt = sqlsrv_prepare($conexion,'exec sp_login @usuario=?',$param);

                if( !$stmt ) {
                    die( print_r( sqlsrv_errors(), true));
                    }
                    
                    if(sqlsrv_execute($stmt)){
                        // make sure all result sets are stepped through, since the output params may not be set until this happens
                        while($res = sqlsrv_fetch_array($stmt)){
                            if(isset($res['error'])){
                                $_SESSION['logsesion']= $res['error'];
                            }else{
                                if($clave==$res['DECRYPT']){
                                    if($res['APROBADO']=="0"){
                                        $_SESSION['logsesion']="El usuario ingresado se encuentra pendiente de aprobación, contactarse con el área oneil.";
                                        $_SESSION['error'] = "yes";
                                        // echo $_SESSION['logsesion'];
                                    }elseif($res['HABILITADO']=="0"){
                                        $_SESSION['logsesion']="El usuario ingresado se encuentra de baja, contactarse con el área oneil.";
                                        $_SESSION['error'] = "yes";
                                        // echo $_SESSION['logsesion'];
                                    }elseif($res['APROBADO']=="1" && $res['HABILITADO']=="1"){
                                        $_SESSION['IDusuario']=$res['ID'];
                                        $_SESSION['username']=$res['NOMBRES'].' '.$res['APELLIDOS'];
                                        $_SESSION['perfil'] = $res['PERFILID'];
                                        header("Location: inicio"); 
                                        // echo "acceso consedido";
                                    }
                                }else{
                                    $_SESSION['logsesion']="Contraseña incorrecta";
                                    $_SESSION['error'] = "yes";
                                    // echo $_SESSION['logsesion'];
                                }
                            }
                        
                        }
                        
                    }else{
                        die( print_r( sqlsrv_errors(), true));
                    }
            }
        }
    }

    public static function __CerrarSesion(){
        if(isset($_GET['cerrarsesion'])){
            session_unset();
            session_destroy();

            header ("location: index");
        }
    }

    public static function __ModulosPorPerfil(){
        if(!isset($_SESSION['perfil'])){
            die();
        }else{
            $perfil = $_SESSION['perfil'];
            $html ="<ul class='menu'>
                    <li class='item'>
                        <p class='item-text'>Control de inventario</p>
                        <ul class='submenu'>
                            <li class='subitem'>
                                <a class='sbitem-elemento' href='vistas/control-de-inventario' target='iframepage'>Principal CI</a>
                            </li>";
            if($perfil=='1'){
                    $html.="<li class='subitem'>
                            <a class='sbitem-elemento' href='vistas/control-de-actividades' target='iframepage'>Control de actividades</a>
                            </li>";
            }
            $html.="</ul></li>";
            
            if($perfil=='1'||$perfil=='2'){
            $html.="<li class='item'>
                        <p class='item-text'>Formularios creación FW3 - Oneil</p>
                        <ul class='submenu'>
                            <li class='subitem'><a class='sbitem-elemento' href='vistas/registrar_cliente' target='iframepage'>Nuevo Cliente</a></li>
                            <li class='subitem'><a class='sbitem-elemento' href='vistas/registrar_usuario_fw3' target='iframepage'>Nuevo Usuario FW3</a></li>
                            <li class='subitem'><a class='sbitem-elemento' href='vistas/registrar_usuario_oneil' target='iframepage'>Nuevo usuario ONEIL</a></li>
                            <li class='subitem'><a class='sbitem-elemento' href='vistas/registrar_usuario_pdt' target='iframepage'>Nuevo Usuario PDT</a></li>
                        </ul>
                    </li>";
            }
            if($perfil=='1'){
            $html.="<li class='item'>
                        <p class='item-text'>Mantenimiento</p>
                        <ul class='submenu'>
                            <li class='subitem'><a class='sbitem-elemento' href='vistas/usuarios' target='iframepage'>Usuarios</a></li>
                            <li class='subitem'><a class='sbitem-elemento' href='vistas/LevelOneil' target='iframepage'>Level Oneil</a></li>
                            <li class='subitem'><a class='sbitem-elemento' href='vistas/periodos' target='iframepage'>Periodo</a></li>
                        </ul>
                    </li>";
            }
            $html.="<li class='item'>
                        <p class='item-text update-password'>Cambiar contraseña</p>
                        <ul class='submenu'>
                            <li class='subitem'>
                                <div class='content-updt-pass'>
                                    <form method='POST' action='inicio'>
                                        <input type='password' placeholder='ingrese nueva contraseña.' name='nuevo_password' autocomplete>
                                        <button name='act-pass' onclick='return confirm(' Estas seguro de cambiar la
                                            contraseña?')'>Actualizar</button>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class='item'><a href='?cerrarsesion'><p class='item-text close-session'>Cerrar Sesión</p></a></li>
                    </ul>";
        }
        return $html;
    }

    public static function __RegistrarUsuario(){
        if(isset($_POST['registrarse'])){
            $conexion = conexion::conectar();
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $correo = $_POST['correo'];
            $perfil = $_POST['perfil'];
            $usuario = $_POST['usuario'];
            $password1 = $_POST['password'];
            $password2 = $_POST['password2'];
            
            // print_r($nombre.$apellido.$correo.$perfil.$usuario.$password1.$password2);
            
            if($perfil=="0"){
                $_SESSION['RespuestaRegistroUsuario']="<p class='resultado'>Debe seleccionar un perfil.</p>";
            }elseif($password1!==$password2){
                $_SESSION['RespuestaRegistroUsuario']="<p class='resultado'>Las contraseñas ingresadas no coinciden.</p>";
            }else{
                if($password1==$password2){$password = $password1;}
                $param = array($usuario,$password,$nombre,$apellido,$correo,$perfil);
                $stmt = sqlsrv_prepare($conexion,'exec sp_registrar_usuario @usuario=?,@password=?,@nombre=?,@apellido=?,@correo=?,@perfil=?',$param);
                
                    if( !$stmt ) {
                    die( print_r( sqlsrv_errors(), true));
                    }
        
                    if(sqlsrv_execute($stmt)===false){
                        die( print_r( sqlsrv_errors(), true));
                    }else{
                        do{
                        while($res = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){;
                                    if($res['respuesta']==1){
                                        $_SESSION['RespuestaRegistroUsuario']= "<p class='resultado-conforme'> Usuario registrado correctamente </p>";
                                        header ("location: index");
                                    }else{
                                        $_SESSION['RespuestaRegistroUsuarioerror'] = "<p class='resultado'>".$res['respuesta']."</p>";
                                        $variables = array($nombre,$apellido,$correo,$perfil,$usuario,$password1,$password2);
                                        return $variables; 
                                    }
                                //  var_dump($result);
                            }
                        }while (sqlsrv_next_result($stmt));
                    }
            }
            unset($sql,$parametro); //limpieza de variables
            // 
            }
    }

}

class __functioncontrolactividades extends conexion{
    public static function ListarPendientes(){
        $conexion = conexion::conectar();
        $stmt = sqlsrv_query($conexion,"exec sp_ca_select");
        $actividades = [];
        while($actividad = sqlsrv_fetch_object($stmt)){
            array_push($actividades,$actividad);
        }
        return $actividades;
    }
}

class __functioncontrolinventario extends conexion{

    public static function __MostrarRegistros(){
        $conexion = conexion::conectar();
        if(isset($_SESSION['totalregistro'])){
            $cantidadreg = $_SESSION['totalregistro'];
        }else{
            $cantidadreg=25;
            $_SESSION['totalregistro'] = $cantidadreg;
        }
        
        if(!isset($_SESSION['pagci'])){
            $pagina = 0;
        }else{
            $pagina= $_SESSION['pagci'];
        }

        $param = array($pagina,$cantidadreg);
        $stmt = sqlsrv_query($conexion, "EXEC SP_CI_SELECT @pagina=?,@cantidadreg=?",$param);
        $registrosci = [];
        while($ci = sqlsrv_fetch_object($stmt)){
            array_push($registrosci,$ci);
        }
        return $registrosci;

    }

    public static function __Paginacion(){
        if(isset($_POST['cantidad-registros'])){
            $_SESSION['totalregistro'] = $_POST['cantidad-registros'];
            if($_SESSION['totalregistro']<0){
                $_SESSION['totalregistro']=1;
            }
            header("location: ../vistas/control-de-inventario");

        }
        if(isset($_GET['paginacion'])){
            // isset($_SESSION['pagci']
            $pagina = $_GET['paginacion'];
            $pagina_actual = $_SESSION['pagci'];
        
            if($pagina=="prev"){
                if($pagina_actual >=1){
                    $pagina_actual=$pagina_actual-1;
                }
            }elseif ($pagina=="next"){
                    $pagina_actual=$pagina_actual+1;
            }
            $_SESSION['pagci'] = $pagina_actual;
            header("location: ../vistas/control-de-inventario");
        }
        
    }

    public static function __PermisosCI($perfil,$id){
        if($perfil=="1"){
            $permiso = '<a class="actividad edit" href="control-de-inventarioUPDT?idregistroci='.$id.'"><img src="..\Img\iconos\create-outline.svg" alt="edit"></a>';
            $permiso .= '<a class="actividad delete" href="control-de-inventario?accion=delete&idregistroci='.$id.'" 
            onclick="return confirm(\'Estas seguro de eliminar el registro?\')" ><img src="..\Img\iconos\trash-outline.svg" alt="trash"></a>';
        }elseif($perfil=="2"){
            $permiso = '<a class="actividad edit" href="control-de-inventarioUPDT?idregistroci='.$id.'"><img src="..\Img\iconos\create-outline.svg" alt="edit"></a>';
        }elseif($perfil=="3"){
            $permiso = '<a class="actividad edit" href="control-de-inventarioUPDT?idregistroci='.$id.'"><img src="..\Img\iconos\create-outline.svg" alt="edit"></a>';
        }
        echo $permiso;
    }

    public static function __AgregarRegistro(){
        if($_SESSION['perfil']==1 || $_SESSION['perfil']==2){
            if(isset($_POST['registrarci'])){
                
                $cliente = $_POST['cliente'];
                $idcliente = $_POST['idcliente'];
                $solicitante = $_POST['solicitante'];
                $workorder = $_POST['workorder'];
                $fechacorreo = $_POST['fechacorreo'];
                $actividad = $_POST['actividad'];
                echo $actividad;
                $fecharecepcion = $_POST['fecharecepcion'];
                $servicio = $_POST['servicio'];
                $inicioinv = $_POST['inicioinv'];
                $fininv = $_POST['fininv'];
                $estadoinv = $_POST['estadoinv'];
                $cantcajas = $_POST['cantcajas'];
                $cantfiles = $_POST['cantfiles'];
                $dias = $_POST['dias'];
                $observacion = $_POST['observacion'];
                $nombrearchivo = $_POST['nombrearchivo'];
                $usuario = $_SESSION['IDusuario'];
            
                    if(empty($fechacorreo)){
                        $fechacorreomod = NULL;
                    }else{
                        $fechacorreomod = $fechacorreo;
                    }
            
                    if(empty($fecharecepcion)){
                        $fecharecepcionmod = NULL;
                    }else{
                        $fecharecepcionmod = $fecharecepcion;
                    }
            
                    if(empty($inicioinv)){
                        $inicioinvmod = NULL;
                    }else{
                        $inicioinvmod = $inicioinv;
                    }
            
                    if(empty($fininv)){
                        $fininvmod = NULL;
                    }else{
                        $fininvmod = $fininv;
                    }
            
                    $param = array($idcliente,$solicitante,$workorder,$fechacorreomod,
                                    $actividad,$fecharecepcionmod,$servicio,$inicioinvmod,$fininvmod,
                                    '1',$cantcajas,$cantfiles,$dias,$observacion,$nombrearchivo,
                                    $usuario);
                        $conexion = conexion::conectar();
                        $stmt = sqlsrv_prepare($conexion,'exec [SP_CI_INSERT] 
                        @cliente=?,	@solicitante=?,	@workorder=?,	@fechacorreo=?,	
                        @actividad=?,	@fecharecepcion=?,	@service=?,	@iinv=?,	@finv=?,	
                        @estadoinv=?,	@ccajas=?,	@citem=?,	@dias=?,	@obs=?,	@nombrearchivo=?, 
                        @usuarioreg=?',$param);
                    // print_r($param);
                    if(sqlsrv_execute($stmt)===true){
                        $_SESSION['RespuestaQuery'] = "<p class='respuesta correcto'>Registro ingresado correctamente.</p> ";
                        header ("location: control-de-inventario");
                        sqlsrv_close($conexion);
                    }else{
                        // if( ($errors = sqlsrv_errors() ) != null) {
                        //     foreach( $errors as $error ) {
                        //         echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
                        //         echo "code: ".$error[ 'code']."<br />";
                        //         echo "message: ".$error[ 'message']."<br />";
                        //     }
                        // }
                        $_SESSION['RespuestaQuery'] = "<p class='respuesta error'>Ocurrio un error al registrar en el control de iventario.".print_r( sqlsrv_errors(), true)."</p> ";
                    }
            
            }
        }else{
            header ("location: control-de-inventario");
            die($_SESSION['RespuestaQuery'] = "<p class='respuesta error'>Usted no tiene permisos para agregar registros del control de inventario</p>");
        }
    }
    public static function __ModificarRegistro(){
        if(isset($_POST['update'])){
                if($_SESSION['perfil']==1||$_SESSION['perfil']==2||$_SESSION['perfil']==3){
                    $conexion = conexion::conectar();
                    $id = $_GET['idregistroci'];
                    // $CLIENTE = $_POST['cliente'];
                    $solicitante = $_POST['solicitante'];
                    $workorder = $_POST['workorder'];
                    $fechacorreo = $_POST['fechacorreo'];
                    $actividad = $_POST['actividad'];
                    $fecharecepcion = $_POST['fecharecepcion'];
                    $servicio = $_POST['servicio'];
                    $inicioinv = $_POST['inicioinv'];
                    $fininv = $_POST['fininv'];
                    // $estadoinv = $_POST['estadoinv'];
                    $cantcajas = $_POST['cantcajas'];
                    $cantfiles = $_POST['cantfiles'];
                    $dias = $_POST['dias'];
                    $observacion = $_POST['observacion'];
                    $nombrearchivo = $_POST['nombrearchivo'];
                    $estadoregistro = $_POST['estadoregistro'];
                    $usuario = $_SESSION['IDusuario'];
            
                    //validacion fecha inicio y fin
                    if(!empty($fininv) && empty($inicioinv)){
                        $_SESSION['RespuestaQuery'] ="No se ingreso la fecha inicio del inventario";   
                    }elseif($fininv < $inicioinv && (!empty($fininv) || $fininv!=="") ){
                        $_SESSION['RespuestaQuery'] ="La fecha final es menor a la fecha inicial del inventario; revisar los datos ingresados.";              
                    }else{
                        $Updtime = date('Y-m-d h:i:s', time());  //date("d").'/'.date("m").'/'.date("Y").' '.time();
                
                        if(empty($fechacorreo)){
                            $fechacorreomod = NULL;
                        }else{
                            $fechacorreomod = $fechacorreo;
                        }
                
                        if(empty($fecharecepcion)){
                            $fecharecepcionmod = NULL;
                        }else{
                            $fecharecepcionmod = $fecharecepcion;
                        }
                
                        if(empty($inicioinv)){
                            $inicioinvmod = NULL;
                        }else{
                            $inicioinvmod = $inicioinv;
                            $estadoinvmod = 2;
                        }
                
                        if(empty($fininv)){
                            $fininvmod = NULL;
                        }else{
                                $parametro = array($id);
                                $consultaperiodo = sqlsrv_query($conexion,'exec SP_PERIODO_X_CI @id=?',$parametro);
                                $datoperiodo = sqlsrv_fetch_array($consultaperiodo,SQLSRV_FETCH_ASSOC);
                
                                if(!isset($datoperiodo['FECHA_INI']) && !isset($datoperiodo['FECHA_FIN'])){
                                    $_SESSION['RespuestaQuery'] = "<p class='resultado error'>Datos no actualizados, error en al intentar obtener información del cliente 'corte y periodo'.</p>";
                                    // die (header("location: control-de-inventario"));
                                }
                                        $PDinicio = $datoperiodo['FECHA_INI'];
                                        $PDfin = $datoperiodo['FECHA_FIN'];            
                                $ff = $fininv;
                
                                    $mes = date("m",strtotime($ff));
                                    $year = date("Y",strtotime($ff));
                        
                                    if($PDfin=="31"||$PDfin=="30"){
                                        if($mes-1 == 0){
                                            $year1 = $year-1;
                                            $mes1 = 12;
                                        }else{
                                            $mes1 = $mes;
                                            $year1 = $year;
                                        }
                                    }else {
                                        if($mes-1 == 0){
                                            $year1 = $year-1;
                                            $mes1 = 12;
                                        }else{
                                            $mes1 = $mes-1;
                                            $year1 = $year;
                                        }
                                    }
                        
                                    $ff = new datetime($ff);
                                    $ff = $ff->format('Y-m-d');
                                    $PFinicio =new datetime($year1.'-'.$mes1.'-'.$PDinicio);
                                    $PFinicio= $PFinicio->format('Y-m-d'); 
                                    $PFfin = new datetime($year.'-'.$mes.'-'.$PDfin);
                                    $PFfin = $PFfin->format('Y-m-d');
                        
                                    if($ff >= $PFinicio && $ff <= $PFfin ){
                                        $mes;
                                        $year;
                                    }else{
                                        if($mes+1 ==13){
                                            $mes=1; $year++;
                                        }else{
                                            $mes++; $year;
                                        }
                                    }
                        
                                    switch ($mes) {
                                        case '1':
                                        $resp = "Enero ".$year;
                                        break;
                                        case '2':
                                        $resp = "Febrero ".$year;
                                        break;
                                        case '3':
                                        $resp = "Marzo ".$year;
                                        break;
                                        case '4':
                                        $resp =  "Abril ".$year;
                                        break;
                                        case '5':
                                        $resp = "Mayo ".$year;
                                        break;
                                        case '6':
                                        $resp =  "Junio ".$year;
                                        break;
                                        case '7':
                                        $resp = "Julio ".$year;
                                        break;
                                        case '8':
                                        $resp = "Agosto ".$year;
                                        break;
                                        case '9':
                                        $resp = "Setiembre ".$year;
                                        break;
                                        case '10':
                                        $resp = "Octubre ".$year;
                                        break;
                                        case '11':
                                        $resp =  "Noviembre ".$year;
                                        break;
                                        case '12':
                                        $resp = "Diciembre ".$year;
                                        break;
                                        
                        
                                    }
                                $fininvmod = $fininv;
                                $periodo = $resp;
                                $estadoinvmod = 3;
                                echo $periodo;
                                echo $estadoinvmod;
                        }
                
                        if(!isset($periodo)){$periodo = NULL;}
                        if(!isset($estadoinvmod)){$estadoinvmod=1;}
                
                        $param = array($id,$solicitante,$workorder,$fechacorreomod,$actividad,$fecharecepcionmod,$servicio,
                                        $inicioinvmod,$fininvmod,$cantcajas,$cantfiles,$dias,$observacion,$nombrearchivo,$periodo,$usuario,$estadoinvmod,$estadoregistro);
                            $stmt = sqlsrv_prepare($conexion,'exec [SP_CI_UPDATE] @id=?,        @solicitante =?,        @workorder =?,        @fechacorreo =?,
                            @actividad =?,        @fecharecepcion =?,        @service =?,        @iinv =?,        @finv =?,        @ccajas =?,
                            @citem =?,        @dias =?,        @obs =?,        @nombrearchivo =?,        @cierre =?,        @usuariomod =?, @estadoinvmod=?, @estadoreg=?',$param);
                
                        if(sqlsrv_execute($stmt)){
                                $_SESSION['RespuestaQuery'] = "<p class='respuesta correcto'>El registro se actualizó correctamente!.</p> ";
                                header("location: control-de-inventario");
                        }else{
                            die($_SESSION['RespuestaQuery'] = "<p class='respuesta error'>".print_r(sqlsrv_errors(),true))."</p>";
                        }
                    }
            }else{
                header ("location: control-de-inventario");
                die($_SESSION['RespuestaQuery'] = "<p class='respuesta error'>Usted no tiene permisos para modificar registros del control de inventario</p>");
            }
        }
    }
    public static function __MostrarRegistroModificar(){
        if($_GET['idregistroci']){
            $id = $_GET['idregistroci'];
        
            $conexion = conexion::conectar();
            $param = array($id);
            $stmt = sqlsrv_prepare($conexion,"exec SP_CI_SELECT_EDIT @id=?",$param);
            if(sqlsrv_execute($stmt)===true){
                $row = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);
                //sin contenido
                if(empty($row)){
                    $_SESSION['RespuestaQuery'] = "<p class='respuesta error'>No se encontro el registro consultado</p>";
                    die(header("location: control-de-inventario"));
                }  
                //formateo de fechas
                // if(!empty($row['FECHA_DE_CORREO'])){$fc = date('Y-m-d', strtotime($row['FECHA_DE_CORREO']));}
                // if(!empty($row['FECHA_RECEPCION'])){$fr = date('Y-m-d', strtotime($row['FECHA_RECEPCION']));}
                // if(!empty($row['INICIO_INV'])){$fii = date('Y-m-d', strtotime($row['INICIO_INV']));}
                // if(!empty($row['FIN_INV'])){$ffi = date('Y-m-d', strtotime($row['FIN_INV']));}             
            }
            return $row;
        }
    }
    public static function __EliminarRegisto(){
        if(isset($_GET['accion']) && isset($_GET['idregistroci'])){
            if($_SESSION['perfil']==1){
                $proceso = $_GET['accion'];
                $id = $_GET['idregistroci'];
                
                if($proceso == 'delete'){
                    $conexion = conexion::conectar();

                    $param = array($id);
                    $stmt = sqlsrv_query($conexion,'exec SP_CI_CA_DELETE_VALIDATE @id=?',$param);
                    $result = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);
                    $reg_exist =  $result['conteo'];

                    if(isset($reg_exist)&& $reg_exist >=1){
                        $param = array($id);
                        $stmt = sqlsrv_query($conexion,'exec SP_CI_CA_DELETE @id=?',$param);
                        if($stmt===false){
                            $_SESSION['RespuestaQuery'] = "<p class='respuesta error'>Ups!, ocurrió un error: ".print_r( sqlsrv_errors(), true)."</p> ";
                        }else{
                            $_SESSION['RespuestaQuery'] = "<p class='respuesta correcto'>Registros eliminado correctamente.</p>";
                        }
                    }else{
                        $_SESSION['RespuestaQuery'] = "<p class='respuesta error'>El registro que desea eliminar no existe.</p>";
                    }
                }
                header ("location control-de-inventario");
            }else{
                // $url = $_SERVER['PHP_SELF'];
                header ("location: control-de-inventario");
                die($_SESSION['RespuestaQuery'] = "<p class='respuesta error'>Usted no tiene permisos para ELIMINAR registros del control de inventario.</p>");
                
            }
        }
    }


    public static function __Refresh(){
        // $page = $_SERVER['PHP_SELF'];
        $sec = "30";
        header("Refresh: $sec; url=control-de-inventario");

        date_default_timezone_set("America/Lima");
        // echo date_default_timezone_get();
    }
}

class __functionsession {
    public static function __SessionPaginaUsuarios($usuario){
        // $usuario = $_SESSION['IDusuario'];
        if (!isset($usuario)) {
            header('location: ../index');
            die();
        }elseif(isset($usuario)){
            if($_SESSION['perfil']<>"1"){
                header('location: ../index');
                die();
            }
        }
    }

    public static function __SessionValidarLogin($usuario){
        if (!isset($usuario)) {
            header('location: ../index');
            die();
        }
    }

    public static function __SessionPaginaInicio($usuario){
        if (!isset($usuario)) {
            header('location: index');
            die();
        }
    }

    public static function __ejemplo(){
        echo ("<ul class='menu'>
        <li class='item'>
            <p class='item-text'>Control de inventario</p>
            <ul class='submenu'>
                <li class='subitem'>
                    <a class='sbitem-elemento' href='vistas/control-de-inventario' target='iframepage'>Principal CI</a>
                </li>
                <li class='subitem'>
                    <a class='sbitem-elemento' href='vistas/control-de-actividades' target='iframepage'>Control de
                        actividades</a>
                </li>
            </ul>
        </li>");
    }
}