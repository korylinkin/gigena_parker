$(function(){


  $(document).on('click','.imagen_perfil_integrante',function(e){
   var nombre = $(this)[0].nextSibling.innerText;
   var contenido = $(this)[0].nextSibling.nextSibling.defaultValue;
    var titulo = $(this)[0].nextSibling.nextSibling.nextSibling.defaultValue;
   var integrante = {nombre:nombre,titulo:titulo,contenido:contenido};
   var contenedor  = '<div class="modal_integrante_contenedor"><a class="btn_modal_cerrar_integrante"></a>';
   var nombre = '<span style="font-weight:bold;">'+integrante.nombre+'</span></br>';
   var titulo = '<span style="font-size:14px;">'+integrante.titulo+'</span></br>';
   var contenido = '<p style="font-size:15px; font-family:"Helvetica";>'+integrante.contenido+'</p>';
   var cerrar_contenedor= '</div>';
   var modal = contenedor+nombre+titulo+contenido+cerrar_contenedor;
   $('.modal_integrante_contenedor').slideUp(100,function(){$(this).html('');});
   $('.contenedor_equipo').append(modal);
   var estilos = {marginLeft:'10%'};
   $('.modal_integrante_contenedor').css(estilos).slideDown(500,function(){
     $('.btn_modal_cerrar_integrante').click(function(){
       $('.modal_integrante_contenedor').slideUp(500,function(){
         $(this).remove();
       });
     });
   });


  });
$(document).on('click','#archivo_pdf',function(e){
  e.stopPropagation();
 e.preventDefault();

});
$(document).on('click','.img_galeria_articulo',function(){

$('.contenedor_zoom_imagen').remove();
var id = $(this).attr('id');
if(id!='archivo_pdf'){
  var style_background = $(this).attr('style');
  var contenedor_zoom = '<div class="contenedor_zoom_imagen">';
  var anterior = '<div class="btn_anterior_zoom"></div>';
  var conte_img = '<div class="contenedor_imagen">';
  var btn_cerrar_zoom='<div class="btn_cerrar_zoom"><span style="color:white;">Cerrar</span></div>';
  var cerrar_conte_img = '</div>';
  var imagen = '<div class="imagen_zoom" style="'+style_background+'"></div>';
  var siguiente = '<div class="btn_siguiente_zoom">'+btn_cerrar_zoom+'</div>';
  var cerrar_contenedor = '</div>';
  var html = contenedor_zoom+btn_cerrar_zoom+conte_img+imagen+cerrar_conte_img+cerrar_contenedor;
  $('.contenedor_preview').after(html);//aca estaria displonible el contenedor zoom
  $('.imagen_zoom').fadeIn(350,function(){
    $("html,body").animate({ scrollTop: 0 }, "slow");

  });
  $(document).on('click','.btn_cerrar_zoom',function(e){
    e.stopPropagation();
    var caja_zoom = $(this).parent();

    caja_zoom.remove();

  });
}
else{
  //aca se descargaria el pdf asique no tiene que pasar nada.. pasa limpio
}


$(document).on('click','.btn_siguiente_zoom',function(){

});
$(document).on('click','.btn_anterior_zoom',function(){
  c
});
});

  $(document).on('click','#btn_acceso',function(e){
    e.preventDefault();
    console.log(e);
    $.ajax({
      url:'administrador/datos/sesion',
      method:'POST',
      dataType:'JSON',
      data:{accion:'sesion'},
      success:function(datos){
        var exito = datos.exito;
        if(exito){
          window.location="administrador";
        }else{
          $('.contenedor_mascara').slideDown(700);
        }
      }


    }).fail( function( jqXHR, textStatus, errorThrown ) {
      console.log(jqXHR.responseText);
      console.log(textStatus);
      console.log(errorThrown);
      });


  });
  $(document).on('click','a#btn_ver_mas',function(e){

    var id_categoria = $(this).data('categoria');
    var ultimo = $(this).data('ultimo');
    var feed_inicio = $(this).data('feed');
    var especial= $(this).data('especial');

    var datos ={accion:'obtener_noticias_feed',id_categoria:id_categoria,index:ultimo,feed:feed_inicio,especial:especial};
    var btn = $(this);
    var contenedor_feed = '';

    if(feed_inicio === 1){
      contenedor_feed='.contenedor_feed_noticias';
    }
    else{
      contenedor_feed='.contenedor_articulos';
    }

    $.ajax({
      url:'datos/usuarios/contenido_feed',
      method:'POST',
      dataType:'JSON',
      data:datos,
      success:function(datos){

        $('.contenedor_ver_mas').hide();
        if(datos.exito){

          $(contenedor_feed).after(datos.feed);
        }

      }

    }).fail( function( jqXHR, textStatus, errorThrown ) {
      console.log(jqXHR.responseText);
      console.log(textStatus);
      console.log(errorThrown);
    });
  });

  $('#cerrar_login_modal').click(function(e){
    $('.info_login').html('');
    $('.contenedor_mascara').slideUp(500,function(){
    });
  });


  $('#login_gigena').submit(function(e){
      e.preventDefault();
      $('.info_login').html('');
      $.ajax({
        url:'logear',
        method:'POST',
        dataType:'JSON',
        data: $(this).serializeArray(),
        success:function(data){
          var exito = data.exito;
          var respuesta = data.respuesta;
          var redireccion = data.redireccion;
          if(exito){
            $('.campo_login_modal').css('border','2px solid green');
            window.location = redireccion;
          }
          else{
            $('.info_login').text(respuesta);
          }

        }


      }).fail( function( jqXHR, textStatus, errorThrown ) {
        console.log(jqXHR.responseText);
        console.log(textStatus);
        console.log(errorThrown);
        });
      });


  })
