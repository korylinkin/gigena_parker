<?php

class Articulos{

    private $id;
    private $autor_id;
    private $id_categoria;
    private $url;
    private $titulo;
    private $texto;
    private $fecha_creacion;
    private $fecha_modificacion;
    private $url_img_principal;
    private $visitas;
    private $activo;
    private $especial;
    private $galeria;
    private $tags;
    public function convertir_a_json(){

      return json_encode([

        'id'=>$this->id,
        'autor_id'=>$this->autor_id,
        'id_categoria'=>$this->id_categoria,
        'titulo' => $this->titulo,
        'texto'=>$this->texto,
        'url'=>$this->url,
        'fecha_creacion'=>$this->fecha_creacion,
        'fecha_modificacion' =>$this->fecha_modificacion,
        'url_img_principal'=>$this->url_img_principal,
        'visitas'=>$this->visitas,
        'activo' => $this->activo,
        'especial' =>$this->especial,
        'galeria' =>$this->galeria,
        'tags' => $this->tags
      ]);




    }

    public function __construct($id,$autor_id,$id_categoria,$url,$titulo,$texto,$fecha_creacion,$fecha_modificacion,$url_img_principal,$galeria,$visitas,$activo,$especial){
        $this->id = $id;
        $this->autor_id = $autor_id;
        $this->id_categoria = $id_categoria;
        $this->url = $url;
        $this->titulo = $titulo;
        $this->texto = $texto;
        $this->fecha_creacion = $fecha_creacion;
        $this->fecha_modificacion = $fecha_modificacion;
        $this->url_img_principal = $url_img_principal;
        $this->visitas = $visitas;
        $this->activo = $activo;
        $this->especial = $especial;
        $this->galeria =$galeria;
    }



    public function cambiar_titulo($titulo){
        $this->titulo= $titulo;
    }
    public function cambiar_texto($texto){
        $this->texto= $texto;
    }
    public function cambiar_activo($activo){
        $this->activo= $activo;
    }
    public function cambiar_especial($especial){
        $this->especial= $especial;
    }

