<?php
if (isset($_POST['accion']) && !empty($_POST['accion'])){
$respuesta = array();

  if($_POST['accion']=="obtener_noticias_feed"){

    include_once 'app/MostrarArticulo.inc.php';
    include_once 'app/iArticulos.inc.php';
    $id_categoria = (int)$_POST['id_categoria'];
    $index_feed = (int)$_POST['index'];
    $feed_ini = (int)$_POST['feed'];
    $especial= (int)$_POST['especial'];
    //esta comprobacion es para ver que tipo de archivo voy a pedir.
    if($feed_ini!==0){
      //aca significa que es el feed de inicio ,entonces tengo que comprobar el especial para saber que feed largar.
      $articulos = iArticulos::obtener_feed_especial($index_feed,$especial,6);
    }
    else{
      //aca es el feed de alguna de las categorias,tengo que saber que categoria es para mostrarla.
      $articulos = iArticulos::obtener_feed_categorias($index_feed,$especial,$id_categoria,6);
    }

    if($articulos['exito']){

      $feed_inicio = MostrarArticulo::recargar_contenido_feed($articulos['articulos'],$feed_ini);

      if($feed_inicio['exito']){
        $respuesta['exito'] =true;
        $respuesta['feed'] = $feed_inicio['html'];
        $respuesta['categoria'] = $id_categoria;
      }
      else{
        $respuesta['exito'] =false;
        $respuesta['feed']='';
      }


    }
    else{
      $respuesta['exito'] =false;
      $respuseta['feed'] ='';
    }
  }

  }

echo json_encode($respuesta);

 ?>
