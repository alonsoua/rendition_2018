
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



{{-- CHECKBOX --}}
<hr></hr>
<div class="form-group row">
   
   {!! Form::label('Detalle', 'Detalle', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}
   

   {{-- IMPONIBLE --}}
   {!! Form::label('Imponible', 'Imponible', ['class' => 'col-sm-2 col-form-label text-right']) !!}
   <div class="col-sm-0">
      <div class="mt-2">
         {{ Form::checkbox('imponible'), 0 }}
      </div>
   </div>


   {{-- SUELDO BASE --}}
   {!! Form::label('Sueldo Base', 'Sueldo Base', ['class' => 'col-sm-2 col-form-label text-right']) !!}
   <div class="col-sm-0">
      <div class="mt-2">
         {{ Form::checkbox('sueldoBase'), 0 }}
      </div>
   </div>


   {{-- SALUD --}}
   {!! Form::label('Salud', 'Salud', ['class' => 'col-sm-2 col-form-label text-right']) !!}
   <div class="col-sm-0">
      <div class="mt-2">
         {{ Form::checkbox('Salud'), 0 }}
      </div>
   </div>


</div>

<div class="form-group row">
   

   {{-- ADICIONAL SALUD --}}
   {!! Form::label('Adicional Salud', 'Adicional Salud', ['class' => 'col-sm-5 col-form-label text-right']) !!}
   <div class="col-sm-0">
      <div class="mt-2">
         {{ Form::checkbox('adicionalSalud'), 0 }}
      </div>
   </div>

   
   {{-- AFP --}}
   {!! Form::label('AFP', 'AFP', ['class' => 'col-sm-2 col-form-label text-right']) !!}
   <div class="col-sm-0">
      <div class="mt-2">
         {{ Form::checkbox('afp'), 0 }}
      </div>
   </div>


</div>

<hr></hr>
{{-- FIN CHECKBOX --}}


{{-- PORCENTAJE MÁXIMO --}}
<div class="form-group row">
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

