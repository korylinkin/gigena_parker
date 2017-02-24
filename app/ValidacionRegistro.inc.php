<?php
//////////////////////////validaciones de formularios
include_once 'app/AccionesDeUsuario.inc.php';
class ValidacionRegistro{

    private $nombre;
    private $apellido;
    private $email;
    private $clave;
    private $privilegio;




    private $aviso_inicio;
    private $aviso_fin;


    private $error_nombre;
    private $error_apellido;

    private $error_email;
    private $error_clave;
    private $error_clave2;
    private $error_pass_igual;

    public function __construct($nombre,$apellido,$email,$clave,$clave2,$privilegio,$conexion){

        $this->aviso_incio ='<div class="error_registro" role="alert">';
        $this->aviso_fin ='</div>';
        $this->nombre ='';
        $this->apellido ='';

        $this->email ='';
        $this->privilegio = $privilegio;

        $this->error_nombre = $this->validar_nombre($nombre);
        $this->error_apellido = $this->validar_apellido($apellido);
        $this->error_email = $this->validar_email($conexion,$email);
        $this->error_clave = $this->validar_clave($clave);
        $this->error_clave2 = $this->validar_claves($clave,$clave2);

        if($this->error_clave===""&&$this->error_clave2===""){
            $this->clave= $clave;
        }
    }
    public function obtener_errores(){

        $error_entero =$this->error_nombre.PHP_EOL.$this->error_apellido.PHP_EOL.$this->error_email.PHP_EOL.$this->error_clave.PHP_EOL.$this->error_clave2;
        return $error_entero;
    }


    private function validar_apellido($apellido){
        if (!$this->definida_vacio($apellido)) {
            //
            return "Tienes que ingresar un apellido.";
        }else{
            $this->apellido = $apellido;
        }
        return '';
    }


    public function registro_valido(){

        if($this->error_nombre===""&&$this->error_email===""&&$this->error_clave===""&&$this->error_clave2===""&&$this->error_apellido===""){
            return true;
        }
        else{
            return false;
        }



    }


    private function definida_vacio($var){
        if (isset($var)&& !empty($var)) {
            return true;
        }
        else{
            return false;
        }
    }
    private function validar_email_login($email){
        if (!$this->definida_vacio($email)) {
            //podria ingresar con pseudo-username-email accesos:[federicolaztra@gmail.com,federicolaztra]
            return "Tienes que ingresar un emaikkk.";
        }

    }
    private function validar_pass_login($clave){
        //encriptar,(enviar y llamar a bd para comparar contraseñas.)

    }

    private function validar_nombre($nombre){
        if (!$this->definida_vacio($nombre)) {
            return "Tienes que ingresar un nombre.";

        }
        else {
            $this->nombre = $nombre;//inicio variable
        }

        if (strlen($nombre)<4) {
            return 'El nombre debe tener mas de 3 letras';
        }
        return '';
    }
    private function validar_email($conexion,$email){
        if(!$this->definida_vacio($email)){
            return 'Debes escribir un email';
        }
        else{
            $this->email = $email;
        }
        $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
        if (preg_match($regex, $email)) {
        $this->email = $email;
        } else {
        return 'Email invalido';
       }
       if(AccionesDeUsuario::email_existe($conexion,$email)){
           return 'Este email ya existe';

       }
       return '';

    }
    private function validar_clave($pass){



        if(!$this->definida_vacio($pass)){
            return 'Debes escribir una contraseña';
        }
        return '';
    }
    private function validar_claves($pass,$clave2){
        if(!$this->definida_vacio($pass)){
            return 'Primero debes rellenar la contraseña';
        }
        if(!$this->definida_vacio($clave2)){
            return 'Debes repetir la contraseña';
        }

        if($pass!==$clave2){
            return 'Las contraseñas deben coincidir';
        }
        else{
            $this->clave = $pass;
        }
        return '';
    }

    public function obtener_nombre(){
        return $this->nombre;
    }
    public function obtener_apellido(){
        return $this->apellido;
    }
    public function obtener_pass(){
        return $this->clave;
    }
    public function obtener_privilegio(){
        return $this->privilegio;
    }
    public function obtener_email(){
        return $this->email;
    }
    public function obtener_error_nombre(){
        return $this->error_nombre;
    }
    public function obtener_error_apellido(){
        return $this->error_apellido;
    }

    public function obtener_error_email(){
        return $this->error_email;
    }
    public function obtener_error_clave(){
        return $this->error_clave;
    }
    public function obtener_error_clave2(){
        return $this->error_clave2;
    }
    public function mostrar_error_nombre(){
        if($this->error_nombre!==''){

            echo $this->aviso_incio.$this->error_nombre.$this->aviso_fin;
        }
    }
    public function mostrar_error_apellido(){
        if($this->error_apellido!==''){

            echo $this->aviso_incio.$this->error_apellido.$this->aviso_fin;
        }
    }
    public function mostrar_error_email(){
        if($this->error_email!==''){

            echo $this->aviso_incio.$this->error_email.$this->aviso_fin;
        }
    }
    public function mostrar_error_clave(){
        if($this->error_clave!==''){
            echo $this->aviso_incio.$this->error_clave.$this->aviso_fin;
        }
    }
    public function mostrar_error_clave2(){
        if($this->error_clave2!==''){
            echo $this->aviso_incio.$this->error_clave2.$this->aviso_fin;
        }
    }
    public function mostrar_nombre(){
        if($this->nombre!==''){
            echo 'value ="'.$this->nombre.'"';
        }

    }
    public function mostrar_apellido(){
        if($this->apellido!==''){
            echo 'value ="'.$this->apellido.'"';
        }

    }
    public function mostrar_email(){
        if($this->email!==''){
            echo 'value ="'.$this->email.'"';
        }

    }

    }
  ?>
