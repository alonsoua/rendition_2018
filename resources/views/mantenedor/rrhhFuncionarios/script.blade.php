$(document).ready(function(){

   
   /*
   |--------------------------------------------------------------------------
   | Boostrap-DatePicker
   |--------------------------------------------------------------------------
   | link: https://uxsolutions.github.io/bootstrap-datepicker/?markup=input&format=&weekStart=&startDate=&endDate=&startView=0&minViewMode=0&maxViewMode=4&todayBtn=false&clearBtn=false&language=en&orientation=auto&multidate=&multidateSeparator=&keyboardNavigation=on&forceParse=on#sandbox
   | documentación: https://bootstrap-datepicker.readthedocs.io/en/latest/
   |
   */
   
   $('.fecha-inicio').datepicker({
      format: 'dd-mm-yyyy',
      daysOfWeekDisabled: "0",
      autoclose: true,
      language: "es"
   });
   
   $('.fecha-termino').datepicker({
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

   $('.select-afp').chosen({
      no_results_text: 'No se encontró la Afp',
      width : '100%'
   });

   $('.select-salud').chosen({
      no_results_text: 'No se encontró el Sistema de Salud',
      width : '100%'
   });

   $('.select-tipoContrato').chosen({
      no_results_text: 'No se encontró el Tipo de Contrato',
      width : '100%'
   });

   $('.select-funcion').chosen({
      no_results_text: 'No se encontró la Función',
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
   $('#dataTable-funcionarios').DataTable({
      "processing": true,
      "oLanguage" : {
         "sProcessing"        : "Procesando...",
         "sLengthMenu"        : "Mostrar _MENU_ registros por página",
         "sZeroRecords"       : "<h5 class='font-weight-light mt-5 mb-5'>No encontramos ningún funcionario con esas características</h5>",
         "sEmptyTable"        : "<h5 class='font-weight-light mt-5 mb-5'>No existen funcionarios registrados</h5>",
         "sLoadingRecords"    : "Cargando...",
         "sInfo"              : "Mostrando _START_ a _END_ de _TOTAL_ registros",
         "sInfoEmpty"         : "Mostrando 0 a 0 de 0 funcionarios",
         "sInfoFiltered"      : "<br>(filtro aplicado en _MAX_ funcionarios)",
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
      "ajax"      : "{{ url('funcionariosTable') }}",
      "columns"   : [
         
         {data: 'establecimiento.nombre',    name: 'establecimiento.nombre'},
         {
            data: 'rut',
            name: 'funcionarios.rut',
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
         {data: 'nombre',                    name: 'funcionarios.nombre'},
         {data: 'tipo_contrato.tipoContrato',name: 'tipo_contrato.tipoContrato'},
         {data: 'funcion.nombre',            name: 'funcion.nombre'},
         {data: 'opciones'},
      ],
         dom: 'Bfrtip',
         buttons: [       
            {
               extend: 'pdfHtml5',
               className: 'btn btn-primary btn-sm mr-1 float-left',
               exportOptions: { 
                  orthogonal: 'export', 
                  columns: [ 0, 1, 2, 3, 4]
               },
            },
            {
               extend: 'csv',
               className: 'btn btn-primary btn-sm mr-1 float-left',
               exportOptions: { 
                  orthogonal: 'export', 
                  columns: [ 0, 1, 2, 3, 4]
               },
            },
            {
               extend: 'excelHtml5',
               className: 'btn btn-primary btn-sm mr-1 float-left',
               exportOptions: { 
                  orthogonal: 'export', 
                  columns: [ 0, 1, 2, 3, 4]
               },
            }    
        ],
      "drawCallback": function () {
         $('.dataTables_paginate > .pagination').addClass('pagination-sm');
      }
   });

   if ($("#form-agregar").length) {
      $('#msgVacio').remove();
   }


   
   var idSalud = $('#lstSalud').val();
   
   if (idSalud == 6) {
      $('#txtUfIsapre').css('display', 'none');
      $('#lblUfIsapre').css('display', 'none');
      $('#txtUfIsapre').val(null);
      $('#vUfIsapre').css('display', 'none');   
   } else if (idSalud.length == 0) {   
      $('#txtUfIsapre').css('display', 'none');
      $('#txtUfIsapre').val(null);
      $('#lblUfIsapre').css('display', 'none');
      $('#vUfIsapre').css('display', 'none');   
   } else {
      $('#txtUfIsapre').css('display', 'block');      
      $('#lblUfIsapre').css('display', 'block');   
      $('#vUfIsapre').css('display', 'block');         
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

   $.post( url, data, function (result) {
         row.fadeOut(); //Quitamos la fila
         $.alertable.alert(result.message).always(function(){});
   }).fail(function(data){
      var res = data.status;         
   
      var mensaje = '';
      if (res == 500) {
         //500 Clave foranea
         mensaje = msgEliminarRegistroUtilizado('M', 'Funcionario');
      } else if (res == 404) { 
         //404 No encontró el registro
         row.fadeOut(); 
         mensaje = msgEliminadoCorrectamente('M', 'Funcionario');
      }

      $.alertable.alert('<p class="text-center">'+mensaje+'</p>', {html: true}).always(function(){});
   });
}

$('#navPersonal').click(function(){
   $('#subvenciones').css('display', 'none');
   $('#personal').css('display', 'block');
   $('#navSubvenciones').removeClass("active");
   $('#navSubvenciones').css('color' , '#495057');
   
   $(this).removeClass("active");
   $(this).addClass('active');
});

$('#navSubvenciones').click(function(){
   $('#personal').css('display', 'none');
   $('#subvenciones').css('display', 'block');
   $('#navPersonal').removeClass('active');
   $('#navPersonal').css('color' , '#495057');

   $(this).removeClass("active");
   $(this).addClass('active');
});



$('#lstSalud').on('change', function(e){  
   var idSalud = e.target.value;
   
   if (idSalud == 6) {
      $('#txtUfIsapre').css('display', 'none');
      $('#lblUfIsapre').css('display', 'none');
      $('#vUfIsapre').css('display', 'none');   
   } else if (idSalud.length == 0) {   
      $('#txtUfIsapre').css('display', 'none');
      $('#lblUfIsapre').css('display', 'none');
      $('#vUfIsapre').css('display', 'none');   
   } else {
      $('#txtUfIsapre').css('display', 'block');
      $('#lblUfIsapre').css('display', 'block');   
      $('#vUfIsapre').css('display', 'block');         
   }

});




$('#guardar').click(function(){

   var idFm = $(this).attr('data-form');
   var form = $('#'+idFm);
   var url  = form.attr('action');
   var dataArray = form.serializeArray();
   
   $('#navPersonal').css('color' , 'black');
   $('#navPersonal').css('background' , 'white');

   $(".cargando").css('visibility', 'visible');
   $.post(
      url,
      dataArray,
      function (result) {
         $.alertable.alert(result.message, {html : true}).always(function(){
            $(".cargando").css('visibility', 'visible');
            location.reload();
         });
   }).fail(function(data){
      $(".cargando").css('visibility', 'hidden');
      //debugger;
      console.log(data);      
      $('#navPersonal').css('color' , 'white');
      $('#navPersonal').css('background' , 'red');
      $('#navPersonal').focus();


      /* VALIDACIONES */
      //rut
      if (data.responseJSON.errors.rut != undefined) {
         $('#vSalud').css('display', 'block');
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
         $('#vSalud').css('display', 'block');
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
         $('#vSalud').css('display', 'block');
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
         $('#vSalud').css('display', 'block');
         $('#txtApellidoMaterno').addClass('is-invalid');
         $('#vApellidoMaterno').addClass('invalid-feedback');
         $('#msgApellidoMaterno').html(data.responseJSON.errors.apellidoMaterno);
      } else {
         $('#txtApellidoMaterno').removeClass('is-invalid');
         $('#txtApellidoMaterno').addClass('is-valid');
         $('#vApellidoMaterno').css('display', 'none');
      }          

      //idAfp
      if (data.responseJSON.errors.afp != undefined) {
         $('#vSalud').css('display', 'block');
         $('#lstAfp').addClass('is-invalid');
         $('#vAfp').addClass('invalid-feedback');
         $('#msgAfp').html(data.responseJSON.errors.afp);
      } else {
         $('#lstAfp').removeClass('is-invalid');
         $('#lstAfp').addClass('is-valid');
         $('#vAfp').css('display', 'none');
      }


      //idSalud
      if (data.responseJSON.errors.salud != undefined) {
         $('#vSalud').css('display', 'block');
         $('#lstSalud').addClass('is-invalid');
         $('#vSalud').addClass('invalid-feedback');
         $('#msgSalud').html(data.responseJSON.errors.salud);
      } else {
         $('#lstSalud').removeClass('is-invalid');
         $('#lstSalud').addClass('is-valid');
         $('#vSalud').css('display', 'none');
      }


      //ufIsapre
      if (data.responseJSON.errors.ufIsapre != undefined) {
         $('#vSalud').css('display', 'block');
         $('#txtUfIsapre').addClass('is-invalid');
         $('#vUfIsapre').addClass('invalid-feedback');
         $('#msgUfIsapre').html(data.responseJSON.errors.ufIsapre);
      } else {
         $('#txtUfIsapre').removeClass('is-invalid');
         $('#txtUfIsapre').addClass('is-valid');
         $('#vUfIsapre').css('display', 'none');
      }

      //idTipoContrato
      if (data.responseJSON.errors.tipoContrato != undefined) {
         $('#vSalud').css('display', 'block');
         $('#lstTipoContrato').addClass('is-invalid');
         $('#vTipoContrato').addClass('invalid-feedback');
         $('#msgTipoContrato').html(data.responseJSON.errors.tipoContrato);
      } else {
         $('#lstTipoContrato').removeClass('is-invalid');
         $('#lstTipoContrato').addClass('is-valid');
         $('#vTipoContrato').css('display', 'none');
      }

      //HorasCtoSemanal
      if (data.responseJSON.errors.horasCtoSemanal != undefined) {
         $('#vSalud').css('display', 'block');
         $('#txtHorasCtoSemanal').addClass('is-invalid');
         $('#vHorasCtoSemanal').addClass('invalid-feedback');
         $('#msgHorasCtoSemanal').html(data.responseJSON.errors.horasCtoSemanal);
      } else {
         $('#txtHorasCtoSemanal').removeClass('is-invalid');
         $('#txtHorasCtoSemanal').addClass('is-valid');
         $('#vHorasCtoSemanal').css('display', 'none');
      }

      //FechaInicioContrato
      if (data.responseJSON.errors.fechaInicioContrato != undefined) {
         $('#vSalud').css('display', 'block');
         $('#txtFechaInicioContrato').addClass('is-invalid');
         $('#vFechaInicioContrato').addClass('invalid-feedback');
         $('#msgFechaInicioContrato').html(data.responseJSON.errors.fechaInicioContrato);
      } else {
         $('#txtFechaInicioContrato').removeClass('is-invalid');
         $('#txtFechaInicioContrato').addClass('is-valid');
         $('#vFechaInicioContrato').css('display', 'none');
      }


      //FechaTerminoContrato
      if (data.responseJSON.errors.fechaTerminoContrato != undefined) {
         $('#vSalud').css('display', 'block');
         $('#txtFechaTerminoContrato').addClass('is-invalid');
         $('#vFechaTerminoContrato').addClass('invalid-feedback');
         $('#msgFechaTerminoContrato').html(data.responseJSON.errors.fechaTerminoContrato);
      } else {
         $('#txtFechaTerminoContrato').removeClass('is-invalid');
         $('#txtFechaTerminoContrato').addClass('is-valid');
         $('#vFechaTerminoContrato').css('display', 'none');
      }


      //idFuncion
      if (data.responseJSON.errors.funcion != undefined) {
         $('#vSalud').css('display', 'block');
         $('#lstFuncion').addClass('is-invalid');
         $('#vFuncion').addClass('invalid-feedback');
         $('#msgFuncion').html(data.responseJSON.errors.funcion);
      } else {
         $('#lstFuncion').removeClass('is-invalid');
         $('#lstFuncion').addClass('is-valid');
         $('#vFuncion').css('display', 'none');
      }

   });
});
