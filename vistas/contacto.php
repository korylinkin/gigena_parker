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
    <script src="https://use.fontawesome.com/86baab9842.js"></script>
    <title>Contacto-Gigena Parker</title>
  </head>
  <body>
    <?php include_once 'estructuras/header.php';?>
    <div class="contenedor_contacto_principal">
    <span class="titulo_contacto">Contacto</span>
    <div class="contenedor_contacto">
      <form id="enviar_mensaje" action="contactar" method="post">
        <label for="nombre">Nombre y Apellido</label>
        <input class="campo_contacto" type="text" name="nombre" value="" required>
        <label for="email">Email</label>
        <input class="campo_contacto" type="email" name="email" value="" required>
        <label for="mensaje">Mensaje</label>
        <textarea class="campo_contacto" name="mensaje" rows="8" cols="80" required></textarea>
        <input type="submit" name="enviar_consulta" value="Enviar Consulta">
      </form>
      <div class="contenedor_info_contacto">
        <div class="contenedor_informacion">
            <span>Fraguerio 1157 - Barrio Cofico, Córdoba Argentina<i class="fa fa-map-marker" aria-hidden="true"></i></span></br>
            <span>+54 0351 4741538 / +54 0351 4711181<i class="fa fa-mobile" aria-hidden="true"></i></span>
            <span>consultas@gigenaparker.com<i class="fa fa-envelope" aria-hidden="true"></i></span></br>
        </div>
        <div class="mapa_contacto">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3405.4534764735026!2d-64.19079718527777!3d-31.401629802679548!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94329864bcaad699%3A0xb6025184fc09f109!2sCentro+de+Asistencia+en+Des%C3%B3rdenes+de+la+Conducta!5e0!3m2!1ses-419!2sar!4v1482013195145" width="100%" height="220" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
      </div>
    </div>
  </div>

  </body>
  <?php include_once 'estructuras/footer.php';?>
  <script type="text/javascript" src="<?php echo RUTA_JS?>polyfill.js"></script>
  <script type="text/javascript" src="<?php echo RUTA_JS?>jquery.min.js"></script>
  <script type="text/javascript" src="<?php echo RUTA_JS?>bootstrap.min.js"></script>
  <script type="text/javascript" src="<?php echo RUTA_JS?>jquery-ui.min.js"></script>
  <script src="<?php echo RUTA_JS?>jquery.flexslider.js"></script>
  <script type="text/javascript" src="<?php echo RUTA_JS?>index.js"></script>
  </html>
