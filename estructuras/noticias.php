<div class="contenedor_noticias">
  <span class="quienes_somos">Noticias</span>
  <div class="contenedor_feed_noticias">
    <?php
    include_once 'app/MostrarArticulo.inc.php';
    include_once 'app/iArticulos.inc.php';
    include_once 'app/ControlSesion.inc.php';

    $html='';
    $sesion = ControlSesion::sesion_iniciada();
    if($sesion){
      $html .= MostrarArticulo::feed_inicio(3,1);
    }
    else{
      $html .= MostrarArticulo::feed_inicio(3,0);
    
    }

    echo $html;

    ?>
  </div>
</div>
