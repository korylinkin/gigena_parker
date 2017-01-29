<div class="container fondo "> 
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
    <h2 class="fs-title">Registrarse</h2>
    <h3 class="fs-subtitle">Datos Personales</h3>
    <input type="text" name="nombre" placeholder="Nombre" />
    <input type="text" name="apellido" placeholder="Apellido"/>    
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
    <input type="email" name="email" placeholder="Email" />
    <input type="password" name="pass" placeholder="Contraseña" />
    <input type="password" name="cpass" placeholder="Confirmar Contraseña" />
    <input type="button" name="previous" class="previous action-button" value="Anterior" />
    <input type="submit" id="env_registro" name="reg_enviado" class=" action-button" value="Registrarse" />
  </fieldset>   
</form>
</div>