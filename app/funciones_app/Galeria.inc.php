<?php

class Galeria{

private static $contenedor = array();

public static  function crear_galeria($galeria,$archivos){

    $datos=array();
    if(isset($galeria) && !empty($galeria)){

      $datos['galeria'] = json_decode($galeria,true);//ahora es un array
      foreach ($archivos['name'] as $key => $value) {
        if($archivos['type'][$key]=='application/pdf'){
          array_push($datos['galeria'],'../uploads/pdfs/'.$archivos['name'][$key]);//aca se guarda el pdf
        }
        elseif ($archivos['type'][$key]=='image/jpeg'||$archivos['type'][$key]=='image/png'||$archivos['type'][$key]=='image/gif'||$archivos['type'][$key]=='image/jpg') {
          array_push($datos['galeria'],'../preview/'.$archivos['name'][$key]); //aca se guarda la img
        }
      }
      $datos['vacio'] = false;
    }
    else{

      $datos['galeria'] = array();
      foreach ($archivos['name'] as $key => $value) {
        if($archivos['type'][$key]=='application/pdf'){
          array_push($datos['galeria'],'../uploads/pdfs/'.$archivos['name'][$key]);//aca se guarda el pdf
        }
        elseif($archivos['type'][$key]=='image/jpeg'||$archivos['type'][$key]=='image/png'||$archivos['type'][$key]=='image/gif'||$archivos['type'][$key]=='image/jpg') {
          array_push($datos['galeria'],'../preview/'.$archivos['name'][$key]); //aca se guarda la img
        }
      }
      $datos['vacio'] = true;
    }
    return $datos;
  }



  public static function comprobar_imagen($tipo){
    $estado = false;
    if ($tipo=='image/jpeg' ||$tipo=='image/jpg' || $tipo=='image/png' || $tipo=='image/gif'){
    $estado = true;
    }
    return $estado;
  }
  public static function mostrar_datos($datos){

    return $datos;
  }
  public static function comprobar_pdf($tipo){
    $estado = false;
    if($tipo=="application/pdf"){
      $estado=true;
    }
    return $estado;
  }
  public static function construir_items_archivos($ubicacion){
    $prehtml='';
    $prehtml.='<div id="conte_img" class="contenedor_preview_img">';
      $prehtml .='<div class="contenedor_img_btn">';
      $prehtml.='<img id="item_img" class="img_preview" src="imgs/pdf_icono.png"/>';
      $prehtml.='<a href="#" class="btn_borrar_preview">X</a>';
      $prehtml .='</div>';
      $prehtml.='<span>'.$ubicacion.'</span>';
    $prehtml.='</div>';
    return $prehtml;
  }
  public static function construccion_items_subidos($ubicacion){

    $prehtml='';
    $prehtml.='<div id="conte_img" class="contenedor_preview_img">';
      $prehtml .='<div class="contenedor_img_btn">';
      $prehtml.='<img id="item_img" class="img_preview" src="preview/'.$ubicacion.'"/>';
      $prehtml.='<a href="#" class="btn_borrar_preview">X</a>';
      $prehtml .='</div>';
      $prehtml.='<span>'.$ubicacion.'</span>';
    $prehtml.='</div>';
    return $prehtml;
  }


}
 ?>
