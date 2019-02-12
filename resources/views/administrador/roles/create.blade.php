@extends('main')

@section('title', 'Agregar Rol')

@section('breadcrumb', 'Roles')

@section('content')

@include('estructura.cargando')

<main style="background-color: #eeeeee;">
<div class="container" style=" padding-top: 15px;">
<div class="row justify-content-md-center">
<div class="col col-lg-11">
<div class="card">

<div class="card-header">
	<h5 class="my-0 font-weight-light text-sm-center">Agregar Rol</h5>
</div>

<div class="card-body">

   @include('administrador.roles.partials.validaciones')

   {!! Form::open(['route' => ['roles.store'], 'method' => 'STORE', 'id' => 'form-agregar', 'autocomplete' => 'off']) !!}

      @include('administrador.roles.partials.fields')

      <hr>
      {{-- Botones --}}
      <div class="form-group row">
         <div class="col-sm-1 col-md-2">
            {!! link_to_route('roles.index', $title='Volver', $parameters = [] ,$attributes = [
               'id'     => 'cancelar',
               'class'  => 'btn btn-light '
            ]) !!}
         </div>
         
         <div class="col-sm-11 col-md-10">
            {!! link_to('#!', $title='Guardar', $attributes = [
               'id'     => 'guardar',
               'class'  => 'btn btn-primary float-right',
               'data-form' => 'form-agregar'
            ], $secure = null) !!}
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
      @include("administrador.roles.script")
   </script>
@endsection
