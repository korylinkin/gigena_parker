<?php


$respuesta='';
if (isset($_POST)&&!empty($_POST)) {
  $titulo = $_POST['url_intento'];
  $respuesta = crear_url($titulo);
  var_dump($respuesta);
}


 ?>
 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <title></title>
   </head>
   <body>
     <form class="" action="url_prueba" method="post">
     <input type="text" name="url_intento" value="">
     <input type="submit" name="enviar" value="Mandar">
     </form>
     <span><?php  //echo $respuesta ?></span>
   </body>
 </html>


<?php

?>
