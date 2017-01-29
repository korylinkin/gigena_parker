<?php
//include_once 'app/Conexion.inc.php';


class iArticulos{


    public static function subir_articulo($articulo){

      Conexion::abrir_conexion();
      $conexion = Conexion::obtener_conexion();
      $articulo_agregado =false;
      if(isset($conexion)){
          try{
          $sql = "INSERT INTO articulos(id_articulo,autor_id,id_categoria,url,titulo,texto,fecha_creacion,fecha_modificacion,url_img_principal,id_galeria,visitas,activa,especial)
          VALUES(:autor_id,:id_categoria,:url,:titulo,:texto,NOW(),NOW(),:img_prin,:id_galeria,0,1,0)";
          $autor_id = $articulo->obtener_autor_id();
          $categoria = $articulo->obtener_id_categoria();
          $url = $articulo->obtener_url();
          $titulo =$articulo->obtener_titulo();
          $texto =$articulo->obtener_texto();
          $img_prin  =$articulo ->obtener_url_img_principal();
          $id_galeria = $articulo->obtener_id_galeria();
          $ejecutar = $conexion->prepare($sql);
          Conexion::cerrar_conexion();
          $ejecutar->bindParam(':autor_id',$autor_id,PDO::PARAM_INT);
          $ejecutar->bindParam(':id_categoria',$categoria,PDO::PARAM_INT);
          $ejecutar->bindParam(':url',$url,PDO::PARAM_STR);
          $ejecutar->bindParam(':titulo',$titulo,PDO::PARAM_STR);
          $ejecutar->bindParam(':texto',$texto,PDO::PARAM_STR);
          $ejecutar->bindParam(':img_prin',$img_prin,PDO::PARAM_STR);
          $ejecutar->bindParam(':id_galeria',$id_galeria,PDO::PARAM_INT);
          $articulo_agregado=$ejecutar->execute();
          }
          catch(PDOException $ex){
              echo 'Error '.$ex->getMessage();
          }
      }
      return $articulo_agregado;




    }

public static function obtener_feed_especial($index,$especial,$cantidad){
//aca ya estoy seguro que son int, se hizo una comprobacion antes.
$respuesta= array();
try {

  Conexion::abrir_conexion();
  $conexion = Conexion::obtener_conexion();
  $articulos = array();
  $sql = "SELECT * FROM articulos WHERE articulos.id_articulo < $index AND articulos.especial=$especial ORDER BY fecha_creacion DESC LIMIT $cantidad";
  $ejecutar = $conexion->prepare($sql);
  $resultado = $ejecutar->execute();
  Conexion::cerrar_conexion();
  if($resultado){

    $datos = $ejecutar->fetchAll();
    if(count($datos)){
      foreach ($datos as $fila) {
        $articulos[] = new Articulos
                    ($fila['id_articulo'],
                    $fila['autor_id'],
                    $fila['id_categoria'],
                    $fila['url'],
                    $fila['titulo'],
                    $fila['texto'],
                    $fila['fecha_creacion'],
                    $fila['fecha_modificacion'],
                    $fila['url_img_principal'],
                    $fila['galeria'],
                    $fila['visitas'],
                    $fila['activa'],
                    $fila['especial']);
      }
      $respuesta['articulos']= $articulos;
      $respuesta['exito']  = $resultado;
      $respuesta['mensaje'] ='';
      return $respuesta;
    }
    else{
      $respuesta['articulos']='';
      $respuesta['exito']=$resultado;
      $respuesta['mensaje'] ='No hay mas usuarios';
      return $respuesta;
    }

  }
  else{
    $respuesta['exito'] =$resultado;
    $respuesta['msj'] = 'Error en la consulta';
    return $respuesta;
  }


} catch(PDOException $ex){
    print 'ERROR'.$ex ->getMessage();
}

}
public static function obtener_x_articulos_categorias($cantidad,$id_categoria){
    $cantidad=  (int)$cantidad;
    $id_categoria = (int)$id_categoria;
    $respuesta = array();
    if($cantidad!==0){
       $articulos= array();
        try{
          Conexion::abrir_conexion();
          $conexion = Conexion::obtener_conexion();
            $sql ="SELECT * FROM articulos WHERE  id_categoria = $id_categoria AND articulos.especial=0 ORDER BY fecha_creacion DESC LIMIT $cantidad";
            $ejecutar =$conexion->prepare($sql);
            $resultado = $ejecutar->execute();
            Conexion::cerrar_conexion();
            if($resultado){
              $datos = $ejecutar->fetchAll();
              if(count($datos)){
                foreach ($datos as $fila) {
                  $articulos[] = new Articulos
                              ($fila['id_articulo'],
                              $fila['autor_id'],
                              $fila['id_categoria'],
                              $fila['url'],
                              $fila['titulo'],
                              $fila['texto'],
                              $fila['fecha_creacion'],
                              $fila['fecha_modificacion'],
                              $fila['url_img_principal'],
                              $fila['galeria'],
                              $fila['visitas'],
                              $fila['activa'],
                              $fila['especial']);
                }
                $respuesta['articulos']= $articulos;
                $respuesta['exito']  = $resultado;
                $respuesta['mensaje'] ='';
                return $respuesta;
              }
              else{
                $respuesta['articulos']='';
                $respuesta['exito']=false;
                $respuesta['mensaje'] ='No hay mas usuarios';
                return $respuesta;
              }
            }else{
              return 'Hubo problemas en la consulta';
            }
        }
        catch(PDOException $ex){
            print 'ERROR'.$ex ->getMessage();
        }
    }
    else{

    }


}
    public static function obtener_feed_categorias($index,$especial,$id_categoria,$cantidad){
        $cantidad=  (int)$cantidad;
        $index = (int)$index;
        $respuesta = array();
        if($cantidad!==0){
           $articulos= array();
            try{
              Conexion::abrir_conexion();
              $conexion = Conexion::obtener_conexion();
                $sql ="SELECT * FROM articulos WHERE articulos.id_articulo < $index AND articulos.especial=$especial AND articulos.id_categoria = $id_categoria ORDER BY fecha_creacion DESC LIMIT $cantidad";
                $ejecutar =$conexion->prepare($sql);
                $resultado = $ejecutar->execute();
                Conexion::cerrar_conexion();
                if($resultado){
                  $datos = $ejecutar->fetchAll();
                  if(count($datos)){
                    foreach ($datos as $fila) {
                      $articulos[] = new Articulos
                                  ($fila['id_articulo'],
                                  $fila['autor_id'],
                                  $fila['id_categoria'],
                                  $fila['url'],
                                  $fila['titulo'],
                                  $fila['texto'],
                                  $fila['fecha_creacion'],
                                  $fila['fecha_modificacion'],
                                  $fila['url_img_principal'],
                                  $fila['galeria'],
                                  $fila['visitas'],
                                  $fila['activa'],
                                  $fila['especial']);
                    }
                    $respuesta['articulos']= $articulos;
                    $respuesta['exito']  = $resultado;
                    $respuesta['mensaje'] ='';
                    return $respuesta;
                  }
                  else{
                    $respuesta['articulos']='';
                    $respuesta['exito']=$resultado;
                    $respuesta['mensaje'] ='No hay mas usuarios';
                    return $respuesta;
                  }
                }else{
                  return 'Hubo problemas en la consulta';
                }
            }
            catch(PDOException $ex){
                print 'ERROR'.$ex ->getMessage();
            }
        }
        else{

        }


    }
    public static function insertar_articulo($conexion,$articulo){

     $articulo_agregado =false;
     if(isset($conexion)){
         try{
         $sql = "INSERT INTO articulos(autor_id,id_categoria,url,titulo,texto,fecha_creacion,fecha_modificacion,url_img_principal,id_galeria,visitas,activa,especial)
         VALUES(:autor_id,:id_categoria,:url,:titulo,:texto,NOW(),NOW(),:img_prin,:id_galeria,0,1,0)";
         $autor_id = $articulo->obtener_autor_id();
         $categoria = $articulo->obtener_id_categoria();
         $url = $articulo->obtener_url();
         $titulo =$articulo->obtener_titulo();
         $texto =$articulo->obtener_texto();
         $img_prin  =$articulo ->obtener_url_img_principal();
         $id_galeria = $articulo->obtener_id_galeria();
         $ejecutar = $conexion->prepare($sql);
         $ejecutar->bindParam(':autor_id',$autor_id,PDO::PARAM_INT);
         $ejecutar->bindParam(':id_categoria',$categoria,PDO::PARAM_INT);
         $ejecutar->bindParam(':url',$url,PDO::PARAM_STR);
         $ejecutar->bindParam(':titulo',$titulo,PDO::PARAM_STR);
         $ejecutar->bindParam(':texto',$texto,PDO::PARAM_STR);
         $ejecutar->bindParam(':img_prin',$img_prin,PDO::PARAM_STR);
         $ejecutar->bindParam(':id_galeria',$id_galeria,PDO::PARAM_INT);
         $articulo_agregado=$ejecutar->execute();
         }
         catch(PDOException $ex){
             echo 'Error '.$ex->getMessage();
         }
     }
     return $articulo_agregado;


    }
    public static function obtener_mas_vistos($cantidad){
      if($cantidad!==0){
         $articulos= array();
          try{

            Conexion::abrir_conexion();
            $conexion = Conexion::obtener_conexion();
              $sql = "SELECT * FROM articulos ORDER BY visitas DESC";
              $ejecutar =$conexion->prepare($sql);
              $resultado = $ejecutar->execute();
              Conexion::cerrar_conexion();
              if($resultado){
                  $todo = $ejecutar->fetchAll();
              if(count($todo)){
                  $c=0;
                  foreach ($todo as $fila) {
                      if($c<$cantidad){
                      $articulos[] = new Articulos
                                  ($fila['id_articulo'],
                                  $fila['autor_id'],
                                  $fila['id_categoria'],
                                  $fila['url'],
                                  $fila['titulo'],
                                  $fila['texto'],
                                  $fila['fecha_creacion'],
                                  $fila['fecha_modificacion'],
                                  $fila['url_img_principal'],
                                  $fila['galeria'],
                                  $fila['visitas'],
                                  $fila['activa'],
                                  $fila['especial']);
                   $c++;
                  }
                  else{
                      return $articulos;
                  }
                  }

              }
              }
              return $articulos;
          }
          catch(PDOException $ex){
              print 'ERROR'.$ex ->getMessage();
          }
      }else{

      }
    }
    public static function obtener_x_articulos($cantidad){
        $cantidad=  (int)$cantidad;
        $respuesta = array();
        if($cantidad!==0){
           $articulos= array();
            try{
              Conexion::abrir_conexion();
              $conexion = Conexion::obtener_conexion();
                $sql = "SELECT  * FROM articulos ORDER BY fecha_creacion DESC LIMIT $cantidad";
                $ejecutar =$conexion->prepare($sql);
                $resultado = $ejecutar->execute();
                Conexion::cerrar_conexion();
                if($resultado){
                  $datos = $ejecutar->fetchAll();
                  if(count($datos)){
                    foreach ($datos as $fila) {
                      $articulos[] = new Articulos
                                  ($fila['id_articulo'],
                                  $fila['autor_id'],
                                  $fila['id_categoria'],
                                  $fila['url'],
                                  $fila['titulo'],
                                  $fila['texto'],
                                  $fila['fecha_creacion'],
                                  $fila['fecha_modificacion'],
                                  $fila['url_img_principal'],
                                  $fila['galeria'],
                                  $fila['visitas'],
                                  $fila['activa'],
                                  $fila['especial']);
                    }
                    $respuesta['exito']=$resultado;
                    $respuesta['articulos'] = $articulos;
                    return $respuesta;
                  }
                  else{
                    $respuesta['exito'] =false;
                    $respuesta['mensaje'] ='No se encontro coincidencias';
                    return $respuesta;
                  }
                }else{
                  return 'Hubo problemas en la consulta';
                }
            }
            catch(PDOException $ex){
                print 'ERROR'.$ex ->getMessage();
            }
        }
        else{

        }
    }
    public static function obtener_articulos_especial($cantidad,$especial){
      $cantidad= (int)$cantidad;
      $especial = (int)$especial;
      if($cantidad!==0){
        $articulos = array();
        try {
          Conexion::abrir_conexion();
          $conexion = Conexion::obtener_conexion();
            $sql = "SELECT  * FROM articulos  WHERE  articulos.especial=$especial ORDER BY id_articulo DESC LIMIT $cantidad";
            $ejecutar =$conexion->prepare($sql);
            $resultado = $ejecutar->execute();
            Conexion::cerrar_conexion();
            if($resultado){
              $datos = $ejecutar->fetchAll();
              if(count($datos)){
                foreach ($datos as $fila) {
                  $articulos[] = new Articulos
                              ($fila['id_articulo'],
                              $fila['autor_id'],
                              $fila['id_categoria'],
                              $fila['url'],
                              $fila['titulo'],
                              $fila['texto'],
                              $fila['fecha_creacion'],
                              $fila['fecha_modificacion'],
                              $fila['url_img_principal'],
                              $fila['galeria'],
                              $fila['visitas'],
                              $fila['activa'],
                              $fila['especial']);
                }
                $respuesta['exito'] =true;
                $respuesta['articulos'] =$articulos;
                return $respuesta;
              }
              else{
                $respuesta['exito'] =false;
                $respuesta['mensaje'] ='No se encontro coincidencias';
                return $respuesta;
              }
            }
          }
          catch(PDOException $ex){
              print 'ERROR'.$ex ->getMessage();
          }

      }
      else{

      }
    }

