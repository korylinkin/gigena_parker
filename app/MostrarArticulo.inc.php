<?php
include_once 'app/iArticulos.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/Articulos.inc.php';
class MostrarArticulo{

    private static function crear_preview_individual($articulo){
        $titulo = $articulo->obtener_titulo();
        $contenido = $articulo->resumir_contenido(450);
        $url = $articulo->obtener_url();
        $html = self::armar_html_preview_feed($titulo,$contenido,$url);
        return $html;
    }

    public static function crear_articulo_indiviual($articulo){
      $titulo = $articulo->obtener_titulo();
      $contenido = $articulo->obtener_texto();
      $url = $articulo->obtener_url();
      $galeria = $articulo->obtener_galeria();
      $visita_nueva = $articulo->sumar_visita();
      if($visita_nueva){
        $html = self::armar_html_preview($titulo,$contenido,$url,$galeria);
      }
      else{
        $html='Error sumando visita';
      }
      return $html;

    }
    public static function vista_full($articulo){

    }
    private static function crear_preview_individual_inicio($articulo,$feed){
      $titulo = $articulo->obtener_titulo();
      $contenido = $articulo->resumir_contenido(300);
      $url = $articulo->obtener_url();
      $id = $articulo->obtener_id_articulo();
      $especial =$articulo->obtener_especial();

      $html = self::armar_html_preview_feed_inicio($titulo,$contenido,$url,$id,$especial,$feed);
      return $html;
    }
    private static function armar_html_preview_feed_inicio($titulo,$contenido,$url,$id,$especial,$feed){
      $tipo_feed= '';
      if($feed===1 && $especial===0){
        //significa que aca esta en inicio
        $tipo_feed='_inicio';
      }
      else{
        if($especial===1){
          $tipo_feed ='_especial';
        }
      }
      $html ='';
      $html .='<div class="contenedor_preview_feed'.$tipo_feed.'" data-id="'.$id.'" data-especial="'.$especial.'">';
      $html .='<a href="'.$url.'"><span class="titulo_preview_feed'.$tipo_feed.'">'.$titulo.'</span></a>';
      $html .='<div class="contenido_preview_feed'.$tipo_feed.'">'.$contenido.'</div>';
      $html .='<a class="leer_mas" href="'.$url.'">Leer Más</a>';
      $html .='</div>';
      return $html;
    }
    public static function feed_inicio($cantidad,$especial){

      $articulos = iArticulos::obtener_articulos_especial($cantidad,$especial);
      $html='';
      $feed= 1;
      $especial='';
      if($articulos['exito']){
        $id_categoria = (int) $articulos['articulos'][0]->obtener_id_categoria();

        foreach ($articulos['articulos'] as $articulo) {
        $html .= self::crear_preview_individual_inicio($articulo,$feed);
        $ultimo_id = (int)$articulo->obtener_id_articulo();
        $especial =(int)$articulo->obtener_especial();
        }
        $html .= self::ver_mas($id_categoria,$ultimo_id,$feed,$especial);
      }
      else{
        $html='No hay articulos cargados';
      }
      return $html;
    }
    /*
    public static function cargar_contenido_feed_inicio($cantidad,$categoria){

      $articulos = iArticulos::obtener_x_articulos_categoria($cantidad,$categoria);
      $html='';
      if($articulos['exito']){
        $id_categoria = (int) $articulos['articulos'][0]->obtener_id_categoria();
        foreach ($articulos['articulos'] as $articulo) {
        $html .= self::crear_preview_individual_inicio($articulo);
        $ultimo_id = $articulo->obtener_id_articulo();
        }
        $html .= self::ver_mas($id_categoria,$ultimo_id,$feed,$especial);
      }
      else{
        $html='No hay articulos cargados';
      }

      //$ultimo_id = $articulos[0]->obtener_id_articulo();


      return $html;
    }*/
    public static function cargar_contenido_feed($cantidad,$id_categoria){//este se usa para cargar los feed de las categorias al principio

      $articulos = iArticulos::obtener_x_articulos_categorias($cantidad,$id_categoria);
      $html='';
      $feed='';
      $especial ='';
      if($articulos['exito']){
        $html .='<div class="contenedor_articulos">'; 

        foreach ($articulos['articulos'] as $articulo) {
        $html .= self::crear_preview_individual($articulo);
        $ultimo_id = $articulo->obtener_id_articulo();
        $especial = (int)$articulo->obtener_especial();
        }
        $html .='</div>';
        $html .= self::ver_mas($id_categoria,$ultimo_id,$feed,$especial);
      }
      else{
        $html='<div class="noHayArt">No hay articulos cargados</div>';
      }

      return $html;
    }
    public static function recargar_contenido_feed($articulos,$feed){
      $html='';
      $respuesta=array();
      $ultimo_id=0;
      $especial ='';

      if(isset($articulos) && !empty($articulos)){

        $id_categoria = (int)$articulos[0]->obtener_id_categoria();

        foreach ($articulos as $articulo) {
        $html .= self::crear_preview_individual_inicio($articulo,$feed);
        $ultimo_id = (int)$articulo->obtener_id_articulo();
        $especial = (int)$articulo->obtener_especial();
        }

        $html .= self::ver_mas($id_categoria,$ultimo_id,$feed,$especial);
        $respuesta['html'] =$html;
        $respuesta['exito'] =true;
      }
      else{
        $respuesta['html'] = $html;
        $respuesta['exito'] = false;
      }
      return $respuesta;
    }
    private static function ver_mas($categoria,$id,$feed,$especial){
      $html ='';
      $html .='<div class="contenedor_ver_mas"><a id="btn_ver_mas" data-feed="'.$feed.'" data-especial="'.$especial.'"data-ultimo ="'.$id.'" data-categoria="'.$categoria.'">Ver más</a></button></div>';
      return $html;
    }



