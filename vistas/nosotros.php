  <?php
if(!isset($datos_individual) && empty($datos_individual)){
  $datos_individual ='';
}

 ?>
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

    <title>Nosotros-Gigena Parker</title>
  </head>
  <body>
    <?php include_once 'estructuras/header.php';?>
    <?php content_generico('pre_content_generico','¿Quiénes Somos?','slider0.jpg',$datos_individual,'img_nosotros');?>
    <div class="contenedor_quienes_somos_nosotros">
      <div class="contenedor_equipo">
        <span class="titulo_trastornos">Equipo
        <div class="contenido_equipo">
          <?php
          include_once 'app/Equipo.inc.php';
          $equipo = new Equipo();
          $integrantes = $equipo->obtener_integrantes();
          $html ='';
          foreach ($integrantes as $integrante) {
            $html .= $integrante->mostrar_integrante();
          }
          echo $html;
           ?>
        </div>

      </div>
    <div class="contenido_quienes_somos_nosotros">
      <p>
      Somos un grupo interdisciplinario de profesionales, avalados por una amplia trayectoria y capacitación. Nos encontramos abocados al abordaje integral de problemáticas conductuales mediante recursos terapéuticos innovadores y programas científicamente aprobados a nivel mundial.
      </br>
      A través de un coordinado trabajo en equipo, desarrollamos programas personalizados e integrales, según la necesidad de cada paciente y su familia, con el objetivo de optimizar la eficacia de nuestro tratamiento.
      </br>
      En todos los casos, nos valemos del máximo respeto, confidencialidad y discreción posibles con las personas asistidas.
      </br>
      El abordaje de la cada problemática se realiza a través de actividades individuales, grupales o familiares, según lo que exija el caso.
      </br>
      Además, desde nuestra fundación ofrecemos programas de asesoramiento integral a empresas con problemáticas relacionadas y efectuamos capacitaciones para profesionales interesados en la temática.
      </br>
      Apostamos por una recuperación integral con una gratificación perdurable y desarrollamos para cada paciente un plan personalizado para lograrlo.
      </p>
    </div>
      <div class="conte_lugares_nosotros">
        <a href="lasvertientes"><img src="<?php echo RUTA_IMG?>logo_vertientes.png" alt=""></a>
      </div>
      <!--<div class="contenedor_trastornos">
        <span class="titulo_trastornos">¿Qué es un Trastorno Adictivo?
        <p>
          Definimos a la adicción como una enfermedad en la que participan factores genéricos y ambientales, y que no se relaciona con la cantidad ni con la frecuencia del consumo, sino con consecuencias adversas que la droga o las conductas adictivas causen en la persona.
        </br>
          Así un trastorno adictivo se define por el uso compulsivo de una sustancia a pesar del derrumbe físico,social, laboral y espiritual asociado directamente al consumo.
        </br>
          Es una enfermedad que si no se trata, inevitablemente termina en daño prematuro por diversas causas.
        </p>
      </div>-->
    </div>
    <div class="contenedor_ofrecemos">
      <span class="titulo_ofrecemos">¿Qué ofrecemos?
      <ul class="lista_ofrecemos">
        <li><i class="fa fa-circle" style="color:#3399CC;  margin-right:10px;  font-size:18px;"aria-hidden="true"></i>Evaluación integral del paciente y su familia, para decidir el tratamiento a implementar.</li>
        <li><i class="fa fa-circle" style="color:#3399CC;  margin-right:10px;  font-size:18px;"aria-hidden="true"></i>Test diagnósticos específicos. Planificación del tratamiento.</li>
        <li><i class="fa fa-circle" style="color:#3399CC;  margin-right:10px;  font-size:18px;"aria-hidden="true"></i>Desintoxicación médicamente asistida.</li>
        <li><i class="fa fa-circle" style="color:#3399CC;  margin-right:10px;  font-size:18px;"aria-hidden="true"></i>Seguimiento de la internación a corto y mediano plazo (ver <a href="lasvertientes">Programa Residencial LasVertientes</a>).</li>
        <li><i class="fa fa-circle" style="color:#3399CC;  margin-right:10px;  font-size:18px;"aria-hidden="true"></i>Tratamientos ambulatorios estructurados diurnos.</li>
        <li><i class="fa fa-circle" style="color:#3399CC;  margin-right:10px;  font-size:18px;"aria-hidden="true"></i>Programa de Tratamiento sin Demanda, brindamos asesoramientos para aquellos casos en los que no exista motivación por parte de la persona afectada para realizar el tratamiento y acuda la familia.</li>
        <li><i class="fa fa-circle" style="color:#3399CC;  margin-right:10px;  font-size:18px;"aria-hidden="true"></i>Entrevistas motivacionales previas para aquellos pacientes que no deciden a ingresar a un tratamiento que requiera abstinencia total.</li>
        <li><i class="fa fa-circle" style="color:#3399CC;  margin-right:10px;  font-size:18px;"aria-hidden="true"></i>Tratamiento Integrativo del Paciente Dual (trastornos adictivos y psiquiátricos) cuando se determine que el programa pueda ser beneficioso según el perfil del paciente y la familia.</li>
        <li><i class="fa fa-circle" style="color:#3399CC;  margin-right:10px;  font-size:18px;"aria-hidden="true"></i>Monitoreo de drogas en orina.</li>
        <li><i class="fa fa-circle" style="color:#3399CC;  margin-right:10px;  font-size:18px;"aria-hidden="true"></i>Tratamientos especiales.</li>
      </ul>
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
