@extends('main')

@section('title', 'Editar Liquidación')

@section('breadcrumb', 'Liquidación')

@section('content')

<main style="background-color: #eeeeee;">
<div class="container" style=" padding-top: 15px;">
<div class="row justify-content-md-center">
<div class="col col-lg-11">
<div class="card">

<div class="card-header">
   <h4 class="my-0 font-weight-light text-sm-center">Editar Liquidación: {{ $liquidacion->numDocumento }}</h4>
</div>

<div class="card-body">

   @include('RRHH.liquidaciones.partials.validaciones')

   {!! Form::model($liquidacion,
      [    'route'   => ['liquidaciones.update', $liquidacion]
         , 'method'  => 'PUT'
         , 'id'      => 'form-editar'])
   !!}
      {{-- @include('RRHH.liquidaciones.partials.fields') --}}
      
      <div id="liquidacion" style="display: block;">
         @include('RRHH.liquidaciones.partials.fieldsLiquidacion')               
      </div>
      <div id="subvenciones" style="display: none;">
         {{-- @include('RRHH.liquidaciones.partials.fieldsSubvenciones')                --}}
      </div>
      <div id="descuentos" style="display: none;">
         @include('RRHH.liquidaciones.partials.fieldsDescuentos')
      </div>  
      <hr>
      {{-- Botones --}}
      <div class="form-group row">
         <div class="col-sm-3">

            {!! link_to_route('liquidaciones.index'
               , $title='Volver'
               , $parameters = []
               , $attributes = [
                  'id'     => 'cancelar',
                  'class'  => 'btn btn-light float-left'
               ]) 
            !!}

         </div>
         <div class="col-sm-9">

            {!! link_to('#!'
               , $title='Editar'
               , $attributes = [
                  'id'     => 'guardar',
                  'class'  => 'btn btn-primary float-right',
                  'data-form' => 'form-editar'
               ], $secure = null) 
            !!}

         </div>
      </div>

   {!! Form::close() !!}

</div>

</div>
</div>
</div>
</div>
</main>
</div>

@endsection

@section('contentScript')
   <script type="text/javascript">
      @include("RRHH.liquidaciones.script")
   </script>
@endsection
