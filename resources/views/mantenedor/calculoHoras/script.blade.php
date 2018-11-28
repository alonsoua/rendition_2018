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
      width : '35%'

   });

   $('.select-periodo').chosen({
      placeholder_text_single: 'Seleccione Periodo',
      no_results_text: 'No se encontró el Periodo',
      width : '35%'

   });


  /*
   |--------------------------------------------------------------------------
   | DataTable
   |--------------------------------------------------------------------------
   | oLanguage: Configura el dataTable para que esté en español.
   | columns: Agrega data a mostrar en tabla.
   | drawCallback function: Agrega class "pagination-sm" para que se vea pequeña.
   |
   */
   $.fn.dataTable.ext.classes.sPagination = 'pagination pagination-sm';
   $('#dataTable-users').DataTable({

      "oLanguage" : {
         "sProcessing"        : "Procesando...",
         "sLengthMenu"        : "Mostrar _MENU_ registros por página",
         "sZeroRecords"       : "<h5 class='font-weight-light mt-5 mb-5'>No encontramos ningún usuario con esas características</h5>",
         "sEmptyTable"        : "<h5 class='font-weight-light mt-5 mb-5'>No existen usuarios registrados</h5>",
         "sLoadingRecords"    : "Cargando...",
         "sInfo"              : "Mostrando _START_ a _END_ de _TOTAL_ registros",
         "sInfoEmpty"         : "Mostrando 0 a 0 de 0 usuarios",
         "sInfoFiltered"      : "<br>(filtro aplicado en _MAX_ usuarios)",
         "sInfoPostFix"       : "",
         "sInfoThousands"     : ".",
         "sSearch"            : "Buscar:",
         "sUrl"               : "",
            "oPaginate"       : {
                  "sFirst"       : "Primera",
                  "sPrevious"    : "Anterior",
                  "sNext"        : "Siguiente",
                  "sLast"        : "Última",
            },
      },
      "serverSide": true,
      "ajax"      : "{{ url('usersTable') }}",
      "columns"   : [
         {data: 'rut'},
         {data: 'name'},
         // {data: 'apellidoPaterno'},
         {data: 'email'},
         {data: 'opciones'},
      ],
      "drawCallback": function () {
         $('.dataTables_paginate > .pagination').addClass('pagination-sm');
      }
   });

   if ($("#form-agregar").length) {
      $('#msgVacio').remove();
   }

});

$('#lstEstablecimiento').on('change', function(e){
   
   var idEstablecimiento = e.target.value;
   
   $('#idEstablecimiento').val(idEstablecimiento);

   $.get('lst-periodos?idEstablecimiento='+ idEstablecimiento,function(data) {
      
      $('#lstPeriodo').empty();

      //Carga info en select
      $('#lstPeriodo').append('<option value="0" disable="true" selected="true">Seleccione Periodo</option>');
      $.each(data, function(index, periodos){
         $('#lstPeriodo').append('<option value="'+periodos.id+'">'+periodos.periodo+'</option>');
      });

      //Actualiza Select
      $("#lstPeriodo").trigger("chosen:updated");
      
      $('#row-Periodo').css('display', 'block');
   });
});



