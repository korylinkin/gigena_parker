<?php
include_once 'RedireccionUrl.inc.php';


class Urls{
    //variables privadas
    private $seccion_url = array(); //almacena la pre-url -> [/categoria/titulo]
    private $parametro ='';
    private $url_entrante = array();
   //metodos privados

  public function __construct($url){
    $str = explode('/',$url['path']);
    $v =array();
    for ($i=1; $i < count($str) ; $i++) {
      $v[]= $str[$i];
    }
    $this->url_entrante = $v;
  }
  public function obtener_url_entrante(){
    return $this->url_entrante;
  }
   public function Url_Amigable($url){
       $xx = count($url);
       switch ($xx) {
           case 1:
               if($url[0]=='logear'){
                   return RUTA_VISTA_ESPECIAL.'logear.php';
               }
               elseif ($url[0]=='administrador') {
                   return RUTA_VISTA_ESPECIAL.'panel.php';
               }
               elseif ($url[0]=='uploader') {
                   return RUTA_APP.'uploader.php';
               }elseif ($url[0]=='lasvertientes') {
                   return RUTA_VERTIENTES.'index_vertientes.php';
               }
               elseif ($url[0]=='vertientes') {
                   return RUTA_APP.'url_vertientes.php';
               }
               elseif ($url[0]=='equipo') {
                   return RUTA_APP.'equipo.php';
               }
               elseif ($url[0]=='comprobar_titulo') {
                   return RUTA_APP.'comprobar_titulo.php';
               }
               elseif ($url[0]=='registrando') {
                   return 'vistas/registro.php';
               }
               elseif ($url[0]=='pruebas_relleno') {
                   return 'pruebas_relleno.php';
               }
               elseif ($url[0]=='noticias') {
                   return 'vistas/noticias.php';
               }
               elseif ($url[0]=='programa') {
                   return 'vistas/programa.php';
               }
               elseif ($url[0]=='nosotros') {
                   return 'vistas/nosotros.php';
               }
               elseif ($url[0]=='contacto') {
                   return 'vistas/contacto.php';
               }
               else{
                   return 'error404.php';
               }
               break;
           case 2:
                if($url[0]=='login'){
                    $this->parametro = $url[1];
                    return RUTA_VISTA_ESPECIAL.'login.php';

               }elseif ($url[0]=='registro') {
                   $this->parametro = $url[1];
                   return RUTA_VISTA_ESPECIAL.'registro.php';
               }
               elseif ($url[1]=='editar') {

                   return 'app/editar.php';
               }elseif ($url[0]=='lasvertientes') {
                  if($url[1]=='inicio'){
                    return 'estructuras/vertientes/inicio_vertientes.php';
                  }

               }
               elseif ($url[0]=='administrador') {
                   $this->parametro = $url[1];
                   if($this->parametro=='salir'){
                      return 'logout.php';
                   }
                   elseif ($this->parametro=='preview'){
                     return 'app/funciones_app/preview_articulo.php';
                   }

               }
               else{
                 $comprobar_categoria_entrante = $this->comprobar_categoria($url);
                 if($comprobar_categoria_entrante['resultado']){
                   $resultado_link= '';
                   //aca se encuentra la categoria correctamente, hay que comprobar el titulo
                   $comprobar_titulo_entrante = $this->comprobar_titulo_url($url);

                   if($comprobar_titulo_entrante['exito']){
                     //aca se encontro el articulo, hay que mostrarlo en una pagina generica.
                     $articulo_obtenido = $comprobar_titulo_entrante['articulo'];
                     $dirigir_articulo = $comprobar_titulo_entrante['respuesta'];
                     $respuesta['articulo'] = $articulo_obtenido;
                     $respuesta['url'] = $dirigir_articulo;
                     $resultado_link= $respuesta;

                   }
                   else{
                     $resultado_link= $comprobar_titulo_entrante['respuesta'];

                   }
                 }
                 else{
                   $resultado_link= $comprobar_categoria_entrante['respuesta'];

                 }
                 return $resultado_link;

               }
                break;
           case 3:
           if($url[1]=='editar'){
               $_GET['id'] = $url[2];
               return 'app/editar.php';
          }elseif ($url[1]=='usuario'){
            if ($url[2]=='filtrado') {
              return 'app/filtrar_usuarios.php';
            }
          }
          elseif ($url[1]=='usuario'){
            if ($url[2]=='filtro') {
              return 'estructuras/admin/herramientas/usuarios.php';

            }
          }
          elseif ($url[1]=='datos'){
            if ($url[2]=='sesion') {
              return 'app/sesion.php';
            }
          }
          elseif($url[0]=='datos'){
            if($url[1]=='usuarios'){
              if($url[2]=='contenido_feed'){
                  return 'app/contenido_feed.php';
              }
            }
          }
          break;
       }
   }
private function comprobar_titulo_url($url){

  $consulta = $this->obtener_articulo_url($url);
  $dirigir = $url[0];

  $respuesta='';
  if($consulta['resultado']){

    $respuesta['articulo']= $consulta['respuesta'];
    $respuesta['respuesta'] = strtolower($dirigir);
    $respuesta['exito'] =true;

  }
  else{
    $respuesta['exito'] =false;
    $respuesta['respuesta'] = $consulta['respuesta'];
  }
  return $respuesta;
}
private function obtener_articulo_url($url){
  include_once 'Conexion.inc.php';
  Conexion::abrir_conexion();
  $conexion = Conexion::obtener_conexion();
  $url_entera = $url[0].'/'.$url[1];
  $sql = "SELECT * FROM articulos WHERE articulos.url = '$url_entera' ";
  $consulta = $conexion->prepare($sql);
  $resultado = $consulta->execute();
  Conexion::cerrar_conexion();

  $dato= array();

  if($resultado){
    $dato['respuesta'] = $consulta->fetchAll();
    if(empty($dato['respuesta'])){

      $dato['respuesta'] = 'error404.php';
      $dato['resultado']= false;
    }else{
      $dato['resultado']= true;
    }

  }
  else {
    $dato['respuesta'] = 'error404.php';
    $dato['resultado']= false;
  }
  return $dato;
}
private function comprobar_categoria($url){
$categorias_web = $this->obtener_categorias_web();
$categoria_url = $url[0];
$consulta = array();
$resultado = false;
$respuesta= '';
foreach ($categorias_web as $categoria) {
$patron = '/^'.$categoria['categoria'].'$/';
if(preg_match($patron,$categoria_url)){
$resultado = true;
$respuesta =strtolower($categoria_url);
break;
}
else {
  $resultado = false;
  $respuesta = 'error404.php';
}

}
$consulta['resultado']=$resultado;
$consulta['respuesta'] =$respuesta;
return $consulta;

}
private function obtener_categorias_web(){
  include_once 'Conexion.inc.php';
  Conexion::abrir_conexion();
  $conexion = Conexion::obtener_conexion();
  $sql = "SELECT * FROM categorias";
  $consulta = $conexion->prepare($sql);
  $resultado = $consulta->execute();
  Conexion::cerrar_conexion();
  $dato= array();
  if($resultado){
    $dato = $consulta->fetchAll();
  }
  return $dato;

}

   public function obtener_parametro(){
       return $this->parametro;
   }
   private function obtenerTermino($termino){
       $t = $termino-1;
       return $this->seccion_url[$t];
   }
   //metodos publicos
    public function ObtenerPath($url){
        //editando la url
        $url_componentes = $url;
        $ruta = $url_componentes['path'];
        $partes_ruta= explode('/',$ruta);
        $partes_ruta = array_filter($partes_ruta);
        $partes_ruta =array_slice($partes_ruta, 1); //obtenido despues del .com/
        if(isset($partes_ruta)&& !empty($partes_ruta)){
           //aca esta el array con contenido (login),(panel), ver si es tipo 1 o 2.
           $this->seccion_url = $partes_ruta;
           unset($partes_ruta);
           return true;
        }
        else {
           return false;
        }
   }

  public function Obtener_Seccion_Url(){
       return $this->seccion_url;
        }




   /*while ($cate = $categorias->fetch_array()){
		if ($partes_ruta[0]==$cate['nombre_categoria']) {
			$categoria_actual=$cate['nombre_categoria'];
			break;//aca seria al nivel de infopico.com/nombre_categoria/
		}
		else{
			echo 'error 404';
			break;
		}
	  }*/

}


?>