    private static function armar_html_preview($titulo,$contenido,$url,$galeria){
      $html ='';
      $html .='<div class="contenedor_preview">';
      $html .='<span class="titulo_preview">'.$titulo.'</span>';
      $html .='<div class="contenido_preview">'.$contenido.'</div>';
      if(isset($galeria) && !empty($galeria)){
        $html .= '<div class="contenedor_galeria">';
        $html_galeria= '';
        $galeria = json_decode($galeria,true);
        foreach ($galeria as $key => $value) {
          if(strpos($galeria[$key],'.pdf') !==false){
            $partes= explode('/',$galeria[$key]);
            $html_galeria .='<img src="../imgs/pdf_icono.png" id="archivo_pdf" title="Descargar '.$partes[3].'" class="img_galeria_articulo" />';
          }
          else{
            //$html_galeria .='<img src="'.$galeria[$key].'" class="img_galeria_articulo" />';
            $html_galeria .='<div style="background-image: url('.$galeria[$key].') ;" class="img_galeria_articulo" ></div>';
          }

        }
        $html .= $html_galeria;
        $html .='</div>';
      }
      $html .='</div>';
      return $html;
    }
    private static function armar_html_preview_feed($titulo,$contenido,$url){
      $html ='';
      $html .='<div class="contenedor_preview_feed">';
      $html .='<a href="'.$url.'"><span class="titulo_preview_feed">'.$titulo.'</span></a>';
      $html .='<div class="contenido_preview_feed">'.$contenido.'</div>';
      $html .='<a class="leer_mas" href="'.$url.'">Leer Más</a>';
      $html .='</div>';
      return $html;
    }






    public static function escribir_articulos(){
        Conexion::abrir_conexion();
        $articulos = iArticulos::obtener_todos_desce(Conexion::obtener_conexion());
        Conexion::cerrar_conexion();
        if(count($articulos)){
            foreach($articulos as $articulo){
                self::mostrar_articulo($articulo);
            }
        }

    }

    public static function obtener_x_articulo($conexion,$cantidad){

        $articulos = iArticulos::obtener_x_articulos($conexion,$cantidad);

        if(count($articulos)){
           foreach($articulos as $articulo){
               self::mostrar_articulo($conexion,$articulo);
           }
        }
    }
    public static function mostrar_articulo($conexion,$articulo){
        $html ='';
        $categoria = iArticulos::obtener_categoria($conexion,$articulo);
        if(!isset($articulo)){
            return;
        }
        ?>
                <div class="conte_articulo">
                <div class="articulo">
                    <div class="">
                        <?php
                        echo $articulo->obtener_titulo().' cate: '.$categoria;
                        ?>
                    </div>
                    <div class="">
                    <p>
                        <strong>
                            <?php
                            echo $articulo->obtener_fecha_creacion();
                            ?>
                        </strong>
                            <img class="img-ph" src="<?php echo $articulo->obtener_url_img_principal()?>" alt="Imagen">
                            </p>
                            <?php
                            echo nl2br($articulo->obtener_texto());
                            ?>
                    </div>
                </div>
               </div>
        <?php
    }


}



?>
