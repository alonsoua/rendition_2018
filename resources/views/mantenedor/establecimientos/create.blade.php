@extends('main')

@section('title', 'Agregar Establecimiento')

@section('breadcrumb', 'Establecimientos')

@section('content')

@include('estructura.cargando')

<main style="background-color: #eeeeee;">
<div class="container" style=" padding-top: 15px;">
<div class="row justify-content-md-center">
<div class="col col-lg-11">
<div class="card">

<div class="card-header">
	<h4 class="my-0 font-weight-light text-sm-center">Agregar Establecimiento</h4>
</div>

<div class="card-body">

   @include('mantenedor.establecimientos.partials.validaciones')

   {!!Form::open(['route' => ['establecimientos.store']
         , 'method'  => 'STORE'
         , 'id'      => 'form-agregar'
         , 'files'   => true
         
      ]) 
   !!}

      @include('mantenedor.establecimientos.partials.fields')
      
      <hr>
      {{-- Botones --}}
      <div class="form-group row">
         <div class="col-sm-3">

            {!! link_to_route('establecimientos.index'
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
      @include("mantenedor.establecimientos.script")
   </script>
@endsection
