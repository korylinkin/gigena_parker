<?php

$pre_url='';
if(isset($datos_individual)&&!empty($datos_individual)){
$pre_url ='../';
}

 ?>
<footer>
  <span class="tipo_logo_footer"><a href="<?php echo INDEX_URL; ?>">Centro Gigena Parker</a></span>
  <div class="conte_menu_footer">
    <ul class="menu_footer">
      <li><a href="<?php echo INDEX_URL; ?>">Inicio</a></li>
      <li><a href="<?php echo $pre_url ?>nosotros">Nosotros</a></li>
      <li><a href="<?php echo $pre_url ?>noticias">Noticias</a></li>
      <li><a href="<?php echo $pre_url ?>programa">Programa</a></li>
      <li><a href="<?php echo $pre_url ?>contacto">Contacto</a></li>
    </ul>
  </div>
  <div class="info_footer">
    <p >
      <a  href="#">consultas@gigenaparker.com</a></br>
      <span>Fraguerio 1157 - Barrio Cofico, Córdoba Argentina</span></br>
      <span>+54 0351 4268998</span>
  </p>
  </div>
</footer>
