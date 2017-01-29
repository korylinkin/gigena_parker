<?php
$datos =array();
if(isset($_POST['accion'])&& !empty($_POST['accion']) && !empty($_SESSION)){


$datos['exito'] =true;
$datos['sesion'] = $_SESSION;
}
else{
  $datos['exito'] =false;
  $datos['sesion'] = '';
}
echo json_encode($datos);
 ?>
