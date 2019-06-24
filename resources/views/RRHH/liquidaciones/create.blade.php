@extends('main')

@section('title', 'Liquidaciones')

@section('breadcrumb', 'Liquidaciones')

@section('content')

<main style="background-color: #eeeeee;">
<div class="container" style=" padding-top: 15px;">
<div class="row justify-content-md-center">
<div class="col col-lg-11">
<div class="card">

<div class="card-header">
	<h4 class="my-0 font-weight-light text-sm-center">Nueva Liquidación</h4>
   <ul class="nav nav-tabs card-header-tabs">
      <li class="nav-item" style="cursor:pointer;">
         <a class="nav-link active" id="navLiquidacion" style="color: #495057;" href="#">Liquidación</a>
      </li>               
      <li class="nav-item" style="cursor:pointer;">
         <a class="nav-link" id="navSubvenciones" style="color: #495057; display: none;" href="#">Subvenciones</a>
      </li>
      <li class="nav-item" style="cursor:pointer;">
         <a class="nav-link" id="navDescuentos" style="color: #495057; display: none;" href="#">Descuentos</a>
      </li>
   </ul>
</div>

<div class="card-body">

   @include('RRHH.liquidaciones.partials.validaciones')

   {!!Form::open(['route' => ['liquidaciones.store']
         , 'method'  => 'STORE'
         , 'id'      => 'form-agregar'
         , 'files'   => true
         
      ]) 
   !!}

      {{-- @include('RRHH.liquidaciones.partials.fields') --}}
      
      <div id="liquidacion" style="display: block;">
         @include('RRHH.liquidaciones.partials.fieldsLiquidacion')               
      </div>
      <div id="subvenciones" style="display: none;">
         @include('RRHH.liquidaciones.partials.fieldsSubvenciones')               
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
               , $title='Guardar'
               , $attributes = [
                  'id'     => 'guardar',
                  'class'  => 'btn btn-primary float-right',
                  'data-form' => 'form-agregar'
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

@endsection

@section('contentScript')
   <script type="text/javascript">
      @include("RRHH.liquidaciones.script")
   </script>
@endsection
