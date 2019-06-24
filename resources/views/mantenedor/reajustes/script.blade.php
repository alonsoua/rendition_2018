$(document).ready(function(){

   /*
   |--------------------------------------------------------------------------
   | Chosen Select de JQuery
   |--------------------------------------------------------------------------
   | link: https://harvesthq.github.io/chosen/
   | documentación: https://harvesthq.github.io/chosen/options.html
   |
   */

   $('.select-establecimiento').chosen({
     
      no_results_text: 'No se encontró el Establecimiento',
      width : '100%'

   });


   /* PERIODO */
   $('.select-ano').chosen({
      placeholder_text_single: 'Seleccione Año',
      no_results_text: 'No se encontró el Año',
      width : '100%'
   });
   /* PERIODO */

   if ($("#form-agregar").length) {
      $('#msgVacio').remove();
   }

});



$('#guardar').click(function(){

   var idFm = $(this).attr('data-form');
   var form = $('#'+idFm);
   var url  = form.attr('action');
   var dataArray = form.serializeArray();
   $(".cargando").css('visibility', 'visible');
   
   $.ajax({
      url: url,
      method: 'POST',
      headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      dataType: 'json',
      data: dataArray,
      success: function(result){      

         $.alertable.alert('<p class="text-center">'+result.message+'</p>', {
            html : true
         }).always(function(){
           $(".cargando").css('visibility', 'visible');

            if (result.reload == 'ok') {
               location.reload();
            } else {               
               $(".cargando").css('visibility', 'hidden');               
            }
         });
      
      }, complete: function(data) {
         $(".cargando").css('visibility', 'hidden');
      }, error: function(data) {
         $(".cargando").css('visibility', 'hidden');
         // console.log(data);
         console.log(data);

         // debugger;
         /* VALIDACIONES */

         //Ano
         if (data.responseJSON.errors.ano != undefined) {
            $('#lstAno').addClass('is-invalid');
            $('#vAno').addClass('invalid-feedback');
            $('#msgAno').html(data.responseJSON.errors.ano);
         } else {
            $('#lstAno').removeClass('is-invalid');
            $('#lstAno').addClass('is-valid');
            $('#vAno').css('display', 'none');
         }

         //rut      
         if (data.responseJSON.errors.porcentajeReajuste != undefined) {
            $('#intPorcentajeReajuste').addClass('is-invalid');
            $('#vPorcentajeReajuste').addClass('invalid-feedback');
            $('#msgPorcentajeReajuste').html(data.responseJSON.errors.porcentajeReajuste);
         } else {
            $('#intPorcentajeReajuste').removeClass('is-invalid');
            $('#intPorcentajeReajuste').addClass('is-valid');
            $('#vPorcentajeReajuste').css('display', 'none');
         }
      }
   });
});
