
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
      todayBtn: 'linked',      
      daysOfWeekDisabled: "0",
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

   $('.select-establecimientos').chosen({         
      no_results_text: 'No se encontró el Establecimiento',
      width : '100%',

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
   

   fetch_data('no');
   
   function fetch_data (info, desde = '', hasta = '') {
      
      if (info === 'no') {
         var url = "../liquidacionesTable";
      } else {
         var url = 'liquidaciones/getRangoFecha/'+desde+'/'+hasta+'';
      }


      $.fn.dataTable.ext.classes.sPagination = 'pagination pagination-sm';      
      var dataTable = $('#dataTable-liquidaciones').DataTable({
         "processing" : true,
         "serverSide" : true,
         "order" : [],
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
         "ajax"      : url, 

         "columns"   : [

         
            {
               data: 'funcionario.rut', 
               name: 'funcionario.rut',
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
               data: 'funcionario.rut', 
               name: 'funcionario.rut',
               render: function formatearRut(data) {
                  var rut = data.substring(0, data.length - 1);                      
                  return rut;
               }
            },
            {
               data: 'funcionario.rut', 
               name: 'funcionario.rut',
               render: function formatearDGVRut(data) {
                  var rut = data.substring(data.length - 1);                      
                  return rut;
               }
            },
            {  
               data: 'funcionario.apellidoPaterno',
               name: 'funcionario.apellidoPaterno'
            },
            {  
               data: 'funcionario.apellidoMaterno',
               name: 'funcionario.apellidoMaterno'
            },
            {
               data: 'funcionario.nombre',           
               name: 'funcionario.nombre'
            },
            {  
               data: 'fechaLiquidacion',             
               name: 'fechaLiquidacion',
               render: function formatoFecha (data) {
                  var fecha = data;
                  return fecha.replace(/^(\d{4})-(\d{2})-(\d{2})$/g,'$3/$2/$1');
               }
            },
            {
               data: 'diasTrabajados',
               name: 'liquidacions.diasTrabajados'
            },
            {  
               data: 'periodo.nombrePeriodo',
               name: 'periodo.nombrePeriodo'
            },
            {  
               data: 'establecimiento.nombre',
               name: 'establecimiento.nombre'
            },
            {
               data: 'establecimiento.rbd',
               name: 'establecimiento.rbd'
            }, 
            {
               data: 'codigoTipoContrato',
               name: 'tipo_contrato.codigoTipoContrato'
            }, 
            {
               data: 'funcionario.horasCtoSemanal',           
               name: 'funcionario.horasCtoSemanal'
            },
            {
               data: 'funcionario.fechaInicioContrato',           
               name: 'funcionario.fechaInicioContrato',
               render: function formatoFecha (data) {
                  var fecha = data;
                  return fecha.replace(/^(\d{4})-(\d{2})-(\d{2})$/g,'$3-$2-$1');
               }
            },
            {
               data: 'codigoFuncion',           
               name: 'funcion.codigoFuncion'
            },
            {
               data: 'fechaLiquidacion',           
               name: 'fechaLiquidacion',
               render: function formatoFecha (data) {
                  var fecha = data;
                  var mes = fecha.replace(/^(\d{4})-(\d{2})-(\d{2})$/g,'$2');
                  var primerDigito = mes.substr(0,1);
                  if (primerDigito == 0) {
                     mes = mes.substr(1,2);
                  }
                  return mes;
               }
            },
            {
               data: 'fechaLiquidacion',           
               name: 'fechaLiquidacion',
               render: function formatoFecha (data) {
                  var fecha = data;
                  var ano = fecha.replace(/^(\d{4})-(\d{2})-(\d{2})$/g,'$1');                  
                  return ano;
               }
            },
            {
               data: 'diasTrabajados',
               name: 'liquidacions.diasTrabajados'
            },
            {
               data: 'funcionario.horasCtoSemanal',           
               name: 'funcionario.horasCtoSemanal'
            },
            {
               data: 'funcionario.fechaInicioContrato',           
               name: 'funcionario.fechaInicioContrato',
               render: function formatoFecha (data) {
                  var fecha = data;
                  return fecha.replace(/^(\d{4})-(\d{2})-(\d{2})$/g,'$3-$2-$1');
               }
            },            
            {
               data: 'subgeneral_ley410101.valor',
               name: 'subgeneral_ley410101.valor'
            },
            // {
            //    data: 'subgeneral_ley410102.valor',
            //    name: 'subgeneral_ley410102.valor'
            // },




            {
               data: 'opciones'
            },

            // 11, 12, 13, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 
                     // 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52,
                     // 53, 54, 55, 56, 57, 58, 59, 60, 61, 62, 63, 64, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 
                     // 78, 79, 80, 81, 82, 83, 84, 85, 86, 87, 88, 89, 90, 91, 92, 93, 94, 95, 96, 97, 98, 99, 100, 101, 
                     // 102, 103, 104, 105, 106, 107, 108, 109, 110, 111, 112, 113, 114, 115, 116, 117, 118, 119, 120
         ],
          "columnDefs": [ 
               { 
                  "visible": false, 
                  "targets": [ 1, 2, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20]
               } 
           ], 
           dom: 'Bfrtip',
           buttons: [          
               {
                  extend: 'csv',
                  className: 'btn btn-primary btn-sm mr-1 float-left',                  
                  customize: function(doc) {

                     //AGREGAMOS 2 FILAS DE CSV LIQUIDACIONES
                     var row1 = "DATGEN,DATGEN,DATGEN,DATGEN,DATGEN,DATGEN,DATGEN,DATGEN,DATGEN,DATGEN,DATGEN,DATGEN,DATGEN,DATGEN,DATGEN,GENERAL,GENERAL,GENERAL,GENERAL,GENERAL,GENERAL,GENERAL,GENERAL,GENERAL,GENERAL,GENERAL,GENERAL,GENERAL,GENERAL,GENERAL,GENERAL,GENERAL,GENERAL,GENERAL,GENERAL,GENERAL,GENERAL,GENERAL,GENERAL,GENERAL,GENERAL,GENERAL,SEP,SEP,SEP,SEP,SEP,SEP,SEP,SEP,PIE,PIE,PIE,PIE,PIE,PIE,PIE,PIE,PRORETENCION,PRORETENCION,PRORETENCION,PRORETENCION,PRORETENCION,PRORETENCION,INTERNADO,INTERNADO,INTERNADO,INTERNADO,INTERNADO,INTERNADO,INTERNADO,REFUERZO,REFUERZO,REFUERZO,REFUERZO,REFUERZO,REFUERZO,HABERNOREND,TOTALHABER,DESCUENTO,DESCUENTO,DESCUENTO,DESCUENTO,DESCUENTO,DESCUENTO,DESCUENTO,DESCUENTO,DESCUENTO,DESCUENTO,DESCUENTO,DESCUENTO,TOTALDESCUENTO,LIQUIDO,GENERAL,GENERAL,GENERAL,GENERAL,PIE,PIE,PIE,PIE,SEP,SEP,SEP,SEP,PRORETENCION,PRORETENCION,PRORETENCION,PRORETENCION,INTERNADO,INTERNADO,INTERNADO,INTERNADO,REFUERZO,REFUERZO,REFUERZO,REFUERZO";
                     var row2 = "RUT,DGV,APP,APM,NOM,RBD,TIP,HC,FEI,FUN,MES,ANIO,DIASTR,HCSEP,FEISEP,410101,410102,410103,410104,410105,410106,410107,410109,410110,410112,410113,410115,410116,410117,410118,410119,410121,410123,410125,410126,410201,410202,410203,410204,410205,410206,410207,410101,410102,410104,410105,410116,410119,410121,410124,410101,410102,410103,410104,410105,410116,410119,410121,410101,410102,410104,410116,410119,410121,410101,410102,410104,410106,410116,410119,410121,410101,410102,410104,410116,410119,410121,HABERNOREND,TOTALHABER,PRE,AAF,SAL,ASA,IMP,CCA,DIF,DIS,REJ,SCE,ANT,ODV,TOTALDESCUENTO,LIQUIDO,410401,410402,410403,410404,410401,410402,410403,410404,410401,410402,410403,410404,410401,410402,410403,410404,410401,410402,410403,410404,410401,410402,410403,410404";

                     return row1 + "\n" + row2 + "\n" + doc;
                  },                 
                  // header: false,                     
                  exportOptions: { 
                     orthogonal: 'export',                     
                     columns: [ 1, 2, 3, 4, 5, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21]
                  },
               },
                  // , 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 
                  //    28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52,
                  //    53, 54, 55, 56, 57, 58, 59, 60, 61, 62, 63, 64, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 
                  //    78, 79, 80, 81, 82, 83, 84, 85, 86, 87, 88, 89, 90, 91, 92, 93, 94, 95, 96, 97, 98, 99, 100, 101, 
                  //    102, 103, 104, 105, 106, 107, 108, 109, 110, 111, 112, 113, 114, 115, 116, 117, 118, 119, 120
           ],

           

         "drawCallback": function () {
            $('.dataTables_paginate > .pagination').addClass('pagination-sm');
         }

      });
   }

   $("#desde").change(function(){
      var desde = $("#desde").val();
      var hasta = $("#hasta").val();      
      if (desde != '' & hasta != '') {
         $("#dataTable-liquidaciones").DataTable().destroy();
         fetch_data('yes', desde, hasta);
      }
   });

   $("#hasta").change(function(){
      var desde = $("#desde").val();
      var hasta = $("#hasta").val();      
      if (desde != '' & hasta != '') {
         $("#dataTable-liquidaciones").DataTable().destroy();
         fetch_data('yes', desde, hasta);
      }
   });


   if ($("#form-agregar").length) {
      $('#msgVacio').remove();
   }


   //Aquí es donde te digo que le hablo al document, le ligo el evento, le digo que selectores y le paso lo que quiero que haga
   $( document ).on( 'click', '.chk', function(){
      var name = $(this).attr('name');
      var checked = $(this).prop('checked');
      

      if (name != undefined) {         
         var nameInput = name.substring(3);         
         if (checked == true) {
            $('.divInput'+nameInput).removeClass('d-none');
         } else {
            
            $('.divInput'+nameInput).addClass('d-none');
            $('.divInput'+nameInput).val(null);
         }
      }

   });


});


