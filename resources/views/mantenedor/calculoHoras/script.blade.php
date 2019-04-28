$(document).ready(function(){

   /*
   |--------------------------------------------------------------------------
   | Chosen Select de JQuery
   |--------------------------------------------------------------------------
   | link: https://harvesthq.github.io/chosen/
   | documentación: https://harvesthq.github.io/chosen/options.html
   |
   */

   $('.select-establecimiento').chosen({
     
      no_results_text: 'No se encontró el Establecimiento',
      width : '35%'

   });


   /* PERIODO */
   $('.select-periodo').chosen({
      placeholder_text_single: 'Seleccione Periodo',
      no_results_text: 'No se encontró el Periodo',
      width : '35%'
   });
   /* PERIODO */

   if ($("#form-agregar").length) {
      $('#msgVacio').remove();
   }

});

$('#lstEstablecimiento').on('change', function(e){
   
   var idEstablecimiento = e.target.value;
   
   $('#idEstablecimiento').val(idEstablecimiento);
   $(".cargando").css('visibility', 'visible');
   $.get('lst-periodos?idEstablecimiento='+ idEstablecimiento,function(data) {
      
      $('#lstPeriodo').empty();

      

      //Carga info en select
      $('#lstPeriodo').append('<option value="0" disable="true" selected="true">Seleccione Periodo</option>');
      $.each(data, function(index, periodos){


         var periodo = periodos.periodo;

         var mes = periodo.substr(0, 2);

         console.log(mes);
         if (mes == 01 || mes == 02 || mes == 03) {
            $('#lstPeriodo').append('<option value="'+periodos.id+'">'+periodos.periodo+'</option>');
         } else {
            var idPeriodo = periodos.id;
            var url2 = 'getAnteriorRegistro?idPeriodo='+idPeriodo+'&idEstablecimiento='+idEstablecimiento;            

            var idCalculoHora = $.ajax({
               url: url2,
               dataType: 'text',
               type: 'GET',
               async: false
            });
            
            if (idCalculoHora.responseText.length != 2) {
               $('#lstPeriodo').append('<option value="'+periodos.id+'">'+periodos.periodo+'</option>');
            } 
         

         }
      });

      //Actualiza Select
      $("#lstPeriodo").trigger("chosen:updated");
      
      $('#row-Periodo').css('display', 'block');
      $(".cargando").css('visibility', 'hidden');
   });
});



