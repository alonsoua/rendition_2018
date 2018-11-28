$(document).ready(function(){

    /*
   |--------------------------------------------------------------------------
   | Chosen Select de JQuery
   |--------------------------------------------------------------------------
   | link: https://harvesthq.github.io/chosen/
   | documentación: https://harvesthq.github.io/chosen/options.html
   |
   */

   $('.select-tipo').chosen({      
      disable_search: true,
      width : '100%'

   });

   $('.select-subvencion').chosen({
      no_results_text: 'No se encontró la Subvención',
      width : '100%'

   });

   //alert('Prueba');
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
   $('#dataTable-leyes').DataTable({

      "oLanguage" : {
         "sProcessing"        : "Procesando...",
         "sLengthMenu"        : "Mostrar _MENU_ registros por página",
         "sZeroRecords"       : "<h5 class='font-weight-light mt-5 mb-5'>No encontramos ningúna ley con esas características</h5>",
         "sEmptyTable"        : "<h5 class='font-weight-light mt-5 mb-5'>No existen leyes registrados</h5>",
         "sLoadingRecords"    : "Cargando...",
         "sInfo"              : "Mostrando _START_ a _END_ de _TOTAL_ registros",
         "sInfoEmpty"         : "Mostrando 0 a 0 de 0 leyes",
         "sInfoFiltered"      : "<br>(filtro aplicado en _MAX_ leyes)",
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
      "ajax"      : "{{ url('leyesTable') }}",
      "columns"   : [
         {data: 'codigo',           name: 'leys.codigo'},
         {data: 'nombre',           name: 'leys.nombre'},
         {data: 'tipo',             name: 'leys.tipo'},
         {data: 'subvencion.nombre',name: 'subvencion.nombre'},
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

   $.alertable.confirm('<p class="text-center">¿Está seguro de eliminar la ley <b>'+codigo+' - '+nombre+'</b>?</p>', {
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
   var url  = form.attr('action').replace(':LEYES_ID', id);
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


   $.ajax({
      url: url,
      method: 'POST',
      headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      dataType: 'json',
      data: dataArray,
      success: function(result){      
         $.alertable.alert('<p class="text-center">'+result.message+'</p>', {html : true}).always(function(){
            location.reload();
         });
      
      }, error: function(data) {
      
         console.log(data);
         /* VALIDACIONES */
         //codigo      
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

         //tipo
         if (data.responseJSON.errors.tipo != undefined) {
            $('#lstTipo').addClass('is-invalid');
            $('#vTipo').addClass('invalid-feedback');
            $('#msgTipo').html(data.responseJSON.errors.tipo);
         } else {
            $('#lstTipo').removeClass('is-invalid');
            $('#lstTipo').addClass('is-valid');
            $('#vTipo').css('display', 'none');
         }

         //subvencion
         if (data.responseJSON.errors.subvencion != undefined) {
            $('#lstSubvencion').addClass('is-invalid');
            $('#vSubvencion').addClass('invalid-feedback');
            $('#msgSubvencion').html(data.responseJSON.errors.subvencion);
         } else {
            $('#lstSubvencion').removeClass('is-invalid');
            $('#lstSubvencion').addClass('is-valid');
            $('#vSubvencion').css('display', 'none');
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

         //porcentajeMaximo      
         if (data.responseJSON.errors.porcentajeMáximo != undefined) {
            $('#txtPorcentajeMax').addClass('is-invalid');
            $('#vPorcentajeMax').addClass('invalid-feedback');
            $('#msgPorcentajeMax').html(data.responseJSON.errors.porcentajeMáximo);
         } else {
            $('#txtPorcentajeMax').removeClass('is-invalid');
            $('#txtPorcentajeMax').addClass('is-valid');
            $('#vPorcentajeMax').css('display', 'none');
         }        

         //tope      
         if (data.responseJSON.errors.tope != undefined) {
            $('#txtTope').addClass('is-invalid');
            $('#vTope').addClass('invalid-feedback');
            $('#msgTope').html(data.responseJSON.errors.tope);
         } else {
            $('#txtTope').removeClass('is-invalid');
            $('#txtTope').addClass('is-valid');
            $('#vTope').css('display', 'none');
         }        

      }
   });
});
