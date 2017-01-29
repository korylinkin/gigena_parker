<?php 
//aca puedo derivar 2 cosas :
//por un lado el login. y por otro lado el registro
include_once 'app/config.inc.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Error 404</title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" type="text/css" href="<?php echo RUTA_CSS?>bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo RUTA_CSS?>404.css">
</head>
<body>
<header>
	<div class="container">
		<div class="cont_titulo">bootstrap.min y un archivo css agregados,jquery-ui,jquery,bootstrap y otro extra</div>
		<h1>Pagina ERROR 404 con urls amigables!!</h1>
	</div>
</header>
</body>
<script type="text/javascript" src="<?php echo RUTA_JS?>jquery.min.js"></script>
<script type="text/javascript" src="<?php echo RUTA_JS?>bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo RUTA_JS?>jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo RUTA_JS?>index.js"></script>
</html>