// LST-GUARDAR
$('#lstPeriodo').on('change', function(e){

   var periodo = $('#lstPeriodo')[0][$('#lstPeriodo').val()].innerText;
   var año = periodo.substr(3, 6);

   var idPeriodo = e.target.value;
   $('#idPeriodo').val(idPeriodo);
   var idEstablecimiento = $('#idEstablecimiento').val();
   
   var url = 'lst-cargaLeyes?idPeriodo='+idPeriodo+'&idEstablecimiento='+idEstablecimiento;
   var row = '';
   $(".cargando").css('visibility', 'visible');
   
   $.get(url,function(data) {
      
      $.each(data, function(index, subvencion){         
         
         row += 
         '<div class="col-sm-12 rowEliminar" >'
         +'<br>'
         +'<div class="col-sm-12">'
            +'<h6 class="f mt-2 text-sm-center float-center">SUBVENCIÓN "'+subvencion['subvencion']+'"</h6>'            
         +'</div>'
         
         +'<div class="col-sm-12">'
            +'<div class="mt-2">'
               +'<table class="table table-hover table-sm table-responsive-sm">'
                  +'<thead>'
                     +'<tr>'
                        +'<th scope="col" width="5%">Código</th>'
                        +'<th scope="col" width="55%">Ley</th>'
                        +'<th scope="col" width="10%">Porce. Carga</th>'
                        +'<th scope="col" width="10%">Carga Periodo</th>'
                        +'<th scope="col" width="10%">Horas Periodo</th>'
                        +'<th scope="col" width="10%" style="text-align: center;">Valor Hora</th>'
                     +'</tr>'
                  +'</thead>'
                  +'<tbody>';

                  $.each(data[index]['leyes'][0], function(index1, leyes){

                     //Si periodo es distinto a MARZO
                     var soloLectura = '';
                     var porcentaje   = leyes['porcentaje'];
                     var cargaPeriodo = leyes['cargaPeriodo'];
                     var cantHoras    = leyes['cantHoras'];
                     var valorHora    = leyes['valor'];
                     if (  
                           leyes['codigoLey'] == '410103' 
                        || leyes['codigoLey'] == '410105'
                        || leyes['codigoLey'] == '410106'
                        || leyes['codigoLey'] == '410125' 
                     ) {

                        if (periodo.substring(0, 2) != '03') {                        
                           soloLectura = 'readonly="readonly"';
                           
                           //PORCENTAJE
                           var linkp = 'getDetalleMarzo?idLey='+leyes['idLey']+'&ano='+año;
                           linkp    += '&idEstablecimiento='+idEstablecimiento+'&param=porcentaje';
                                                      
                           var porcentajeAjax = $.ajax({
                              url: linkp, //indicamos la ruta donde se genera la hora
                              dataType: 'text',//indicamos que es de tipo texto plano
                              type: 'GET',
                              async: false     //ponemos el parámetro asyn a falso
                           });

                           if (porcentajeAjax.status == 200) {
                              porcentaje = porcentajeAjax.responseText;
                           } else {
                              porcentaje = 0;
                           }
                           
                           //CARGA PERIODO
                           var linkcp = 'getDetalleMarzo?idLey='+leyes['idLey']+'&ano='+año;
                           linkcp    += '&idEstablecimiento='+idEstablecimiento+'&param=cargaPeriodo';
                           
                           var cargaPeriodoAjax = $.ajax({
                              url: linkcp, //indicamos la ruta donde se genera la hora
                              dataType: 'text',//indicamos que es de tipo texto plano
                              type: 'GET',
                              async: false     //ponemos el parámetro asyn a falso
                           });

                           if (cargaPeriodoAjax.status == 200) {
                              cargaPeriodo = cargaPeriodoAjax.responseText;
                           } else {
                              cargaPeriodo = 0;
                           }

                           //CANT HORAS
                           var linkch = 'getDetalleMarzo?idLey='+leyes['idLey']+'&ano='+año;
                           linkch    += '&idEstablecimiento='+idEstablecimiento+'&param=cantHoras';
                           
                           var cantHorasAjax = $.ajax({
                              url: linkch, //indicamos la ruta donde se genera la hora
                              dataType: 'text',//indicamos que es de tipo texto plano
                              type: 'GET',
                              async: false     //ponemos el parámetro asyn a falso
                           });

                           if (cantHorasAjax.status == 200) {
                              cantHoras = cantHorasAjax.responseText;
                           } else {
                              cantHoras = 0;
                           }

                           //VALOR HORA
                           var linkv = 'getDetalleMarzo?idLey='+leyes['idLey']+'&ano='+año;
                           linkv    += '&idEstablecimiento='+idEstablecimiento+'&param=valor';
                           
                           var valorHoraAjax = $.ajax({
                              url: linkv, //indicamos la ruta donde se genera la hora
                              dataType: 'text',//indicamos que es de tipo texto plano
                              type: 'GET',
                              async: false     //ponemos el parámetro asyn a falso
                           });
                           
                           if (valorHoraAjax.status == 200) {
                              valorHora = valorHoraAjax.responseText;
                           } else {
                              valorHora = 0;
                           }
                        }                     
                     }

                     row += '<tr>'
                        +'<td>'+leyes['codigoLey']+'</td>'
                        +'<td>'+leyes['nombreLey']+'</td>'
                        +'<td>'
                           +'<div class="input-group input-group-sm">'
                              
                              +'<input type="text" value="'+formatoMiles(porcentaje)+'"'
                              +'id="txtPorcCarga'+leyes['idLey']+'"  name="porcCarga['+leyes['idLey']+']"'
                              +'onkeyUp="maxLenght(txtPorcCarga'+leyes['idLey']+', 100); valorHora('+leyes['idLey']+');"'
                              +'class="form-control miles" style="text-align:right" a-describedby="inputGroup-sizing-sm"' 
                              +'maxlength="3" oncopy="return false" onpaste="return false"'
                              +'ondragstart="return false;" ondrop="return false;"'
                              +''+soloLectura+'>'
                              +'<div class="input-group-prepend">'
                                 +'<span class="input-group-text" id="basic-addon-calendar">'
                                   +'  <i class="fa fa-percent form-control-feedback"></i>'
                                 +'</span>'
                              +'</div>'
                           +'</div>'
                        +'</td>'
                        +'<td>'
                           +'<div class="input-group input-group-sm">'    
                              +'<div class="input-group-prepend">'
                                 +'<span class="input-group-text" id="basic-addon-calendar">'
                                   +'  <i class="fa fa-dollar-sign form-control-feedback"></i>'
                                 +'</span>'
                              +'</div>'                          
                              +'<input type="text" value="'+formatoMiles(cargaPeriodo)+'"'
                              +'id="txtCargaPeriodo'+leyes['idLey']+'" name="cargaPeriodo['+leyes['idLey']+']"'
                              +' onkeyUp="valorHora('+leyes['idLey']+')" class="form-control miles"' 
                              +'style="text-align:right" aria-describedby="inputGroup-sizing-sm" '
                              +'maxlength="13" oncopy="return false" onpaste="return false" ondragstart="return false;"'
                              +' ondrop="return false;"'
                              +''+soloLectura+'>'
                           +'</div>'
                        +'</td>'
                        +'<td>'
                           +'<div class="input-group input-group-sm">'
                              +'<input type="text" value="'+formatoMiles(cantHoras)+'"'
                              +'id="txtCantHoras'+leyes['idLey']+'"  name="cantHoras['+leyes['idLey']+']"'
                              +' onkeyUp="valorHora('+leyes['idLey']+')" class="form-control miles"' 
                              +'style="text-align:right" a-describedby="inputGroup-sizing-sm"'
                              +'maxlength="13" oncopy="return false" onpaste="return false" ondragstart="return false;"'
                              +' ondrop="return false;"'
                              +''+soloLectura+'>'
                           +'</div>'
                        +'</td>'                        
                        +'<td>'
                           +'<div class="input-group input-group-sm">'
                              +'<div class="input-group-prepend">'
                                 +'<span class="input-group-text" id="basic-addon-calendar">'
                                   +'  <i class="fa fa-dollar-sign form-control-feedback"></i>'
                                 +'</span>'
                              +'</div>'
                              +'<input type="text" value="'+formatoMiles(valorHora)+'" '  
                              +'id="txtValorHora'+leyes['idLey']+'"'
                              +' data-values'+leyes['idLey']+'="'+formatoMiles(leyes['valor'])+'"" '
                              +'name="valor['+leyes['idLey']+']" class="form-control miles" ' 
                              +'style="text-align:right" a-describedby="inputGroup-sizing-sm"'
                              +'maxlength="13" onkeyup="inputValorHora(txtValorHora'+leyes['idLey']+', '+leyes['idLey']+');"'
                              +' oncopy="return false" onpaste="return false"'
                              +'ondragstart="return false;" ondrop="return false;>"'
                           +'</div>'
                        +'</td>'
                     +'</tr>';
                  });


               row += '</tbody>'
               +'</table>'
            +'</div>'
         +'</div>'
      +'</div>';
      });     

      // Muestra leyes y acciones   
      $('#acciones').css('display', 'none');
      $('.rowEliminar').remove();
      $('#rowCalculoHoras').append(row);
      $('#rowCalculoHoras').css('display', 'block');
      $('#acciones').css('display', 'block');
      $(".cargando").css('visibility', 'hidden');   

   });
});


