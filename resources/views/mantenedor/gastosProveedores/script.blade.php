$(document).ready(function(){


   /*
   |--------------------------------------------------------------------------
   | Chosen Select de JQuery
   |--------------------------------------------------------------------------
   | link: https://harvesthq.github.io/chosen/
   | documentación: https://harvesthq.github.io/chosen/options.html
   |
   */

   $('.select-tipoPersonas').chosen({
      disable_search: true,
      width : '100%'
   });

   $('.select-comunas').chosen({
      no_results_text: 'No se encontró la Comuna',
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
   $('#dataTable-proveedores').DataTable({
      "processing": true,
      "oLanguage" : {
         "sProcessing"        : "Procesando...",
         "sLengthMenu"        : "Mostrar _MENU_ registros por página",
         "sZeroRecords"       : "<h5 class='font-weight-light mt-5 mb-5'>No encontramos ningún proveedor con esas características</h5>",
         "sEmptyTable"        : "<h5 class='font-weight-light mt-5 mb-5'>No existen proveedores registrados</h5>",
         "sLoadingRecords"    : "Cargando...",
         "sInfo"              : "Mostrando _START_ a _END_ de _TOTAL_ registros",
         "sInfoEmpty"         : "Mostrando 0 a 0 de 0 proveedores",
         "sInfoFiltered"      : "<br>(filtro aplicado en _MAX_ proveedores)",
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
      "ajax"      : "{{ url('proveedoresTable') }}",
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
         {data: 'razonSocial'},
         {data: 'giro'},
         {data: 'direccion'},
         {data: 'fono'},
         {data: 'opciones'},
      ],
        dom: 'Bfrtip',
        buttons: [ 
            // {
            //     extend: 'print',
            //     text: 'Imprimir',
            //     className: 'btn btn-primary btn-sm mr-1 float-left',
            //     exportOptions: {
            //         columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
            //     }
            // },
            {
               extend: 'pdfHtml5',
               className: 'btn btn-primary btn-sm mr-1 float-left',
               exportOptions: { 
                  orthogonal: 'export', 
                  columns: [ 0, 1, 2, 3, 4]
               },
            }
            // ,
            // {
            //    extend: 'csv',
            //    className: 'btn btn-primary btn-sm mr-1 float-left',
            //    exportOptions: { 
            //       orthogonal: 'export', 
            //       columns: [ 0, 1, 2, 3, 4]
            //    },
            // },
            // {
            //    extend: 'excelHtml5',
            //    className: 'btn btn-primary btn-sm mr-1 float-left',
            //    exportOptions: { 
            //       orthogonal: 'export', 
            //       columns: [ 0, 1, 2, 3, 4]
            //    },
            // }    
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

   var rut         = $(i).attr('data-rut');
   var razonSocial = $(i).attr('data-razonSocial');
   var mensaje     = '¿Está seguro de eliminar el proveedor <b>'+rut+' - '+razonSocial+'</b>?';

   $.alertable.confirm('<p class="text-center">'+mensaje+'</p>', {
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
   var url  = form.attr('action').replace(':PROVEEDOR_ID', id);
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
         mensaje = msgEliminarRegistroUtilizado('M', 'Proveedor');
      } else if (res == 404) { 
         //404 No encontró el registro
         row.fadeOut(); 
         mensaje = msgEliminadoCorrectamente('M', 'Proveedor');
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
         //tipoPersona      
         if (data.responseJSON.errors.tipoPersona != undefined) {
            $('#lstTipoPersona').addClass('is-invalid');
            $('#vTipoPersona').addClass('invalid-feedback');
            $('#msgTipoPersona').html(data.responseJSON.errors.tipoPersona);
         } else {
            $('#lstTipoPersona').removeClass('is-invalid');
            $('#lstTipoPersona').addClass('is-valid');
            $('#vTipoPersona').css('display', 'none');
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

         //giro
         if (data.responseJSON.errors.giro != undefined) {
            $('#txtGiro').addClass('is-invalid');
            $('#vGiro').addClass('invalid-feedback');
            $('#msgGiro').html(data.responseJSON.errors.giro);
         } else {
            $('#txtGiro').removeClass('is-invalid');
            //$('#txtGiro').addClass('is-valid');
            $('#vGiro').css('display', 'none');
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
         if (data.responseJSON.errors.telefono != undefined) {
            $('#txtTelefono').addClass('is-invalid');
            $('#vTelefono').addClass('invalid-feedback');
            $('#msgTelefono').html(data.responseJSON.errors.telefono);
         } else {
            $('#txtTelefono').removeClass('is-invalid');
            $('#txtTelefono').addClass('is-valid');
            $('#vTelefono').css('display', 'none');
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
