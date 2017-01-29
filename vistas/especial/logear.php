<?php
 include_once 'app/Conexion.inc.php';
 include_once 'app/ValidacionLogin.inc.php';
 include_once 'app/ControlSesion.inc.php';
 Conexion::abrir_conexion();

 $control_login = new ControlSesion();
 $campos_correctos = $control_login->comprobar_campos($_POST['email'],$_POST['password']);
 $validador = new ValidacionLogin($_POST['email'],$_POST['password'],Conexion::obtener_conexion());
 Conexion::cerrar_conexion();
 //viene el if que dice que si los campos estan llenos, entonces se ejecutan las cosas porque se enviaron datos, sino alguien intenta entrar.
 if($campos_correctos){
   //aca se mandan los datos del post correctamente

   $usuario = $validador ->obtener_usuario();
   $error= $validador->obtener_error();
   $respuesta =array();
   if($error==''&& !is_null($usuario)){
       //iniciar sesion y redirigir
          ControlSesion::iniciar_sesion($usuario->obtener_id(),$usuario->obtener_privilegio(),$usuario->obtener_nombre());
          $respuesta['exito']=true;
          $respuesta['redireccion'] ='administrador';
   }
   else{
     $respuesta['exito']=false;
     $respuesta['respuesta']=$error;
     $respuesta['redireccion'] ='';
   }

      echo json_encode($respuesta);
 }
 else{

   //RedireccionUrl::redirigir(INDEX_URL);
   $error= $validador->obtener_error();
   $respuesta['exito']=false;
   $respuesta['respuesta'] =$error;
   $respuesta['redireccion'] ='';
   echo json_encode($respuesta);

 }

?>
