$(function(){
    //si man... funciona.

    $('#salir').click(function(){
      window.location="administrador/salir";
    });

    $('#btn_resumen').click(function(){
      $('#publicar').remove();
      var path_estructura = 'estructuras/admin/herramientas/resumen.php';
      $('.contenedor_administrativo').html('').load(path_estructura);
    });
    $('#btn_usuarios').click(function(){
      $('#publicar').remove();
      var path_estructura = 'estructuras/admin/herramientas/usuarios.php';
      $('.contenedor_administrativo').html('').load(path_estructura);

    });
    $('.contenedor_administrativo').ready(function(){
      var path_estructura = 'estructuras/admin/herramientas/resumen.php';
      $('.contenedor_administrativo').html('').load(path_estructura);
    });

    $(document).on('change','#filtro_usuarios',function(){
        var id_filtro = parseInt($(this).val());
        var datos = {accion:'filtrar',id:id_filtro};

        $.ajax({
          url:'administrador/usuario/filtrado',
          method:'POST',
          data:datos,
          dataType:'JSON',
          success:function(data){
            $('.fila_usuario').remove();
            var usuarios_filtrados = data['usuarios_filtrados'][0];
            var privilegio_sesion = parseInt(data['datos_sesion']['privilegio']);
            var id_usuario_sesion = parseInt(data['datos_sesion']['id_usuario']);

            var cerrar_conte = '</tr>';
              $(usuarios_filtrados).each(function(index){

                var privilegio_usuario = usuarios_filtrados[index]['privilegio'];

                var id_usuario = usuarios_filtrados[index]['id'];
                var apellido = usuarios_filtrados[index]['apellido'];
                var nombre = usuarios_filtrados[index]['nombre'];
                var id_privilegio = parseInt(usuarios_filtrados[index]['id_priv']);
                var herramientas = '';
                var conte ='<tr class="fila_usuario"  data-id="'+id_usuario+'">';
                var nombre ='<td style=""><a id="nombres_usuario "href="#">'+apellido+' ,'+nombre+'</a></td>';
                var privilegio= '<td>'+privilegio_usuario+'</td>';

                if(13 == privilegio_sesion){
                 herramientas += '<td><i class="fa fa-pencil" aria-hidden="true"></i><a id="acciones_usuario" data-privilegio="'+id_privilegio+'" data-accion="editar_usuario"  data-id="'+id_usuario+'">Editar</a></td>';
                 herramientas +='<td><i class="fa fa-trash-o" aria-hidden="true"></i><a id="acciones_usuario" data-privilegio="'+id_privilegio+'" data-accion="borrar_usuario" data-id="'+id_usuario+'">Borrar</a></td>';

                }
                else if (11==privilegio_sesion){
                  herramientas += '<td><i class="fa fa-pencil" aria-hidden="true"></i><a id="acciones_usuario" data-privilegio="'+id_privilegio+'" data-accion="editar_usuario"  data-id="'+id_usuario+'">Editar</a></td>';

                }
                else {

                }

                $('#cabecera_tabla').after(conte+nombre+privilegio+herramientas+cerrar_conte);

                });





          }
        }).fail( function( jqXHR, textStatus, errorThrown ) {
          console.log(jqXHR.responseText);
          console.log(textStatus);
          console.log(errorThrown);
        });

    });


$(document).on('submit','#agregar_usuario_nuevo',function(e){
e.preventDefault();
var accion_actual = e.delegateTarget.activeElement.value.toLowerCase();
var datos = $(this).serializeArray();
if(accion_actual=='modificar'){
  var accion = 'modificar_usuario';
  var id_i = $('#nombre_usuario_actualizar').attr('data-id');
  $.ajax({
    url:'administrador/editar',
    method:'POST',
    dataType:'JSON',
    data:{accion:accion,usuario:id_i,datos:datos},
    success:function(data){
      if(data.exito){
        var path_estructura = 'estructuras/admin/herramientas/usuarios.php';
        var cartel_informe = '<div class="publicado_exito">'+data.respuesta+'</div>';
        $('.contenedor_administrativo').html('').load(path_estructura);
        $('.contenedor_administrativo').before(cartel_informe);
        $('.publicado_exito').ready(function(){
          $('.publicado_exito').slideUp(1500,'easeInQuint',function(){
            $(this).remove();
          });
      });
      }
      else{
        alert('error en la consulta');
      }
    }
  }).fail( function( jqXHR, textStatus, errorThrown ) {
    console.log(jqXHR.responseText);
    console.log(textStatus);
    console.log(errorThrown);
  });
}
else{
  $.ajax({
    url:'registrando',
    method:'POST',
    dataType:'JSON',
    data:datos,
    success:function(data){
      var exito = data.exito;
      var respuesta = data.respuesta;
      if(exito){

        $('.info_usuarios').show().text(respuesta).slideUp(1400,'easeInQuint',function(){
          $('#btn_usuarios').click();

        });

      }
      else{
        $('.info_usuarios').show().addClass('error_usuario').text(respuesta).slideUp(3500,'easeInQuint',function(){
          $(this).removeClass('error_usuario');
        });
      }
    }

  }).fail( function( jqXHR, textStatus, errorThrown ) {
    console.log(jqXHR.responseText);
    console.log(textStatus);
    console.log(errorThrown);
  });
}

});


    $(document).on('click','#editar_articulo',function(e){
      e.preventDefault();
      var id = $(this).data('id');
      var accion = $(this).data('accion');
      var url_articulo = $(this).data('url');

        if($.isNumeric(id)){
          var datos = {'id':id,'accion':accion};
            $.ajax({
              url:'administrador/editar',
              method:'POST',
              dataType:'JSON',
              data: datos,
              success:function(data){
                  //aca habria que simular apretar el click.
                  if(data.resultado=='borrado_completo'){
                    $('.contenedor_administrativo').html('');
                    $('#btn_resumen').click();
                  }
                  else{

                    var html_modal ='<div class="contenedor_modificar"><form id="modificar_articulo" class="modal_modificar" action="administrador/editar" method="post"><input class="campo_modal" id="titulo_modal" type="text" name="titulo" value=""><div id="contenido_modal"></div><textarea class="form_texto" id="texto_modificado"></textarea><input id="id_edicion" type="hidden" value=""><input id="url_edicion" type="hidden" value=""><div class="info_modificado"></div><input class="btn_modal" type="button" id="cerrar_modal" name="cerrar" value="Cerrar"><input class="btn_modal" type="submit" id="modificar_modal" name="modificar" value="Modificar"></form></div>';
                    $('.resumen_articulos').append(html_modal);
                    $('#titulo_modal').val(data.titulo);
                    $('#contenido_modal').html(data.texto);
                    $('#id_edicion').attr('value',id);
                    $('#url_edicion').attr('value',url_articulo);
                    var toolbarOptions = [
                    ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
                    ['blockquote'],               // custom button values
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'indent': '-1'}, { 'indent': '+1' }],         // outdent/indent
                    ['link'],
                    [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
                    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                    [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
                    [{ 'font': [] }],
                    [{ 'align': [] }],
                    ['clean']                                         // remove formatting button
                    ];
                    var quill = new Quill('#contenido_modal', {
                    modules: {
                      toolbar: toolbarOptions
                    },
                    theme: 'snow'
                  });
                  $('.ql-toolbar.ql-snow').css({backgroundColor:"white",marginTop:"55px"});
                  $('.ql-editor').css({backgroundColor:"white",height:"180px"});
                    $('.contenedor_modificar').slideDown(600);
                  }

              }
            }).fail( function( jqXHR, textStatus, errorThrown ) {
              console.log(jqXHR.responseText);
              console.log(textStatus);
              console.log(errorThrown);
            });
          }






    });
    $(document).on('change','#privilegios',function(e){
      var priv_form = parseInt($(this).val());
      var priv_selec = $(this);
      $.ajax({
        url: 'administrador/datos/sesion',
        method:'POST',
        dataType:'JSON',
        data:{accion:'datos'},
        success:function(datos_sesion){
          var priv_sesion = parseInt(datos_sesion['sesion'].privilegio);
          if(priv_form>priv_sesion){
            $(priv_selec).val(priv_sesion);
            $('.info_usuarios').show().addClass('error_usuario').text('No puedes otorgar un privilegio mayor al tuyo').slideUp(2500,'easeInQuint',function(){
              $(this).removeClass('error_usuario');
            });
          }

        }
      });

    });
    $(document).on('click','#acciones_usuario',function(e){
      e.preventDefault();
      var id_usuario = parseInt($(this).data('id'));
      var accion_actual = $(this).data('accion');
      var usuario_privilegio = parseInt($(this).data('privilegio'));
      var sesion ='';
        $.ajax({
          url: 'administrador/datos/sesion',
          method:'POST',
          dataType:'JSON',
          data:{accion:'datos'},
          success:function(datos_sesion){

            if(datos_sesion.exito){
              var privilegio_sesion = datos_sesion['sesion'].privilegio;
              if(usuario_privilegio<= privilegio_sesion){
                if(accion_actual=='editar_usuario'){

                  $('#btn_registrar_usuario').val('Modificar');
                  $('#limpiar_form').val('Cancelar');
                  $('.contenedor_estadisticas>span.titulo_administrador').text('Modificar Usuario');
                  var datos ={usuario:id_usuario,accion:accion_actual,sesion:datos_sesion.sesion,consulta:'obtener_usuario'};
                  $.ajax({
                    url:'administrador/editar',
                    method:'POST',
                    dataType:'JSON',
                    data:datos,
                    success:function(data){
                      if(data.exito){
                        var form_usuario = $('#agregar_usuario_nuevo');
                        var form_seria = form_usuario.serializeArray();
                        var id_sesion = parseInt(datos_sesion['sesion'].id_usuario);
                        var id_usuario = parseInt(data['usuario'].id);

                        for (var i = 0; i < form_seria.length; i++) {

                          if(form_seria[i]['name']=='nombre'){
                            form_seria[i]['value'] = data['usuario'].nombre;
                            $(form_usuario[0][i]).attr('data-id',id_usuario);
                            $(form_usuario[0][i]).attr('id','nombre_usuario_actualizar');
                          }
                          if(form_seria[i]['name']=='apellido'){
                            form_seria[i]['value'] = data['usuario'].apellido;

                          }
                          if(form_seria[i]['name']=='email'){
                            form_seria[i]['value'] = data['usuario'].email;
                          }
                          if(form_seria[i]['name']=='contrasena'){

                          }
                          if(form_seria[i]['name']=='contrasena_check'){

                          }
                          if(form_seria[i]['name']=='privilegios_nuevo'){

                            form_seria[i]['value'] = data['usuario'].privilegio;
                            $(form_usuario[0][i]).val(form_seria[i]['value']);

                          }

                          var name = $(form_usuario)[0][i].name;
                          if(name==form_seria[i]['name']){

                            $(form_usuario[0][i]).val(form_seria[i]['value']);

                          }

                        }//termina el for


                      }


                    }
                  }).fail( function( jqXHR, textStatus, errorThrown ) {
                    console.log(jqXHR.responseText);
                    console.log(textStatus);
                    console.log(errorThrown);
                    });
                }
                else{
                  var datos = {usuario:id_usuario,accion:accion_actual,sesion:datos_sesion.sesion};
                  $.ajax({
                    url:'administrador/editar',
                    method:'POST',
                    dataType:'JSON',
                    data:datos,
                    success:function(data){
                      if(data.exito && data.accion=='borrar_usuario'){

                        var path_estructura = 'estructuras/admin/herramientas/usuarios.php';
                        var cartel_informe = '<div class="publicado_exito">'+data.respuesta+'</div>';
                        $('.contenedor_administrativo').html('').load(path_estructura);
                        $('.contenedor_administrativo').before(cartel_informe);
                        $('.publicado_exito').ready(function(){
                          $('.publicado_exito').slideUp(1500,'easeInQuint',function(){
                            $(this).remove();
                          });
                      });
                    }
                  }
                  }).fail( function( jqXHR, textStatus, errorThrown ) {
                    console.log(jqXHR.responseText);
                    console.log(textStatus);
                    console.log(errorThrown);
                  });
                }
              }else{
                //aca se intenta editar un privilegio mas alto
                $('.info_usuarios').show().addClass('error_usuario').text('No tienes los privilegios necesarios para editar a este usuario').slideUp(2500,'easeInQuint',function(){
                  $(this).removeClass('error_usuario');
                });
              }

            }
            else{
              //aca exito = false
            }
          }
        }).fail( function( jqXHR, textStatus, errorThrown ) {
          console.log(jqXHR.responseText);
          console.log(textStatus);
          console.log(errorThrown);
        });




  });

    $(document).on('click','#limpiar_form',function(e){
        e.preventDefault();
        var txt = $(this).val().toLowerCase();
        var form_padre = $(this)[0].form;
        if(txt=='cancelar'){

          $('#btn_registrar_usuario').val('Agregar');
          $('#limpiar_form').val('Limpiar');
          $('.contenedor_estadisticas>span.titulo_administrador').text('Agregar Usuario');
          form_padre.reset();
        }
        if(txt=='limpiar'){
          form_padre.reset();
        }

    });
    $(document).on('click','#modificar_modal',function(e){

      e.preventDefault();
      var titulo_nuevo= $('#titulo_modal').val();
      var id = $('#id_edicion').val();
      var txt_editor = $('.ql-editor').html();
      var txt_area = $('#texto_modificado');
      $(txt_area).val(txt_editor);
      var txt_modificado = $(txt_area).val();

      $.ajax({
        url:'administrador/editar',
        method:'POST',
        dataType:'JSON',
        data:{accion:'crear_url',titulo:titulo_nuevo},
        success:function(url_nueva){
          var url_pack = $('#url_edicion').val();
              url_pack = url_pack.split("/");
          var categoria_url = url_pack[0];
          url_nueva = categoria_url+'/'+url_nueva;
          var datos = {titulo_mod:titulo_nuevo,accion:'modificar',id:id,texto_nuevo:txt_modificado,url:url_nueva};
          $.ajax({
            url:'administrador/editar',
            method:'POST',
            dataType:'JSON',
            data:datos,
            success:function(data){
              if (data.exito){
                  $('.info_modificado').show().text(data.resultado).slideUp(700,'easeInQuint',function(){
                    $('.contenedor_modificar').slideUp(900,function(){
                      $('#btn_resumen').click();
                    });
                  });

              }
            }

          }).fail( function( jqXHR, textStatus, errorThrown ) {
            console.log(jqXHR.responseText);
            console.log(textStatus);
            console.log(errorThrown);
          });
        }

      });



    });

    $(document).on('click','#cerrar_modal',function(){
      $('.contenedor_modificar').slideUp(600,function(){
        $(this).remove();
      })
    });

    $(document).on('click','.img_item',function(){
      var url = $(this).attr('src');
      $('.img_principal').attr('src',url);
      $('#portada').attr('value',url);

    });


$('#btn_subir_articulo').click(function(e){

  var path_estructura = 'estructuras/admin/herramientas/articulos.php';
  $('#publicar').remove();
  $('.contenedor_administrativo').html('').load(path_estructura);
  var caja_publicacion = '<div class="caja_herramienta">';
  var caja_publicacion_cerrado = '</div>';
  var input_articulo ='<input form ="articulo_nuevo" id="publicar" type="submit" class="btn_publicar" value="Publicar">';
  var html = caja_publicacion+input_articulo+caja_publicacion_cerrado;
  $('.contenedor_admin').append(html);

});

$(document).on('submit','#articulo_nuevo',function(e){
e.preventDefault();

var txt_editor = $('.ql-editor').html();
var txt_area = $('#contenido_articulo');
$(txt_area).val(txt_editor);

$.ajax({
  url:'administrador/preview',
  method:'POST',
  dataType:'JSON',
  data: $(this).serializeArray(),
  success:function(data){

   var exito= data.exito;
    var resultado = data.resultado;
    var accion = data.accion;

    if(exito){
      var path_estructura = 'estructuras/admin/herramientas/resumen.php';
      var cartel_informe = '<div class="publicado_exito">'+resultado+'</div>';
      $('.contenedor_administrativo').html('').load(path_estructura);
      $('.contenedor_administrativo').before(cartel_informe);
      $('.publicado_exito').ready(function(){
        $('.publicado_exito').slideUp(1500,'easeInQuint',function(){
          $(this).remove();
        });
      });
    }
    else{
      window.location = accion;
    }
  }
}).fail( function( jqXHR, textStatus, errorThrown ) {
  console.log(jqXHR.responseText);
  console.log(textStatus);
  console.log(errorThrown);
});


});

$(document).on('focusout','.titulo_articulo',function(e){
  $('.contenedor_superior').remove('.error_titulo_articulo');
  $.ajax({
    url:'comprobar_titulo',
    method:'POST',
    dataType:'JSON',
    data: $(this).serializeArray(),
    success:function(data){

      if(data.error){
        var error_titulo = '<div class="error_titulo_articulo" >'+data.texto+'</div>';
        $('.contenedor_superior').append(error_titulo);
        $('.error_titulo_articulo').effect('fade',2500,function(e){
          $(this).remove();
        });
      }
    }

  });
});
$(document).on('focusout','#titulo_modal',function(e){

  $('.contenedor_modificar').remove('.error_titulo');
  var titulo_actual = $(this).val();
  $.ajax({
    url:'comprobar_titulo',
    method:'POST',
    dataType:'JSON',
    data: {titulo_articulo:titulo_actual},
    success:function(data){

      if(data.error){
        var error_titulo = '<div class="error_titulo" >'+data.texto+'</div>';
        $('.contenedor_modificar').append(error_titulo);
        $('.error_titulo').effect('fade',2500,function(e){
          $(this).remove();
        });
      }
    }

  });
});


$(document).on('drop','#upload',function(e){
  e.preventDefault();
});



$(document).on('drop','.drop',function(e){

  e.preventDefault();

  $(this).removeClass('drag_over');
  var datos = new FormData();
  var lista_archivos = e.originalEvent.dataTransfer.files;

  for(var i=0; i<lista_archivos.length ;i++){
    datos.append('archivos[]',lista_archivos[i]);
  }

 var fotos_actuales = $('#galeria_articulo').attr('value');
 if(fotos_actuales===undefined){
   fotos_actuales ='';
 }
 datos.append('galera',fotos_actuales);

  $.ajax({
    url:'uploader',
    method:'POST',
    dataType:'JSON',
    data: datos,
    contentType:false,
    cache:false,
    processData:false,
    success:function(data){
      if(data.exito){

        var img_preview = data.previews;
        var galeria_vacia= data.galeria.vacio;
        if(!galeria_vacia){
          var datos_galeria = JSON.stringify(data.galeria.galeria);
          $('#galeria_articulo').attr('value',datos_galeria);

        }
        else{
          var datos_galeria = JSON.stringify(data.galeria.galeria);
          $('#galeria_articulo').attr('value',datos_galeria);
        }
        $('#upload ul').append(img_preview);



        $('.img_preview').mouseenter(function(){
          var btn = $(this);
          var btn_borrar = $(this)[0].nextSibling;
          var estilos = {display: 'block',textDecoration:'none',cursor:'pointer',color:'rgba(#3692cc, 1)'};
          $(btn_borrar).css(estilos);
          $(btn_borrar).mouseenter(function(){
            var estilos = {display: 'block',textDecoration:'none',cursor:'pointer',color:'rgba(#3692cc, 1)'};
            $(btn_borrar).css(estilos);
          });
          $(btn_borrar).mouseleave(function(){
            var estilos = {display:'none'};
            $(btn_borrar).css(estilos);
          });
      });
        $('.img_preview').mouseleave(function(){
          var btn = $(this);
          var btn_borrar = $(this)[0].nextSibling;
          var estilos = {display:'none'};
          $(btn_borrar).css(estilos);
        });

    }
      /*var img_preview = data[0];
      var datos_galeria = data[1];
      var error= data[2];
      if(error==''){
        $('#galeria_articulo').attr('value',datos_galeria);
        $('#upload ul').append(img_preview);
        $('#upload ul').stickMe();
      }*/
    }
  }).fail( function( jqXHR, textStatus, errorThrown ) {
    console.log(jqXHR.responseText);
    console.log(textStatus);
    console.log(errorThrown);
  });

});

$(document).on('click','a.btn_borrar_preview',function(e){

  e.preventDefault();
  e.stopPropagation();
  var contenedor_imagen = $(this)[0].parentNode.parentNode;
  var galeria = JSON.parse($('#galeria_articulo').attr('value'));
  console.log(galeria);
  var nombre_archivo = $(contenedor_imagen)[0].childNodes[1].innerText;
  var index = -1;
  var url_archivo='';
  var filteredObj = galeria.find(function(item, i){
    if(item.includes(nombre_archivo)){
      index = i;
      url_archivo =item;
      galeria.splice(index,1);
      contenedor_imagen.remove();
      return true;
    }
  });

  if(filteredObj){
    $.ajax({
      url: 'administrador/editar',
      method:'POST',
      dataType:'JSON',
      data:{accion:'borrar_archivo',url_archivo:url_archivo},
      success:function(datos){
        var exito = datos.respuesta;
        if(!exito){
          alert('Hubo un error al borrar el archivo');
        }
      }
    }).fail( function( jqXHR, textStatus, errorThrown ){

      console.log(jqXHR.responseText);
      console.log(textStatus);
      console.log(errorThrown);
    });
  }
  var json = JSON.stringify(galeria);
  $('#galeria_articulo').attr('value',json);


});

$(document).on('click','#btn_bold',function(e){

        document.execCommand('bold',false,'');
});

$(document).on('click','#btn_img',function(e){

});

$(document).on('click','.opcion_subida',function(){
var txt= $(this).parent().prevObject[0].className;
if(txt.includes('picture')){
  txt='Arrastrar Imagenes';
}
else{
  txt='Arrastrar Archivos';
}

  $('.drop h4').text(txt);
});


$(document).on('dragover','.drop',function(){
  $(this).addClass('drag_over');
  return false;
});

$(document).on('dragleave','.drop',function(){
  $(this).removeClass('drag_over');
  return false;
});



$(document).on('drop','.texto_editor',function(e){

e.preventDefault();
e.stopPropagation();

var imageUrl = e.originalEvent.dataTransfer.getData('URL');
var imagen = '<img class="img_contenido"src="'+imageUrl+'"/>';


document.execCommand('insertHTML', false, imagen);

/**/
});




$(document).on('click','.texto_editor',function(e){
});









  // Helper function that formats the file sizes
  function formatFileSize(bytes) {
      if (typeof bytes !== 'number') {
          return '';
      }

      if (bytes >= 1000000000) {
          return (bytes / 1000000000).toFixed(2) + ' GB';
      }

      if (bytes >= 1000000) {
          return (bytes / 1000000).toFixed(2) + ' MB';
      }

      return (bytes / 1000).toFixed(2) + ' KB';
  }






















})
