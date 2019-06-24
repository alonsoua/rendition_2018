{{-- @php
   dd($imputacion);
@endphp --}}
{{-- {!! Form::hidden('editar'         
   , $editar,
   ['id'          => 'hiddenEditar'])
!!}

{!! Form::hidden('idImputacion'         
   , $imputacion->id,
   ['id'          => 'hiddenIdImputacion'])
!!} --}}



{{-- lst ESTABLECIMIENTO --}}
<div class="form-group row">
   {!! Form::label('Establecimiento', 'Establecimiento', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}

   <div class="col-sm-9">
      {{ Form::select('establecimiento', $establecimientos , $editar == 0 ? null : $imputacion->idEstablecimiento,
         [
            'id'           => 'lstEstablecimiento',
            'placeholder'  => 'Seleccione Establecimiento',
            'class'        => 'form-control select-establecimientos'
         ])
      }}
      <div id="vEstablecimiento"><span id="msgEstablecimiento" class="validacion"></span></div>
   </div>
</div> 


{{-- lst FUNCIONARIO --}}
<div class="form-group row">
   {!! Form::label('Funcionario', 'Funcionario', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}
   

   @php
      if ($editar == 0) {
         $disabledFuncionario = 'disabled';
      } else {
         $disabledFuncionario = '';            
         
      }
   @endphp

   <div class="col-sm-9">
      {{ Form::select('funcionario', $funcionarios, $editar == 0 ? null : $imputacion->idFuncionario,
         [
            'id'           => 'lstFuncionario',
            'placeholder'  => 'Seleccione Funcionario',
            'class'        => 'select-funcionarios form-control',
            $disabledFuncionario
         ])
      }}

      <div id="vFuncionario"><span id="msgFuncionario" class="validacion"></span></div> {{-- Div de Validación --}}
   
   </div>

</div>


{{-- CHECKBOX REEMBOLSABLE
<div class="form-group row">
   
   {!! Form::label('Es Reembolsable', 'Es Reembolsable', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}

   <div class="col-sm-2 mt-2">
      
      {{ Form::checkbox('reembolsable'), 0 }}
      
   </div>
   @php
      if ($editar == 0) {
         $disabledFuncionario = 'disabled';
      } else {
         $disabledFuncionario = '';            
         
      }
   @endphp
   <div class="col-sm-7 mt-2">
      {{ Form::select('funcionario', $funcionarios , $editar == 0 ? null : $imputacion->idFuncionario,
         [
            'id'          => 'lstFuncionario',
            'placeholder' => 'Seleccione Funcionario',
            'class'       => 'form-control select-funcionarios',
            $disabledFuncionario
         ])
      }}
      
      <div id="vFuncionario"><span id="msgFuncionario" class="validacion"></span></div>

   </div>

</div> --}}


{{-- lst SUBVENCIÓN --}}
<div class="form-group row">
   {!! Form::label('Subvención', 'Subvención', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}

   <div class="col-sm-9">
      {{ Form::select('subvencion', $subvenciones, $editar == 0 ? null : $imputacion->idSubvencion,
         [
            'id'           => 'lstSubvencion',
            'placeholder'  => 'Seleccione Subvención',
            'class'        => 'select-subvencion form-control'
         ])
      }}

      <div id="vSubvencion"><span id="msgSubvencion" class="validacion"></span></div> {{-- Div de Validación --}}
   
   </div>

</div> 


{{-- lst CUENTA --}}
<div class="form-group row">
   {!! Form::label('Cuenta', 'Cuenta', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}
   
@php
   if ($editar == 0) {
      $disabledCuenta = 'disabled';
   } else {
      $disabledCuenta = '';
   }
@endphp

   <div class="col-sm-9">
      {{ Form::select('cuenta', $cuentas, $editar == 0 ? null : $imputacion->idCuenta,
         [
            'id'           => 'lstCuenta',
            'placeholder'  => 'Seleccione Cuenta',
            'class'        => 'select-cuenta form-control',
            $disabledCuenta
         ])
      }}

      <div id="vCuenta"><span id="msgCuenta" class="validacion"></span></div> {{-- Div de Validación --}}
   
   </div>

</div> 




{{-- lst TIPO DOCUMENTO --}}
<div class="form-group row">
   {!! Form::label('Tipo Documento', 'Tipo Documento', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}

@php
   if ($editar == 0) {
      $disabledDocumento = 'disabled';
   } else {
      $disabledDocumento = '';
   }
@endphp

   <div class="col-sm-9">
      {{ Form::select('tipoDocumento', $tipoDocumentos, $editar == 0 ? null : $imputacion->idTipoDocumento,
         [
            'id'           => 'lstTipoDocumento',
            'placeholder'  => 'Seleccione Subvención',
            'class'        => 'select-tipoDocumento form-control',
            $disabledDocumento
         ])
      }}

      <div id="vTipoDocumento"><span id="msgTipoDocumento" class="validacion"></span></div>
   
   </div>

</div> 


{{-- {{-- lst ESTABLECIMIENTO --}}
{{--<div  class="form-group row">
   {!! Form::label('Forma Pago', 'Forma Pago', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}

   <div class="col-sm-9">
      {{ Form::select('formaPago', $formaPago , $editar == 0 ? null : $imputacion->idFormaPago,
         [
            'id'           => 'lstFormaPago',
            'placeholder'  => 'Seleccione Forma Pago',
            'class'        => 'form-control select-formaPagos'
         ])
      }}
      <div id="vFormaPago"><span id="msgFormaPago" class="validacion"></span></div>
   </div>
</div> 
 --}}


{{-- N° DOCUMENTO --}}
<div class="form-group row">
   {!! Form::label('N° Documento', 'N° Documento', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}
   <div class="col-sm-9">      
      {!! Form::number('numDocumento', $editar == 0 ? null : $imputacion->numDocumento,
                     ['id'              => 'txtNumDocumento',
                     'class'            => 'form-control text-left',
                     'maxlength'        => 50,                        
                     'placeholder'      => 'N° Documento',
                     'aria-describedby' => 'inputGroup-sizing-sm'])
      !!}  

      <div id="vNumDocumento"><span id="msgNumDocumento" class="validacion"></span></div> {{-- Div de Validación --}}
   </div>
</div>


{{-- FECHA DOCUMENTO --}}
<div class="form-group row ">
   {!! Form::label('Fecha Documento', 'Fecha Documento', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}

   <div class="col-sm-9">
      <div class="input-group">
        
      {!! Form::text('fechaDocumento'         
         , $editar == 0 ? null : date("d-m-Y", strtotime($imputacion->fechaDocumento)),
         ['id'          => 'txtFechaDocumento',
         'class'        => 'form-control fecha-documento',
         'placeholder'  => 'Fecha Documento'])
      !!}
         
         <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon-calendar">
               <i class="fa fa-calendar-alt form-control-feedback"></i> 
            </span>
         </div>
      </div>
      <div id="vFechaDocumento"><span id="msgFechaDocumento" class="validacion"></span></div>
   </div>
</div>


{{-- FECHA PAGO --}}
<div class="form-group row ">
   {!! Form::label('Fecha Pago', 'Fecha Pago', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}

   <div class="col-sm-9">
      <div class="input-group">
        
      {!! Form::text('fechaPago'         
         , $editar == 0 ? null : date("d-m-Y", strtotime($imputacion->fechaPago)),
         ['id'          => 'txtFechaPago',
         'class'        => 'form-control fecha-pago',
         'placeholder'  => 'Fecha Pago'])
      !!}
         
         <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon-calendar">
               <i class="fa fa-calendar-alt form-control-feedback"></i> 
            </span>
         </div>
      </div>
      <div id="vFechaPago"><span id="msgFechaPago" class="validacion"></span></div>
   </div>
</div>



{{-- DESCRIPCIÓN --}}
<div class="form-group row">
   {!! Form::label('Descripción', 'Descripción', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}
   <div class="col-sm-9">

      {!! Form::textarea('descripcion', null,
         ['id'          => 'txtDescripcion',
         'class'        => 'form-control',
         'placeholder'  => 'Descripción',
         'rows'         => 4 ,
         'cols'         => 4 ])
      !!}
      <div id="vDescripcion"><span id="msgDescripcion" class="validacion"></span></div>
   </div>
</div>


{{-- lst PROVEEDOR --}}
<div class="form-group row">
   {!! Form::label('Proveedor', 'Proveedor', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}

   <div class="col-sm-9">
      {{ Form::select('proveedor', $proveedores, $editar == 0 ? null : $imputacion->idProveedor,
         [
            'id'           => 'lstProveedor',
            'placeholder'  => 'Seleccione Proveedor',
            'class'        => 'select-proveedor form-control'
         ])
      }}

      <div id="vProveedor"><span id="msgProveedor" class="validacion"></span></div> {{-- Div de Validación --}}
   
   </div>

</div> 


{{-- MONTO GASTO --}}
<div class="form-group row">
   {!! Form::label('Monto Gasto', 'Monto Gasto', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}
   <div class="col-sm-9 input-group">
      
      <div class="input-group-prepend">
         <span class="input-group-text" id="basic-addon-calendar">
             <i class="fa fa-dollar-sign form-control-feedback"></i> 
         </span>
      </div>
   

      {!! Form::number('montoGasto', $editar == 0 ? null : $imputacion->montoGasto,
                     ['id'              => 'txtMontoGasto',
                     'class'            => 'form-control text-left',
                     'maxlength'        => 50,                        
                     'placeholder'      => 'Monto Gasto',
                     'aria-describedby' => 'inputGroup-sizing-sm'])
      !!}  

      <div id="vMontoGasto"><span id="msgMontoGasto" class="validacion"></span></div> {{-- Div de Validación --}}
   </div>
</div>


{{-- MONTO DOCUMENTO --}}
<div class="form-group row">
   {!! Form::label('Monto Documento', 'Monto Documento', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}
   <div class="col-sm-9 input-group">

      <div class="input-group-prepend">
         <span class="input-group-text" id="basic-addon-calendar">
             <i class="fa fa-dollar-sign form-control-feedback"></i> 
         </span>
      </div>
   

      {!! Form::number('montoDocumento', $editar == 0 ? null : $imputacion->montoDocumento,
                     ['id'              => 'txtMontoDocumento',
                     'class'            => 'form-control text-left',
                     'maxlength'        => 50,                        
                     'placeholder'      => 'Monto Documento',
                     'aria-describedby' => 'inputGroup-sizing-sm'])
      !!}  

      <div id="vMontoDocumento"><span id="msgMontoDocumento" class="validacion"></span></div> {{-- Div de Validación --}}
   </div>
</div>


{{-- DOCUMENTO --}}
{{-- <div class="form-group row">
   {!! Form::label('Insignia', 'Insignia', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}
   <div class="col-sm-9">
   
       {!! Form::File('insignia', null,
         [  'id'           => 'fileInsignia',
            'class'        => 'form-control',
            'placeholder'  => 'Seleccione una imagen'])
         !!}
      <div id="vInsignia"><span id="msgInsignia" class="validacion"></span></div>
   </div>
</div> --}}


{{-- ESTADO --}}
<div class="form-group row">

@can('imputaciones.index')
   @php
      $opcion = ($editar == 0) ? null : $imputacion->estado ;
      $disabledEstado = "";
   @endphp   
@else 
   @php
      $opcion = "Por Aprobar";
      $disabledEstado = "disabled";
   @endphp   
@endcan

   {!! Form::label('Estado', 'Estado', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}

   <div class="col-sm-9">
      {{ Form::select('estado', 
         [
            'Por Aprobar' => 'Por Aprobar',
            'Aprobado'    => 'Aprobado',
            'Rechazado'   => 'Rechazado'
         ], $opcion,
         [
            'id'           => 'lstEstado',
            'class'        => 'select-estado form-control',
            $disabledEstado
         ])
      }}

      <div id="vEstado"><span id="msgEstado" class="validacion"></span></div> {{-- Div de Validación --}}
  
   </div>

</div> 