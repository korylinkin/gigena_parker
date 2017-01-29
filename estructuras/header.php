<?php
$url_img_logo= RUTA_IMG.'logo_gigena.png';
$pre_url='';
if(isset($datos_individual)&&!empty($datos_individual)){
$url_img_logo= RUTA_IMG.'logo_gigena.png';
$pre_url ='../';
}
?>
<header >
    <span class="tipo_logo"><a href="<?php echo SERVIDOR; ?>"><img src="<?php echo $url_img_logo ?>" alt="logo"></a><a class="txt_logo_gigena" href="<?php echo SERVIDOR; ?>">CentroGigenaParker</a></span>
    <div class="conte_menu">
      <ul class="menu">
        <li><a class="inicio" href="<?php echo SERVIDOR ?>">Inicio</a></li>
        <li><a href="<?php echo SERVIDOR ?>nosotros">Nosotros</a></li>
        <li><a href="<?php echo SERVIDOR ?>noticias">Noticias</a></li>
        <li><a href="<?php echo SERVIDOR ?>programa">Programas</a></li>
        <li><a href="<?php echo SERVIDOR ?>contacto">Contacto</a></li>
      </ul>

      <?php
      if(isset($_SESSION) && !empty($_SESSION)){
          ?>
          <div class="contenedor_usuario">
            <span>Bienvenido <a id="usuario_admin" href="administrador"> <?php echo $_SESSION['nombre'];?></a></span>
            <p>|</p>
            <a href="administrador/salir" class="salir">Cerrar Sesión</a>
          </div>
        </div>
  <?php
      }

      ?>
    </div>







    <!--<div class="conte_login col-md-6 col-xs-6">
      <a href="login" class="reg" id="login">Entrar</a>
    </div>
    <div class="conte_social">
      <div class="btn_sociales">
          <a href="#"><i class="fa fa-search" aria-hidden="true"></i></a>
          <a href="#"><i class="fa fa-youtube" aria-hidden="true"></i></a>
          <a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
          <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
          <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
          <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
      </div>
    </div>
  </div>
  </div>-->
</header>
