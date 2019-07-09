
{{-- CÓDIGO --}}
<div class="form-group row">
   
   {!! Form::label('Código', 'Código', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}
   
   <div class="col-sm-9">

      {!! Form::text('codigo', null,
         ['id'          => 'txtCodigo',
         'class'        => 'form-control',
         'maxlength'    => '20',
         'placeholder'  => 'Código'])
      !!}
   
      <div id="vCodigo"><span id="msgCodigo" class="validacion"></span></div> {{-- Div de Validación --}}
   
   </div>
</div>


{{-- NOMBRE --}}
<div class="form-group row">
  
   {!! Form::label('Nombre', 'Nombre', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}
  
   <div class="col-sm-9">

      {!! Form::text('nombre', null,
         ['id'          => 'txtNombre',
         'class'        => 'form-control',
         'maxlength'    => '100',
         'placeholder'  => 'Nombre'])
      !!}
  
      <div id="vNombre"><span id="msgNombre" class="validacion"></span></div> {{-- Div de Validación --}}
  
   </div>
</div>


{{-- TIPO --}}
<div class="form-group row">
   {!! Form::label('Tipo', 'Tipo', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}

   <div class="col-sm-9">
      {{ Form::select('tipo',
         [
            'Haber'     => 'Haber',
            'Descuento' => 'Descuento'
         ], $editar == 0 ? null : $ley->tipo,
         [
            'id'           => 'lstTipo',
            'placeholder'  => 'Seleccione Tipo...',
            'class'        => 'select-tipo form-control'
         ])
      }}

      <div id="vTipo"><span id="msgTipo" class="validacion"></span></div> {{-- Div de Validación --}}
   
   </div>

</div> 

{{-- OPCION TIPO --}}
   {{-- DISPLAY TIPOS --}}
   @php
         $displayHaber = $editar == 0 ? 'd-none' : ($ley->haber == null ? 'd-none' : '');      
         $displayDescuento = $editar == 0 ? 'd-none' : ($ley->descuento == null ? 'd-none' : '');      
   @endphp

   {{-- HABER --}}
   <div class="form-group row {{ $displayHaber }} divLstHaber">
      {!! Form::label('Haber', 'Haber', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}

      <div class="col-sm-9">
         {{ Form::select('haber',
            [
               'Imponible'    => 'Imponible',
               'No Imponible' => 'No Imponible'
            ], $editar == 0 ? null : $ley->haber,
            [
               'id'           => 'lstHaber',
               'placeholder'  => 'Seleccione Haber...',
               'class'        => 'select-haber form-control'
            ])
         }}

         <div id="vHaber"><span id="msgHaber" class="validacion"></span></div> {{-- Div de Validación --}}
      
      </div>

   </div> 



   {{-- DESCUENTO --}}
   <div class="form-group row {{ $displayDescuento }} divLstDescuento">
      {!! Form::label('Descuento', 'Descuento', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}

      <div class="col-sm-9">
         {{ Form::select('descuento',
            [
               'Descuento Legal' => 'Descuento Legal',
               'Otro Descuento'  => 'Otro Descuento'
            ], $editar == 0 ? null : $ley->descuento,
            [
               'id'           => 'lstDescuento',
               'placeholder'  => 'Seleccione Descuento...',
               'class'        => 'select-descuento form-control'
            ])
         }}

         <div id="vDescuento"><span id="msgDescuento" class="validacion"></span></div> {{-- Div de Validación --}}
      
      </div>

   </div> 



{{-- SUBVENCIÓN --}}
<div class="form-group row">
   {!! Form::label('Subvención', 'Subvención', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}

   <div class="col-sm-9">
      {{ Form::select('subvencion', $subvenciones, $editar == 0 ? null : $ley->idSubvencion,
         [
            'id'           => 'lstSubvencion',
            'placeholder'  => 'Seleccione Subvención...',
            'class'        => 'select-subvencion form-control'
         ])
      }}

      <div id="vSubvencion"><span id="msgSubvencion" class="validacion"></span></div> {{-- Div de Validación --}}
   
   </div>

</div> 


{{-- DESCRIPCIÓN --}}
<div class="form-group row">
  
   {!! Form::label('Descripción', 'Descripción', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}
  
   <div class="col-sm-9">

      {!! Form::text('descripcion', null,
         ['id'          => 'txtDescripcion',
         'class'        => 'form-control',
         'placeholder'  => 'Descripción'])
      !!}
  
      <div id="vDescripcion"><span id="msgDescripcion" class="validacion"></span></div> {{-- Div de Validación --}}
  
   </div>
</div>

{{-- PORCENTAJE MÁXIMO --}}
<div class="form-group row mt-2">
   {!! Form::label('Porcentaje Máximo', 'Porcentaje Máximo', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}

   <div class="col-sm-9 input-group">
      {!! Form::number('porcentajeMáximo', $editar == 0 ? null : $ley->porcMax,
         ['id'          => 'txtPorcentajeMax',
         'class'        => 'form-control',
         'maxlength'    => '3',
         'placeholder'  => 'Porcentaje Máximo'])
      !!}
      
      <div class="input-group-prepend">
         <span class="input-group-text" id="basic-addon-calendar">
             <i class="fa fa-percent form-control-feedback"></i> 
         </span>
      </div>

      <div id="vPorcentajeMax"><span id="msgPorcentajeMax" class="validacion"></span></div>
   </div>
</div>


{{-- TOPE POR HORA --}}
<div class="form-group row">
   {!! Form::label('Tope por Hora', 'Tope por Hora', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}

   <div class="col-sm-9">
      {!! Form::number('tope', null,
         ['id'          => 'txtTope',
         'class'        => 'form-control',
         'maxlength'    => '8',
         'placeholder'  => 'Tope por Hora'])
      !!}
      
      <div id="vTope"><span id="msgTope" class="validacion"></span></div>
   </div>
</div>


{{-- CHECKBOX --}}

<br>
   <hr>   
      <h5 class="card-title text-center">Detalle</h5>
   <hr>
   <br>

<div class="form-group row mb-5">
   {!! Form::label('Sueldo Base', 'Sueldo Base', ['class' => 'col-sm-2 col-form-label text-right']) !!}
   <div class="col-sm-1 mt-2">      
      {{ Form::checkbox('sueldoBase'), 0 }}      
   </div>

   {{-- SALUD --}}
   {!! Form::label('Salud', 'Salud', ['class' => 'col-sm-2 col-form-label text-right']) !!}
   <div class="col-sm-1 mt-2">      
      {{ Form::checkbox('Salud'), 0 }}      
   </div>

   {{-- ADICIONAL SALUD --}}
   {!! Form::label('Adicional Salud', 'Adicional Salud', ['class' => 'col-sm-2 col-form-label text-right']) !!}
   <div class="col-sm-1 mt-2">      
      {{ Form::checkbox('adicionalSalud'), 0 }}      
   </div>

   {{-- AFP --}}
   {!! Form::label('AFP', 'AFP', ['class' => 'col-sm-2 col-form-label text-right']) !!}
   <div class="col-sm-1 mt-2">      
      {{ Form::checkbox('afp'), 0 }}      
   </div>
   
   {{-- {!! Form::label('Detalle', 'Detalle', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!} --}}
   
   {{-- IMPONIBLE --}}
{{-- 
   {!! Form::label('Imponible', 'Imponible', ['class' => 'col-sm-2 col-form-label text-right']) !!}
   <div class="col-sm-0">
      <div class="mt-2">
         {{ Form::checkbox('imponible'), 0 }}
      </div>
   </div>

 --}}
   {{-- SUELDO BASE --}}

</div>
{{-- FIN CHECKBOX --}}