// $('#navLiquidacion').click(function(){
//    $('#subvenciones').css('display', 'none');
//    $('#liquidacion').css('display', 'block');
//    $('#navSubvenciones').removeClass("active");
//    $('#navSubvenciones').css('color' , '#495057');
//    $('#descuentos').css('display', 'none');
//    $('#navDescuentos').removeClass('active');
//    $('#navDescuentos').css('color' , '#495057');
   
//    $(this).removeClass("active");
//    $(this).addClass('active');
// });

// $('#navSubvenciones').click(function(){
//    $('#liquidacion').css('display', 'none');
//    $('#navLiquidacion').removeClass('active');
//    $('#navLiquidacion').css('color' , '#495057');
//    $('#descuentos').css('display', 'none');
//    $('#navDescuentos').removeClass('active');
//    $('#navDescuentos').css('color' , '#495057');

//    $('#subvenciones').css('display', 'block');
//    $(this).removeClass("active");
//    $(this).addClass('active');
// });

// $('#navDescuentos').click(function(){
//    $('#liquidacion').css('display', 'none');
//    $('#navLiquidacion').removeClass('active');
//    $('#navLiquidacion').css('color' , '#495057');
//    $('#subvenciones').css('display', 'none');   
//    $('#navSubvenciones').removeClass("active");
//    $('#navSubvenciones').css('color' , '#495057');