    public static function obtener_articulos_especial_feed($cantidad,$categoria,$index){
        $cantidad =  (int)$cantidad;
        if($cantidad!==0){
           $articulos= array();
            try{
              Conexion::abrir_conexion();
              $conexion = Conexion::obtener_conexion();
                $sql = "SELECT  * FROM articulos  WHERE  articulos.id_categoria=$categoria AND articulos.especial=0 ORDER BY fecha_creacion DESC LIMIT $cantidad";
                $ejecutar =$conexion->prepare($sql);
                $resultado = $ejecutar->execute();
                Conexion::cerrar_conexion();
                if($resultado){
                  $datos = $ejecutar->fetchAll();
                  if(count($datos)){
                    foreach ($datos as $fila) {
                      $articulos[] = new Articulos
                                  ($fila['id_articulo'],
                                  $fila['autor_id'],
                                  $fila['id_categoria'],
                                  $fila['url'],
                                  $fila['titulo'],
                                  $fila['texto'],
                                  $fila['fecha_creacion'],
                                  $fila['fecha_modificacion'],
                                  $fila['url_img_principal'],
                                  $fila['galeria'],
                                  $fila['visitas'],
                                  $fila['activa'],
                                  $fila['especial']);
                    }
                    $respuesta['exito'] =true;
                    $respuesta['articulos'] =$articulos;
                    return $respuesta;
                  }
                  else{
                    $respuesta['exito'] =false;
                    $respuesta['mensaje'] ='No se encontro coincidencias';
                    return $respuesta;
                  }
                }else{
                  return 'Hubo problemas en la consulta';
                }
            }
            catch(PDOException $ex){
                print 'ERROR'.$ex ->getMessage();
            }
        }
        else{

        }
    }

