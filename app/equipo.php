<?php

 include_once 'app/Equipo.inc.php';

$imagen='';
if (isset($_POST) && !empty($_POST)){
  if (isset($_POST['enviar']) && !empty($_POST['enviar'])){

    $nombre = $_POST['nombre'];
    $titulo = $_POST['titulo'];
    $contenido = $_POST['contenido'];
    $imagen = $_POST['imagen_perfil'];
    $equipo = new Equipo();
    $guardado = $equipo->guardar_integrante($nombre,$titulo,$contenido,$imagen);
    $imagen = $equipo->obtener_img_perfil();
    if($guardado){
      echo 'Se guardo con exito';
    }
    else{
      echo 'Hubo algun error';
    }

  }
}
else{
  RedireccionUrl::redirigir(INDEX_URL);
}
?>
<style media="screen">

  input,textarea,label{
    clear: both;
    display: block;
    float: left;
  }
  form{
    display: block;
    float: left;
    width: 40%;
  }

  .imagen_perfil_integrante{
   width: 100px;
   height: 100px;
   background-size: cover;
   background-position: center;
   display: block;
   border-radius: 50px;
   border:1px solid red;
  }

</style>
<div class="">
    <div class="imagen_perfil_integrante" style="background-image: url('<?php echo $imagen; ?>');">
    </div>
  <form  action="equipo" method="post">
  <label for="nombre">Nombre</label>
  <input type="text" name="nombre" value="">
  <label for="titulo">Titulo</label>
  <input type="text" name="titulo" value="">
  <label for="contenido">Contenido</label>
  <textarea name="contenido" rows="8" cols="80"></textarea>
  <input type="file" name="imagen_perfil" value="">
  <input type="submit" name="enviar" value="Subir Imagen">
</form>

</div>