// LST-GUARDAR
$('#lstPeriodo').on('change', function(e){

   var idPeriodo = e.target.value;
   $('#idPeriodo').val(idPeriodo);
   var idEstablecimiento = $('#idEstablecimiento').val();
   
   var url = 'lst-cargaLeyes?idPeriodo='+idPeriodo+'&idEstablecimiento='+idEstablecimiento;
   var row = '';

   $.get(url,function(data) {
      
      $.each(data, function(index, subvencion){         
         
         row += 
         '<div class="col-sm-12 rowEliminar" >'
         +'<br>'
         +'<div class="col-sm-12">'
            +'<h6 class="f mt-2 text-sm-left float-left">'+subvencion['subvencion']+'</h6>'
         +'</div>'
         
         +'<div class="col-sm-12">'
            +'<div class="mt-2">'
               +'<table class="table table-hover table-sm table-responsive-sm">'
                  +'<thead>'
                     +'<tr>'
                        +'<th scope="col" width="5%">Código</th>'
                        +'<th scope="col" width="65%">Nombre</th>'
                        +'<th scope="col" width="10%">Carga Periodo</th>'
                        +'<th scope="col" width="10%">Cant. Horas</th>'
                        +'<th scope="col" width="10%">Valor Hora</th>'
                     +'</tr>'
                  +'</thead>'
                  +'<tbody>';

                  $.each(data[index]['leyes'][0], function(index1, leyes){

                     row += '<tr>'
                        +'<td>'+leyes['codigoLey']+'</td>'
                        +'<td>'+leyes['nombreLey']+'</td>'
                      
                        +'<td>'
                           +'<div class="input-group input-group-sm">'                              
                              +'<input type="text"   value="'+formatoMiles(leyes['cargaPeriodo'])+'"'
                              +'id="txtCargaPeriodo" name="cargaPeriodo['+leyes['idLey']+']" class="form-control miles"' 
                              +'style="text-align:right" aria-describedby="inputGroup-sizing-sm" '
                              +'maxlength="13">'
                           +'</div>'
                        +'</td>'
                        +'<td>'
                           +'<div class="input-group input-group-sm">'
                              +'<input type="text" value="'+formatoMiles(leyes['cantHoras'])+'"'
                              +'id="txtCantHoras"  name="cantHoras['+leyes['idLey']+']" class="form-control miles"' 
                              +'style="text-align:right" a-describedby="inputGroup-sizing-sm"'
                              +'maxlength="13">'
                           +'</div>'
                        +'</td>'
                        +'<td>'
                           +'<div class="input-group input-group-sm">'
                              +'<div class="input-group-prepend">'
                                 +'<span class="input-group-text" id="basic-addon-calendar">'
                                   +'  <i class="fa fa-dollar-sign form-control-feedback"></i>'
                                 +'</span>'
                              +'</div>'
                              +'<input type="text" value="'+formatoMiles(leyes['valor'])+'"' 
                              +'id="txtValorHora"  name="valor['+leyes['idLey']+']" class="form-control miles"' 
                              +'style="text-align:right" a-describedby="inputGroup-sizing-sm"'
                              +'maxlength="13">'                              
                           +'</div>'
                        +'</td>'
                     +'</tr>';
                  });

               row += '</tbody>'
               +'</table>'
            +'</div>'
         +'</div>'
      +'</div>';
      });     

      // Muestra leyes y acciones      
      $('#acciones').css('display', 'none');
      $('.rowEliminar').remove();
      $('#rowCalculoHoras').append(row);
      $('#rowCalculoHoras').css('display', 'block');
      $('#acciones').css('display', 'block');

   });
});



// BTN-GUARDAR
$('#guardar').click(function(){   

   var idFm = $(this).attr('data-form');
   var form = $('#'+idFm);
   var url  = form.attr('action');
   var dataArray = form.serializeArray();
   $("#msg").css('display', 'none');
   
   //VALIDACIONES 
   //cargaPeriodo
   //cantHoras
   //valorHoras  
   var countInvalid = 0;   
   dataArray.forEach( function(element, index) {            

      if (element.value === "") {                     
      
         $('[name="'+element.name+'"]').addClass('is-invalid');
         $('#txtRut').addClass('is-invalid');  
         countInvalid++;
         
         //Si es el primer dato invalido
         //hace focus
         if (countInvalid == 1) {
            $('[name="'+element.name+'"]').focus();
         }
      
      } else {
         $('#txtRut').removeClass('is-invalid');         
      }
      
   });   

   //Si falta algún dato retorna false
   if (countInvalid != 0) { 
      $("#msg").css('display', 'block');
      $("#msg").append('Todos los campos son obligatorios.');
      return false; 
   }
   
   $.post(
      url,
      dataArray,
      function (result) {
         $.alertable.alert(result.message, {html : true}).always(function(){
            location.reload();
         });
   }).fail(function(data){

      dataArray.forEach( function(element, index) {
      
         if (element.value === "") {                     
            $('[name="'+element.name+'"]').addClass('is-invalid');
            $('#txtRut').addClass('is-invalid');      
         } else {
            $('#txtRut').removeClass('is-invalid');
            $('[name="'+element.name+'"]').addClass('is-valid');
         }
         
      });

   });
});



