$(function(){

//ejecuciones de codigo



  /*$('.login').keydown(function(e) { por las dudas, pero el evento del enter funca igual.

  var key = e.which;
  if (key == 13){
    enviarForm();
  }

  });
  */
  $(document).on('click','#btn_login',function(e){
  e.preventDefault();
  enviarForm();

  });
  $(document).on('click','#env_registro',function(e){
    e.preventDefault();
    registrar();

  });

  $(document).on('click','#env_validado',function(e){
    e.preventDefault();
    registrar();
  });
  function registrar(){
    $.ajax({
      url:'registrando',
      method:'POST',
      data:$('#msform').serializeArray(),
      success:function(respuesta){
        if(respuesta.trim()=='inicia'){
         window.location='administrador';
        }
        else{
          $('.fondo').html('').html(respuesta);
        }
      }

    });
  }
  function enviarForm(){
    if (!estaVacio()) {
            $.ajax({
            url:'logear',
            method:'POST',
            data:$('.login').serializeArray(),
            success:function(respuesta){
              if(respuesta.trim()=='bien_logeado'){
              window.location ='administrador';
              }
              else{
                $('#info').html(respuesta).addClass('error_login').slideUp(1500,'easeInQuint');
              }
            }

          });
    }
  }








  /////////////////////////////////////////
  //funciones del btn_login registro.

 $(document).on('click','.registro',function(){
   $(this).css('color','white');
   $('.cont_login').slideUp(800,function(){
      $('.fondo').slideDown(1000,'easeOutBounce');
   });
 });

 $(document).on('click','.cerrar',function(){
   $('.fondo').slideUp(1000,'easeInBounce',function(){
     $('.cont_login').slideDown(800);
   });
 });
  /////////////////////////////////////////
 //funciones del registro.
 //jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches

var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches

$(document).on('click','.next',function(){
  if(animating) return false;
  animating = true;

  current_fs = $(this).parent();
  next_fs = $(this).parent().next();

  //activate next step on progressbar using the index of next_fs
  $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
  //show the next fieldset
  next_fs.show();
  //hide the current fieldset with style
  current_fs.animate({opacity: 0}, {
    step: function(now, mx) {
      //as the opacity of current_fs reduces to 0 - stored in "now"
      //1. scale current_fs down to 80%
      scale = 1 - (1 - now) * 0.2;
      //2. bring next_fs from the right(50%)
      left = (now * 50)+"%";
      //3. increase opacity of next_fs to 1 as it moves in
      opacity = 1 - now;
      current_fs.css({
        'transform': 'scale('+scale+')',
        'position': 'absolute'
      });
      next_fs.css({'left': left, 'opacity': opacity});
    },
    duration: 800,
    complete: function(){
      current_fs.hide();
      animating = false;
    },
    //this comes from the custom easing plugin
    easing: 'easeInOutBack'
  });
});


$(document).on('click','.previous',function(){
  if(animating) return false;
  animating = true;

  current_fs = $(this).parent();
  previous_fs = $(this).parent().prev();

  //de-activate current step on progressbar
  $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

  //show the previous fieldset
  previous_fs.show();
  //hide the current fieldset with style
  current_fs.animate({opacity: 0}, {
    step: function(now, mx) {
      //as the opacity of current_fs reduces to 0 - stored in "now"
      //1. scale previous_fs from 80% to 100%
      scale = 0.8 + (1 - now) * 0.2;
      //2. take current_fs to the right(50%) - from 0%
      left = ((1-now) * 50)+"%";
      //3. increase opacity of previous_fs to 1 as it moves in
      opacity = 1 - now;
      current_fs.css({'left': left});
      previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
    },
    duration: 800,
    complete: function(){
      current_fs.hide();
      animating = false;
    },
    //this comes from the custom easing plugin
    easing: 'easeInOutBack'
  });
});


//funciones del login
  function desLogin(){
    $(".regis").slideDown(550,vaciarTodo());
    $(".login").slideUp(500);
    $('#envia').css({'margin-left': '2.8em','padding-left': '30%'}).html('Registrarme');
    }

  function vaciarTodo(){
  $('.campo').val("");
  $('.campo').focus().css({'border':'2px solid #D6DAC2'});
  }

  function estaVacio(){
    var er = 0;
    $('.campos_login').each(function(){
      var texto = $(this).val();
      var campo = $(this);
      if (texto=='')
        {
          er++;
          $(this).focus().css({
              'border':'2px solid #FF3939',
          });
          campos_vacios_login(campo);
        }
    });
    if (er>0){
        return true;
        }
    else {
       return false;
    }
}
//comprobando errores de logeo
function campos_vacios_login(campo_login){
  var texto = campo_login.attr('placeholder');
  if(texto=='Correo'){
    campo_login.after("<div class='error_vacio'><strong>Debes ingresar un "+texto+"</strong></div>");
  }
  else{
    campo_login.after("<div class='error_vacio'><strong>Debes ingresar una "+texto+"</strong></div>");
  }
  $('.error_vacio').slideUp(2000,'easeInQuint',function(){
    $(this).remove();
  });
}

  function resetearCss(){
    $('.campos').each(function(){
      var camp = $(this);
      camp.css({'border':'1px solid #464D56'});
        });
        $('#info').val('');
  }









})
