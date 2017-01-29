<?php
include_once 'app/config.inc.php';
include_once 'app/ControlSesion.inc.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Centro Gigena Parker</title><!-- modificado 25/1/17 00:07 acomodado el slide-->
	<meta charset="UTF-8">

  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" type="text/css" href="<?php echo RUTA_CSS?>bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo RUTA_CSS?>index.css">
	<link rel="stylesheet" type="text/css" href="<?php echo RUTA_CSS?>panel_admin.css">
	<link rel="stylesheet" href="<?php echo RUTA_CSS?>flexslider.css" type="text/css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo RUTA_JS?>sticky-header.js"></script>
	<script src="https://use.fontawesome.com/86baab9842.js"></script>
	<script type="text/javascript" charset="utf-8">

  $(window).load(function() {
		$('.slides').show();
    $('.flexslider').flexslider({
    	touch: true,
    	pauseOnAction: false,
    	pauseOnHover: false,
			slideshowSpeed: 4000,
    });
  });
</script>
</head>
<body>
	<?php
	$sesion = ControlSesion::sesion_iniciada();
	if($sesion){
		//aca esta logeado mostrar solo feed noticias privado
		include_once 'estructuras/login_modal.php';
		include_once 'estructuras/header.php';
		include_once 'estructuras/noticias.php';
		include_once 'estructuras/footer.php';
	}
	else{
		//aca se muestra la web normal
		 include_once 'estructuras/login_modal.php';
		 include_once 'estructuras/header.php';
		 include_once 'estructuras/pre_content.php';
		 include_once 'estructuras/quienes_somos.php';
		 include_once 'estructuras/noticias.php';
		 include_once 'estructuras/footer.php';

	}

	 ?>


</body>
<script type="text/javascript" src="<?php echo RUTA_JS?>jquery.min.js"></script>
<script type="text/javascript" src="<?php echo RUTA_JS?>bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo RUTA_JS?>jquery-ui.min.js"></script>
 <script src="<?php echo RUTA_JS?>jquery.flexslider.js"></script>
<script type="text/javascript" src="<?php echo RUTA_JS?>index.js"></script>
</html>
