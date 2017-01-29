<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $titulo; ?></title>
    <meta charset="utf-8">

    <link rel="stylesheet" href="../css/panel_admin.css">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/preview.css">
    <script type="text/javascript" src="<?php echo RUTA_JS?>jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo RUTA_JS?>sticky-header.js"></script>
    <script type="text/javascript" src="<?php echo RUTA_JS?>preview.js"></script>

  </head>
  <body>
    
    <?php include_once 'estructuras/admin/barra_herramientas.php';?>
    <div class="contenedor_articulo_preview">
      <div class="contenedor_info">
        <h1><?php echo $titulo;?></h1>
        <div class="contenido_preview">
          <?php echo $contenido; ?>
          <footer><?php echo $fecha_creacion;?></footer>
        </div>
        <form class="" id="datos_articulo"action="#" method="post">
              <input type="hidden" value='<?php echo $datos;?>' name="datos_articulo">
        </form>
      </div>

  </div>
    <?php include_once 'estructuras/footer.php';?>

  </body>

</html>