    public static function obtener_categoria($conexion,$articulo){

      $id_articulo = $articulo->obtener_id_categoria();
      $sql ="SELECT categorias.categoria FROM categorias INNER JOIN articulos ON $id_articulo = categorias.id_categoria;";
      $ejecutar =$conexion->prepare($sql);
      $resultado = $ejecutar->execute();
      $nombre= '';
      if($resultado){
        $todo = $ejecutar->fetchAll();
        if (count($todo)) {
          $nombre = $todo[0]['categoria'];
        }
      }
      return $nombre;

    }

    public static function obtener_todos_desce($conexion){
        $articulos= array();
            try{
                $sql = "SELECT * FROM articulos ORDER BY fecha_creacion DESC";
                $ejecutar =$conexion->prepare($sql);
                $resultado = $ejecutar->execute();

                if($resultado){
                    $todo = $ejecutar->fetchAll();
                if(count($todo)){
                    foreach ($todo as $fila) {
                        $articulos[] = new Articulos
                                    ($fila['id_articulo'],
                                    $fila['autor_id'],
                                    $fila['id_categoria'],
                                    $fila['url'],
                                    $fila['titulo'],
                                    $fila['texto'],
                                    $fila['fecha_creacion'],
                                    $fila['fecha_modificacion'],
                                    $fila['url_img_principal'],
                                    $fila['id_galeria'],
                                    $fila['visitas'],
                                    $fila['activa'],
                                    $fila['especial']);
                    }
                }
                }
                return $articulos;
            }
            catch(PDOException $ex){
                print 'ERROR'.$ex ->getMessage();
            }

           }

public static function crear_obj_articulo($fila){
  $articulo = new Articulos
                    ($fila['id_articulo'],
                    $fila['autor_id'],
                    $fila['id_categoria'],
                    $fila['url'],
                    $fila['titulo'],
                    $fila['texto'],
                    $fila['fecha_creacion'],
                    $fila['fecha_modificacion'],
                    $fila['url_img_principal'],
                    $fila['galeria'],
                    $fila['visitas'],
                    $fila['activa'],
                    $fila['especial']);
    return $articulo;
    }



public static function obtener_articulo_url($url){
  $articulo = array();
      try{
          $sql = "SELECT * FROM articulos WHERE url = $url";
          $consulta =$conexion->prepare($sql);
          $resultado = $consulta->execute();

          if($resultado){
            $fila = $ejecutar->fetch();
            $articulo = new Articulos
                              ($fila['id_articulo'],
                              $fila['autor_id'],
                              $fila['id_categoria'],
                              $fila['url'],
                              $fila['titulo'],
                              $fila['texto'],
                              $fila['fecha_creacion'],
                              $fila['fecha_modificacion'],
                              $fila['url_img_principal'],
                              $fila['galeria'],
                              $fila['visitas'],
                              $fila['activa'],
                              $fila['especial']);
              }
              return $articulo;
          }
      catch(PDOException $ex){
          print 'ERROR'.$ex ->getMessage();
      }
}

}


?>
