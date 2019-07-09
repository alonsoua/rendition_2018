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
      todayBtn: 'linked',      
      autoclose: true,
      language: "es"
   });
   
   $('.fecha-pago').datepicker({
      format: 'dd-mm-yyyy',
      daysOfWeekDisabled: "0",
      todayBtn: 'linked',      
      autoclose: true,
      language: "es"
   });

   $('.fecha-desde').datepicker({
      format: 'yyyy-mm-dd',
      todayBtn: 'linked',
      daysOfWeekDisabled: "0",
      autoclose: true,
      language: "es"
   });

   $('.fecha-hasta').datepicker({
      format: 'yyyy-mm-dd',
      todayBtn: 'linked',
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

    $('.select-funcionarios').chosen({         
         no_results_text: 'No se encontró el Funcionario',
         width : '100%',         
      });
   
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

   $('.select-formaPagos').chosen({
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
  
   fetch_data('no');
   
   function fetch_data (info, desde = '', hasta = '') {
      
      if (info === 'no') {
         var url = "../honorariosTable";
      } else {
         var url = 'honorarios/getRangoFecha/'+desde+'/'+hasta+'';
      }

      $.fn.dataTable.ext.classes.sPagination = 'pagination pagination-sm';
      $('#dataTable-honorarios').DataTable({
         "processing": true,
         "oLanguage" : {
            "sProcessing"        : "Procesando...",
            "sLengthMenu"        : "Mostrar _MENU_ registros por página",
            "sZeroRecords"       : "<h5 class='font-weight-light mt-5 mb-5'>No encontramos ninguna boleta de honorario con esas características</h5>",
            "sEmptyTable"        : "<h5 class='font-weight-light mt-5 mb-5'>No existen honorarios registrados</h5>",
            "sLoadingRecords"    : "Cargando...",
            "sInfo"              : "Mostrando _START_ a _END_ de _TOTAL_ registros",
            "sInfoEmpty"         : "Mostrando 0 a 0 de 0 honorarios",
            "sInfoFiltered"      : "<br>(filtro aplicado en _MAX_ honorarios)",
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
         "ajax"      : url, 
         "columns"   : [

            {
               data: 'establecimiento.nombre', 
               name: 'establecimiento.nombre'
            },
            
            {
               data: 'establecimiento.rbd', 
               name: 'establecimiento.rbd'
            },

            {
               data: 'subvencion.nombre',      
               name: 'subvencion.nombre'
            },

            {
               data: 'cuenta.codigo', 
               name: 'cuenta.codigo'
            },


            {
               data: 'documento.nombre',       
               name: 'documento.nombre'
            },      

            {
               data: 'numDocumento',            
               name: 'honorarios.numDocumento'
            },
            {
               data: 'fechaDocumento',            
               name: 'honorarios.fechaDocumento',
               render: function formatoFecha (data) {
                  var fecha = data;
                  return fecha.replace(/^(\d{4})-(\d{2})-(\d{2})$/g,'$3/$2/$1');
               }
            },
            {
               data: 'fechaPago',            
               name: 'honorarios.fechaPago' ,
               render: function formatoFecha (data) {
                  var fecha = data;
                  return fecha.replace(/^(\d{4})-(\d{2})-(\d{2})$/g,'$3/$2/$1');
               }
            },

            {
               data: 'descripcion',            
               name: 'honorarios.descripcion'
            },

            { 
               data: 'proveedor.rut',  
               name: 'proveedor.rut',
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
            { 
               data: 'proveedor.razonSocial',  
               name: 'proveedor.razonSocial'
            },
            {
               data: 'montoGasto',             
               name: 'honorarios.montoGasto',
               render: $.fn.dataTable.render.number( '.', '.', 0, '$' )
            },
            {  
               data: 'montoDocumento',         
               name: 'honorarios.montoDocumento' ,
               render: $.fn.dataTable.render.number( '.', '.', 0, '$' )
            },
            {
               data: 'estado',
               className:'estado',
               name: 'honorarios.estado'
            },
            {
               data: 'opciones'
            },

         ],
          "columnDefs": [ 
               { 
                  "visible": false, "targets": [0,1,7,9] 
               } 
           ], 
           dom: 'Bfrtip',
           buttons: [          
               {
                  extend: 'csv',
                  className: 'btn btn-primary btn-sm mr-1 float-left',
                  exportOptions: { 
                     orthogonal: 'export', 
                     columns: [ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12 ]
                  },
               },
                  
           ],

         "drawCallback": function () {
            $('.dataTables_paginate > .pagination').addClass('pagination-sm');
         },      
      });
   }

   $("#desde").change(function(){
      var desde = $("#desde").val();
      var hasta = $("#hasta").val();      
      if (desde != '' & hasta != '') {
         $("#dataTable-honorarios").DataTable().destroy();
         fetch_data('yes', desde, hasta);
      }
   });

   $("#hasta").change(function(){
      var desde = $("#desde").val();
      var hasta = $("#hasta").val();      
      if (desde != '' & hasta != '') {
         $("#dataTable-honorarios").DataTable().destroy();
         fetch_data('yes', desde, hasta);
      }
   });

   if ($("#form-agregar").length) {
      $('#msgVacio').remove();
   }
   

   // var checked = $('[name=reembolsable]').prop('checked');
   
   // if (checked) {            
   //    $('#lstFuncionario_chosen').css('display', 'block');      
   //    $('#lblFuncionario').css('display', 'block');      
   //    $('#vFuncionario').css('display', 'block');      
   // }else {      
   //    $('#lstFuncionario_chosen').css('display', 'none');      
   //    $('#lblFuncionario').css('display', 'none');
   //    $('#vFuncionario').css('display', 'none');
   // }

});

function MensajeEliminar(e, i) {
   e.preventDefault();
   // var rbd     = $(i).attr('data-rbd');
   var descripcion  = $(i).attr('data-descripcion');

   var texto = '¿Está seguro que desea eliminar el gasto <b>'+descripcion+'</b>?';

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
   var url  = form.attr('action').replace(':HONORARIO_ID', id);
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

function ModificarEstado (e, i) {

   var idHonorario = $(i).attr('id');
   var estado = $(i).attr('data-estado');

   $.get('modificarEstadoHonorario/'+idHonorario+'/'+estado+'', function(data) {
      location.reload();
   });

}

$('#lstEstablecimiento').on('change', function(e){
   var idEstablecimiento = e.target.value;   
   $('#idEstablecimiento').val(idEstablecimiento);

   
   $.get('getFuncionariosTipoContrato/' +idEstablecimiento+'/3', function(data) {
      
      $('#lstFuncionario').empty();
      
      //Carga lstFuncionario en select
      $('#lstFuncionario').append('<option value="0" disable="false" selected="true">Seleccione Funcionario</option>');
      if ($.isEmptyObject(data)) {
            
         $('#lstFuncionario').addClass('is-invalid');
         $('#vFuncionario').css('display', 'block');
         $('#vFuncionario').addClass('invalid-feedback');
         $('#msgFuncionario').html('El establecimiento seleccionado, no tiene funcionarios agregados.');
                  
      }else {
         $('#lstFuncionario').removeClass('is-invalid');
         $('#lstFuncionario').addClass('is-valid');
         $('#vFuncionario').css('display', 'none');
      }



      $.each(data, function(id, funcionario){                 
         $('#lstFuncionario').append('<option value="'+id+'">'+funcionario+'</option>');
         $('#lstFuncionario').removeAttr('disabled');      
      });      
      
      //Actualiza Select
      $("#lstFuncionario").trigger("chosen:updated");

   });
});

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

$('#lstCuenta').on('change', function(e){
   var idCuenta = e.target.value;   
   // $('#idCuenta').val(idCuenta);


   $.get('getDocumentos/'+idCuenta+'', function(data) {

      // console.log(data);
      // debugger;
      $('#lstTipoDocumento').empty();
      
      //Carga lstTipoDocumento en select
      $('#lstTipoDocumento').append('<option value="0" disable="false" selected="true">Seleccione Tipo Documento</option>');

      $.each(data, function(index, documento){        
         $('#lstTipoDocumento').append('<option value="'+documento.id+'">'+documento.nombre+'</option>');
         $('#lstTipoDocumento').removeAttr('disabled');
      });      
      
      //Actualiza Select
      $("#lstTipoDocumento").trigger("chosen:updated");

   });
});

// $('#lstEstablecimiento').on('change', function(e){
      
//    var idEstablecimiento = e.target.value;   

//    $.get('getFuncionariosTipoContrato/'+idEstablecimiento+'-3', function(data) {

//       console.log(data);
//       debugger;
//       // $('#lstTipoDocumento').empty();
      
//       // //Carga lstTipoDocumento en select
//       // $('#lstTipoDocumento').append('<option value="0" disable="false" selected="true">Seleccione Tipo Documento</option>');

//       // $.each(data, function(index, documento){        
//       //    $('#lstTipoDocumento').append('<option value="'+documento.id+'">'+documento.nombre+'</option>');
//       //    $('#lstTipoDocumento').removeAttr('disabled');
//       // });      
      
//       // //Actualiza Select
//       // $("#lstTipoDocumento").trigger("chosen:updated");

//    });

//    if (checked) {            
//       $('#lstFuncionario_chosen').css('display', 'block');      
//       $('#lblFuncionario').css('display', 'block');      
//       $('#vFuncionario').css('display', 'block');      
//    } 
//    else {      
//       $('#lstFuncionario_chosen').css('display', 'none');      
//       $('#lblFuncionario').css('display', 'none'); 
//       $('#vFuncionario').css('display', 'none');     
//    }
   
// });



$('#guardar').click(function(){
   
   var idFm = $(this).attr('data-form');
   var form = $('#'+idFm);
   var url  = form.attr('action');
   var dataArray = form.serializeArray();
   $(".cargando").css('visibility', 'visible');
   $('#lstEstado').removeAttr('disabled');

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
         $('#lstEstado').attr('disabled');
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

         //funcionario      
         if (data.responseJSON.errors.funcionario != undefined) {
            $('#lstFuncionario').addClass('is-invalid');
            $('#vFuncionario').addClass('invalid-feedback');
            $('#msgFuncionario').html(data.responseJSON.errors.funcionario);
         } else {
            $('#lstFuncionario').removeClass('is-invalid');
            $('#lstFuncionario').addClass('is-valid');
            $('#vFuncionario').css('display', 'none');
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

         //formaPago      
         if (data.responseJSON.errors.formaPago != undefined) {
            $('#lstFormaPago').addClass('is-invalid');
            $('#vFormaPago').addClass('invalid-feedback');
            $('#msgFormaPago').html(data.responseJSON.errors.formaPago);
         } else {
            $('#lstFormaPago').removeClass('is-invalid');
            $('#lstFormaPago').addClass('is-valid');
            $('#vFormaPago').css('display', 'none');
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
         debugger;
         console.log(data.responseJSON.errors.fechaDocumento);
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
