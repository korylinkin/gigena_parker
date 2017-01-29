<?php 
include_once 'app/ValidacionRegistro.inc.php';
include_once 'app/Conexion.inc.php';
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$sexo = $_POST['sexo'];
$email = $_POST['email'];
$clave = $_POST['pass'];
$cclave=$_POST['cpass'];
Conexion::abrir_conexion();
$validador = new ValidacionRegistro($nombre,$apellido,$sexo,$email,$clave,$cclave,Conexion::obtener_conexion());
Conexion::cerrar_conexion();
?>
  <!-- multistep form -->
<form id="msform" method="post" action="login">
  <!-- progressbar -->
  <ul id="progressbar">
    <li class="active"></li>
    <li ></li>
    <li ></li>     
  </ul>
  <!-- fieldsets -->
  <fieldset class="active">
   <div class="cerrar"></div>
    <h2 class="fs-title">Registrarse perra</h2>
    <h3 class="fs-subtitle">Datos Personales</h3>
    <input type="text" name="nombre" placeholder="Nombre" <?php $validador->mostrar_nombre(); ?>  />
    <?php echo $validador->mostrar_error_nombre(); ?>
    <input type="text" name="apellido" placeholder="Apellido" <?php $validador->mostrar_apellido();?>  />
    <?php echo $validador->mostrar_error_apellido(); ?>    
    <input type="button" id="prime" name="siguiente" class="next" value="Siguiente" />
  </fieldset>
  
  <fieldset >
  <div class="cerrar"></div>
    <h2 class="fs-title">Registrarse</h2>
    <h3 class="fs-subtitle">Datos Personales</h3>    
    <select name="sexo" id="sexo">
      <option value="masculino">Masculino</option>
      <option value="femenino">Femenino</option>
      <option value="otro">Otro</option>      
    </select>
    <input type="button" name="previous" class="previous action-button" value="Anterior" />
    <input type="button" name="siguiente" class="next action-button" value="Siguiente" />    
  </fieldset>
  
  
   <fieldset >
  <div class="cerrar"> </div>
    <h2 class="fs-title">Registrarse</h2>
    <h3 class="fs-subtitle">Contacto</h3>
    <input type="text" name="email" placeholder="Email" <?php $validador->mostrar_email();?>/>
    <?php echo $validador->mostrar_error_email(); ?>
    <input type="password" name="pass" placeholder="Contraseña" />
    <?php echo $validador->mostrar_error_clave(); ?>
    <input type="password" name="cpass" placeholder="Confirmar Contraseña" />
    <?php echo $validador->mostrar_error_clave2(); ?>
    <input type="button" name="previous" class="previous action-button" value="Anterior" />
    <input type="button" id="env_validado" name="reg_enviado" class="action-button" value="Registrarse" />
  </fieldset> 

  
</form>
