<?php

class ControlSesion{

    public static function iniciar_sesion($id_usuario,$privilegio,$nombre_usuario){
      $exito = false;
        if(session_id()==''){
            session_start();
        }
        else{
          $_SESSION['id_usuario'] = $id_usuario;
          $_SESSION['privilegio'] = $privilegio;
          $_SESSION['nombre'] = $nombre_usuario;
          $exito = true;
          return $exito;
        }

    }
    public static function cerrar_session(){
       if(session_id()==''){
            session_start();
        }
        if(isset($_SESSION['id_usuario'])){
            unset($_SESSION['id_usuario']);
        }
        if(isset($_SESSION['privilegio'])){
           unset($_SESSION['privilegio']);
        }
        if(isset($_SESSION['nombre'])){
            unset($_SESSION['nombre']);
        }
        session_destroy();
    }
    public static function sesion_iniciada(){
      
        if(isset($_SESSION['id_usuario'])&& isset($_SESSION['nombre'])){
            return true;
        }
        else{
            return false;
        }

    }
    public function comprobar_campos($correo,$contra){

      //si esta todo bien que me devuelva true osea, esta definido y no esta vacio
      if ($this->validar_vacio($correo)&& $this->validar_vacio($contra)) {
        return true;
      }
      else{
        return false;
      }
    }

    private function validar_vacio($txt){

      if( isset($txt) && !empty($txt) ){
        return true;
      }
      else{
        return false;
      }
    }
  }
?>
