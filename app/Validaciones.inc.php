<?php

class Validaciones{
    
    
        private $aprobado =false;
    
    public function PackValidacion($txt){
        
            $vacio = $this->estaVacio($txt);//true = es primera vez que se carga la web
            $definida = $this->estaDefinida($txt);//true=si esta definida
            
            
        if ($definida && $vacio) {
            $this->aprobado=false;
            return $this->aprobado;
        }
        else{
            $this->aprobado=true;
            return $this->aprobado;
        }
        
        
        
    }
    private function estaDefinida($txt){
        if(isset($txt)){
            return true;
        }
        else{
            return false;
        }
    }
    private function estaVacio($txrt){
        if (empty($txrt)) {
            return true;
        }
        else{
            return false;
        }
    }



    
    
    
    
}





?>