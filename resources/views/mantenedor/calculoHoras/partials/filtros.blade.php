@include('estructura.cargando')
<input type="hidden" id="idEstablecimiento">
<div class="form-group row">
   {!! Form::label('Establecimiento', 'Establecimiento', ['class' => 'col-sm-3 col-form-label text-right']) !!}
   <div class="col-sm-9">
      <div class="mt-1">
         
         {{ Form::select('establecimiento', $establecimientos , null,
               [
                  'id'           => 'lstEstablecimiento',
                  'placeholder'  => 'Seleccione Establecimiento',         
                  'class'        => 'form-control select-establecimiento'
               ])
         }}

         <div id="vEstablecimiento"><span id="msgEstablecimiento" class="validacion"></span></div>
      </div>
   </div>
</div>

<div  id="row-Periodo" style="display: none">
   <div class="form-group row">
    
      {!! Form::label('Periodo', 'Periodo', ['class' => 'col-sm-3 col-form-label text-right']) !!}
    
      <div class="col-sm-9">
         <div class="mt-1">
    
            {{ Form::select('periodo', ['' => ''], null,
                  [
                     'id'           => 'lstPeriodo',
                     'placeholder'  => 'Seleccione Periodo',         
                     'class'        => 'form-control select-periodo'
                  ])
            }}

            <div id="vPeriodo"><span id="msgPeriodo" class="validacion"></span></div>
         </div>
      </div>
   </div>
</div>