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
   <br>
   <ul class="nav nav-tabs nav-fill card-header-tabs">
      <li class="nav-item">
         <a class="nav-link active" id="navLiquidacion" style="color: #495057;" href="#">Liquidación</a>
      </li>               
      <li class="nav-item">
         <a class="nav-link disabled" id="navImponibles" style="color: #495057;" href="#">Imponibles</a>
      </li>
      <li class="nav-item">
         <a class="nav-link disabled" id="navDescuentos" style="color: #495057;" href="#">Descuentos</a>
      </li>
   </ul>
</div>

<div class="card-body">

   @include('RRHH.liquidaciones.partials.validaciones')

   {!! Form::model($liquidacion,
      [    'route'   => ['liquidaciones.update', $liquidacion]
         , 'method'  => 'PUT'
         , 'id'      => 'form-editar'])
   !!}
      {{-- @include('RRHH.liquidaciones.partials.fields') --}}
      
      <div id="includeLiquidacion" class="">
         @include('RRHH.liquidaciones.partials.fieldsLiquidacion')               
      </div>
      <div id="includeImponibles" class="d-none">
         @include('RRHH.liquidaciones.partials.fieldsSubvenciones')               
      </div>
      <div id="includeDescuentos" class="d-none">
         @include('RRHH.liquidaciones.partials.fieldsDescuentos')
      </div>  
      <hr>
      {{-- Botones --}}
      <div class="form-group row">
         <div class="col-sm-3 divBtnVolver">

            {!! link_to_route('liquidaciones.index'
               , $title='Volver'
               , $parameters = []
               , $attributes = [
                  'id'     => 'cancelar',
                  'class'  => 'btn btn-light float-left'
               ]) 
            !!}

         </div>
         <div class="col-sm-3 d-none divBtnAtras">

            {!! link_to('#!'
               , $title='Volver'               
               , $attributes = [
                  'id'     => 'atras',
                  'class'  => 'btn btn-light float-left'
               ]) 
            !!}

         </div>

         <div class="col-sm-9 divBtnSiguiente">

            {!! link_to('#!'
               , $title='Siguiente'
               , $attributes = [
                  'id'     => 'siguiente',
                  'class'  => 'btn btn-primary float-right',
                  'data-form' => 'form-editar'
               ], $secure = null) 
            !!}

         </div>         
         <div class="col-sm-9 d-none divBtnGuardar">

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
