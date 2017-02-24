<?php
//info base de datos
define('NOMBRE_SERVIDOR','104.131.225.131');
define('NOMBRE_USUARIO','mjuncos');
define('PASSWORD','guadalupe01');
define('NOMBRE_BD','gigena');
//rutas de la web
define('WEB','www.gigenaparker.com.ar/');
define('SERVIDOR','http://'.WEB);

define('INDEX_URL','/');
define('RUTA_APP','app/');

define('RUTA_VERTIENTES','estructuras/vertientes/');
define('RUTA_CONFIG',RUTA_APP.'config.inc.php');
define('RUTA_ESTRUCTURAS_ADMIN','estructuras/admin/');
define('RUTA_FUNCIONES_APP',RUTA_APP.'funciones_app/');
/////carpeta vistas
define('RUTA_VISTA','vistas/');
define('RUTA_INICIO',RUTA_VISTA.'inicio.php');
/////////////////carpeta especial
define('RUTA_VISTA_ESPECIAL',RUTA_VISTA.'especial/');
define('RUTA_LOGIN','login');
define('RUTA_IMG',SERVIDOR.'/imgs/');
define('RUTA_PANELADMIN',RUTA_VISTA.'especial/admin');
define('RUTA_REGISTRO','registro');
/////////////////carpeta articulos
define('RUTA_VISTA_ARTCICULO',RUTA_VISTA.'articulos/');
//recursos
define('RUTA_CSS', SERVIDOR .'css/');
define('RUTA_JS', SERVIDOR .'js/');
define('CSS_FHD','<link rel="stylesheet" type="text/css" media="(min-width:1380px)" href="'.RUTA_CSS.'responsive/responsive_fhd.css">');
define('CSS_HD','<link rel="stylesheet" type="text/css" media="(min-width:1110px) and (max-width:1379px)" href="'.RUTA_CSS.'responsive/responsive_hd.css">');
define('CSS_NOR','<link rel="stylesheet" type="text/css" media="(min-width:830px) and (max-width:1109px)" href="'.RUTA_CSS.'responsive/responsive_nor.css">');
define('CSS_TAB','<link rel="stylesheet" type="text/css" media="(min-width:580px) and (max-width:829px)" href="'.RUTA_CSS.'responsive/responsive_tab.css">');
define('CSS_MOBIL','<link rel="stylesheet" type="text/css" media="(min-width:320px) and (max-width:579px)" href="'.RUTA_CSS.'responsive/responsive_m.css">');
define('IMPORTAR_RESPONSIVE',CSS_FHD.PHP_EOL.CSS_HD.PHP_EOL.CSS_NOR.PHP_EOL.CSS_TAB.PHP_EOL.CSS_MOBIL);