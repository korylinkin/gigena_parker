<?php
include_once 'app/AccionesDeUsuario.inc.php';
class ValidacionLogin{

    private $usuario;
    private $contra;
    private $error;

    public function __construct($username,$pass,$conexion){

        $this->usuario = $username;
        $this->contra = $pass;

        if(!$this->definida_vacio($username)||!$this->definida_vacio($pass)){
            $this->nombre_usuario=null;
            $this->error='Falta Email o Contraseña';
        }
        else{

            $this->usuario = AccionesDeUsuario::obtener_usuario_email($conexion,$username);
            if(is_null($this->usuario)||!password_verify($pass,$this->usuario->obtener_password())){
                $this->error = 'Email o Contraseña incorrectas';
            }
        }


    }
    public function obtener_email(){
        $email='';
        if(!empty($this->usuario->obtener_email())){
            $email = 'value ="'.$this->usuario->obtener_email().'"';
        }
        return $email;
    }
     private function definida_vacio($var){
        if (isset($var)&& !empty($var)) {
            return true;
        }
        else{
            return false;
        }
    }
    public function obtener_usuario(){
        return $this->usuario;
    }
    public function obtener_error(){
        return $this->error;
    }
    public function mostrar_error(){
        if($this->error!==''){
            echo '<div role="alert">';
            echo $this->error;
            echo '</div>';
        }
    }




}
?>
