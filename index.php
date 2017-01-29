<?php
include_once 'app/config.inc.php';
include_once 'app/Urls.inc.php';
include_once 'app/RedireccionUrl.inc.php';
session_start();
$url_componentes = parse_url($_SERVER['REQUEST_URI']);
$m_url = new Urls($url_componentes);
$obteniendo_url = $m_url->obtener_url_entrante()[0];

$url_actual = '';
if ($obteniendo_url ==''){
	$url_actual =RUTA_INICIO;
}
else {
	//aca todavia puede haber una url de tipo 1 o tipo 2 entonces validar
	//$url_pack = $m_url->Obtener_Seccion_Url();
	$url_actual =$m_url->Url_Amigable($m_url->obtener_url_entrante());
	$para = $m_url->obtener_parametro();


}
if(!empty($url_actual['articulo'])&& isset($url_actual['url'])){
	$datos_individual = $url_actual['articulo'];
	$direccion[0]= $url_actual['url'];
	$url_dirigir = $m_url->Url_Amigable($direccion);

}
else{
	$url_dirigir = $url_actual;
}

include_once $url_dirigir;



function content_generico($url,$titulo,$img_slide,$contenido){

$str = 'estructuras/';
$ext = '.php';
$url = $str.$url.$ext;
$txt_titulo = $titulo;
$url_img_slide =RUTA_IMG.'slideshow/'.$img_slide;
if(isset($contenido) && !empty($contenido)){
	$url_img_slide ='../'.RUTA_IMG.'slideshow/'.$url_img_slide;
}
include_once $url;

}
?>
