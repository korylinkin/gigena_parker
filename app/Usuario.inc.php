<?php
include_once 'Conexion.inc.php';
class Usuario{

private $id;
private $nombre;
private $apellido;
private $email;
private $pass;
private $prefijo;
private $especialidad;
private $titulos;
private $img_perfil;
private $privilegio;
private $fecha_creacion;
private $activo;



public function __construct($id,$nombre,$apellido,$email,$pass,$prefijo,$especialidad,$titulos,$img_perfil,$privilegio,$fecha_creacion,$activo){

    $this-> id = $id;
    $this-> nombre =$nombre;
    $this-> apellido =$apellido;
    $this-> email= $email;
    $this-> pass= $pass;
    $this-> prefijo = $prefijo;
    $this-> especialidad = $especialidad;
    $this-> titulos = $titulos;
    $this-> img_perfil = $img_perfil;
    $this-> privilegio =$privilegio;
    $this-> fecha_creacion =$fecha_creacion;
    $this-> activo =$activo;



}
public function convertir_a_json(){
  $json_usuario = array(
    'id'=>$this->id,
    'nombre'=>$this->nombre,
    'apellido'=>$this->apellido,
     'email'=> $this->email,
    'pass'=>$this->pass,
    'prefijo'=>$this->prefijo,
    'especialidad'=>$this->especialidad,
     'titulos'=>$this->titulos,
    'img_perfil'=>$this->img_perfil,
    'privilegio'=>$this->privilegio,
    'fecha_creacion'=> $this->fecha_creacion,
    'activo'=>$this->activo

  );
  return $json_usuario;
}

public function cambiarEmail($email){
$this-> email =$email;
}
public function cambiarPsw($pass){
$this-> pass =$pass;
}
public function cambiarEstado($estado){
$this-> activo =$estado;
}
public function cambiar_id($id){
$this-> id =$id;
}
public function obtener_id(){
   return $this -> id;
}
public function obtener_nombre(){
   return $this -> nombre;
}
public function obtener_apellido(){
   return $this -> apellido;
}
public function obtener_email(){
   return $this -> email;
}
public function obtener_password(){
   return $this -> pass;
}
public function obtener_privilegio(){
   return $this -> privilegio;
}
public function obtener_prefijo(){
   return $this -> prefijo;
}
public function obtener_especialidad(){
   return $this -> especialidad;
}
public function obtener_titulos(){
   return $this -> titulos;
}
public function obtener_img_perfil(){
   return $this -> img_perfil;
}
public function obtener_creacion(){
   return $this -> fecha_creacion;
}
public function obtener_estado(){
   return $this -> activo;
}
public function obtener_cantidad_articulos(){
Conexion::abrir_conexion();
$conexion =Conexion::obtener_conexion();
$sql = "SELECT cantidad_ariticulos FROM usuarios WHERE id='$this->id'";
$manejador = $conexion->prepare($sql);
$resultado = $manejador->execute();
if($resultado){
  $datos = $manejador->fetch();
  var_dump($datos);
}
else{
  return 'error en base2234';
}

return $this->cantidad_ariticulos;
}


public function obtener_privilegio_nombre(){
  Conexion::abrir_conexion();
  $conexion =Conexion::obtener_conexion();
  $id_privilegio = (int)$this->privilegio;
  $sql = $sql ="SELECT privilegios.privilegio FROM privilegios WHERE $id_privilegio = privilegios.id_priv";
  $manejador = $conexion->prepare($sql);
  $resultado = $manejador->execute();
  if($resultado){
    $datos = $manejador->fetch();
    $privilegio = $datos['privilegio'];
    return $datos;
  }

}





}



?>
