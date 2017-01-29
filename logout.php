<?php
include_once 'app/ControlSesion.inc.php';
ControlSesion::cerrar_session();
RedireccionUrl::redirigir(INDEX_URL);
?>
 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <title>Saliendo</title>
   </head>
   <body>

   </body>
</html>
