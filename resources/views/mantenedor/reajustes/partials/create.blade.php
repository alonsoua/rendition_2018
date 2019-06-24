


{{-- Formulario --}}

{{-- Porcentaje --}}
<div class="form-group row">
   {!! Form::label('Año', 'Año', ['class' => 'col-sm-3 col-form-label text-right']) !!}
   <div class="col-sm-9">
      <div class="mt-1">
         
         {{ Form::select('ano', $anos , $anoSelected,
               [
                  'id'           => 'lstAno',
                  'placeholder'  => 'Seleccione Año',         
                  'class'        => 'form-control select-ano'
               ])
         }}

         <div id="vAno"><span id="msgAno" class="validacion"></span></div>
      </div>
   </div>
</div>

{{-- Porcentaje Máximo --}}
<div class="form-group row">

   {!! Form::label('Porcentaje Reajuste', 'Porcentaje Reajuste', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}
   
   <div class="col-sm-9 input-group">

      {!! Form::number('porcentajeReajuste', Null,
         ['id'          => 'intPorcentajeReajuste',
         'class'        => 'form-control',
         'maxlength'    => '10',
         'placeholder'  => 'Porcentaje Reajuste' ]) 
      !!}
      
      <div class="input-group-prepend">
         <span class="input-group-text" id="basic-addon-calendar">
             <i class="fa fa-percent form-control-feedback"></i> 
         </span>
      </div>
   
      <div id="vPorcentajeReajuste"><span id="msgPorcentajeReajuste" class="validacion"></span></div>
      
   </div>
</div>
{{-- 
<div class="form-group row">
    
   <div class="col-sm-3">
      {!! link_to('#!', $title='Guardar', $attributes = [
         'id'     => 'guardar',
         'class'  => 'btn btn-primary float-right',
         'data-form' => 'form-agregar'
      ], $secure = null) !!}        
   </div>

   <div class="col-sm-9">
      {!! link_to_route('calculohoras.index', $title='Cancelar', $parameters = [] ,$attributes = [
         'id'     => 'cancelar',
         'class'  => 'btn btn-light float-right'
      ]) !!}
   </div>  




   
</div> --}}