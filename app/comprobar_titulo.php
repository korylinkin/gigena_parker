<?php
include_once 'app/Conexion.inc.php';

function comprobar_titulo($titulo){

  Conexion::abrir_conexion();
  $conexion = Conexion::obtener_conexion();
  $respuesta = array();
  $sql = 'SELECT titulo FROM articulos WHERE titulo ="'.$titulo.'"';
  $ejecutar = $conexion->prepare($sql);
  $resultado = $ejecutar->execute();
  Conexion::cerrar_conexion();
  if($resultado){
    $datos = $ejecutar->fetch();
    if($datos){
      $error= 'Este titulo ya esta en uso';
      $respuesta['texto'] = $error;
      $respuesta['error'] = true;
      return json_encode($respuesta);
    }
    else{
      $error= 'Este titulo esta disponible';
      $respuesta['texto'] = $error;
      $respuesta['error'] = false;
      return json_encode($respuesta);
    }

  }


}
if(empty($_POST)){
  RedireccionUrl::redirigir(INDEX_URL);
}
$comprobar = comprobar_titulo($_POST['titulo_articulo']);
echo $comprobar;


 ?>
