<?php
include_once 'app/funciones_app/Galeria.inc.php';
$datos = array();
$galeria =array();

$salida ='';
$error ='';
if(empty($_POST)){
  RedireccionUrl::redirigir(INDEX_URL);
  exit();  
}
if(isset($_FILES['archivos']['name'][0]) && !empty($_FILES['archivos']['name'][0])){

$galeria = $_POST['galera'];
foreach($_FILES['archivos']['name'] as $key => $value) {

  $tipo_archivo = $_FILES['archivos']['type'][$key];
  $imagen = Galeria::comprobar_imagen($tipo_archivo);
  $pdf = Galeria::comprobar_pdf($tipo_archivo);
  if($imagen){
    if(move_uploaded_file($_FILES['archivos']['tmp_name'][$key],'preview/'.$value))
    {
    $salida.= Galeria::construccion_items_subidos($value);
    }
  }
  elseif($pdf){
      //es pdf
      if(move_uploaded_file($_FILES['archivos']['tmp_name'][$key],'uploads/pdfs/'.$value)){
        $salida .= Galeria::construir_items_archivos($value);
      }
  }
  else{

  }
}
$galeria= Galeria::crear_galeria($galeria,$_FILES['archivos']);
$datos['galeria'] =$galeria;
$datos['exito']=true;
$datos['previews']=$salida;


}
else{
  $datos['exito'] = false;
  $datos['error'] = 'No hay archivos para subir';
}
echo json_encode($datos);






?>