//    $('#descuentos').css('display', 'block');
//    $(this).removeClass("active");
//    $(this).addClass('active');
// });

function MensajeEliminar(e, i) {
   e.preventDefault();   
   var nombre  = $(i).attr('data-nombre');
   var apellido  = $(i).attr('data-apellido');
   var rut  = $(i).attr('data-rut');
   var fecha  = $(i).attr('data-fecha');

   var texto = '¿Está seguro de eliminar la Liquidación de <b>'+nombre+' '+apellido+' - '+rut+'</b> con fecha <b>'+fecha+'</b>?';

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
   var url  = form.attr('action').replace(':LIQUIDACION_ID', id);
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




// $('#lstSubvencion').on('change', function(e){
//    var idSubvencion = e.target.value;   
//    $('#idSubvencion').val(idSubvencion);


//    $.get('getCuentas/'+idSubvencion+'', function(data) {

//       $('#lstCuenta').empty();
      
//       //Carga lstCuenta en select
//       $('#lstCuenta').append('<option value="0" disable="false" selected="true">Seleccione Cuenta</option>');

//       $.each(data, function(index, cuenta){        
//          $('#lstCuenta').append('<option value="'+cuenta.id+'">'+cuenta.nombre+'</option>');
//          $('#lstCuenta').removeAttr('disabled');
//       });      
      
//       //Actualiza Select
//       $("#lstCuenta").trigger("chosen:updated");

//    });
// });



$('#btnImprimir').on('click', function(e){
   
   var desde = $("#desde").val();
   var hasta = $("#hasta").val();      

   if (desde != '' & hasta != '') {

      $.get('liquidaciones/imprimirLiquidaciones/'+desde+'/'+hasta+'', function() {            
      });
   }   
});



$('#lstEstablecimiento').on('change', function(e){

   var idEstablecimiento = e.target.value;   
   $('#idEstablecimiento').val(idEstablecimiento);
   
   $.get('getFuncionarios/' +idEstablecimiento, function(data) {
   
      //Deja lstFuncionario Vacío
      $('#lstFuncionario').empty();

      //Muestra Sned
      // if (data.sned == 1) {
      //    $('.divInputSned').removeClass('d-none');   
      //    $('#snedHidden').val(1);
      // } else {
      //    $('.divInputSned').addClass('d-none');
      //    $('#snedHidden').val(0);
      // }
      
      //Carga lstFuncionario en select
      $('#lstFuncionario').append('<option value="0" disable="false" selected="true">Seleccione Funcionario</option>');
      if ($.isEmptyObject(data.funcionarios)) {
            
         $('#lstFuncionario').addClass('is-invalid');
         $('#vFuncionario').css('display', 'block');
         $('#vFuncionario').addClass('invalid-feedback');
         $('#msgFuncionario').html('El establecimiento seleccionado, no tiene funcionarios agregados.');
                  
      }else {
         $('#lstFuncionario').removeClass('is-invalid');
         $('#lstFuncionario').addClass('is-valid');
         $('#vFuncionario').css('display', 'none');
      }

      $.each(data.funcionarios, function(id, funcionario){                 
         $('#lstFuncionario').append('<option value="'+id+'">'+funcionario+'</option>');
         $('#lstFuncionario').removeAttr('disabled');      
      });      
      
      //Actualiza Select
      $("#lstFuncionario").trigger("chosen:updated");

   });
   
});
   

$('#lstFuncionario').on('change', function(e){

   var idEstablecimiento = $("#lstEstablecimiento").val();
   var idFuncionario     = $("#lstFuncionario").val();
    
   $(".cargando").css('visibility', 'visible'); 
   
   var idAno = 1;
   $.get('getPeriodos/' +idAno+'/' +idEstablecimiento, function(data) {
      
      //Deja lstPeriodo Vacio
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


$('#lstPeriodo').on('change', function(e){

   lstPeriodo();

});

function lstPeriodo () {

   var idPeriodo         = $("#lstPeriodo").val();
   var idEstablecimiento = $("#lstEstablecimiento").val();
   var idFuncionario     = $("#lstFuncionario").val();
   var editar            = $("#editar").val();

   if (editar == 0) {
      var link = 'horasContrato/'+idFuncionario+'/'+idEstablecimiento+'/'+idPeriodo;
   } else {
      var link = '/rrhh/liquidaciones/horasContrato/'+idFuncionario+'/'+idEstablecimiento+'/'+idPeriodo;
   }
   
   valorImputables(link);
}

function valorImputables (link) {

   $.get(link, function(data) {      

      var valorSubv      = 0;
      var valorSubRemove = 0;
      var valorTotal = 0;
      $.each(data, function(index, detalleLey) {

         if (index === "0") {
            
            var periodo = detalleLey.periodo.substr(0, 2);

            $('.bonoVacaciones').addClass('d-none');
            $('.aguinaldoPatria').addClass('d-none');
            $('.aguinaldoNavidad').addClass('d-none');
            $('.bonoSae').addClass('d-none');
            // $('.divInputReliquidacionSned').addClass('d-none');

            if (periodo === '01') {
               $('.bonoVacaciones').removeClass('d-none');
            }else if (periodo === '09') {
               $('.aguinaldoPatria').removeClass('d-none');
            } else if (periodo === '12') {               
               //Muestra Reajuste Sned
               // if (sned == 1) {
               //    $('.divInputReliquidacionSned').removeClass('d-none');  
               // } else {
               //    $('.divInputReliquidacionSned').addClass('d-none');
               // }               

               $('.aguinaldoNavidad').removeClass('d-none');
               $('.bonoSae').removeClass('d-none');
            } 
      
         } else {


            $("#txtHoras"+detalleLey.idLey).val(detalleLey.horas);               
                     
            var valorSueldo = parseInt(detalleLey.horas) * parseInt(detalleLey.valorHora);                     
            
            //REAJUSTE
            // if (detalleLey.reajuste == 1 && valorSueldo > 0) { //Establecimiento si tiene reajuste
            //    console.log(detalleLey.porcentajeReajuste);
            //    valorSueldo = (valorSueldo * parseInt(detalleLey.porcentajeReajuste)) + valorSueldo;   
            //    console.log(valorSueldo);               
            // } 

            $("#txtValor"+detalleLey.idLey).val(formatoMiles(valorSueldo));   

            $("#txtValor"+detalleLey.idLey).attr('data-valorHora', detalleLey.valorHora);   
            
            valorTotal = valorTotal + valorSueldo;

            if (detalleLey.sned == 1) {   //Establecimiento con sned

               if (  
                        detalleLey.codigoFuncion == 'DOCAUL' 
                     || detalleLey.codigoFuncion == 'DOCDIR' 
                     || detalleLey.codigoFuncion == 'DOCTEP'
               ) {               
                  $(".410110").remove(); //Elimina sned asistente
               } 
               else if (  
                        detalleLey.codigoFuncion == 'ASIAUX' 
                     || detalleLey.codigoFuncion == 'ASIPAR' 
                     || detalleLey.codigoFuncion == 'ASIPRO'
               ) {                  
                  $(".410109").remove(); //Elimina sned docente
               } 
               else {
                  $(".410109").remove(); //Elimina sned docente
                  $(".410110").remove(); //Elimina sned asistente
               }

            } else if (detalleLey.sned == 0) { //Establecimiento sin sned
               
               if (detalleLey.codigoLey == 410109 || detalleLey.codigoLey == 410110) {
                  $("#tr"+detalleLey.idLey).remove(); //elimina SNEDS
               } 
            }
         }
      });         
      $('#totalImponible').val(formatoMiles(valorTotal));

   });
}


function calcularValorSueldo(idLey) {

   var diasTrabajados = parseInt($('#txtDiasTrabajados').val());   
   var horas          = $("#txtHoras"+idLey).val();   
   var valor          = $("#txtValor"+idLey).val().replace('.', '');
   var valorHora      = $("#txtValor"+idLey).attr('data-valorHora').replace('.', '');   
   var totalImponible = $('#totalImponible').val().replace('.', '');

   // VALOR SUELDO
   var valorSueldo = horas * valorHora; 

   //Calculo por días trabajados
   valorSueldo = Math.round((valorSueldo / 30) * diasTrabajados);

   //Restamos el valor modificado
   totalImponible = (totalImponible - valor) + valorSueldo;

   if (horas <= 44) {
      $("#txtValor"+idLey).val(formatoMiles(valorSueldo));      
      $("#totalImponible").val(formatoMiles(totalImponible));      
   }   
}

function calculoSueldoPorDiasTrabajados () {
   
   var diasTrabajados = parseInt($('#txtDiasTrabajados').val());
   var inputs         = $('.valorHora');
   var totalImponible = 0;

   $.each( inputs, function ( key, input ) {
      var valorSueldo        = parseInt(input.value.replace('.', ''));
      var nuevoCalculoSueldo = Math.round((valorSueldo / 30) * diasTrabajados);

      $('#'+input.id).val(formatoMiles(nuevoCalculoSueldo));

      totalImponible = totalImponible + nuevoCalculoSueldo;

   });   
   $('#totalImponible').val(formatoMiles(totalImponible));         
}

$('#atras').click(function(){

   $(".cargando").css('visibility', 'visible');   

   var navActual = $('#navHidden').val();

   if (navActual == 'navImponibles') {      
      var nav = 'Liquidacion';

      //Actualiza valores imponibles
      //Luego al pasar del nav Liquidacion a Imponible 
      //calcula todo nuevamente
      lstPeriodo();

   } else if (navActual == 'navDescuentos') {
      var nav = 'Imponibles';
   }

   //NAV
   $("#navLiquidacion").removeClass('active');
   $("#navLiquidacion").addClass('disabled');
   $("#navImponibles").removeClass('active');
   $("#navImponibles").addClass('disabled');
   $("#navDescuentos").removeClass('active');
   $("#navDescuentos").addClass('disabled');

   $("#nav"+nav).addClass('active');

   //INCLUDE
   $("#includeLiquidacion").addClass('d-none');
   $("#includeImponibles").addClass('d-none');
   $("#includeDescuentos").addClass('d-none');

   $("#include"+nav).removeClass('d-none');      

   //SETEMAMOS INPUT HIDDEN
   $('#navHidden').val('nav'+nav);

   
   if (nav == 'Liquidacion') {
      //BTN GUARDAR
      $('.divBtnSiguiente').removeClass('d-none');
      $('.divBtnGuardar').removeClass('d-none');
      $('.divBtnGuardar').addClass('d-none');
      
      //BTN VOLVER               
      $('.divBtnVolver').removeClass('d-none');
      $('.divBtnAtras').removeClass('d-none');
      $('.divBtnAtras').addClass('d-none');         

   } else if (nav == 'Imponibles') {               
      //BTN GUARDAR
      $('.divBtnSiguiente').removeClass('d-none');
      $('.divBtnGuardar').removeClass('d-none');
      $('.divBtnGuardar').addClass('d-none');

      //BTN VOLVER               
      $('.divBtnAtras').removeClass('d-none');
      $('.divBtnVolver').removeClass('d-none');
      $('.divBtnVolver').addClass('d-none');         
   } 

   $(".cargando").css('visibility', 'hidden');

});


$('#siguiente').click(function(){
   var idFm = $(this).attr('data-form');
   var form = $('#'+idFm);
   var url  = form.attr('action');      
   var dataArray = form.serializeArray();

   $.post(
      url,
      dataArray,      
      function (result) {
         if (result.reload != 'nav') {            
            $.alertable.alert(result.message, {html : true}).always(function(){
               
               $(".cargando").css('visibility', 'visible');
               
               if (result.reload == 'ok') {            
                  location.reload();            
               } else if (result.reload == 'no') {            
                  $(".cargando").css('visibility', 'hidden');
               }

            });
         } else {
            
            $(".cargando").css('visibility', 'visible');

            //NAV
            $("#navLiquidacion").removeClass('active');
            $("#navLiquidacion").addClass('disabled');
            $("#navImponibles").removeClass('active');
            $("#navImponibles").addClass('disabled');
            $("#navDescuentos").removeClass('active');
            $("#navDescuentos").addClass('disabled');

            $("#nav"+result.message).addClass('active');

            //INCLUDE
            $("#includeLiquidacion").addClass('d-none');
            $("#includeImponibles").addClass('d-none');
            $("#includeDescuentos").addClass('d-none');

            $("#include"+result.message).removeClass('d-none');      

            //SETEMAMOS INPUT HIDDEN
            $('#navHidden').val('nav'+result.message);

            if (result.message == 'Imponibles') {      

               //CALCULA DÍAS FALTADOS
               calculoSueldoPorDiasTrabajados();


               //BTN GUARDAR
               $('.divBtnSiguiente').removeClass('d-none');
               $('.divBtnGuardar').removeClass('d-none');
               $('.divBtnGuardar').addClass('d-none');

               //BTN VOLVER               
               $('.divBtnAtras').removeClass('d-none');
               $('.divBtnVolver').removeClass('d-none');
               $('.divBtnVolver').addClass('d-none');         

            } else if (result.message == 'Descuentos') {
               //BTN GUARDAR
               $('.divBtnGuardar').removeClass('d-none');
               $('.divBtnSiguiente').removeClass('d-none');
               $('.divBtnSiguiente').addClass('d-none');

               //BTN VOLVER               
               $('.divBtnAtras').removeClass('d-none');
               $('.divBtnVolver').removeClass('d-none');
               $('.divBtnVolver').addClass('d-none');   
            }

            $(".cargando").css('visibility', 'hidden');

         }
   }).fail(function(data) {      
      validaciones(data);         
   });
});

$('#guardar').click(function(){
   
   var idFm = $(this).attr('data-form');
   var form = $('#'+idFm);
   var url  = form.attr('action');   

   var dataArray = form.serializeArray();

   $.post(
      url,
      dataArray,      
      function (result) {

         $.alertable.alert(result.message, {html : true}).always(function(){
            $(".cargando").css('visibility', 'visible');
            if (result.reload == 'ok') {
               location.reload();
            } else {               
               $(".cargando").css('visibility', 'hidden');               
            }
         });
   }).fail(function(data){      
      validaciones(data);         
   });
});

function validaciones (data) {
   
   /* VALIDACIONES */
   //establecimiento      
   if (data.responseJSON.errors.establecimiento != undefined) {
      $('#vEstablecimiento').removeClass('d-none');
      $('#lstEstablecimiento').addClass('is-invalid');
      $('#vEstablecimiento').addClass('invalid-feedback');
      $('#msgEstablecimiento').html(data.responseJSON.errors.establecimiento);
   } else {
      $('#lstEstablecimiento').removeClass('is-invalid');
      $('#lstEstablecimiento').addClass('is-valid');
      $('#vEstablecimiento').addClass('d-none');
   }

   //funcionario      
   if (data.responseJSON.errors.funcionario != undefined) {
      $('#vFuncionario').removeClass('d-none');
      $('#lstFuncionario').addClass('is-invalid');
      $('#vFuncionario').addClass('invalid-feedback');
      $('#msgFuncionario').html(data.responseJSON.errors.funcionario);
   } else {
      $('#lstFuncionario').removeClass('is-invalid');
      $('#lstFuncionario').addClass('is-valid');
      $('#vFuncionario').addClass('d-none');
   }

   //periodo      
   if (data.responseJSON.errors.periodo != undefined) {
      $('#vPeriodo').removeClass('d-none');
      $('#lstPeriodo').addClass('is-invalid');
      $('#vPeriodo').addClass('invalid-feedback');
      $('#msgPeriodo').html(data.responseJSON.errors.periodo);
   } else {
      $('#lstPeriodo').removeClass('is-invalid');
      $('#lstPeriodo').addClass('is-valid');
      $('#vPeriodo').addClass('d-none');
   }

   //fechaLiquidacion   
   if (data.responseJSON.errors.fechaLiquidacion != undefined) {
      $('#vFechaLiquidacion').removeClass('d-none');
      $('#txtFechaLiquidacion').addClass('is-invalid');
      $('#vFechaLiquidacion').addClass('invalid-feedback');
      $('#msgFechaLiquidacion').html(data.responseJSON.errors.fechaLiquidacion);
   } else {
      $('#txtFechaLiquidacion').removeClass('is-invalid');
      $('#txtFechaLiquidacion').addClass('is-valid');
      $('#vFechaLiquidacion').addClass('d-none');
   }

   //diasTrabajados
   if (data.responseJSON.errors.diasTrabajados != undefined) {
      $('#txtDiasTrabajados').addClass('is-invalid');
      $('#vDiasTrabajados').removeClass('d-none');
      $('#txtDiasTrabajados').removeClass('is-valid');
      $('#vDiasTrabajados').addClass('invalid-feedback');
      $('#msgDiasTrabajados').html(data.responseJSON.errors.diasTrabajados);
   } else {
      $('#txtDiasTrabajados').removeClass('is-invalid');
      $('#txtDiasTrabajados').addClass('is-valid');
      $('#vDiasTrabajados').addClass('d-none');
   }

   //sned
   // if (data.responseJSON.errors.sned != undefined) {
   //    $('#txtSned').addClass('is-invalid');
   //    $('#vSned').removeClass('d-none');
   //    $('#txtSned').removeClass('is-valid');
   //    $('#vSned').addClass('invalid-feedback');
   //    $('#msgSned').html(data.responseJSON.errors.sned);
   // } else {
   //    $('#txtSned').removeClass('is-invalid');
   //    $('#txtSned').addClass('is-valid');
   //    $('#vSned').addClass('d-none');
   // }
}
