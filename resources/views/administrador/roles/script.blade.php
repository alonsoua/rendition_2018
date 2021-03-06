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
   $('#dataTable-roles').DataTable({
      "processing": true,
      "oLanguage" : {
         "sProcessing"        : "Procesando...",
         "sLengthMenu"        : "Mostrar _MENU_ registros por página",
         "sZeroRecords"       : "<h5 class='font-weight-light mt-5 mb-5'>No encontramos ningún rol con esas características</h5>",
         "sEmptyTable"        : "<h5 class='font-weight-light mt-5 mb-5'>No existen roles registrados</h5>",
         "sLoadingRecords"    : "Cargando...",
         "sInfo"              : "Mostrando _START_ a _END_ de _TOTAL_ registros",
         "sInfoEmpty"         : "Mostrando 0 a 0 de 0 roles",
         "sInfoFiltered"      : "<br>(filtro aplicado en _MAX_ roles)",
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
      "ajax"      : "{{ url('rolesTable') }}",
      "columns"   : [         
         {data: 'name'},      
         {data: 'description'}, 
         {data: 'opciones'},
      ],
      "drawCallback": function () {
         $('.dataTables_paginate > .pagination').addClass('pagination-sm');
      }
   });

});

function MensajeEliminar(e, i) {
   e.preventDefault();
   var id     = $(i).attr('data-id');
   var nombre = $(i).attr('data-nombre');

   $.alertable.confirm('<p class="text-center">¿Está seguro de eliminar el Rol <b>'+nombre+'</b>?</p>', {
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
   var url  = form.attr('action').replace(':ROL_ID', id);
   var data = form.serialize();
   var mensaje = '';

   $.post( url, data, function (result) {
                  
         if (result.id == 0 && result.message == 0) {
            mensaje = msgEliminarRegistroUtilizado('M', 'Rol');            
         } else {
            row.fadeOut();         
            mensaje = result.message;
         }

         $.alertable.alert('<p class="text-center">'+mensaje+'</p>', {html: true}).always(function(){});

   }).fail( function(data) {
         
         var res = data.status;
         
         if (res == 500) {
            //500 Clave foranea
            mensaje = msgEliminarRegistroUtilizado('M', 'Rol');
         } else if (res == 404) { 
            //404 No encontró el registro
            row.fadeOut(); 
            mensaje = msgEliminadoCorrectamente('M', 'Rol');
         }

         $.alertable.alert('<p class="text-center">'+mensaje+'</p>', {html: true}).always(function(){});
   });
}

//CHECKEA TODOS
$("[name='todo']").click(function(){
   
   var id = "."+$(this).val();
   if (this.checked) {
      $(id).attr('checked', '');
   }else {
      $(id).removeAttr('checked', '');
   }   

});


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
         
         //nombre
         if (data.responseJSON.errors.name != undefined) {
            $('#txtNombre').addClass('is-invalid');
            $('#vNombre').css('display', 'block');
            $('#vNombre').addClass('invalid-feedback');
            $('#msgNombre').html(data.responseJSON.errors.name);
         } else {

            $('#txtNombre').removeClass('is-invalid');
            $('#txtNombre').addClass('is-valid');
            $('#vNombre').css('display', 'none');
         }

         //descripcion
         if (data.responseJSON.errors.descripcion != undefined) {
            $('#txtDescripcion').addClass('is-invalid');
            $('#vDescripcion').css('display', 'block');
            $('#vDescripcion').addClass('invalid-feedback');
            $('#msgDescripcion').html(data.responseJSON.errors.descripcion);
         } else {
            $('#txtDescripcion').removeClass('is-invalid');
            $('#txtDescripcion').addClass('is-valid');
            $('#vDescripcion').css('display', 'none');
         }
      }
   });
});
