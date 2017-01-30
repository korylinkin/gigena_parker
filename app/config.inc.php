<?php
//info base de datos
define('NOMBRE_SERVIDOR','mysql.hostinger.es');
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
