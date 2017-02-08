$(function(){

var ancho = $(window).width();
console.log(ancho);



$(document).ready(function(){
  for (var i = 0; i < $(this)[0].links.length; i++) {
    var btn = $(this)[0].links[i];
    if(btn.className=='activo'){
      btn.click();
      break;
    }
  }
  });

var galeria_imagenes_vertientes;
var index_galeria = 0;
$(document).on('click','.flecha>img',function(e){
var accion = $(this).data('siguiente');
if(accion){

  if(index_galeria<galeria_imagenes_vertientes.length-1){

    index_galeria++;
    $('.contenedor_imagenes').attr('style','background-image:url('+galeria_imagenes_vertientes[index_galeria]['Nombre']+')');

  }else {
    index_galeria=0;
    $('.contenedor_imagenes').attr('style','background-image:url('+galeria_imagenes_vertientes[index_galeria]['Nombre']+')');
  }
}
else{
  //aca va si se apreta el boton atras
  if(index_galeria==0 ){
    index_galeria = galeria_imagenes_vertientes.length-1;
    $('.contenedor_imagenes').attr('style','background-image:url('+galeria_imagenes_vertientes[index_galeria]['Nombre']+')');

  }else {
    index_galeria--;
    $('.contenedor_imagenes').attr('style','background-image:url('+galeria_imagenes_vertientes[index_galeria]['Nombre']+')');

  }
}
});
$(document).on('click','.miniatura_galeria',function(e){

var url_miniatura = $(this).attr('src');
var index_miniatura = $(this).data('index');
$('.contenedor_imagenes').attr({style: "background-image:url("+url_miniatura+")"});
index_galeria = index_miniatura;

});
$(document).on('click','.item_menu>a',function(e){
  e.preventDefault();
  $('.item_menu>a').removeClass('activo');
  $(this).addClass('activo'); //hecha la animacion, ahora hay que cambiar de cuerpo...
  var url = $(this).parent().data('url');
  if(url=='inicio'){
    $('.contenido_menu').load('estructuras/vertientes/inicio_vertientes.php');
  }
  else if (url=='nosotros') {
    $('.contenido_menu').load('estructuras/vertientes/nosotros_vertientes.php');
    var datos = {accion:'obtener_galeria'};
    $.ajax({
      url:'vertientes',
      method:'POST',
      dataType:'JSON',
      data:datos,
      success:function(datos){
        galeria_imagenes_vertientes = datos.archivos;
        $('.contenedor_imagenes').attr('style','background-image:url('+galeria_imagenes_vertientes[index_galeria]['Nombre']+')');
        var html ='';
        for (var i = 0; i < datos.archivos.length; i++) {
           html+= '<img src='+datos.archivos[i]['Nombre']+' class="miniatura_galeria" data-index="'+i+'">';
        }
        $('.mini_galeria').html(html);
        }
    });
  }
  else if (url=='espacios') {
    $('.contenido_menu').load('estructuras/vertientes/espacios_terapeuticos.php');
  }
  else if (url='equipo') {
    $('.contenido_menu').load('estructuras/vertientes/equipo_vertientes.php');
  }

});


/*





*/

})
