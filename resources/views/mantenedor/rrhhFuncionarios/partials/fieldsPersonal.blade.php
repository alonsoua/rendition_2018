{{-- lst ESTABLECIMIENTO --}}
<div class="form-group row">
   {!! Form::label('Establecimiento', 'Establecimiento', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}

   <div class="col-sm-9">
      {{ Form::select('establecimiento', $establecimientos , $editar == 0 ? null : $funcionario->idEstablecimiento,
         [
            'id'           => 'lstEstablecimiento',
            'placeholder'  => 'Seleccione Establecimiento',
            'class'        => 'form-control select-establecimientos'
         ])
      }}
      <div id="vEstablecimiento"><span id="msgEstablecimiento" class="validacion"></span></div>
   </div>
</div> 


{{-- RUT --}}
<div class="form-group row">
   {!! Form::label('Rut', 'Rut', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}
   <div class="col-sm-9">

      {!! Form::text('rut', $editar == 0 ? null : $funcionario->rut,
         ['id'          => 'txtRut',
         'class'        => 'form-control',
         'maxlength'    => '14',
         'placeholder'  => 'Rut'])
      !!}
      <div id="vRut"><span id="msgRut" class="validacion"></span></div> {{-- Div de Validación --}}
   </div>
</div>


{{-- NOMBRE --}}
<div class="form-group row">
   {!! Form::label('Nombre', 'Nombre', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}

   <div class="col-sm-9">
      {!! Form::text('nombre', $editar == 0 ? null : $funcionario->nombre,
         ['id'          => 'txtNombre',
         'class'        => 'form-control',
         'maxlength'    => '100',
         'placeholder'  => 'Nombre'])
      !!}
      <div id="vNombre"><span id="msgNombre" class="validacion"></span></div>
   </div>
</div>


{{-- APELLIDOPATERNO --}}
<div class="form-group row">
   {!! Form::label('Apellido Paterno', 'Apellido Paterno', ['class' => 'col-sm-3 col-form-label  text-md-right text-sm-left']) !!}

   <div class="col-sm-9">
      {!! Form::text('apellidoPaterno', $editar == 0 ? null : $funcionario->apellidoPaterno,
         ['id'          => 'txtApellidoPaterno',
         'class'        => 'form-control',
         'maxlength'    => '100',
         'placeholder'  => 'Apellido Paterno'])
      !!}
      <div id="vApellidoPaterno"><span id="msgApellidoPaterno" class="validacion"></span></div>
   </div>
</div>


{{-- APELLIDOMATERNO --}}
<div class="form-group row">
   {!! Form::label('Apellido Materno', 'Apellido Materno', ['class' => 'col-sm-3 col-form-label  text-md-right text-sm-left']) !!}

   <div class="col-sm-9">
      {!! Form::text('apellidoMaterno', $editar == 0 ? null : $funcionario->apellidoMaterno,
         ['id'          => 'txtApellidoMaterno',
         'class'        => 'form-control',
         'maxlength'    => '100',
         'placeholder'  => 'Apellido Materno'])
      !!}
      <div id="vApellidoMaterno"><span id="msgApellidoMaterno" class="validacion"></span></div>
   </div>
</div>

{{-- TIPO CONTRATO --}}
<div class="form-group row">
   {!! Form::label('Tipo Contrato', 'Tipo Contrato', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}

   <div class="col-sm-9">
      {{ Form::select('tipoContrato', $tipoContrato , $editar == 0 ? null : $funcionario->idTipoContrato,
         [
            'id'           => 'lstTipoContrato',
            'placeholder'  => 'Seleccione Tipo Contrato',
            'class'        => 'form-control select-tipoContrato'
         ])
      }}
      <div id="vTipoContrato"><span id="msgTipoContrato" class="validacion"></span></div>
   </div>
</div> 

@php   
   if ($editar == 1) {
      if ($funcionario->idTipoContrato == 1) {
         $divContratoDisplay  = 'block'; 
         $fechaTerminoDisplay = 'display:none;';
      } else if ($funcionario->idTipoContrato == 2) {
         $divContratoDisplay  = 'block'; 
         $fechaTerminoDisplay = 'display:block;';
      } else if ($funcionario->idTipoContrato == 3) {            
         $divContratoDisplay  = 'none';
         $fechaTerminoDisplay = 'display:none;';
      } else {
         $divContratoDisplay  = 'block';            
         $fechaTerminoDisplay = 'display:block;';
      }   
   } else {
      $divContratoDisplay = 'block';   
      $fechaTerminoDisplay = 'display:block;';     
   }
@endphp

<div id="divContrato" style="display: {{ $divContratoDisplay }};">
      
   {{-- lst AFP --}}
   <div class="form-group row">
      {!! Form::label('AFP', 'AFP', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}

      <div class="col-sm-9">
         {{ Form::select('afp', $afp , $editar == 0 ? null : $funcionario->idAfp,
            [
               'id'           => 'lstAfp',
               'placeholder'  => 'Seleccione Afp',
               'class'        => 'form-control select-afp'
            ])
         }}
         <div id="vAfp"><span id="msgAfp" class="validacion"></span></div>
      </div>
   </div> 


   {{-- lst SISTEMA DE SALUD --}}
   <div class="form-group row">
      {!! Form::label('Salud', 'Salud', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}

      <div class="col-sm-9">
         {{ Form::select('salud', $salud , $editar == 0 ? null : $funcionario->idSalud,
            [
               'id'           => 'lstSalud',
               'placeholder'  => 'Seleccione Salud',
               'class'        => 'form-control select-salud'
            ])
         }}
         <div id="vSalud"><span id="msgSalud" class="validacion"></span></div>
      </div>
   </div> 


   {{-- UF ISAPRE --}}
   <div class="form-group row">
      {!! Form::label('UF Isapre', 'UF Isapre', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left',
                                                 'id'    => 'lblUfIsapre',
                                                 'style' => 'display:none;',]) !!}
      
      <div class="col-sm-9">            
         {!! Form::number('ufIsapre', $editar == 0 ? null : $funcionario->ufIsapre,
            ['id'         => 'txtUfIsapre',
            'class'       => 'form-control decimales',
            'maxlength'   => 10,
            'style'       => 'display:none;',
            'placeholder' => 'Uf Isapre'])
         !!}      
         <div id="vUfIsapre"><span id="msgUfIsapre" class="validacion"></span></div>
      </div>
   </div>

   {{-- HORAS CONTRATO SEMANAL --}}
   <div class="form-group row">
      {!! Form::label('Horas Contrato Semanal', 'Horas Contrato Semanal', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}

      <div class="col-sm-9">
         {!! Form::number('horasCtoSemanal', $editar == 0 ? null : $funcionario->horasCtoSemanal,
            ['id'          => 'txtHorasCtoSemanal',
            'class'        => 'form-control',
            'placeholder'  => 'Horas Contrato Semanal'])
         !!}
         <div id="vHorasCtoSemanal"><span id="msgHorasCtoSemanal" class="validacion"></span></div>
      </div>
   </div>



   {{-- FECHA INICIO CONTRATO --}}
   <div class="form-group row ">
      {!! Form::label('Fecha Inicio Contrato', 'Fecha Inicio Contrato', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}

      <div class="col-sm-9">
         <div class="input-group">
           
         {!! Form::text('fechaInicioContrato'         
            , $editar == 0 ? null : date("d-m-Y", strtotime($funcionario->fechaInicioContrato)),
            ['id'          => 'txtFechaInicioContrato',
            'class'        => 'form-control fecha-inicio',
            'placeholder'  => 'Fecha Inicio Contrato'])
         !!}
            
            <div class="input-group-prepend">
               <span class="input-group-text" id="basic-addon-calendar">
                  <i class="fa fa-calendar-alt form-control-feedback"></i> 
               </span>
            </div>
         </div>
         <div id="vFechaInicioContrato"><span id="msgFechaInicioContrato" class="validacion"></span></div>
      </div>
   </div>

   {{-- FECHA TÉRMINO CONTRATO --}}
   <div id="divFechaTermino">
      <div class="form-group row ">
         {!! Form::label('Fecha Término Contrato', 'Fecha Término Contrato', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left',
                                                    'id'    => 'lblFechaTerminoContrato',
                                                    'style' => $fechaTerminoDisplay,]) !!}
         
         <div class="col-sm-9"  style="{{ $fechaTerminoDisplay }}">
            <div class="input-group">
              
               {!! Form::text('fechaTerminoContrato'
                     , $editar == 0 ? null : date("d-m-Y", strtotime($funcionario->fechaTerminoContrato)),
                  ['id'          => 'txtFechaTerminoContrato',
                  'class'        => 'form-control fecha-termino',
                  'placeholder'  => 'Fecha Término Contrato',
                  'style'        => $fechaTerminoDisplay,])
               !!}
                  
               {{-- <div class="input-group-prepend" id="calFechaTerminoContrato" > --}}

               <div class="input-group-prepend" >
                  <span class="input-group-text" id="basic-addon-calendar">
                     <i class="fa fa-calendar-alt form-control-feedback"></i> 
                  </span>
               </div>

            </div>
            <div id="vFechaTerminoContrato"><span id="msgFechaTerminoContrato" class="validacion"></span></div>
         </div>   
      </div>
   </div>
</div>

{{-- lst FUNCIÓN --}}
<div class="form-group row">
   {!! Form::label('Función', 'Función', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}

   <div class="col-sm-9">
      {{ Form::select('funcion', $funciones , $editar == 0 ? null : $funcionario->idFuncion,
         [
            'id'           => 'lstFuncion',
            'placeholder'  => 'Seleccione Función',
            'class'        => 'form-control select-funcion'
         ])
      }}
      <div id="vFuncion"><span id="msgFuncion" class="validacion"></span></div>
   </div>
</div> 
{{--
{{-- lst Cuentas GENERAL
<div class="form-group row">
   {!! Form::label('Cuentas Sub. General ', 'Cuentas Sub. General', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}

   <div class="col-sm-9">
   
      {{ Form::select('cuentasGeneral[]', $cuentasGeneral ,  $editar == 0 ? null : $subGeneral
         ,[
            'id'           => 'lstCuentasGeneral',                  
            'class'        => 'select-cuentasGeneral form-control',
            'multiple' 
         ])
      }}

      <div id="vCuentasGeneral"><span id="msgCuentasGeneral" class="validacion"></span></div>
   </div>
</div> 

{{-- lst Cuentas PIE 
<div class="form-group row">
   {!! Form::label('Cuentas Sub. PIE', 'Cuentas Sub. PIE', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}

   <div class="col-sm-9">
   
      {{ Form::select('cuentasPie[]', $cuentasPie ,  $editar == 0 ? null : $cuentaSub
         ,[
            'id'           => 'lstCuentasPie',                  
            'class'        => 'select-cuentasPie form-control',
            'multiple' 
         ])
      }}

      <div id="vCuentasPie"><span id="msgCuentasPie" class="validacion"></span></div>
   </div>
</div> 

{{-- lst Cuentas SEP 
<div class="form-group row">
   {!! Form::label('Cuentas Sub. SEP', 'Cuentas Sub. SEP', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}

   <div class="col-sm-9">
   
      {{ Form::select('cuentasSep[]', $cuentasSep ,  $editar == 0 ? null : $cuentaSub
         ,[
            'id'           => 'lstCuentasSep',                  
            'class'        => 'select-cuentasSep form-control',
            'multiple' 
         ])
      }}

      <div id="vCuentasSep"><span id="msgCuentasSep" class="validacion"></span></div>
   </div>
</div>  --}}

<hr>