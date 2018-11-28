{{-- Formulario --}}
<div class="form-group row">

   <div class="col-sm-12" id="rowCalculoHoras" style="display: none;"></div>
   
   {{-- Botones --}}
   <div class="col-sm-12" id="acciones" style="display: none;">
      <div class="text-center col-md-10 col-lg-12 alert alert-danger" id="msg" style="display: none;" role="alert">
      </div>

      {{-- GUARDAR --}}
      <div class="col-sm-10 col-md-12">
         {!! link_to('#!', $title='Guardar', $attributes = [
            'id'     => 'guardar',
            'class'  => 'btn btn-primary float-right',
            'data-form' => 'form-agregar'
         ], $secure = null) !!}        
      </div>

      {{-- CANCELAR --}}
      <div class="col-xs-5 col-sm-3 col-md-2 col-lg-2">
         {!! link_to_route('calculohoras.index', $title='Cancelar', $parameters = [] ,$attributes = [
            'id'     => 'cancelar',
            'class'  => 'btn btn-light float-right'
         ]) !!}
      </div>  
   </div>
   
   
</div>