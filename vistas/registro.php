<?php
if(empty($_POST)){
  RedireccionUrl::redirigir(INDEX_URL);
}
    include_once 'app/AccionesDeUsuario.inc.php';
    include_once 'app/Usuario.inc.php';
    include_once 'app/ValidacionRegistro.inc.php';
    include_once 'app/RenderizarPhp.inc.php';
    include_once 'app/Conexion.inc.php';
    include_once 'app/ControlSesion.inc.php';
    Conexion::abrir_conexion();
    $respuesta = '';
    $datos=array();
    $insertado='';
    $validador = new ValidacionRegistro($_POST['nombre'],$_POST['apellido'],$_POST['email'],$_POST['contrasena'],$_POST['contrasena_check'],$_POST['privilegios_nuevo'],Conexion::obtener_conexion());
    if($validador->registro_valido()){
      $nombre =$validador->obtener_nombre();
      $apellido =$validador->obtener_apellido();
      $email = $validador->obtener_email();
      $password =$validador->obtener_pass();
      $privilegio = $validador->obtener_privilegio();
      //registro valido, paso todas las pruebas ---agregar usuario a la bd----
      $usuario = new Usuario('',$nombre,$apellido,$email,password_hash($password,PASSWORD_DEFAULT),'','','','',$privilegio,'NOW()',1);
      $insertado = AccionesDeUsuario::insertar_usuario(Conexion::obtener_conexion(),$usuario);
      if($insertado){
        Conexion::cerrar_conexion();
        $datos['exito'] = $insertado;
        $datos['respuesta'] = 'Usuario agregado correctamente';
      }
      else{
        $datos['exito'] = $insertado;
        $datos['respuesta'] ='Hubo algun error en la consulta';
      }

    }
    else{
      //$html = var_dump($validador->obtener_errores());
      //$respuesta= Renderizar::render_php('estructuras/registro_form_validado.php');
      $datos['exito'] =false;
      $datos['respuesta'] = $validador->obtener_errores();
    }

echo json_encode($datos);

?>
