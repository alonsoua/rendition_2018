$(document).ready(function(){

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
   $('#dataTable-documentos').DataTable({
      "processing": true,
      "oLanguage" : {
         "sProcessing"        : "Procesando...",
         "sLengthMenu"        : "Mostrar _MENU_ registros por página",
         "sZeroRecords"       : "<h5 class='font-weight-light mt-5 mb-5'>No encontramos ningún documento con esas características</h5>",
         "sEmptyTable"        : "<h5 class='font-weight-light mt-5 mb-5'>No existen documentos registrados</h5>",
         "sLoadingRecords"    : "Cargando...",
         "sInfo"              : "Mostrando _START_ a _END_ de _TOTAL_ registros",
         "sInfoEmpty"         : "Mostrando 0 a 0 de 0 documentos",
         "sInfoFiltered"      : "<br>(filtro aplicado en _MAX_ documentos)",
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
      "ajax"      : "{{ url('documentosTable') }}",
      "columns"   : [
         {data: 'codigo'},
         {data: 'nombre'},
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
   var texto  = '¿Está seguro de eliminar el Tipo de Documento <b>'+codigo+' - '+nombre+'</b>?';

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
   var url  = form.attr('action').replace(':DOC_ID', id);
   var data = form.serialize();

   $.post( url, data, function (result) {
         row.fadeOut(); //Quitamos la fila
         $.alertable.alert('<p class="text-center">'+result.message+'</p>', {
            html: true
         }).always(function(){});
   }).fail(function(data){
      var res = data.status;         
      
      var mensaje = '';
      if (res == 500) {
         //500 Clave foranea
         mensaje = msgEliminarRegistroUtilizado('M', 'Tipo de Documento');
      } else if (res == 404) { 
         //404 No encontró el registro
         row.fadeOut(); 
         mensaje = msgEliminadoCorrectamente('M', 'Tipo de Documento');
      }

      $.alertable.alert('<p class="text-center">'+mensaje+'</p>', {html: true}).always(function(){});
   });
}

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
         $.alertable.alert('<p class="text-center">'+result.message+'</p>', {html : true}).always(function(){
            $(".cargando").css('visibility', 'visible');
            location.reload();
         });
      
      }, complete: function(data) {
         $(".cargando").css('visibility', 'hidden');
      }, error: function(data) {
         $(".cargando").css('visibility', 'hidden');
      
         /* VALIDACIONES */
         console.log(data);
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

      }
   });
});