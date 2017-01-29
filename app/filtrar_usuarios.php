<?php
if(isset($_POST['accion'])&& $_POST['accion']=='filtrar'){

  include_once 'app/Conexion.inc.php';
  include_once 'app/Usuario.inc.php';
  include_once 'app/AccionesDeUsuario.inc.php';
  Conexion::abrir_conexion();
  $conexion = Conexion::obtener_conexion();
  $usuarios = AccionesDeUsuario::obtenerTodos($conexion);
  $id_filtro = (int)$_POST['id'];

  $usuarios_filtrados =array();
  $usuarios_filtrados['usuarios_filtrados'][] = filtrar_usuarios($id_filtro,$conexion);
  $usuarios_filtrados['datos_sesion'] =$_SESSION;
  Conexion::cerrar_conexion();
  $respuesta= '';
  $respuesta = json_encode($usuarios_filtrados);
  echo $respuesta;


}
function filtrar_usuarios($id_privilegio,$conexion){
  $sql='';
  if($id_privilegio==0){
    $sql = "SELECT * FROM usuarios INNER JOIN privilegios ON usuarios.privilegio = privilegios.id_priv ";
  }
  else{
  $sql = "SELECT * FROM usuarios INNER JOIN privilegios ON usuarios.privilegio = privilegios.id_priv WHERE usuarios.privilegio = $id_privilegio ";

  }
  $consulta = $conexion->prepare($sql);
  $resultado = $consulta->execute();
  if($resultado){
    $datos  = $consulta->fetchAll();
    return $datos;
  }






}

 ?>
