<div class="contenedor_admin">
  <div class="botones">
    <button type="button"  id="btn_resumen" class= "opcion publicar" name="publicar">Resumen</button>
    <div class="linea_vertical"></div>
    <?php
    include_once 'app/Conexion.inc.php';
    include_once 'app/AccionesDeUsuario.inc.php';
    $id_priv = (int)$_SESSION['privilegio'];
    $privilegio_sesion = AccionesDeUsuario::obtener_privilegio_id($id_priv)['privilegio'];
    if ($privilegio_sesion=='Administrador') {
      ?>
      <button type="button" id="btn_subir_articulo" class="opcion atras" name="atras">Subir Articulo</button>
      <div class="linea_vertical"></div>
      <?php
    }
     ?>
    <button type="button" id="btn_usuarios" class="opcion usuarios" name="usuarios">Usuarios</button>
   </div>
</div>
<!-- aca iria el contenido borrar:wrapper,contenedor_herramientas herramienta btn btn-default
<div class="wrapper">
<div class="contenedor_herramientas" id="header">
  <div class="btn-group  " role="group" aria-label="...">
    <button type="button" class="herramienta btn btn-default ">Resumen</button>
    <button type="button" class="herramienta btn btn-default">Articulos</button>
    <button type="button" class="herramienta btn btn-default">Link Rapido</button>
    <button type="button" class="herramienta btn btn-default">Radio</button>
  </div>
</div> !-->





<!--<div id="footer"><button class="btn_admin_menu" name="admin_menu" id="menu_herramientas"><span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span></button>
</div>-->

</div>
