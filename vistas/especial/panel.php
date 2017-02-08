<?php
if (isset($_SESSION['id_usuario'])) {
  $privilegio = (int)$_SESSION['privilegio'];
  if($privilegio===5){
      echo '<script> window.location = "'.INDEX_URL.'";</script>';     
  }
  ?>
  <!DOCTYPE html>
  <html>
  <head>
  	<title>Panel Admin</title>
  	<meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  	<link rel="stylesheet" type="text/css" href="<?php echo RUTA_CSS?>bootstrap.min.css">
  	<link rel="stylesheet" type="text/css" href="<?php echo RUTA_CSS?>panel_admin.css">
    
    <?php echo IMPORTAR_RESPONSIVE?>
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_CSS?>jquery-ui.min.css">
    <link href="https://cdn.quilljs.com/1.1.5/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.1.5/quill.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_CSS?>funciones/articulos_subir.css">
    <script type="text/javascript" src="<?php echo RUTA_JS?>jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo RUTA_JS?>sticky-header.js"></script>

    <script src="https://use.fontawesome.com/86baab9842.js"></script>


  </head>
    <body>
      <?php include_once(RUTA_ESTRUCTURAS_ADMIN.'header_admin.php'); ?>
      <?php include_once(RUTA_ESTRUCTURAS_ADMIN.'barra_herramientas.php');?>
      <?php include_once(RUTA_ESTRUCTURAS_ADMIN.'contenido_admin.php');?>

    </body>
    <script type="text/javascript" src="<?php echo RUTA_JS?>jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?php echo RUTA_JS?>bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo RUTA_JS?>panel.js"></script>

    </html>

  <?php
}
else {
echo '<script> window.location = "'.INDEX_URL.'";</script>';
}
?>
