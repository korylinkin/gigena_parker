<?php

////good
if(isset($_POST['accion'])&& !empty($_POST['accion'])&& !empty($_SESSION)){

$ide = '';
$accion = $_POST['accion'];
$id_usuario ='';
if(isset($_POST['usuario'])&&!empty($_POST['usuario'])){
  $id_usuario = $_POST['usuario'];
}
if(isset($_POST['id'])&&!empty($_POST['id'])){
  $ide = $_POST['id'];
}
if($accion=='borrar_archivo'){
  $url_archivo = $_POST['url_archivo'];
  $partes = explode('/',$url_archivo);
  $url_nueva = $partes[1].'/'.$partes[2];
  if(count($partes)>3){
    $url_nueva = $partes[1].'/'.$partes[2].'/'.$partes[3];
  }
  $borrado = unlink($url_nueva);
  $datos['respuesta'] =$borrado;
  echo json_encode($datos);
}

if($accion=='crear_url'){
  $titulo = $_POST['titulo'];
$resultado = crear_url($titulo);
echo json_encode($resultado);
}
if($accion=='borrar'){
$resultado = borrar_post($ide);
echo json_encode($resultado);
}
if($accion=='editar'){
  $resultado = editar_post($ide);
  echo json_encode($resultado);
}
if($accion=='modificar'){
  $resultado = modificar_post($ide);
  echo json_encode($resultado);
}



if ($accion=='editar_usuario') {

  $d_sesion = $_POST['sesion'];
  $id_priv = (int)$d_sesion['privilegio'];
  if($id_priv==11 || $id_priv==13){

    if(isset($_POST['consulta']) && $_POST['consulta']=='obtener_usuario'){
      $resp = obtener_usuario_id($id_usuario);
      $resultado = $resp;
    }

  }
  else{
    $resultado['respuesta'] = 'No podes acceder rata.';

  }
  echo json_encode($resultado);
}
if ($accion=='borrar_usuario') {

  $d_sesion = $_POST['sesion'];
  $id_priv = (int)$d_sesion['privilegio'];
  if($id_priv==11 || $id_priv==13){
    $borrar_usuario = borrar_usuario($id_usuario);
    $resultado['exito'] = $borrar_usuario['exito'];
    $resultado['accion'] = $accion;
    $resultado['respuesta'] =$borrar_usuario['respuesta'];

  }
  else{
    $resultado['exito'] = $borrar_usuario['exito'];
    $resultado['respuesta'] =$borrar_usuario['respuesta'];

  }
  echo json_encode($resultado);
}
if($accion=='modificar_usuario'){

$respuesta = modificar_usuario_id($id_usuario);

echo json_encode($respuesta);

}



}
else{
  echo '<script> window.location="login"</script>';
}


function modificar_usuario_id($id){
  include_once 'app/Conexion.inc.php';
  $respuesta =array();
  Conexion::abrir_conexion();
  $conexion = Conexion::obtener_conexion();
  $nombre = $_POST['datos'][0]['value'];
  $apellido = $_POST['datos'][1]['value'];
  $email = $_POST['datos'][2]['value'];
  $privilegio = (int)$_POST['datos'][5]['value'];
  $sql = "UPDATE usuarios SET nombre = '$nombre',apellido ='$apellido',email='$email',privilegio='$privilegio' WHERE id = '$id'";
  $consulta = $conexion->prepare($sql);
  $resultado = $consulta->execute();
  Conexion::cerrar_conexion();
  if($resultado){
    $respuesta['exito']=true;
    $respuesta['respuesta']="Usuario modificado con exito";

  }else {
    $respuesta['exito']=false;
    $respuesta['respuesta'] = 'Hubo algun error en la consulta, vuelve a intentarlo';
  }

  return $respuesta;

  }

function obtener_usuario_id($id){
  include_once 'app/Conexion.inc.php';
  $respuesta =array();
  Conexion::abrir_conexion();
  $conexion = Conexion::obtener_conexion();
  $sql = "SELECT id,nombre,apellido,email,privilegio FROM usuarios WHERE usuarios.id = $id";
  $consulta = $conexion->prepare($sql);
  $resultado = $consulta->execute();
  Conexion::cerrar_conexion();
  if($resultado){
    $respuesta['exito']=true;
    $respuesta['usuario'] = $consulta->fetch();

  }else {
    $respuesta['exito']=false;
    $respuesta['respuesta'] = 'Hubo algun error en la consulta, vuelve a intentarlo';
  }

  return $respuesta;

}

