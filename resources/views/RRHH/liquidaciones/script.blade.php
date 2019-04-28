$(document).ready(function(){

   /*
   |--------------------------------------------------------------------------
   | Boostrap-DatePicker
   |--------------------------------------------------------------------------
   | link: https://uxsolutions.github.io/bootstrap-datepicker/?markup=input&format=&weekStart=&startDate=&endDate=&startView=0&minViewMode=0&maxViewMode=4&todayBtn=false&clearBtn=false&language=en&orientation=auto&multidate=&multidateSeparator=&keyboardNavigation=on&forceParse=on#sandbox
   | documentación: https://bootstrap-datepicker.readthedocs.io/en/latest/
   |
   */
   
   $('.fecha-liquidacion').datepicker({
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

   $('.select-funcionarios').chosen({         
      no_results_text: 'No se encontró el Funcionario',
      width : '100%'       
   });
   
   $('.select-periodos').chosen({
      // no_results_text: 'No se encontró ',
      width : '100%',
      disable_search: true
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
   $('#dataTable-liquidaciones').DataTable({

      "oLanguage" : {
         "sProcessing"        : "Procesando...",
         "sLengthMenu"        : "Mostrar _MENU_ registros por página",
         "sZeroRecords"       : "<h5 class='font-weight-light mt-5 mb-5'>No encontramos ninguna liquidación con esas características</h5>",
         "sEmptyTable"        : "<h5 class='font-weight-light mt-5 mb-5'>No existen liquidaciones registrados</h5>",
         "sLoadingRecords"    : "Cargando...",
         "sInfo"              : "Mostrando _START_ a _END_ de _TOTAL_ registros",
         "sInfoEmpty"         : "Mostrando 0 a 0 de 0 liquidaciones",
         "sInfoFiltered"      : "<br>(filtro aplicado en _MAX_ liquidaciones)",
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
      "ajax"      : "{{ url('liquidacionesTable') }}",
      "columns"   : [

      
         {data: 'funcionario.rut',              name: 'funcionario.rut',
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

         {data: 'funcionario.nombre',           name: 'funcionario.nombre'},
         {data: 'funcionario.apellidoPaterno',  name: 'funcionario.apellidoPaterno'},
         {data: 'periodo.periodo',              name: 'periodo.periodo'},
         {data: 'diasTrabajados',               name: 'liquidacions.diasTrabajados'},
         {data: 'establecimiento.nombre',       name: 'establecimiento.nombre'},
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

$('#navLiquidacion').click(function(){
   $('#subvenciones').css('display', 'none');
   $('#liquidacion').css('display', 'block');
   $('#navSubvenciones').removeClass("active");
   $('#navSubvenciones').css('color' , '#495057');
   $('#descuentos').css('display', 'none');
   $('#navDescuentos').removeClass('active');
   $('#navDescuentos').css('color' , '#495057');
   
   $(this).removeClass("active");
   $(this).addClass('active');
});

$('#navSubvenciones').click(function(){
   $('#liquidacion').css('display', 'none');
   $('#navLiquidacion').removeClass('active');
   $('#navLiquidacion').css('color' , '#495057');
   $('#descuentos').css('display', 'none');
   $('#navDescuentos').removeClass('active');
   $('#navDescuentos').css('color' , '#495057');

   $('#subvenciones').css('display', 'block');
   $(this).removeClass("active");
   $(this).addClass('active');
});

$('#navDescuentos').click(function(){
   $('#liquidacion').css('display', 'none');
   $('#navLiquidacion').removeClass('active');
   $('#navLiquidacion').css('color' , '#495057');
   $('#subvenciones').css('display', 'none');   
   $('#navSubvenciones').removeClass("active");
   $('#navSubvenciones').css('color' , '#495057');

   $('#descuentos').css('display', 'block');
   $(this).removeClass("active");
   $(this).addClass('active');
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





$('#lstPeriodo').on('change', function(e){
   // Elimina Navs   
   var idPeriodo = $("#lstPeriodo").val();
   var idEstablecimiento = $("#lstEstablecimiento").val();
   var idFuncionario = $("#lstFuncionario").val();

   if (idFuncionario == 0) {
      $("#navSubvenciones").css('display', 'none');
      $("#navDescuentos").css('display', 'none');

   }   

   $.get('horasContrato/'+idFuncionario+'/'+idEstablecimiento+'/'+idPeriodo,function(data) {
      
      $.each(data, function(index, detalleLey){
      
         $("#txtHoras"+detalleLey.idLey).val(detalleLey.horas);      
         
         // VALOR SUELDO
         var valorSueldo = parseInt(detalleLey.horas) * parseInt(detalleLey.valorHora);        
         
         $("#txtValor"+detalleLey.idLey).val(formatoMiles(valorSueldo));   

         $("#txtValor"+detalleLey.idLey).attr('data-valorHora', detalleLey.valorHora);   

         if (idFuncionario != 0) {
            $("#navSubvenciones").css('display', 'block');
            $("#navDescuentos").css('display', 'block');                     
         }         
      });
    
   });
});

function calcularValorSueldo(idLey) {

   
   var horas = $("#txtHoras"+idLey).val();   
   var valorHora = $("#txtValor"+idLey).attr('data-valorHora');   

   // VALOR SUELDO
   var valorSueldo = horas * valorHora; 

   if (horas <= 44) {
      $("#txtValor"+idLey).val(formatoMiles(valorSueldo));      
   }
}


$('#lstFuncionario').on('change', function(e){

   // ELIMINA NAVS
   $("#navSubvenciones").css('display', 'none');   
   $("#navDescuentos").css('display', 'none'); 

   var idEstablecimiento = $("#lstEstablecimiento").val();
   var idFuncionario = $("#lstFuncionario").val();
    
   $(".cargando").css('visibility', 'visible'); 
   
   var idAno = 1;
   $.get('getPeriodos/' +idAno, function(data) {
      
      $('#lstPeriodo').empty();
      
      //Carga lstPeriodo en select
      $('#lstPeriodo').append('<option value="0" disable="false" selected="true">Seleccione Periodo</option>');
      if ($.isEmptyObject(data)) {
            
         $('#lstPeriodo').addClass('is-invalid');
         $('#vPeriodo').css('display', 'block');
         $('#vPeriodo').addClass('invalid-feedback');
         $('#msgPeriodo').html('El establecimiento seleccionado, no tiene Periodos agregados.');
                  
      }else {
         $('#lstPeriodo').removeClass('is-invalid');
         $('#lstPeriodo').addClass('is-valid');
         $('#vPeriodo').css('display', 'none');
      }

      $.each(data, function(id, Periodo){                 
         $('#lstPeriodo').append('<option value="'+id+'">'+Periodo+'</option>');
         $('#lstPeriodo').removeAttr('disabled');      
      });      
      
      //Actualiza Select
      $("#lstPeriodo").trigger("chosen:updated");

   });

});

$('#lstEstablecimiento').on('change', function(e){

   // Elimina Navs
   $("#navSubvenciones").css('display', 'none');   
   $("#navDescuentos").css('display', 'none');     


   var idEstablecimiento = e.target.value;   
   $('#idEstablecimiento').val(idEstablecimiento);
   
   
   $.get('getFuncionarios/' +idEstablecimiento, function(data) {
      
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


$('[name=reembolsable]').on('click', function(e){
   
   var checked = $(this).prop('checked');

   if (checked) {            
      $('#lstFuncionario_chosen').css('display', 'block');      
      $('#lblFuncionario').css('display', 'block');      
      $('#vFuncionario').css('display', 'block');      
   } 
   else {      
      $('#lstFuncionario_chosen').css('display', 'none');      
      $('#lblFuncionario').css('display', 'none'); 
      $('#vFuncionario').css('display', 'none');     
   }
   
});



$('#guardar').click(function(){
   
   var idFm = $(this).attr('data-form');
   var form = $('#'+idFm);
   var url  = form.attr('action');
   var dataArray = form.serializeArray();

   // console.log(dataArray);
   // debugger;

   $.post(
      url,
      dataArray,
      function (result) {

         console.log(result);
         debugger;
         $.alertable.alert(result.message, {html : true}).always(function(){
            $(".cargando").css('visibility', 'visible');
            location.reload();
         });
   }).fail(function(data){
      
         console.log(data.responseJSON);
         debugger;
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

      
   });
});
