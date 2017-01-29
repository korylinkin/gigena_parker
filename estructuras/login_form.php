
<div class="cont_login col-xs-12 col-md-4 col-md-offset-4">
         <header>
           <a href="<?php echo INDEX_URL;?>"><img class="img-responsive center-block"src="<?php echo RUTA_IMG;?>logo2.png" alt="No se pudo mostrar img."></a>
          </header>
         <form class="login" action="login" method="post">
            <div class="form-group">
              <input type="text" id="correo" class="campos_login " name="correo" placeholder="Correo">
              <input type="password" class="campos_login" name="contra" placeholder="Contraseña">
            </div>
           <button type="submit" name="enviar" id="btn_login" class="col-xs-12 col-md-6 btn entrar">Blogear</button>
           <!---->
           <button type="button" name="registro" id="btn_registro" class="col-xs-12 col-md-6  btn entrar registro">Registrarse</button>

           <div class=" conte_recu col-md-7 col-md-offset-3" ><a class="recu_contra" href="#">Olvide mi contraseña</a>
            </div>
          </form>
         <div id="info" >
          </div>
           </div>
