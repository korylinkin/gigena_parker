<?php
include_once '../../../app/Conexion.inc.php';
include_once '../../../app/Articulos.inc.php';
session_start();
class ArticulosEstructura{

//estructura en cajas, adentro de cada caja, van las cosas individuales
private $abir_div;
private $cerrar_div;
private $html_final;
private $id_articulo_actual;
private $articulo_actual;
private $contenedor_principal;//no sirveg
private $autor;//o usuario

public function __construct(){
if($this->obtener_id_actual()){
    $this->autor = $this->obtener_autor();//obtengo quien edita.
    //var_dump($this->autor);var_dump($_SESSION);
   $this->html_final = $this->construir_cajas_principales();
}
else{
  return 'error en la base de datos11';
}


}

function obtener_autor(){

$id_autor = (int)$_SESSION['id_usuario'];
$id_privilegio = (int)$_SESSION['privilegio'];

Conexion::abrir_conexion();
$conexion = Conexion::obtener_conexion();
$sql ="SELECT * FROM usuarios INNER JOIN privilegios ON usuarios.privilegio = privilegios.id_priv WHERE usuarios.id =$id_autor";
  //$sql = "SELECT * FROM usuarios WHERE id=$id_autor";
$ejecutar =$conexion->prepare($sql);
$resultado = $ejecutar->execute();
if ($resultado) {
  $autor = $ejecutar->fetch();
  $this->autor = $autor;

  Conexion::cerrar_conexion();
  return $this->autor;
}
else{

  Conexion::cerrar_conexion();
  return false;
}

}
public function obtener_html_final(){
  return $this->html_final;
}
function obtener_id_actual(){
  Conexion::abrir_conexion();
  $conexion = Conexion::obtener_conexion();
  $sql ="SELECT COUNT(id_articulo) FROM articulos";
  $ejecutar =$conexion->prepare($sql);
  $resultado = $ejecutar->execute();
  if ($resultado) {
    $id = $ejecutar->fetch();
    $id['COUNT(id_articulo)'] +=1;
    $this->id_articulo_actual =$id['COUNT(id_articulo)'];
    Conexion::cerrar_conexion();
    return true;
  }
  else{
    Conexion::cerrar_conexion();
    return false;
  }

}


function construir_cajas_principales(){
  $pre_html='';
  $pre_html .=' <form id="articulo_nuevo" method="post" action="administrador/preview">';
  $pre_html .= $this->abrir_div('contenedor_principal_articulos');
  $pre_html .= $this->abrir_div('contenedor_superior_medio');
    $pre_html .= $this->abrir_div('contenedor_superior');
        //aca podria ir el contenido dentro del contenedor superior
        $pre_html .= $this->construir_contenedor_superior();
        $pre_html .= $this->cerrar_div();//cerrado contenido conte_sup
     $pre_html .= $this->cerrar_div();//cerrado conte sup
     $pre_html .='</form>';
     $pre_html .= $this->abrir_div('contenedor_vertical_derecho');
     //aca podria ir el contenido dentro del contenedor_vertical_derecho
     $pre_html .= $this->construir_contenedor_vertical();
     $pre_html .= $this->cerrar_div();//cerrado vertical
     $pre_html .= $this->abrir_div('contenedor_medio');
          //aca podria ir el contenido dentro del contenedor superior
           $pre_html .= $this->construir_contenedor_medio();
     $pre_html .= $this->cerrar_div();
  $pre_html .= $this->cerrar_div();//cerrado conte medio_sup


  $pre_html .= $this->cerrar_div();//cerrado conte principal

  return $pre_html;
}


private $contenedor_vertical_derecho;
  private $img_upload;
  private $tags;
  private $btn_borrador;
  private $btn_publicar;

