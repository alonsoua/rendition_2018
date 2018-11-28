$(document).ready(function(){

   /*
   |--------------------------------------------------------------------------
   | Boostrap-DatePicker
   |--------------------------------------------------------------------------
   | link: https://uxsolutions.github.io/bootstrap-datepicker/?markup=input&format=&weekStart=&startDate=&endDate=&startView=0&minViewMode=0&maxViewMode=4&todayBtn=false&clearBtn=false&language=en&orientation=auto&multidate=&multidateSeparator=&keyboardNavigation=on&forceParse=on#sandbox
   | documentación: https://bootstrap-datepicker.readthedocs.io/en/latest/
   |
   */
   
   $('.fecha-documento').datepicker({
      format: 'dd-mm-yyyy',
      daysOfWeekDisabled: "0",
      autoclose: true,
      language: "es"
   });
   
   $('.fecha-pago').datepicker({
      format: 'dd-mm-yyyy',
      daysOfWeekDisabled: "0",
      autoclose: true,
      language: "es"
   });


   /*
   |--------------------------------------------------------------------------
   | Chosen Select de JQuery
   |--------------------------------------------------------------------------
   | link: https://harvesthq.github.io/chosen/
   | documentación: https://harvesthq.github.io/chosen/options.html
   |
   */

   $('.select-establecimientos').chosen({         
      no_results_text: 'No se encontró el Establecimiento',
      width : '100%'

   });

   $('.select-subvencion').chosen({
      no_results_text: 'No se encontró la Subvención',
      width : '100%'

   });

   $('.select-cuenta').chosen({
      no_results_text: 'No se encontró la Cuenta',
      width : '100%'

   });

   $('.select-tipoDocumento').chosen({
      no_results_text: 'No se encontró el Tipo Documento',
      width : '100%'

   });

   $('.select-proveedor').chosen({
      no_results_text: 'No se encontró el Proveedor',
      width : '100%'

   });

   $('.select-estado').chosen({
      disable_search: true,
      width : '100%'

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
   $('#dataTable-imputaciones').DataTable({

      "oLanguage" : {
         "sProcessing"        : "Procesando...",
         "sLengthMenu"        : "Mostrar _MENU_ registros por página",
         "sZeroRecords"       : "<h5 class='font-weight-light mt-5 mb-5'>No encontramos ninguna imputación con esas características</h5>",
         "sEmptyTable"        : "<h5 class='font-weight-light mt-5 mb-5'>No existen imputaciones registrados</h5>",
         "sLoadingRecords"    : "Cargando...",
         "sInfo"              : "Mostrando _START_ a _END_ de _TOTAL_ registros",
         "sInfoEmpty"         : "Mostrando 0 a 0 de 0 imputaciones",
         "sInfoFiltered"      : "<br>(filtro aplicado en _MAX_ imputaciones)",
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
      "ajax"      : "{{ url('imputacionesTable') }}",
      "columns"   : [
         {data: 'establecimiento.nombre', name: 'establecimientos.nombre'},
         {data: 'subvencion.nombre', name: 'subvencions.nombre'},
         {data: 'documento.nombre', name: 'documentos.nombre'},
         {data: 'descripcion', name: 'imputacions.descripcion'},
         {data: 'proveedor.nombre', name: 'proveedors.nombre'},
         {data: 'montoGasto', name: 'imputacions.montoGasto'},
         {data: 'montoDocumento', name: 'imputacions.montoDocumento'},
         {data: 'estado', name: 'imputacions.estado'},
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
   var rbd     = $(i).attr('data-rbd');
   var nombre  = $(i).attr('data-nombre');

   var texto = '¿Está seguro de eliminar el establecimiento <b>'+nombre+'</b> con RBD <b>'+rbd+'</b>?';

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
   var url  = form.attr('action').replace(':ESTABLECIMIENTO_ID', id);
   var data = form.serialize();

   $.post(
      url,
      data,
      function (result) {
         //Quitamos la fila
         row.fadeOut(); 
         //Mostramos alert
         $.alertable.alert('<p class="text-center">'+result.message+'</p>', {html: true}).always(function(){});
   }).fail(function(data){
         //console(data);
   });
}


$('#lstSubvencion').on('change', function(e){
   var idSubvencion = e.target.value;   
   $('#idSubvencion').val(idSubvencion);


   $.get('getCuentas/'+idSubvencion+'', function(data) {

      $('#lstCuenta').empty();
      
      //Carga lstCuenta en select
      $('#lstCuenta').append('<option value="0" disable="false" selected="true">Seleccione Cuenta</option>');

      $.each(data, function(index, cuenta){        
         $('#lstCuenta').append('<option value="'+cuenta.id+'">'+cuenta.nombre+'</option>');
         $('#lstCuenta').removeAttr('disabled');
      });      
      
      //Actualiza Select
      $("#lstCuenta").trigger("chosen:updated");

   });
});



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
         console.log(1, result);
         $.alertable.alert('<p class="text-center">'+result.message+'</p>', {html : true}).always(function(){
            location.reload();
         });
      
      }, error: function(data) {
      
         console.log(data);
         /* VALIDACIONES */
         //establecimiento      
         if (data.responseJSON.errors.establecimiento != undefined) {
            $('#lstEstablecimiento').addClass('is-invalid');
            $('#vEstablecimiento').addClass('invalid-feedback');
            $('#msgEstablecimiento').html(data.responseJSON.errors.establecimiento);
         } else {
            $('#lstEstablecimiento').removeClass('is-invalid');
            $('#lstEstablecimiento').addClass('is-valid');
            $('#vEstablecimiento').css('display', 'none');
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

         //cuenta      
         if (data.responseJSON.errors.cuenta != undefined) {
            $('#lstCuenta').addClass('is-invalid');
            $('#vCuenta').addClass('invalid-feedback');
            $('#msgCuenta').html(data.responseJSON.errors.cuenta);
         } else {
            $('#lstCuenta').removeClass('is-invalid');
            $('#lstCuenta').addClass('is-valid');
            $('#vCuenta').css('display', 'none');
         }

         //tipoDocumento      
         if (data.responseJSON.errors.tipoDocumento != undefined) {
            $('#lstTipoDocumento').addClass('is-invalid');
            $('#vTipoDocumento').addClass('invalid-feedback');
            $('#msgTipoDocumento').html(data.responseJSON.errors.tipoDocumento);
         } else {
            $('#lstTipoDocumento').removeClass('is-invalid');
            $('#lstTipoDocumento').addClass('is-valid');
            $('#vTipoDocumento').css('display', 'none');
         }

         //numDocumento
         if (data.responseJSON.errors.numDocumento != undefined) {
            $('#txtNumDocumento').addClass('is-invalid');
            $('#vNumDocumento').addClass('invalid-feedback');
            $('#msgNumDocumento').html(data.responseJSON.errors.numDocumento);
         } else {
            $('#txtNumDocumento').removeClass('is-invalid');
            $('#txtNumDocumento').addClass('is-valid');
            $('#vNumDocumento').css('display', 'none');
         }

         //fechaDocumento
         if (data.responseJSON.errors.fechaDocumento != undefined) {
            $('#txtFechaDocumento').addClass('is-invalid');
            $('#vFechaDocumento').addClass('invalid-feedback');
            $('#msgFechaDocumento').html(data.responseJSON.errors.fechaDocumento);
         } else {
            $('#txtFechaDocumento').removeClass('is-invalid');
            $('#txtFechaDocumento').addClass('is-valid');
            $('#vFechaDocumento').css('display', 'none');
         }

         //fechaPago
         if (data.responseJSON.errors.fechaPago != undefined) {
            $('#txtFechaPago').addClass('is-invalid');
            $('#vFechaPago').addClass('invalid-feedback');
            $('#msgFechaPago').html(data.responseJSON.errors.fechaPago);
         } else {
            $('#txtFechaPago').removeClass('is-invalid');
            $('#txtFechaPago').addClass('is-valid');
            $('#vFechaPago').css('display', 'none');
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

         //proveedor      
         if (data.responseJSON.errors.proveedor != undefined) {
            $('#lstProveedor').addClass('is-invalid');
            $('#vProveedor').addClass('invalid-feedback');
            $('#msgProveedor').html(data.responseJSON.errors.proveedor);
         } else {
            $('#lstProveedor').removeClass('is-invalid');
            $('#lstProveedor').addClass('is-valid');
            $('#vProveedor').css('display', 'none');
         }

         //montoGasto      
         if (data.responseJSON.errors.montoGasto != undefined) {
            $('#txtMontoGasto').addClass('is-invalid');
            $('#vMontoGasto').addClass('invalid-feedback');
            $('#msgMontoGasto').html(data.responseJSON.errors.montoGasto);
         } else {
            $('#txtMontoGasto').removeClass('is-invalid');
            $('#txtMontoGasto').addClass('is-valid');
            $('#vMontoGasto').css('display', 'none');
         }

         //montoDocumento      
         if (data.responseJSON.errors.montoDocumento != undefined) {
            $('#txtMontoDocumento').addClass('is-invalid');
            $('#vMontoDocumento').addClass('invalid-feedback');
            $('#msgMontoDocumento').html(data.responseJSON.errors.montoDocumento);
         } else {
            $('#txtMontoDocumento').removeClass('is-invalid');
            $('#txtMontoDocumento').addClass('is-valid');
            $('#vMontoDocumento').css('display', 'none');
         }

         //estado      
         if (data.responseJSON.errors.estado != undefined) {
            $('#lstEstado').addClass('is-invalid');
            $('#vEstado').addClass('invalid-feedback');
            $('#msgEstado').html(data.responseJSON.errors.estado);
         } else {
            $('#lstEstado').removeClass('is-invalid');
            $('#lstEstado').addClass('is-valid');
            $('#vEstado').css('display', 'none');
         }

      }
   });
});
