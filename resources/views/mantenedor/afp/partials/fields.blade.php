
{{-- Nombre --}}
<div class="form-group row">

   {!! Form::label('Nombre', 'Nombre', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}

   <div class="col-sm-9">

      {!! Form::text('nombre', $editar == 0 ? null : $afp->nombre,
         ['id'          => 'txtNombre',
         'class'        => 'form-control',
         'maxlength'    => '100',
         'placeholder'  => 'Nombre'])
      !!}

      <div id="vNombre"><span id="msgNombre" class="validacion"></span></div>

   </div>
</div>

{{-- Porcentaje Máximo --}}
<div class="form-group row">

   {!! Form::label('Porcentaje Descuento', 'Porcentaje Descuento', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}
   
   <div class="col-sm-9 input-group">

      {!! Form::number('porcentajeDescuento', $editar == 0 ? null : $afp->porcentaje,
         ['id'          => 'intPorcentajeDescuento',
         'class'        => 'form-control',
         'maxlength'    => '10',
         'placeholder'  => 'Porcentaje Descuento' ]) 
      !!}
      
      <div class="input-group-prepend">
         <span class="input-group-text" id="basic-addon-calendar">
             <i class="fa fa-percent form-control-feedback"></i> 
         </span>
      </div>
   
      <div id="vPorcentajeDescuento"><span id="msgPorcentajeDescuento" class="validacion"></span></div>
      
   </div>
</div>