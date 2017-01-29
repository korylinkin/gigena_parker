$(function(){

$('header').stickMe();

$.ajax({
  url:'administrador/preview',
  method:'POST',
  dataType:'JSON'
}).fail(function( jqXHR, textStatus ){
  console.log(jqXHR+' + '+textStatus);
  console.log(jqXHR.responseText);
}).done(function(e){
  console.log(e);
});


$(document).on('click','#atras',function(e){

});
$(document).on('click','#publicar',function(e){
alert('apretado publicar');
});

});
