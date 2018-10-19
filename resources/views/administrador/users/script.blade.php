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
      "ajax"      : "{{ url('usersPermisos') }}",
      "columns"   : [
         {data: 'rut'},
         {data: 'name'},
         {data: 'apellidoPaterno'},
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

function MensajeEliminar(e, i) {
   e.preventDefault();
   var rut = $(i).attr('data-rut');

   $.alertable.confirm('<p class="text-center">¿Está seguro de eliminar el usuario con rut '+rut+'?</p>', {
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
   var url  = form.attr('action').replace(':USER_ID', id);
   var data = form.serialize();

   $.post(
      url,
      data,
      function (result) {
         row.fadeOut(); //Quitamos la fila
         $.alertable.alert(result.message).always(function(){});
   }).fail(function(data){
      // console(data);
   });
}

$('#guardar').click(function(){

   // console.log();
   // debugger;
   var idFm = $(this).attr('data-form');
   var form = $('#'+idFm);
   var url  = form.attr('action');
   var data = form.serialize();

   $.post(
      url,
      data,
      function (result) {
         $.alertable.alert(result.message, {html : true}).always(function(){
            location.reload();
         });
   }).fail(function(data){

      //debugger;
      console.log(data);

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

      //pass
      if (data.responseJSON.errors.pass != undefined) {
         $('#txtPass').addClass('is-invalid');
         $('#vPass').addClass('invalid-feedback');
         $('#msgPass').html(data.responseJSON.errors.pass);
      } else {
         $('#txtPass').removeClass('is-invalid');
         $('#txtPass').addClass('is-valid');
         $('#vPass').css('display', 'none');
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

      //direccion
      if (data.responseJSON.errors.direccion != undefined) {
         $('#txtDireccion').addClass('is-invalid');
         $('#vDireccion').addClass('invalid-feedback');
         $('#msgDireccion').html(data.responseJSON.errors.direccion);
      } else {
         $('#txtDireccion').removeClass('is-invalid');
         //$('#txtDireccion').addClass('is-valid');
         $('#vDireccion').css('display', 'none');
      }

      //correo
      if (data.responseJSON.errors.correo != undefined) {
         $('#txtCorreo').addClass('is-invalid');
         $('#vCorreo').addClass('invalid-feedback');
         $('#msgCorreo').html(data.responseJSON.errors.correo);
         console.log(data.responseJSON.errors.correo);
      } else {
         $('#txtCorreo').removeClass('is-invalid');
         $('#txtCorreo').addClass('is-valid');
         $('#vCorreo').css('display', 'none');
      }
   });
});
