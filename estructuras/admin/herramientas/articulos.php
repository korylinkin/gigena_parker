<?php
//aca toda la parte php para esta web.
//include_once RUTA_CONFIG;
//
include_once '../../../app/config.inc.php';
include_once '../../../'.RUTA_FUNCIONES_APP.'ArticulosEstructura.inc.php';
$estructura_articulos = new ArticulosEstructura();
$html_final = $estructura_articulos->obtener_html_final();

echo $html_final;

?>
<script type="text/javascript" src="js/funciones/articulos.js">
</script>
