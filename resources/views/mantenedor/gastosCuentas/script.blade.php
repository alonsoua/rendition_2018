$(document).ready(function(){

   /*
   |--------------------------------------------------------------------------
   | Chosen Select de JQuery
   |--------------------------------------------------------------------------
   | link: https://harvesthq.github.io/chosen/
   | documentación: https://harvesthq.github.io/chosen/options.html
   |
   */

   $('.select-subvenciones').chosen({
      no_results_text: 'No se encontró la Subvención',
      width : '100%',
      placeholder_text_multiple: 'Seleccione Subvenciones'      

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
   $('#dataTable-cuentas').DataTable({

      "oLanguage" : {
         "sProcessing"        : "Procesando...",
         "sLengthMenu"        : "Mostrar _MENU_ registros por página",
         "sZeroRecords"       : "<h5 class='font-weight-light mt-5 mb-5'>No encontramos ningún cuenta con esas características</h5>",
         "sEmptyTable"        : "<h5 class='font-weight-light mt-5 mb-5'>No existen cuentas registrados</h5>",
         "sLoadingRecords"    : "Cargando...",
         "sInfo"              : "Mostrando _START_ a _END_ de _TOTAL_ registros",
         "sInfoEmpty"         : "Mostrando 0 a 0 de 0 cuentas",
         "sInfoFiltered"      : "<br>(filtro aplicado en _MAX_ cuentas)",
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
      "ajax"      : "{{ url('cuentasTable') }}",
      "columns"   : [
         {data: 'codigo', name:'cuentas.codigo'},         
         {data: 'nombre', name:'cuentas.nombre'},
         {data: 'NombreSubvencion'},      
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

function MensajeEliminar(e, i) {
   e.preventDefault();
   var codigo = $(i).attr('data-codigo');
   var nombre = $(i).attr('data-nombre');
   var texto  = '¿Está seguro de eliminar la cuenta <b>'+codigo+' - '+nombre+'</b>?';

   $.alertable.confirm('<p class="text-center">'+texto+'</p>', {
      html: true
   }).then(function() {
      Eliminar(i);
   }, function() {
      return false;
   });
}

function Eliminar(i) {

   var row  = $(i).parents('tr');
   var id   = $(i).attr('id');
   var form = $('#form-delete');
   var url  = form.attr('action').replace(':CUENTA_ID', id);
   var data = form.serialize();

   $.post(
      url,
      data,
      function (result) {
         row.fadeOut(); //Quitamos la fila
         $.alertable.alert('<p class="text-center">'+result.message+'</p>', {
            html: true
         }).always(function(){});
   }).fail(function(data){
      // console(data);
   });
}

$('#guardar').click(function(){
   
   var idFm = $(this).attr('data-form');
   var form = $('#'+idFm);
   var url  = form.attr('action');
   var dataArray = form.serializeArray();  

   //console.log(1, dataArray);
   $.ajax({
      url: url,
      method: 'POST',
      headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      dataType: 'json',
      data: dataArray,
      success: function(result){      
         console.log('success', result);
         $.alertable.alert('<p class="text-center">'+result.message+'</p>', {html : true}).always(function(){
            location.reload();
         });
      
      }, error: function(data) {
      
         /* VALIDACIONES */
         console.log('error', data);
         //código
         if (data.responseJSON.errors.codigo != undefined) {
            $('#txtCodigo').addClass('is-invalid');
            $('#vCodigo').addClass('invalid-feedback');
            $('#msgCodigo').html(data.responseJSON.errors.codigo);
         } else {
            $('#txtCodigo').removeClass('is-invalid');
            $('#txtCodigo').addClass('is-valid');
            $('#vCodigo').css('display', 'none');
         }

         //nombre
         if (data.responseJSON.errors.nombre != undefined) {
            $('#txtNombre').addClass('is-invalid');
            $('#vNombre').addClass('invalid-feedback');
            $('#msgNombre').html(data.responseJSON.errors.nombre);
         } else {
            $('#txtNombre').removeClass('is-invalid');
            $('#txtNombre').addClass('is-valid');
            $('#vNombre').css('display', 'none');
         }

         //descripcion
         if (data.responseJSON.errors.descripcion != undefined) {
            $('#txtDescripcion').addClass('is-invalid');
            $('#vDescripcion').addClass('invalid-feedback');
            $('#msgDescripcion').html(data.responseJSON.errors.descripcion);
         } else {
            $('#txtDescripcion').removeClass('is-invalid');
            $('#txtDescripcion').addClass('is-valid');
            $('#vDescripcion').css('display', 'none');
         }

         //subvenciones
         if (data.responseJSON.errors.subvenciones != undefined) {
            $('#lstSubvencion').addClass('is-invalid');
            $('#vSubvencion').addClass('invalid-feedback');
            $('#msgSubvencion').html(data.responseJSON.errors.subvenciones);
         } else {
            $('#lstSubvencion').removeClass('is-invalid');
            $('#lstSubvencion').addClass('is-valid');
            $('#vSubvencion').css('display', 'none');
         }

      }
   });
});