function borrar_usuario($id){
  include_once 'app/Conexion.inc.php';
  $respuesta =array();
  Conexion::abrir_conexion();
  $conexion = Conexion::obtener_conexion();
  $sql = "DELETE FROM usuarios WHERE usuarios.id = $id";
  $consulta = $conexion->prepare($sql);
  $resultado = $consulta->execute();
  Conexion::cerrar_conexion();
  if($resultado){
    $respuesta['exito']=true;
    $respuesta['respuesta'] = 'Se elimino el usuario con exito';

  }else {
    $respuesta['exito']=false;
    $respuesta['respuesta'] = 'Hubo algun error en la consulta, vuelve a intentarlo';
  }

  return $respuesta;

}
function modificar_post($id){
  include_once 'app/Conexion.inc.php';
  $titulo = $_POST['titulo_mod'];
  $texto = $_POST['texto_nuevo'];

  date_default_timezone_set('America/Argentina/Buenos_Aires');
  $dat = date('d/m/Y H:i:s');
  $url_nueva = $_POST['url'];

  Conexion::abrir_conexion();
  $conexion = Conexion::obtener_conexion();
  $sql = "UPDATE articulos SET titulo =  '$titulo',texto ='$texto',fecha_modificacion =NOW() ,url='$url_nueva' WHERE id_articulo = '$id'";
  $consulta = $conexion->prepare($sql);
  $resultado = $consulta->execute();
  Conexion::cerrar_conexion();
  if($resultado){
    $datos['resultado'] ='El articulo se modifico correctamente';
    $datos['exito'] = $resultado;
    return $datos;
  }
  else{
    $datos['resultado'] ='actualizacion_incorrecta';
    $datos['exito'] = $resultado;
    return $datos;
  }
}
function borrar_post($id){
  include_once 'app/Conexion.inc.php';
  Conexion::abrir_conexion();
  $conexion = Conexion::obtener_conexion();
  $sql = "DELETE FROM articulos WHERE articulos.id_articulo = '$id'";
  $consulta = $conexion->prepare($sql);
  $resultado = $consulta->execute();
  Conexion::cerrar_conexion();
  if($resultado){
    $datos['resultado'] ='borrado_completo';
    $datos['exito'] = $resultado;
    return $datos;
  }
  else{
    $datos['resultado'] ='error en consulta';
    $datos['exito'] = $resultado;
    return $datos;
  }

}

function editar_post($id){
  include_once 'app/Conexion.inc.php';
  Conexion::abrir_conexion();
  $conexion = Conexion::obtener_conexion();
  $sql = "SELECT id_articulo,titulo,texto FROM articulos WHERE articulos.id_articulo = $id";
  $consulta = $conexion->prepare($sql);
  $resultado = $consulta->execute();
  Conexion::cerrar_conexion();
  if($resultado){
    $datos = $consulta->fetch();
    return $datos;
  }
  else{
    return 'anda mal algo';
  }
}


function crear_url($titulo){
  $titulo = comprobar_signos($titulo);
  $titulo = eliminar_tildes($titulo);
  $titulo = str_replace(' ','-',$titulo);
  $titulo = strtolower($titulo);
  return $titulo;
}
function comprobar_signos($titulo){
  $primer = $titulo[0];
  $ultimo = $titulo[strlen($titulo)-1];
  $comprobar = mb_convert_encoding($primer, 'UTF-8', 'UTF-8');
  $modificado ='';
  if($comprobar=='?' || $ultimo=='?'){
    if ($comprobar=='?' && $ultimo=='?'){
      $modificado = substr($titulo,2,strlen($titulo)-3);
    }
    else{
      if ($comprobar=='?') {
        $modificado = substr($titulo,2,strlen($titulo));
      }else {
        $modificado = substr($titulo,0,strlen($titulo)-1);
      }
    }
  }
  else{
    $modificado = $titulo;
  }
  $resultado = $modificado;
  return $resultado;
}
function eliminar_tildes($cadena){
    //Ahora reemplazamos las letras
    $cadena = str_replace(
        array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
        array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
        $cadena
    );
    $cadena = str_replace(
        array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
        array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
        $cadena );
    $cadena = str_replace(
        array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
        array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
        $cadena );
    $cadena = str_replace(
        array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
        array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
        $cadena );
    $cadena = str_replace(
        array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
        array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
        $cadena );
    $cadena = str_replace(
        array('ñ', 'Ñ', 'ç', 'Ç'),
        array('n', 'N', 'c', 'C'),
        $cadena
    );
    return $cadena;
}


 ?>
