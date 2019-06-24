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
      "processing": true,
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
         {
            data: 'rut',
            render: function formateaRut(data) {
               var rut = data;
               var actual = rut.replace(/^0+/, "");
               if (actual != '' && actual.length > 1) {
                  var sinPuntos = actual.replace(/\./g, "");
                  var actualLimpio = sinPuntos.replace(/-/g, "");
                  var inicio = actualLimpio.substring(0, actualLimpio.length - 1);
                  var rutPuntos = "";
                  var i = 0;
                  var j = 1;
                  for (i = inicio.length - 1; i >= 0; i--) {
                     var letra = inicio.charAt(i);
                     rutPuntos = letra + rutPuntos;
                     if (j % 3 == 0 && j <= inicio.length - 1) {
                        rutPuntos = "." + rutPuntos;
                     }
                     j++;
                  }
                  var dv = actualLimpio.substring(actualLimpio.length - 1);
                  rutPuntos = rutPuntos + "-" + dv;
               }                
               return rutPuntos;
            }
         },
         {data: 'name'},
         // {data: 'apellidoPaterno'},
         {data: 'email'},
         {data: 'opciones'},
      ],
         dom: 'Bfrtip',
         buttons: [
            {
               extend: 'pdfHtml5',
               className: 'btn btn-primary btn-sm mr-1 float-left',
               exportOptions: { 
                  orthogonal: 'export', 
                  columns: [ 0, 1, 2]
               },
            },
            {
               extend: 'csv',
               className: 'btn btn-primary btn-sm mr-1 float-left',
               exportOptions: { 
                  orthogonal: 'export', 
                  columns: [ 0, 1, 2]
               },
            },
            {
               extend: 'excelHtml5',
               className: 'btn btn-primary btn-sm mr-1 float-left',
               exportOptions: { 
                  orthogonal: 'export', 
                  columns: [ 0, 1, 2]
               },
            } 
        ],
      "drawCallback": function () {
         $('.dataTables_paginate > .pagination').addClass('pagination-sm');
      }
   });   

});



function MensajeEliminar(e, i) {
   e.preventDefault();
   var rut    = $(i).attr('data-rut');
   var nombre = $(i).attr('data-nombre');

   $.alertable.confirm('<p class="text-center">¿Está seguro de eliminar el usuario <b>'+rut+' - '+nombre+'</b>?</p>', {
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
         $.alertable.alert('<p class="text-center">'+result.message+'</p>', {
            html: true
         }).always(function(){});
   }).fail(function(data){
      var res = data.status;         
      
         var mensaje = '';
         if (res == 404) {
            //404 No encontró el registro
            row.fadeOut(); 
            mensaje = msgEliminadoCorrectamente('M', 'Usuario');
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
         console.log(data); 
         // debugger;

         /* VALIDACIONES */
         //rol      
         if (data.responseJSON.errors.rol != undefined) {
            $('#lstRol').addClass('is-invalid');
            $('#vRol').addClass('invalid-feedback');
            $('#msgRol').html(data.responseJSON.errors.rol);
         } else {
            $('#lstRol').removeClass('is-invalid');
            $('#lstRol').addClass('is-valid');
            $('#vRol').css('display', 'none');
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

         //contraseña
         if (data.responseJSON.errors.password != undefined) {
            $('#txtPass').addClass('is-invalid');
            $('#vPass').addClass('invalid-feedback');
            $('#msgPass').html(data.responseJSON.errors.password);
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
            //$('#txtApellidoMaterno').addClass('is-valid');
            $('#vApellidoMaterno').css('display', 'none');
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
         } else {
            $('#txtCorreo').removeClass('is-invalid');
            $('#txtCorreo').addClass('is-valid');
            $('#vCorreo').css('display', 'none');
         }
      }
   });
});
