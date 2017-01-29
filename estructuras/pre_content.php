<?php
$txt_slogan = 'Un Equipo, Un Plan';
$txt_btn = 'Acceso a Miembros';

?>
<!-- <div class="flexslider">
  <div class="informacion_slide">
    <span class="txt_slogan">Un equipo,Un plan</span>
    <button type="button" name="log_in" class="btn_contactar" id="btn_acceso">Acceso a Miembros</button>
  </div>
  <ul class="slides">
    <li>
      <img src="<?php echo RUTA_IMG?>slideshow/slider0.jpg" />
    </li>
    <li>
      <img src="<?php echo RUTA_IMG?>slideshow/slider1.jpg" />
    </li>
    <li>
      <img src="<?php echo RUTA_IMG?>slideshow/slider00.jpg" />
    </li>
  </ul>

</div> -->
<div class="flexslider">
<div class="contenedor_slideshow">
<img class="img_slideshow" src="<?php echo RUTA_IMG?>slideshow/slider0.jpg" alt="Contactanos" />
<div class="mascara_oculta">
</div>
<div class="informacion_slide">
  <span class="txt_slogan"><?php echo $txt_slogan;?></span>
  <button type="button" id="btn_acceso" class="btn_contactar"><?php echo $txt_btn;?></button>
</div>
</div>

</div>



<!-- eliminar clase: logo_web linea_sepadora-->
