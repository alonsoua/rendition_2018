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
   $('#dataTable-afp').DataTable({       
      "processing": true,
      "oLanguage" : {
         "sProcessing"        : "Procesando...",
         "sLengthMenu"        : "Mostrar _MENU_ registros por página",
         "sZeroRecords"       : "<h5 class='font-weight-light mt-5 mb-5'>No encontramos ningúna AFP con esas características</h5>",
         "sEmptyTable"        : "<h5 class='font-weight-light mt-5 mb-5'>No existen AFP registradas</h5>",
         "sLoadingRecords"    : "Cargando...",
         "sInfo"              : "Mostrando _START_ a _END_ de _TOTAL_ registros",
         "sInfoEmpty"         : "Mostrando 0 a 0 de 0 AFP",
         "sInfoFiltered"      : "<br>(filtro aplicado en _MAX_ AFP)",
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
      "ajax"      : "{{ url('afpTable') }}",
      "columns"   : [
         {data: 'nombre'},
         {
            data: 'porcentaje',            

            render: $.fn.dataTable.render.number('.', ',', 2,'', ' %')
         },
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
   var nombre = $(i).attr('data-nombre');

   $.alertable.confirm('<p class="text-center">¿Está seguro de eliminar la AFP <b>'+nombre+'</b>?</p>', {
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
   var url  = form.attr('action').replace(':AFP_ID', id);
   var data = form.serialize();

   $.post(
      url,
      data,
      function (result) {
         row.fadeOut(); //Quitamos la fila
         $.alertable.alert('<p class="text-center">'+result.message+'</p>', {html : true}).always(function(){});
   }).fail(function(data){
      var res = data.status;         
      
      var mensaje = '';
      if (res == 500) {
         //500 Clave foranea
         mensaje = msgEliminarRegistroUtilizado('F', 'AFP');
      } else if (res == 404) { 
         //404 No encontró el registro
         row.fadeOut(); 
         mensaje = msgEliminadoCorrectamente('F', 'AFP');
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
         debugger;
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

         //porcentajeMax      
         if (data.responseJSON.errors.porcentajeDescuento != undefined) {
            $('#intPorcentajeDescuento').addClass('is-invalid');
            $('#vPorcentajeDescuento').addClass('invalid-feedback');
            $('#msgPorcentajeDescuento').html(data.responseJSON.errors.porcentajeDescuento);
         } else {
            $('#intPorcentajeDescuento').removeClass('is-invalid');
            $('#intPorcentajeDescuento').addClass('is-valid');
            $('#vPorcentajeDescuento').css('display', 'none');
         }        
      }
   });
});
