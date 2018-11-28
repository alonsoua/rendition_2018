@extends('main')

@section('title', 'Agregar Sostenedor')

@section('breadcrumb', 'Sostenedores')

@section('content')

<main style="background-color: #eeeeee;">
<div class="container" style=" padding-top: 15px;">
<div class="row justify-content-md-center">
<div class="col col-lg-11">
<div class="card">

<div class="card-header">
	<h4 class="my-0 font-weight-light text-sm-center">Agregar Sostenedor</h4>
</div>

<div class="card-body">

   @include('mantenedor.sostenedores.partials.validaciones')

   {!! Form::open(['route' => ['sostenedores.store'], 'method' => 'STORE', 'id' => 'form-agregar']) !!}

      @include('mantenedor.sostenedores.partials.fields')

      <hr>
      {{-- Botones --}}
      <div class="form-group row">
         <div class="col-sm-3">
            {!! link_to_route('sostenedores.index', $title='Volver', $parameters = [] ,$attributes = [
               'id'     => 'cancelar',
               'class'  => 'btn btn-light float-left'
            ]) !!}
         </div>
         <div class="col-sm-9">
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
      @include("mantenedor.sostenedores.script")
   </script>
@endsection
