<?php
include_once 'app/Conexion.inc.php';
include_once 'app/Articulos.inc.php';
include_once 'app/iArticulos.inc.php';
date_default_timezone_set('America/Argentina/Buenos_Aires');


if(isset($_POST)&& !empty($_POST)){
  $id_articulo= $_POST['id_articulo'];
  $id_autor = $_POST['id_autor'];
  $id_categoria =(int)$_POST['categoria_articulo'];
  $url ='';
  $titulo = $_POST['titulo_articulo'];
  $contenido = $_POST['contenido_articulo'];
  $fecha_creacion = date(' d/m/Y H:i:s');
  $fecha_modificacion =$fecha_creacion;
  $img_principal = $_POST['img_principal'];
  $galeria =$_POST['galera'];
  $acceso_cliente = $_POST['especial'];
  $resultado ='';
  $articulo = new Articulos($id_articulo,$id_autor,$id_categoria,$url,$titulo,
                           $contenido,$fecha_creacion,$fecha_modificacion,
                           $img_principal,$galeria,0,1,$acceso_cliente);


  if($articulo->crear_url_articulo()){
   $subir = $articulo->guardar_articulo();//aca ya se subio el articulo a la base de datos.
   if($subir){
     $datos['exito']= $subir;
     $datos['resultado'] ='El Articulo se subio correctamente';
     $datos['accion'] ='<script > window.location= "../administrador";</script>';
     echo json_encode($datos);
   }
   else{
     $datos['exito'] = $subir;
     $datos['resultado'] ='Algo salio mal';
     echo json_encode($datos);

   }
  }
}
else{
  $datos['exito'] = false;
  $datos['resultado'] ='Redireccionando';
  RedireccionUrl::redirigir(INDEX_URL);
}














?>
