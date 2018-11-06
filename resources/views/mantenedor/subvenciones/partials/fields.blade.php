
{{-- Nombre --}}
<div class="form-group row">

   {!! Form::label('Nombre', 'Nombre', ['class' => 'col-sm-3 col-form-label text-right']) !!}

   <div class="col-sm-9">

      {!! Form::text('nombre', null,
         ['id'          => 'txtNombre',
         'class'        => 'form-control',
         'placeholder'  => 'Nombre'])
      !!}

      <div id="vNombre"><span id="msgNombre" class="validacion"></span></div>

   </div>
</div>


{{-- Descripción --}}
<div class="form-group row">

   {!! Form::label('Descripción', 'Descripción', ['class' => 'col-sm-3 col-form-label text-right']) !!}

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


{{-- Porcentaje Máximo --}}
<div class="form-group row">

   {!! Form::label('Porcentaje Máximo', 'Porcentaje Máximo', ['class' => 'col-sm-3 col-form-label text-right']) !!}
   
   <div class="col-sm-9">

      {!! Form::number('porcentajeMaximo', $number,
         ['id'          => 'intPorcentajeMax',
         'class'        => 'form-control',
         'placeholder'  => 'Porcentaje Máximo' ]) 
      !!}
      
      <div id="vPorcentajeMax"><span id="msgPorcentajeMax" class="validacion"></span></div>
      
   </div>
</div>