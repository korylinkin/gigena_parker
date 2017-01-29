<?php
include_once '../../../app/Conexion.inc.php';
include_once '../../../app/Usuario.inc.php';
include_once '../../../app/AccionesDeUsuario.inc.php';
session_start();


Conexion::abrir_conexion();
$conexion = Conexion::obtener_conexion();
$usuarios = AccionesDeUsuario::obtenerTodos($conexion);
Conexion::cerrar_conexion();
$privilegios = obtener_privilegios();
$id_priv = (int)$_SESSION['privilegio'];
$id_sesion = (int)$_SESSION['id_usuario'];
$privilegio_sesion = AccionesDeUsuario::obtener_privilegio_id($id_priv);
$cantidad_usuarios = count($usuarios);
date_default_timezone_set('America/Argentina/Buenos_Aires');


?>
<div class="resumen_articulos">
<span class="titulo_administrador">Lista de Usuarios</span>
<hr style="border-top:1px solid black;margin-top:5px; margin-bottom:10px;">
<table>
  <tr id="cabecera_tabla">
    <td>Profesional</td>
    <td>
      <select id="filtro_usuarios" >
      <option value="0">Todos</option>
      <?php
      foreach ($privilegios as $privilegio) {
        echo '<option value="'.$privilegio['id_priv'].'">'.$privilegio['privilegio'].'</option>';
      }
       ?>
    </select>
  </td>
  </tr>
  <?php
  if($cantidad_usuarios>0){
    foreach ($usuarios as $usuario) {
      $id = $usuario->obtener_id();
      $id_privilegio = (int)$usuario->obtener_privilegio();
      $privilegio = $usuario->obtener_privilegio_nombre()['privilegio'];
      echo '<tr class="fila_usuario"  data-id="'.$id.'">';
      echo '<td style=""><a  id="acciones_usuario" data-accion="editar_usuario" data-privilegio="'.$id_privilegio.'" data-id="'.$id.'">'.$usuario->obtener_apellido().' ,'.$usuario->obtener_nombre().'</a></td>';
      echo '<td>'.$privilegio.'</td>';

      if($privilegio_sesion['privilegio']=='Administrador'){
        if($id_sesion==$id){
          echo  '<td><i class="fa fa-pencil" aria-hidden="true"></i><a id="acciones_usuario" data-privilegio="'.$id_privilegio.'" data-accion="editar_usuario"  data-id="'.$id.'">Editar</a></td>';

        }
        else{
          echo  '<td><i class="fa fa-pencil" aria-hidden="true"></i><a id="acciones_usuario" data-privilegio="'.$id_privilegio.'" data-accion="editar_usuario"  data-id="'.$id.'">Editar</a></td>';
          echo  '<td><i class="fa fa-trash-o" aria-hidden="true"></i><a id="acciones_usuario" data-privilegio="'.$id_privilegio.'" data-accion="borrar_usuario" data-id="'.$id.'">Borrar</a></td>';
        }
      }
      elseif ($privilegio_sesion['privilegio']=='Editor') {
        echo  '<td><i class="fa fa-pencil" aria-hidden="true"></i><a id="acciones_usuario" data-privilegio="'.$id_privilegio.'" data-accion="editar_usuario"  data-id="'.$id.'">Editar</a></td>';

      }
      echo '</tr>';

    }



  }else{
    echo '<tr><td><span> No hay usuarios registrados</span></td></tr>';
  }
  ?>




</table>
</div>
<?php
if($privilegio_sesion['privilegio']=='Administrador'|| $privilegio_sesion['privilegio']=='Editor'){
  ?>
  <div class="contenedor_estadisticas">
    <div class="info_usuarios"></div>
    <span class="titulo_administrador">Agregar Usuario</span>
    <hr style="border-top:1px solid black;margin-top:5px; margin-bottom:10px;">
    <form id="agregar_usuario_nuevo" action="registrando" method="post">
      <label class=""for="nombre_nuevo">Nombre</label>
      <input class="campo_registro" type="text" name="nombre" value="">
      <label for="apellido_nuevo">Apellido</label>
      <input class="campo_registro" type="text" name="apellido" value="">
      <label for="email_nuevo">Email</label>
      <input class="campo_registro" type="email" name="email" value="">
      <label for="contrasena_nuevo">Contraseña</label>
      <input class="campo_registro" type="password" name="contrasena" value="">
      <label for="contrasenad_nuevo">Repetir contraseña</label>
      <input class="campo_registro" type="password" name="contrasena_check" value="">
      <label id="privilegio_label"for="privilegios_nuevo">Privilgio</label>
      <select id="privilegios" name="privilegios_nuevo">
      <?php
        foreach ($privilegios as $privilegio) {
          echo '<option value="'.$privilegio['id_priv'].'">'.$privilegio['privilegio'].'</option>';
        }
       ?>
      </select>
      <input type="button" id="limpiar_form" class="btn_registro limpiar" name="limpiar" value="Limpiar">
      <input type="submit" id="btn_registrar_usuario" class="btn_registro agregar" name="registrar_usuario_nuevo"  value="Agregar">
    </form>
  </div>
  <?php
}
elseif ($privilegio_sesion=='Cliente') {
  echo 'Comete una garcha cliente';
}

 ?>



<?php
function obtener_privilegios(){
 Conexion::abrir_conexion();
 $conexion = Conexion::obtener_conexion();
 $sql ="SELECT * FROM privilegios ";
 $ejecutar =$conexion->prepare($sql);
 $resultado = $ejecutar->execute();
 if($resultado){
   $todo = $ejecutar->fetchAll();
   if (count($todo)) {

     return $todo;

   }
   else{
     return false;
   }
 }
 Conexion::cerrar_conexion();
}
?>
