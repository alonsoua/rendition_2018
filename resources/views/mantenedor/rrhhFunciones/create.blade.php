@extends('main')

@section('title', 'Agregar Función')

@section('breadcrumb', 'Funciones')

@section('content')

<main style="background-color: #eeeeee;">
<div class="container" style=" padding-top: 15px;">
<div class="row justify-content-md-center">
<div class="col col-lg-11">
<div class="card">

<div class="card-header">
	<h4 class="my-0 font-weight-light text-sm-center">Agregar Función</h4>
</div>

<div class="card-body">

   @include('mantenedor.rrhhFunciones.partials.validaciones')

   {!! Form::open(['route' => ['funciones.store'], 'method' => 'STORE', 'id' => 'form-agregar']) !!}

      @include('mantenedor.rrhhFunciones.partials.fields')

      {{-- Botones --}}
      <div class="form-group row">
         <div class="col-sm-3">
            {!! link_to_route('funciones.index', $title='Volver', $parameters = [] ,$attributes = [
               'id'     => 'cancelar',
               'class'  => 'btn btn-info float-right'
            ]) !!}
         </div>
         <div class="col-sm-9">
            {!! link_to('#!', $title='Guardar', $attributes = [
               'id'     => 'guardar',
               'class'  => 'btn btn-success float-left',
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
      @include("mantenedor.rrhhFunciones.script")
   </script>
@endsection
