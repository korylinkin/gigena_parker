<?php
session_start();
include_once '../../../app/Conexion.inc.php';
include_once '../../../app/Articulos.inc.php';
include_once '../../../app/iArticulos.inc.php';
include_once '../../../app/AccionesDeUsuario.inc.php';

$articulos = iArticulos::obtener_x_articulos(10);
if($articulos['exito']){

  $cantidad_articulos = count($articulos['articulos']);
}
else{
  $cantidad_articulos = $articulos['exito'];
}
$articulos_mas_vistos = iArticulos::obtener_mas_vistos(5);
$total_usuarios = AccionesDeUsuario::total_usuarios();
$id_priv = (int)$_SESSION['privilegio'];
$privilegio_sesion = AccionesDeUsuario::obtener_privilegio_id($id_priv)['privilegio'];
date_default_timezone_set('America/Argentina/Buenos_Aires');
 ?>
<div class="resumen_articulos">
  <span class="titulo_administrador">Artículos</span>
  <hr style="border-top:1px solid black;margin-top:5px; margin-bottom:10px;">
  <table>
    <tr>
      <td>Título</td>
      <td>Última Edición</td>
    </tr>
    <?php
    if($cantidad_articulos>0){
      foreach($articulos['articulos'] as $articulo){
          $id = $articulo->obtener_id_articulo();
          $url = $articulo->obtener_url();
          $titulo_articulo = $articulo->resumir_titulo(45);
          echo '<tr>';
          echo '<td style=""><a id="editar_articulo" data-accion="editar" data-url="'.$url.'" data-id="'.$id.'">'.$titulo_articulo.'</a></td>';
          echo '<td>'.$articulo->obtener_fecha_modificacion().'</td>';
          if($privilegio_sesion=='Administrador'){
            echo  '<td><i class="fa fa-pencil" aria-hidden="true"></i><a id="editar_articulo" data-accion="editar" data-url="'.$url.'" data-id="'.$id.'">Editar</a></td>';
            echo  '<td><i class="fa fa-trash-o" aria-hidden="true"></i><a id="editar_articulo" data-accion="borrar" data-id="'.$id.'">Borrar</a></td>';
          }
          elseif ($privilegio_sesion=='Editor') {
          echo  '<td><i class="fa fa-pencil" aria-hidden="true"></i><a id="editar_articulo" data-accion="editar" data-url="'.$url.'" data-id="'.$id.'">Editar</a></td>';

          }

          echo '</tr>';

        }
    }else{
      echo '<tr><td><span> No hay articulos en este momento</span></td></tr>';
    }
    ?>

  </table>

</div>
<div class="contenedor_estadisticas">
  <div class="estadisticas">
    <span class="titulo_administrador">Estadísticas</span>
    <hr style="border-top:1px solid black;margin-top:5px; margin-bottom:10px;">
    <div class="contenedor_datos">
    <span><i style="margin-right:5px;font-size:16px;" class="fa fa-eye" aria-hidden="true"></i>Visitas: </span></br>
    <span><i style="margin-right:5px;font-size:16px;" class="fa fa-user-circle-o" aria-hidden="true"></i>Usuarios:<?php echo $total_usuarios; ?> </span>
    </div>
  </div>
  <div class="lo_mas_visto">
    <span class="titulo_administrador">Más visto</span>
    <hr style="border-top:1px solid black;margin-top:5px; margin-bottom:10px;">
    <div class="contenedor_datos">
      <?php
      if(count($articulos_mas_vistos)){
        foreach ($articulos_mas_vistos as $articulo) {
          echo '<span class="contador_visitas">'.$articulo->obtener_visitas().'</span><span>'.$articulo->resumir_titulo(33).'</span></br>';
        }
      }
       ?>
    </div>
  </div>
</div>
