<?php
include_once 'app/Articulos.inc.php';
$fila= $datos[0];
$articulo_ind = new Articulos
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
var_dump($articulo_ind);
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Pagina de las categorias</title>
  </head>
  <body>

  </body>
</html>