function inputValorHora(idInput, id) {
   
  var attributo = 'data-values'+id;
  // $("#"+idInput.id).val($("#"+idInput.id).attr(attributo));
  
}

function valorHora(idLey) {

   var valorPorcentaje   = $("#txtPorcCarga"+idLey).val();
   var valorCargaPeriodo = $("#txtCargaPeriodo"+idLey).val();
   var valorCantidadHora = $("#txtCantHoras"+idLey).val();

   // Calcula el porcentaje del valorCargaPeriodo
   var cargaTotal = (valorCargaPeriodo.replace(/\./g,'') / 100) * valorPorcentaje;

   // Calcula el valorHora
   var valorHora  = cargaTotal / valorCantidadHora.replace(/\./g,'');

   if (isNaN(valorHora) || valorHora === Infinity) {
      $("#txtValorHora"+idLey).val(0);
      //Data-Value
      $("#txtValorHora"+idLey).attr('data-value', 0);
   } else {
      //Value
      $("#txtValorHora"+idLey).val(formatoMiles(Math.round(valorHora)));
      //Data-Value
      $("#txtValorHora"+idLey).attr('data-value',formatoMiles(Math.round(valorHora)));
      
   }
}

// BTN-GUARDAR
$('#guardar').click(function(){   

   var idFm = $(this).attr('data-form');
   var form = $('#'+idFm);
   var url  = form.attr('action');
   var dataArray = form.serializeArray();
   $("#msg").css('display', 'none');
   $(".cargando").css('visibility', 'visible');
   
   //VALIDACIONES 
   //cargaPeriodo
   //cantHoras
   //valorHoras  
   var countInvalid = 0;   
   dataArray.forEach( function(element, index) {            

      if (element.value === "") {                           
         $('[name="'+element.name+'"]').addClass('is-invalid');
         $('#txtRut').addClass('is-invalid');  
         countInvalid++;
         
         //Si es el primer dato invalido
         //hace focus
         if (countInvalid == 1) {
            $('[name="'+element.name+'"]').focus();
         }      
      } else {
         $('#txtRut').removeClass('is-invalid');     
      }
      
   });   

   //Si falta algún dato retorna false
   if (countInvalid != 0) { 
      $(".cargando").css('visibility', 'hidden');
      $("#msg").css('display', 'block');
      $("#msg").empty();
      $("#msg").append('Todos los campos son obligatorios.');
      return false; 
   }

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
      dataArray.forEach( function(element, index) {
      
         if (element.value === "") {                     
            $('[name="'+element.name+'"]').addClass('is-invalid');
            $('#txtRut').addClass('is-invalid');      
         } else {
            $('#txtRut').removeClass('is-invalid');
            $('[name="'+element.name+'"]').addClass('is-valid');
         }
      });

   });
});



