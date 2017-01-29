<?php


class AccionesDeUsuario{
  public static function obtener_todos_filtro($filtro,$conexion){
    $usuarios = array();
    if (isset($conexion)){
        try{

            $sql ="SELECT * FROM usuarios WHERE privilegio = '$filtro' ORDER BY fecha_creacion DESC";
            $preparar =$conexion->prepare($sql);
            $preparar->execute();
            $resultado = $preparar->fetchAll();
            if (count($resultado)) {
                foreach ($resultado as $fila) {
                   $usuarios[] = new Usuario($fila['id'],$fila['nombre'],$fila['apellido'],
                                             $fila['email'],$fila['passw'],$fila['prefijo'],
                                             $fila['especialidad'],$fila['titulos'],$fila['img_perfil'],
                                             $fila['privilegio'],$fila['fecha_creacion'],$fila['activo']);
             }
            }
            else {
                print('No hay usuarios');
            }


        }
        catch(PDOException $ex){
            print 'ERROR'.$ex->getMessage();
        }
    }
    return $usuarios;

  }
public static function obtenerTodos($conexion){
    $usuarios = array();
    if (isset($conexion)){
        try{

            $sql ='SELECT * FROM usuarios ORDER BY fecha_creacion DESC';
            $preparar =$conexion->prepare($sql);
            $preparar->execute();
            $resultado = $preparar->fetchAll();
            if (count($resultado)) {
                foreach ($resultado as $fila) {
                   $usuarios[] = new Usuario($fila['id'],$fila['nombre'],$fila['apellido'],
                                             $fila['email'],$fila['passw'],$fila['prefijo'],
                                             $fila['especialidad'],$fila['titulos'],$fila['img_perfil'],
                                             $fila['privilegio'],$fila['fecha_creacion'],$fila['activo']);
             }
            }
            else {
                print('No hay usuarios');
            }


        }
        catch(PDOException $ex){
            print 'ERROR'.$ex->getMessage();
        }
    }
    return $usuarios;
}
public static function total_usuarios(){

    $usuarios_totales=0;

    Conexion::abrir_conexion();
    $conexion = Conexion::obtener_conexion();
        try{
        $sql ='SELECT COUNT(*) as total FROM usuarios';
        $preparar =$conexion->prepare($sql);
        $preparar->execute();
        $resultado = $preparar->fetch();
        $usuarios_totales = $resultado['total'];
        Conexion::cerrar_conexion();

        }
        catch(PDOException $ex){
            print 'Error '.$ex->getMessage();
        }

    return $usuarios_totales;
 }

 public static function insertar_usuario($conexion,$usuario){

     $usuario_agregado =false;
     if(isset($conexion)){
         try{
         $sql = "INSERT INTO usuarios(nombre,apellido,email,passw,privilegio,fecha_creacion,activo)
         VALUES(:nombre,:apellido,:email,:pass,:privilegio,NOW(),1)";
         $nombre = $usuario->obtener_nombre();
         $ape = $usuario->obtener_apellido();
         $em =$usuario->obtener_email();
         $psw =$usuario->obtener_password();
         $pv = $usuario->obtener_privilegio();
         $ejecutar = $conexion->prepare($sql);
         $ejecutar->bindParam(':nombre',$nombre,PDO::PARAM_STR);
         $ejecutar->bindParam(':apellido',$ape,PDO::PARAM_STR);
         $ejecutar->bindParam(':email',$em,PDO::PARAM_STR);
         $ejecutar->bindParam(':pass',$psw,PDO::PARAM_STR);
         $ejecutar->bindParam(':privilegio',$pv,PDO::PARAM_INT);
         $usuario_agregado= $ejecutar->execute();
         if($usuario_agregado){
           $sql = "SELECT id FROM usuarios WHERE email='$em'";
           $ejecutar = $conexion->prepare($sql);
           $busca = $ejecutar->execute();
           if($busca){
             $datos =$ejecutar->fetch();
             $usuario->cambiar_id($datos['id']);
           }
         }
         }
         catch(PDOException $ex){
             echo 'Error '.$ex->getMessage();

         }
     }
     return $usuario_agregado;

 }
 public static function email_existe($conexion,$email){
     $email_existe = true;
     if(isset($conexion)){
         try{
             $sql = "SELECT * FROM usuarios WHERE email= :email";
             $ejecutar = $conexion->prepare($sql);
             $ejecutar->bindParam(':email',$email,PDO::PARAM_STR);
             $ejecutar->execute();
             $resultado = $ejecutar->fetchAll();
             if(count($resultado)){
                 $email_existe= true;
             }
             else{
                 $email_existe = false;
             }
         }
         catch(PDOException $ex){
             print 'ERROR'.$ex->getMessage();
         }
     }
     return $email_existe;
 }
  public static function nombre_existe($conexion,$nombre){
     $nombre_existe = true;
     if(isset($conexion)){
         try{
             $sql = "SELECT * FROM usuarios WHERE nombre= :nombre";
             $ejecutar = $conexion->prepare($sql);
             $ejecutar->bindParam(':nombre',$email,PDO::PARAM_STR);
             $ejecutar->execute();
             $resultado = $ejecutar->fetchAll();
             if(count($resultado)){
                 $nombre_existe= true;
             }
             else{
                 $nombre_existe = false;
             }
         }
         catch(PDOException $ex){
             print 'ERROR'.$ex->getMessage();
         }
     }
     return $nombre_existe;
 }

 public static function obtener_privilegio_id($id_privilegio){
   Conexion::abrir_conexion();
   $conexion =Conexion::obtener_conexion();

   $sql = $sql ="SELECT privilegios.privilegio FROM privilegios WHERE $id_privilegio = privilegios.id_priv";
   $manejador = $conexion->prepare($sql);
   $resultado = $manejador->execute();
   if($resultado){
     $datos = $manejador->fetch();
     $privilegio = $datos['privilegio'];
     return $datos;
   }

 }
 public static function obtener_usuario_email($conexion,$email){
    include_once 'app/Usuario.inc.php';
     $usuario=null;
     if(isset($conexion)){

         try{
             $sql ="SELECT * FROM usuarios WHERE email= :email";
             $ejecutar = $conexion->prepare($sql);
             $ejecutar->bindParam(':email',$email,PDO::PARAM_STR);
             $ejecutar->execute();
             $resultado =$ejecutar->fetch();
             if(!empty($resultado)){
                 $usuario = new Usuario($resultado['id'],$resultado['nombre'],$resultado['apellido'],$resultado['email'],$resultado['passw'],
                                        $resultado['prefijo'],$resultado['especialidad'],$resultado['titulos'],
                                        $resultado['img_perfil'],$resultado['privilegio'],$resultado['fecha_creacion'],
                                        $resultado['activo']);
             }
         }
         catch (PDOException $ex){
             print 'ERROR '.$ex->getMessage();
         }


     }
     return $usuario;

 }

}



?>
