$(function(){




  $(document).on('click','input.ql-image',function(e){
  e.preventDefault();
  $(this).remove();
  });



  $(document).on('click','.item',function(){
    var txt = $(this).text();
    $('.boton_categorias').text($(this).text());
  });

  var toolbarOptions = [
  ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
  ['blockquote'],               // custom button values
  [{ 'list': 'ordered'}, { 'list': 'bullet' }],
  [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
  [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
  [{ 'direction': 'rtl' }],                       // text direction
  ['link','image'],
  [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
  [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

  [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
  [{ 'font': [] }],
  [{ 'align': [] }],
  ['clean']                                         // remove formatting button
  ];


let Inline = Quill.import('blots/inline');
let BlockEmbed = Quill.import('blots/block/embed');
class ImageBlot extends BlockEmbed {
  static create(value) {
    let node = super.create();
    node.setAttribute('alt', value.alt);
    node.setAttribute('src', value.url);

    return node;
  }

  static value(node) {
    return {
      alt: node.getAttribute('alt'),
      url: node.getAttribute('src')
    };
  }
}
ImageBlot.blotName = 'image';
ImageBlot.tagName = 'img';


  class LinkBlot extends Inline {
    static create(url) {
      let node = super.create();
      // Sanitize url if desired
      node.setAttribute('href', url);

      // Okay to set other non-format related attributes
      node.setAttribute('target', '_self');
      return node;
    }

    static formats(node) {
      // We will only be called with a node already
      // determined to be a Link blot, so we do
      // not need to check ourselves
      return node.getAttribute('href');
    }
  }

  LinkBlot.blotName = 'link';
  LinkBlot.tagName = 'a';
  Quill.register(LinkBlot);
  Quill.register(ImageBlot);
var quill = new Quill('#editor', {
modules: {
  toolbar: toolbarOptions
},
theme: 'snow'
});
var cursor_en=0;
var largo=0;
var seleccion=false;
var c=0;


var acceso_privado=true;
$(document).on('click','#btn_acceso_privado',function(e){
  //tengo qeu armar la logica de si es true hacer tal cosa, false la otratengo que pensar en que momento se da la accion, supongo que cuando toca el btn de acceso  y cuando quiere subirlo.
  var html_acceso='';

  if(acceso_privado){
    html_acceso='<span id="tipo_acceso" >Publico</span><i id="btn_acceso_privado" class="fa fa-unlock-alt" aria-hidden="true"></i><input type="hidden" name="especial" value="0" form="articulo_nuevo">';
    acceso_privado=false;

  }
  else{
    html_acceso ='<span id="tipo_acceso">Privado</span><i id="btn_acceso_privado" class="fa fa-lock" aria-hidden="true"></i><input type="hidden" name="especial" value="1" form="articulo_nuevo">';
    acceso_privado=true;
  }
  $('.acceso_cliente').html(html_acceso);




});
$(document).on('click','.ql-editor img#item_img.img_item',function(e){
  //aca tengo la img apretada enel editor
  var url = $(this).attr('src');
  var descripcion = $(this).attr('alt');
  var ancho = $(this).width();
  var alto = $(this).height();
  datos = '[{"url":"'+url+'","descripcion":"'+descripcion+'","ancho":"'+ancho+'","alto":"'+alto+'"}]';
  $('.ql-image').addClass('img_activa');
  $('button.ql-image').attr('data-activo',true);
  $('.ql-image').attr('data-imagen',datos);
  console.log('apretada img en editor');

});



$(document).on('click','button.ql-image',function(e){

  e.preventDefault();
  var estado = $(this).attr('data-activo');

  if(!(estado==undefined)){
    estado = JSON.parse(estado);
    if(estado){

      var html = armar_modal_imagen($(this).data('imagen')[0]);
      $('.contenedor_super_superior').append('<div class="modal_imagen">'+html+'</div>');
      var posicion_btn_link = $(this).offset();
      var pos_x = posicion_btn_link.left;
      var pos_y = posicion_btn_link.top+25;
      $('.modal_imagen').offset({top:pos_y,left:pos_x}).slideDown(400,function(){


      });
    }

  }

});
function armar_modal_imagen(datos){
  var btn_cerrar= '<div class="cerrar_div" title="Cerrar">X</div>';
  //var input_url = '<label for="url_imagen">URL:</label><input type="text" class="campo_imagen" id="url_imagen" value="'+datos.url+'" placeholder="Escribir Url"/>';
  var input_descripcion = '<input type="text" class="campo_imagen" id="image_descripcion" value="'+datos.descripcion+'" placeholder="Descripcion"/>';
  var input_alto = '<input type="text" class="campo_imagen" id="alto_imagen" value="'+datos.alto+'"/>';
  var input_ancho = '<input type="text" class="campo_imagen" id="alto_imagen" value="'+datos.ancho+'"/>';
  var btn_aceptar = '<button type="button" class="btn_actualizar"  id="btn_actualizar_imagen">Aceptar</button>';
  var html= btn_cerrar+input_descripcion+input_alto+input_ancho+btn_aceptar;
  return html;
}


$(document).click(function(){

  if(!quill.hasFocus()){

    $('button.ql-image').removeClass('img_activa');
    $('button.ql-image').attr('data-activo',false);

  }
});


$(document).on('drop','.ql-editor',function(e){

  quill.setSelection(quill.getLength(),0);
  quill.insertText(quill.getLength()+1,'\n');
/*
e.preventDefault();
var url = e.originalEvent.dataTransfer.getData('text/html');
var clase = $(url).attr('class');
var id = $(url).attr('id');
var insertar_html = '<p>'+url+'</p>';
var sel = quill.getSelection();
if(sel){
  quill.clipboard.dangerouslyPasteHTML(sel.index,insertar_html);
  $('.ql-editor img').addClass(clase).attr('id',id);
  quill.setSelection(quill.getLength(),0);
  quill.insertText(quill.getLength(),'\n');
  //$('.ql-editor img').css('z-index',200);
}
*/


});


function crear_label(id,texto){
  var label_url = '<label for="'+id+'"  >'+texto+'</label>';
  return label_url;
}



$(document).on('click','.ql-link',function(e){

$('.modal_link').remove();
var texto_seleccionado ='';
var url_link='';
var range = quill.getSelection();
if (range) {
  if (range.length == 0) {
    //aca esta solo posicionado en un lugar
    cursor_en= range.index;
    largo = range.length;
    seleccion=false;
    var btn_cerrar= '<div class="cerrar_div" title="Cerrar">X</div>';
    var input_url = '<input type="text" id="url_link" value="'+url_link+'" placeholder="Escribir Url"/>';
    var input_descripcion = '<input type="text" id="link_descripcion" value="'+texto_seleccionado+'" placeholder="Descripcion"/>';
    var btn_aceptar = '<button type="button" id="btn_link">Aceptar</button>';
    var cursor  ='<input type="hidden" value="'+cursor_en+'"/>';
    $('.contenedor_super_superior').append('<div class="modal_link">'+btn_cerrar+input_url+input_descripcion+btn_aceptar+cursor+'</div>');
    var posicion_btn_link = $(this).offset();
    var pos_x = posicion_btn_link.left;
    var pos_y = posicion_btn_link.top+25;
    $('.modal_link').offset({top:pos_y,left:pos_x}).slideDown(400,function(){


    });

  } else {

     texto_seleccionado = quill.getText(range.index, range.length);
     var forma = quill.getFormat(range.index,range.length);
     seleccion = true;
     var btn_cerrar= '<div class="cerrar_div" title="Cerrar">X</div>';
     var input_url = '<input type="text" id="url_link" value="'+url_link+'" placeholder="Escribir Url"/>';
     var input_descripcion = '<input type="text" id="link_descripcion" value="'+texto_seleccionado+'" placeholder="Descripcion"/>';
     var btn_aceptar = '<button type="button" id="btn_link">Aceptar</button>';
     var cursor  ='<input type="hidden" value="'+cursor_en+'"/>';
     $('.contenedor_super_superior').append('<div class="modal_link">'+btn_cerrar+input_url+input_descripcion+btn_aceptar+cursor+'</div>');
     var posicion_btn_link = $(this).offset();
     var pos_x = posicion_btn_link.left;
     var pos_y = posicion_btn_link.top+25;
     $('.modal_link').offset({top:pos_y,left:pos_x}).slideDown(400,function(){

     });

  }
} else {
  //aca esta fuera del editor
}


});

$(document).on('click',function(e){

});
$(document).on('click','#btn_link',function(e){

var desc = $('#link_descripcion').val();

if(seleccion){
  crear_link_con_texto();
  seleccion=false;
  alert('este con txto');
}else{
crear_link_sin_texto();
alert('fue sin txt');
}
cerrar_div_padre($(this));

});

function crear_link_sin_texto(){
var preurl = $('#url_link').val();
var url ='http://'+preurl;
var desc = $('#link_descripcion').val();
if(desc==''){
  quill.insertText(cursor_en,preurl,'link',url);

}else{
 quill.insertText(cursor_en,desc,'link',url);
}
quill.setSelection(quill.getLength(),0);

}
function crear_link_con_texto(){
  var preurl = $('#url_link').val();
  var url ='http://'+preurl;
  quill.format('link',url);
  quill.insertText(quill.getLength(),'\n');
  quill.setSelection(quill.getLength(),0);
}


$(document).on('click','.cerrar_div',function(e){
  cerrar_div_padre($(this));


});
function cerrar_div_padre(actual){
  var contenedor = actual[0].parentNode;
  $(contenedor).slideUp(300,function(){
    contenedor.remove();
  });
}



    quill.once('text-change', function() {
      $('.ql-toolbar.ql-snow').stickMe();

    });

  $('.btn_borrador').click(function(e){

  });






/*$('.opcion_editor').on('mouseover',function(evento){
  $('.opcion_editor').tooltip();
  var posicion = $(this).position();
  posicion.top = posicion.top-40;
  //posicion.left = posicion.left;
  $('.ui-tooltip').css({display:"block",top:posicion.top,left:posicion.left});
});*/













})
