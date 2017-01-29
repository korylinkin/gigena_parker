<?php

$respuesta = array();
if(isset($_POST) && !empty($_POST)){
  if (isset($_POST['accion']) && !empty($_POST['accion'])) {
    if($_POST['accion']==='enrutar'){
      $url = $_POST['url'];
      $vista = obtener_vista($url);
      if($vista['exito']){
        $respuesta['exito'] = $vista['exito'];
        $respuesta['url'] =$vista['url'];
      }else {
        $respuesta['exito'] = $vista['exito'];
        $respuesta['url'] =$vista['url'];
      }
    }elseif ($_POST['accion']=='obtener_galeria') {
      $respuesta['exito'] = true;
      $respuesta['archivos'] =obtenerListadoDeArchivos('imgs/vertientes');
    }

  }
}

echo json_encode($respuesta);

function obtenerListadoDeArchivos($directorio){

  // Array en el que obtendremos los resultados
  $res = array();

  // Agregamos la barra invertida al final en caso de que no exista
  if(substr($directorio, -1) != "/") $directorio .= "/";

  // Creamos un puntero al directorio y obtenemos el listado de archivos
  $dir = @dir($directorio) or die("getFileList: Error abriendo el directorio $directorio para leerlo");
  while(($archivo = $dir->read()) !== false) {
      // Obviamos los archivos ocultos
      if($archivo[0] == ".") continue;
      if(is_dir($directorio . $archivo)) {
          $res[] = array(
            "Nombre" => $directorio . $archivo . "/",
            "Tamaño" => 0,
            "Modificado" => filemtime($directorio . $archivo)
          );
      } else if (is_readable($directorio . $archivo)) {
          $res[] = array(
            "Nombre" => $directorio . $archivo,
            "Tamaño" => filesize($directorio . $archivo),
            "Modificado" => filemtime($directorio . $archivo)
          );
      }
  }
  $dir->close();
  return $res;
}


function obtener_vista($url){
  $respuesta = array();
  if($url=='inicio'){
    $url = 'estructuras/vertientes/inicio_vertientes.php';
    $respuesta['exito']=true;
    $respuesta['url'] =$url;
  }elseif ($url=='nosotros') {
    # code...
    $url = 'estructuras/vertientes/nosotros_vertientes.php';
    $respuesta['exito']=true;
    $respuesta['url'] =$url;
  }elseif ($url=='espacios') {
    # code...
    $url = 'estructuras/vertientes/espacios_terapeuticos.php';
    $respuesta['exito']=true;
    $respuesta['url'] =$url;
  }
  elseif ($url == 'equipo') {
    # code...
    $url = 'estructuras/vertientes/equipo_vertientes.php';
    $respuesta['exito']=true;
    $respuesta['url'] =$url;
  }
  else{
    $respuesta['exito'] =false;
    $respuesta['url'] = '';
    $respuesta['error'] = 'No se encontro la ruta especificada';
  }
  return $respuesta;
}
?>
