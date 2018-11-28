$(document).ready(function(){

   /*
   |--------------------------------------------------------------------------
   | Chosen Select de JQuery
   |--------------------------------------------------------------------------
   | link: https://harvesthq.github.io/chosen/
   | documentación: https://harvesthq.github.io/chosen/options.html
   |
   */

   $('.select-tipoDependencias').chosen({
     
      disable_search: true,
      width : '100%'

   });

   $('.select-sostenedores').chosen({
      no_results_text: 'No se encontró el Sostenedor',
      width : '100%'

   });

   $('.select-comunas').chosen({
      no_results_text: 'No se encontró la Comuna',
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
   $('#dataTable-establecimientos').DataTable({

      "oLanguage" : {
         "sProcessing"        : "Procesando...",
         "sLengthMenu"        : "Mostrar _MENU_ registros por página",
         "sZeroRecords"       : "<h5 class='font-weight-light mt-5 mb-5'>No encontramos ningún establecimiento con esas características</h5>",
         "sEmptyTable"        : "<h5 class='font-weight-light mt-5 mb-5'>No existen establecimientos registrados</h5>",
         "sLoadingRecords"    : "Cargando...",
         "sInfo"              : "Mostrando _START_ a _END_ de _TOTAL_ registros",
         "sInfoEmpty"         : "Mostrando 0 a 0 de 0 establecimientos",
         "sInfoFiltered"      : "<br>(filtro aplicado en _MAX_ establecimientos)",
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
      "ajax"      : "{{ url('establecimientosTable') }}",
      "columns"   : [
         {data: 'rbd', name: 'establecimientos.rbd'},
         {data: 'nombre', name: 'establecimientos.nombre'},
         {data: 'sostenedor.nombre', name: 'sostenedor.nombre'},
         {data: 'direccion', name: 'establecimientos.direccion'},
         {data: 'fono', name: 'establecimientos.fono'},
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
         //rbd      
         if (data.responseJSON.errors.rbd != undefined) {
            $('#txtRbd').addClass('is-invalid');
            $('#vRbd').addClass('invalid-feedback');
            $('#msgRbd').html(data.responseJSON.errors.rbd);
         } else {
            $('#txtRbd').removeClass('is-invalid');
            $('#txtRbd').addClass('is-valid');
            $('#vRbd').css('display', 'none');
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

         //razonSocial
         if (data.responseJSON.errors.razonSocial != undefined) {
            $('#txtRazonSocial').addClass('is-invalid');
            $('#vRazonSocial').addClass('invalid-feedback');
            $('#msgRazonSocial').html(data.responseJSON.errors.razonSocial);
         } else {
            $('#txtRazonSocial').removeClass('is-invalid');
            $('#txtRazonSocial').addClass('is-valid');
            $('#vRazonSocial').css('display', 'none');
         }

         //rut      
         if (data.responseJSON.errors.rut != undefined) {
            $('#txtRut').addClass('is-invalid');
            $('#vRut').addClass('invalid-feedback');
            $('#msgRut').html(data.responseJSON.errors.rut);
         } else {
            $('#txtRut').removeClass('is-invalid');
            $('#txtRut').addClass('is-valid');
            $('#vRut').css('display', 'none');
         }        

         //idTipoDependencia
         if (data.responseJSON.errors.tipoDependencia != undefined) {
            $('#lstTipoDependencia').addClass('is-invalid');
            $('#vTipoDependencia').addClass('invalid-feedback');
            $('#msgTipoDependencia').html(data.responseJSON.errors.tipoDependencia);
         } else {
            $('#lstTipoDependencia').removeClass('is-invalid');
            $('#lstTipoDependencia').addClass('is-valid');
            $('#vTipoDependencia').css('display', 'none');
         }

         //idSostenedor
         if (data.responseJSON.errors.sostenedor != undefined) {
            $('#lstSostenedor').addClass('is-invalid');
            $('#vSostenedor').addClass('invalid-feedback');
            $('#msgSostenedor').html(data.responseJSON.errors.sostenedor);
         } else {
            $('#lstSostenedor').removeClass('is-invalid');
            $('#lstSostenedor').addClass('is-valid');
            $('#vSostenedor').css('display', 'none');
         }      

         //idComuna
         if (data.responseJSON.errors.comuna != undefined) {
            $('#lstComuna').addClass('is-invalid');
            $('#vComuna').addClass('invalid-feedback');
            $('#msgComuna').html(data.responseJSON.errors.comuna);
         } else {
            $('#lstComuna').removeClass('is-invalid');
            $('#lstComuna').addClass('is-valid');
            $('#vComuna').css('display', 'none');
         }

         //direccion
         if (data.responseJSON.errors.direccion != undefined) {
            $('#txtDireccion').addClass('is-invalid');
            $('#vDireccion').addClass('invalid-feedback');
            $('#msgDireccion').html(data.responseJSON.errors.direccion);
         } else {
            $('#txtDireccion').removeClass('is-invalid');
            $('#txtDireccion').addClass('is-valid');
            $('#vDireccion').css('display', 'none');
         }

         //fono
         if (data.responseJSON.errors.fono != undefined) {
            $('#txtFono').addClass('is-invalid');
            $('#vFono').addClass('invalid-feedback');
            $('#msgFono').html(data.responseJSON.errors.fono);
         } else {
            $('#txtFono').removeClass('is-invalid');
            $('#txtFono').addClass('is-valid');
            $('#vFono').css('display', 'none');
         }

         //correo
         if (data.responseJSON.errors.correo != undefined) {
            $('#txtCorreo').addClass('is-invalid');
            $('#vCorreo').addClass('invalid-feedback');
            $('#msgCorreo').html(data.responseJSON.errors.correo);
         } else {
            $('#txtCorreo').removeClass('is-invalid');
            $('#txtCorreo').addClass('is-valid');
            $('#vCorreo').css('display', 'none');
         }
      }
   });
});
