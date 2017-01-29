  <?php
    
    include_once 'app/config.inc.php';

    if (isset($_SESSION['id_usuario'])) {
      echo ('<script> window.location= "administrador"</script>');
    }
   ?>
   <!DOCTYPE html>
   <html>
   <head>
     <meta charset="utf-8">
     <link rel="stylesheet" href="<?php echo RUTA_CSS?>bootstrap.min.css">
     <link rel="stylesheet" href="<?php echo RUTA_CSS?>login.css">
     <link rel="stylesheet" href="<?php echo RUTA_CSS?>registro_form.css">
     <link href='https://fonts.googleapis.com/css?family=Droid+Sans:700' rel='stylesheet' type='text/css'>
     <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
     <title>Logeo Simple</title>
   </head>
     <body>
    <div class="container" >
       <!-- cargar el contenido del login contrlando si se apreta el btn registro o no-->

      <?php include_once 'estructuras/login_form.php';?>
     </div>
    <!-- aca creo el contenedor del registro escondido para cuando lo abran-->
    <?php
     include_once 'estructuras/registro_form.php';
    ?>



   <script src="<?php echo RUTA_JS?>jquery.min.js"></script>
   <script src="<?php echo RUTA_JS?>jquery-ui.min.js"></script>
   <script src="<?php echo RUTA_JS?>bootstrap.min.js"></script>
   <script type="text/javascript" src="<?php echo RUTA_JS?>login.js"></script>
   </body>
   </html>
