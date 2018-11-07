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
   $('#dataTable-sostenedores').DataTable({

      "oLanguage" : {
         "sProcessing"        : "Procesando...",
         "sLengthMenu"        : "Mostrar _MENU_ registros por página",
         "sZeroRecords"       : "<h5 class='font-weight-light mt-5 mb-5'>No encontramos ningún sostenedor con esas características</h5>",
         "sEmptyTable"        : "<h5 class='font-weight-light mt-5 mb-5'>No existen sostenedores registrados</h5>",
         "sLoadingRecords"    : "Cargando...",
         "sInfo"              : "Mostrando _START_ a _END_ de _TOTAL_ registros",
         "sInfoEmpty"         : "Mostrando 0 a 0 de 0 sostenedores",
         "sInfoFiltered"      : "<br>(filtro aplicado en _MAX_ sostenedores)",
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
      "ajax"      : "{{ url('sostenedoresTable') }}",
      "columns"   : [
         {data: 'rut'},
         {data: 'nombre'},
         {data: 'apellidoPaterno'},
         {data: 'direccion'},
         {data: 'fono'},
         {data: 'correo'},
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
   var rut    = $(i).attr('data-rut');
   var nombre = $(i).attr('data-nombre');

   var texto = '¿Está seguro de eliminar el sostenedor <b>'+rut+' - '+nombre+'</b>?';
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
   var url  = form.attr('action').replace(':SOSTENEDOR_ID', id);
   var data = form.serialize();

   
   $.post(
      url,
      data,
      function (result) {
         row.fadeOut(); //Quita la fila del dato a eliminar
         $.alertable.alert('<p class="text-center">'+result.message+'</p>', {
            html: true
         }).always(function(){});
   }).fail(function(data){
       console.log(data);
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
         $.alertable.alert('<p class="text-center">'+result.message+'</p>', {
            html : true
         }).always(function(){
            location.reload();
         });
      
      }, error: function(data) {
         
         console.log(data);
         //debugger;

         /* VALIDACIONES */
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

         //apellidoPaterno
         if (data.responseJSON.errors.apellidoPaterno != undefined) {
            $('#txtApellidoPaterno').addClass('is-invalid');
            $('#vApellidoPaterno').addClass('invalid-feedback');
            $('#msgApellidoPaterno').html(data.responseJSON.errors.apellidoPaterno);
         } else {
            $('#txtApellidoPaterno').removeClass('is-invalid');
            $('#txtApellidoPaterno').addClass('is-valid');
            $('#vApellidoPaterno').css('display', 'none');
         }

         //apellidoMaterno
         if (data.responseJSON.errors.apellidoMaterno != undefined) {
            $('#txtApellidoMaterno').addClass('is-invalid');
            $('#vApellidoMaterno').addClass('invalid-feedback');
            $('#msgApellidoMaterno').html(data.responseJSON.errors.apellidoMaterno);
         } else {
            $('#txtApellidoMaterno').removeClass('is-invalid');
            $('#txtApellidoMaterno').addClass('is-valid');
            $('#vApellidoMaterno').css('display', 'none');
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
            //$('#txtFono').addClass('is-valid');
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





   //$.post( url, data, function(result) {
   //       $.alertable.alert(result.message, {html : true}).always(function(){
   //          location.reload();
   //       });
   // }).fail(function(data){

   //    //console.log();
   //   //debugger;

   //    /* VALIDACIONES */
   //    //rut      
   //    if (data.responseJSON.errors.rut!= undefined) {
   //       $('#txtRut').addClass('is-invalid');
   //       $('#vRut').addClass('invalid-feedback');
   //       $('#msgRut').html(data.responseJSON.errors.rut);
   //    } else {
   //       $('#txtRut').removeClass('is-invalid');
   //       $('#txtRut').addClass('is-valid');
   //       $('#vRut').css('display', 'none');
   //    }

   //    //nombre
   //    if (data.responseJSON.errors.nombre != undefined) {
   //       $('#txtNombre').addClass('is-invalid');
   //       $('#vNombre').addClass('invalid-feedback');
   //       $('#msgNombre').html(data.responseJSON.errors.nombre);
   //    } else {
   //       $('#txtNombre').removeClass('is-invalid');
   //       $('#txtNombre').addClass('is-valid');
   //       $('#vNombre').css('display', 'none');
   //    }

   //    //apellidoPaterno
   //    if (data.responseJSON.errors.apellidoPaterno != undefined) {
   //       $('#txtApellidoPaterno').addClass('is-invalid');
   //       $('#vApellidoPaterno').addClass('invalid-feedback');
   //       $('#msgApellidoPaterno').html(data.responseJSON.errors.apellidoPaterno);
   //    } else {
   //       $('#txtApellidoPaterno').removeClass('is-invalid');
   //       $('#txtApellidoPaterno').addClass('is-valid');
   //       $('#vApellidoPaterno').css('display', 'none');
   //    }

   //    //apellidoMaterno
   //    if (data.responseJSON.errors.apellidoMaterno != undefined) {
   //       $('#txtApellidoMaterno').addClass('is-invalid');
   //       $('#vApellidoMaterno').addClass('invalid-feedback');
   //       $('#msgApellidoMaterno').html(data.responseJSON.errors.apellidoMaterno);
   //    } else {
   //       $('#txtApellidoMaterno').removeClass('is-invalid');
   //       $('#txtApellidoMaterno').addClass('is-valid');
   //       $('#vApellidoMaterno').css('display', 'none');
   //    }      

   //    //direccion
   //    if (data.responseJSON.errors.direccion != undefined) {
   //       $('#txtDireccion').addClass('is-invalid');
   //       $('#vDireccion').addClass('invalid-feedback');
   //       $('#msgDireccion').html(data.responseJSON.errors.direccion);
   //    } else {
   //       $('#txtDireccion').removeClass('is-invalid');
   //       //$('#txtDireccion').addClass('is-valid');
   //       $('#vDireccion').css('display', 'none');
   //    }

   //    //correo
   //    if (data.responseJSON.errors.correo != undefined) {
   //       $('#txtCorreo').addClass('is-invalid');
   //       $('#vCorreo').addClass('invalid-feedback');
   //       $('#msgCorreo').html(data.responseJSON.errors.correo);
   //       console.log(data.responseJSON.errors.correo);
   //    } else {
   //       $('#txtCorreo').removeClass('is-invalid');
   //       $('#txtCorreo').addClass('is-valid');
   //       $('#vCorreo').css('display', 'none');
   //    }
   // });