    public function obtener_id_articulo(){
        return $this->id;
    }
    public function obtener_galeria(){
        return $this->galeria;
    }
    public function obtener_tags(){
        return $this->tags;
    }
    public function obtener_autor_id(){
        return $this->autor_id;
    }
    public function obtener_id_categoria(){
        return $this->id_categoria;
    }
    public function resumir_titulo($largo){
      $titulo_articulo = $this->titulo;
      if(strlen($titulo_articulo)>=$largo){
        $titulo_articulo = substr($titulo_articulo,0,$largo);
        $titulo_articulo .='...';
      }
      return $titulo_articulo;
    }
    public function resumir_contenido($largo){
      $contenido_articulo = $this->texto;
      if(strlen($contenido_articulo)>=$largo){
        $contenido_articulo = substr($contenido_articulo,0,$largo);
        $contenido_articulo .='...';
      }
      return $contenido_articulo;
    }
    public function obtener_url(){
        return $this->url;
    }
    public function obtener_titulo(){
        return $this->titulo;
    }
    public function obtener_texto(){
        return $this->texto;
    }
    public function obtener_fecha_creacion(){
        return $this->fecha_creacion;
    }
    public function obtener_fecha_modificacion(){
        return $this->fecha_modificacion;
    }
    public function obtener_url_img(){
        return $this->url_imgns;
    }
    public function obtener_url_img_principal(){
        return $this->url_img_principal;
    }
    public function obtener_visitas(){
        return $this->visitas;
    }
    public function esta_activo(){
        return $this->activo;
    }
    public function obtener_categoria(){

    }
    public function obtener_especial(){
        return (int)
        $this->especial;
    }
    public function crear_url_articulo(){
      $creando =false;
      Conexion::abrir_conexion();
      $conexion = Conexion::obtener_conexion();
      $cate = $this->id_categoria;
      $sql = "SELECT categoria FROM categorias WHERE id_categoria=$cate";
      $ejecutar = $conexion->prepare($sql);
      $articulo_agregado= $ejecutar->execute();
      Conexion::cerrar_conexion();
      if($articulo_agregado){
        $dato = $ejecutar->fetch();
        $categoria = $dato['categoria'];
        $categoria = str_replace(' ','_',$categoria);
        $titulo = $this->crear_url($this->titulo);
        $this->url = $categoria.'/'.$titulo;
        $creando=true;
      }
      return $creando;

    }
    function crear_url($titulo){
      $titulo = $this->comprobar_signos($titulo);
      $titulo = $this->eliminar_tildes($titulo);
      $titulo = str_replace(' ','-',$titulo);
      $titulo = strtolower($titulo);
      return $titulo;
    }
    function comprobar_signos($titulo){
      $primer = $titulo[0];
      $ultimo = $titulo[strlen($titulo)-1];
      $comprobar = mb_convert_encoding($primer, 'UTF-8', 'UTF-8');
      $modificado ='';
      if($comprobar=='?' || $ultimo=='?'){
        if ($comprobar=='?' && $ultimo=='?'){
          $modificado = substr($titulo,2,strlen($titulo)-3);
        }
        else{
          if ($comprobar=='?') {
            $modificado = substr($titulo,2,strlen($titulo));
          }else {
            $modificado = substr($titulo,0,strlen($titulo)-1);
          }
        }
      }
      else{
        $modificado = $titulo;
      }
      $resultado = $modificado;
      return $resultado;
    }
    function eliminar_tildes($cadena){
        //Ahora reemplazamos las letras
        $cadena = str_replace(
            array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
            array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
            $cadena
        );
        $cadena = str_replace(
            array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
            array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
            $cadena );
        $cadena = str_replace(
            array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
            array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
            $cadena );
        $cadena = str_replace(
            array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
            array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
            $cadena );
        $cadena = str_replace(
            array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
            array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
            $cadena );
        $cadena = str_replace(
            array('ñ', 'Ñ', 'ç', 'Ç'),
            array('n', 'N', 'c', 'C'),
            $cadena
        );
        return $cadena;
    }
    public function sumar_visita(){
      Conexion::abrir_conexion();
      $conexion = Conexion::obtener_conexion();
      $this->visitas +=1;
      $visita = $this->visitas;
      $respuesta=array();
      $sql = "UPDATE articulos SET visitas='$visita' WHERE id_articulo='$this->id' ";
      $ejecutar = $conexion->prepare($sql);
      $resultado = $ejecutar->execute();
      if($resultado){
        $respuesta['exito'] =$resultado;
      }
      else{
        $resultado['exito'] =$resultado;
      }
      return $respuesta;
    }
    public function guardar_articulo(){

      Conexion::abrir_conexion();
      $conexion = Conexion::obtener_conexion();
      $articulo_agregado =false;
      if(isset($conexion)){
          try{
          $sql = "INSERT INTO articulos(autor_id,id_categoria,url,titulo,texto,fecha_creacion,fecha_modificacion,url_img_principal,galeria,visitas,activa,especial)
          VALUES(:autor_id,:id_categoria,:url,:titulo,:texto,NOW(),NOW(),:img_prin,:galeria,0,1,:especial)";
          $autor_id = $this->obtener_autor_id();
          $categoria = $this->obtener_id_categoria();
          $url = $this->obtener_url();
          $titulo =$this->obtener_titulo();
          $texto =$this->obtener_texto();
          $img_prin  =$this ->obtener_url_img_principal();
          $galeria = $this->obtener_galeria();
          $especial = $this->obtener_especial();
          $ejecutar = $conexion->prepare($sql);
          Conexion::cerrar_conexion();
          $ejecutar->bindParam(':autor_id',$autor_id,PDO::PARAM_INT);
          $ejecutar->bindParam(':id_categoria',$categoria,PDO::PARAM_INT);
          $ejecutar->bindParam(':url',$url,PDO::PARAM_STR);
          $ejecutar->bindParam(':titulo',$titulo,PDO::PARAM_STR);
          $ejecutar->bindParam(':texto',$texto,PDO::PARAM_STR);
          $ejecutar->bindParam(':img_prin',$img_prin,PDO::PARAM_STR);
          $ejecutar->bindParam(':galeria',$galeria,PDO::PARAM_STR);
          $ejecutar->bindParam(':especial',$especial,PDO::PARAM_INT);
          $articulo_agregado=$ejecutar->execute();
          }
          catch(PDOException $ex){
              echo 'Error '.$ex->getMessage();
          }
      }
      return $articulo_agregado;
    }








}


?>
