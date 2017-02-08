<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=EB+Garamond|Lato|Open+Sans|Roboto" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_CSS?>bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_CSS?>panel_admin.css">
    <link rel="stylesheet" type="text/css" href="<?php echo RUTA_CSS?>index.css">
    <?php echo IMPORTAR_RESPONSIVE?> <!-- ACA SE INCLUYEN TODOS LOS CSS DEL RESPONSIVE-->
    <title>Nosotros-Gigena Parker</title>
  </head>
  <body>
    <?php include_once 'estructuras/header.php';?>
    <?php
    if(!isset($datos_individual) && empty($datos_individual)){
      $datos_individual ='';
      content_generico('pre_content_generico','Programas','slider02.jpg',$datos_individual,'img_programa');
      //aca mostrar 5 articulos de noticias y un btn ver mas
      include_once 'app/MostrarArticulo.inc.php';

      $html  ='';
      $html .= MostrarArticulo::cargar_contenido_feed(5,2);
      echo $html;

    }else {
      //aca se nostraria el contenido del ariticulo individual

      include_once 'app/MostrarArticulo.inc.php';
      include_once 'app/iArticulos.inc.php';
      $articulo = $datos_individual[0];
      $articulo = iArticulos::crear_obj_articulo($articulo);
      $html = MostrarArticulo::crear_articulo_indiviual($articulo);
      echo $html;
    }
    ?>
     </body>
    <?php include_once 'estructuras/footer.php';?>
    <script type="text/javascript" src="<?php echo RUTA_JS?>polyfill.js"></script>
    <script type="text/javascript" src="<?php echo RUTA_JS?>jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo RUTA_JS?>bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo RUTA_JS?>jquery-ui.min.js"></script>
    <script src="<?php echo RUTA_JS?>jquery.flexslider.js"></script>
    <script type="text/javascript" src="<?php echo RUTA_JS?>index.js"></script>
    </html>
