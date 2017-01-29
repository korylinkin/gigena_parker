<?php
include_once 'app/Conexion.inc.php';
class Integrante
{
  private $nombre;
  private $titulo;
  private $contenido;
  private $img_perfil;
  function __construct($nombre,$titulo,$contenido,$imagen)
  {
    $this->nombre=$nombre;
    $this->titulo =$titulo;
    $this->contenido =$contenido;
    $this->img_perfil=$imagen;
  }
  public function obtener_nombre(){
    return $this->nombre;
  }
  public function obtener_titulo(){
    return $this->titulo;
  }
  public function obtener_contenido(){
    return $this->contenido;
  }
  public function obtener_img_perfil(){
    return $this->img_perfil;
  }

  public function mostrar_integrante(){
    $html ='';
    $html .= '<div class="integrante">';
    $html .= '<div class="imagen_perfil_integrante" style="background-image: url('.$this->img_perfil.');"></div>';
    $html .= '<span>'.$this->nombre.'</span>';
    $html .='<input type="hidden" id="contenido_integrante" value="'.$this->contenido.'"/>';
    $html .='<input type="hidden" id="titulo_integrante" value="'.$this->titulo.'"/>';
    $html .= '</div>';
    return $html;
  }
}

class Equipo
{
private $nombre;
private $titulo;
private $contenido;
private $img_perfil;

 function __construct()
 {

 }
 public function obtener_integrantes(){
   $sql = "SELECT * FROM equipo";
   Conexion::abrir_conexion();
   $conexion = Conexion::obtener_conexion();
   $peticion = $conexion->prepare($sql);
   $resultado = $peticion->execute();
   if($resultado){
     $integrantes = $peticion->fetchAll();
     foreach ($integrantes as $integrante) {
       $inte[] = new Integrante($integrante['nombre'],$integrante['titulo'],$integrante['contenido'],$integrante['img_perfil']);
     }
     return $inte;
   }
 }
 public function guardar_integrante($nombre,$titulo,$contenido,$img_perfil){

   $this->nombre=$nombre;
   $this->titulo =$titulo;
   $this->contenido =$contenido;
   $this->img_perfil='imgs/equipo/'.$img_perfil;
   $exito = false;

   Conexion::abrir_conexion();
   $conexion = Conexion::obtener_conexion();
   $sql = "INSERT INTO equipo(nombre,titulo,contenido,img_perfil) VALUES(:nombre,:titulo,:contenido,:url_img)";
   $img_perfil = $this->img_perfil;
   $peticion = $conexion->prepare($sql);
   $peticion->bindParam(':nombre',$nombre,PDO::PARAM_STR);
   $peticion->bindParam(':titulo',$titulo,PDO::PARAM_STR);
   $peticion->bindParam(':url_img',$img_perfil,PDO::PARAM_STR);
   $peticion->bindParam(':contenido',$contenido,PDO::PARAM_STR);
   $resultado = $peticion->execute();
   Conexion::cerrar_conexion();
   if($resultado){
     $exito = $resultado;
   }
     return $exito;
 }
 public function obtener_img_perfil(){
   return $this->img_perfil;
 }

}


 ?>