  function construir_caja_publicar(){
    $prehtml='';
    $prehtml.=$this->abrir_div('caja_publicar');
    $prehtml.='<input type="submit" class="btn_publicar" value="Siguiente">';
    $prehtml.='<button type="button" class="btn_borrador">Borrador</button>';
    $prehtml.=$this->cerrar_div();
    return $prehtml;
  }
//////////////////////////////
function construir_caja_info_autor(){

  $html ='';
  $html .=$this->abrir_div('caja_info_creacion');
  $html .= '<ul>';
  $html .='<li class="item">'.'Autor : '.$this->autor['nombre'].' '.$this->autor['apellido'].'</li>';
  $html .='<li class="item">'.'Privilegio : '.$this->autor['privilegio'].'</li>';
  $html .='<li class="item">'.'ID Articulo: '.$this->id_articulo_actual.'</li>';
  $html .='<li class="item">'.'Hechos: '.$this->autor['cantidad_ariticulos'].'</li>';
  $html .='<li class="item">'.'Hechos: '.$this->autor['cantidad_ariticulos'].'</li>';
  /*
  $info = $this->obtener_info_autor();

  if($info){
     var_dump($info);
  }else{
    echo 'hubo error en consulta de datos';
  }
  for($i=0;$i<count($info);$i++){

  }*/

  $html .='</ul>';
  $html .=$this->cerrar_div();
  return $html;
}

//////////////////////////////
function construir_contenedor_vertical(){
  $html='';
  $html .= $this->mini_uploader();
  return $html;
}
function mini_uploader(){
  $prehtml='';
  $prehtml.='<form id="upload" method="post" action="uploader" enctype="multipart/form-data">';
  $prehtml.=$this->abrir_div('opciones_subida');
  $prehtml.='<span class="glyphicon glyphicon-picture opcion_subida " aria-hidden="true"></span>';
  $prehtml.='<span class="txt_subida">Imagenes</span>';
  $prehtml.='<span class="glyphicon glyphicon-paperclip opcion_subida" aria-hidden="true"></span>';
  $prehtml.='<span class="txt_subida">Archivos</span>';
  $prehtml.=$this->cerrar_div();//cerrando opciones subida
  $prehtml.=$this->abrir_div('drop');
  $prehtml.='<h4>Arrastrar archivos o imagenes aqui</h4>
  <input type="file" id="g_articulo" name="galeria[]" multiple />';
  $prehtml.=$this->cerrar_div();
  $prehtml.='<ul></ul>';

  $prehtml .='</form>';
  return $prehtml;
}

function construir_caja_tags(){
  $prehtml  = '';
  $prehtml .= $this->abrir_div('crear_tags');
  $prehtml .='<input type="text" name="tags_articulo" class="tags_articulo" placeholder="Ingresar palabras claves separadas por coma "," ">';
  $prehtml .='<input type="hidden"  id="galeria_articulo" name="galera"  />';
  $prehtml .= '<input type="hidden" name="id_articulo" value="'.$this->id_articulo_actual.'"/>';
  $prehtml .= '<input type="hidden" name="id_autor" value="'.$this->autor['id'].'"/>';
  $prehtml .= '<input type="hidden" id="portada" name="img_principal" value=""/>';
  $prehtml .= $this->cerrar_div();
  return $prehtml;
}




private $contenedor_medio;
  private $texto_contenido;
//////////////////////////////
function construir_contenedor_medio(){

  $this->contenedor_medio  ='';
  $this->contenedor_medio .='<div id="editor"></div>';
  $this->contenedor_medio .= '<textarea  rows="17" id="contenido_articulo" name="contenido_articulo" class="form_texto"></textarea>';
  return $this->contenedor_medio;
}
private $contenedor_superior;
  private $img_principal; //img_principal
  private $titulo;//titulo_articulo
  private $categorias;
  private $btn_cerrar;
////////////////////////////// construyendo el contenedor superior
function construir_contenedor_superior(){
$this->contenedor_superior='';
$this->contenedor_superior .= $this->construir_titulo();
$this->contenedor_superior .= $this->construir_categorias();
$this->contenedor_superior .= $this->construir_acceso();

$this->contenedor_superior .= $this->datos_usuario();
$this->contenedor_superior .= $this->construir_boton_cerrar();
return $this->contenedor_superior;
}
function construir_acceso(){
  $html='';
  $html.=$this->abrir_div('contenedor_acceso');
  $html.=$this->abrir_div('acceso_cliente');
  $html.='<span id="tipo_acceso">Privado</span><i id="btn_acceso_privado" class="fa fa-lock" aria-hidden="true"></i><input type="hidden" name="especial" value="1" form="articulo_nuevo">';
  $html.=$this->cerrar_div();
  $html.=$this->cerrar_div();
  return $html;
}
function construir_boton_cerrar(){
  $prehtml='';
  $prehtml='<a class="boton_cerrar" href="#">X</a>';
  $this->btn_cerrar = $prehtml;
  return $this->btn_cerrar;
}
function datos_usuario(){
  $prehtml='';
  $prehtml .='<input type="hidden"  id="galeria_articulo" name="galera"  />';
  $prehtml .= '<input type="hidden" name="id_articulo" value="'.$this->id_articulo_actual.'"/>';
  $prehtml .= '<input type="hidden" name="id_autor" value="'.$this->autor['id'].'"/>';
  $prehtml .= '<input type="hidden" id="portada" name="img_principal" value=""/>';
  return $prehtml;
}

function construir_titulo(){
  $pre_html = '<input type="text" id="titulo_articulo" class="titulo_articulo" name="titulo_articulo" value="" placeholder="Ingresar un titulo" required>';
  $this->titulo = $pre_html;
  return $this->titulo;
}
function construir_categorias(){
  $pre_html ='';
  $pre_html .= $this->abrir_div('opciones_categoria');
  $categorias = $this->obtener_categorias();
  if($categorias){
      $pre_html .='<label class="label_cate" for="categoria_articulo">Tipo</label>';
      $pre_html.='<select name="categoria_articulo" >';
    /*$pre_html='<div class="lista_categorias">
      <button class="boton_categorias" type="button" name="categorias">Categorias<span class="glyphicon glyphicon-chevron-down flecha" aria-hidden="true"></span></button>
      <div class="categorias">
      ';*/
      $categorias_html='';

    foreach ($categorias as $categoria) {
      //$categorias_html .= '<a class="item" href="#">'.$categoria[1].'</a>';
      $categorias_html .= '<option  value="'.$categoria[0].'">'.$categoria[1].'</option>';
    }
    $pre_html .= $categorias_html.'</select>';
    /*$pre_html.= $categorias_html.'</div>
          </div>';*/
    $pre_html .= $this->cerrar_div();
    $this->categorias = $pre_html;

  return $this->categorias;
  }
  else{
    return $categorias;
  }
}
 function obtener_categorias(){
  Conexion::abrir_conexion();
  $conexion = Conexion::obtener_conexion();
  $sql ="SELECT * FROM categorias ";
  $ejecutar =$conexion->prepare($sql);
  $resultado = $ejecutar->execute();
  if($resultado){
    $todo = $ejecutar->fetchAll();
    if (count($todo)) {

      return $todo;

    }
    else{
      return false;
    }
  }
  Conexion::cerrar_conexion();
}




//funciones auxiliares
function abrir_div($nombre_clase){
  $this->abrir_div = '<div class='.$nombre_clase.'>';
  return $this->abrir_div;
}


function cerrar_div(){
  $this->cerrar_div = '</div>';
  return $this->cerrar_div;
}









}

 ?>
