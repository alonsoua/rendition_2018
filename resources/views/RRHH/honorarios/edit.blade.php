@extends('main')

@section('title', 'Editar Boleta de Honorario')

@section('breadcrumb', 'Boleta de Honorario')

@section('content')

@include('estructura.cargando')

<main style="background-color: #eeeeee;">
<div class="container" style=" padding-top: 15px;">
<div class="row justify-content-md-center">
<div class="col col-lg-11">
<div class="card">

<div class="card-header">
   <h4 class="my-0 font-weight-light text-sm-center">Editar Boleta de Honorario: {{ $imputacion->numDocumento }}</h4>
</div>

<div class="card-body">

   @include('RRHH.honorarios.partials.validaciones')

   {!! Form::model($imputacion,
      [    'route'   => ['honorarios.update', $imputacion]
         , 'method'  => 'PUT'
         , 'id'      => 'form-editar'
         , 'files'   => true
         , 'enctype' => 'multipart/form-data'
      ])
   !!}
         {{-- , 'enctype' => 'multipart/form-data' --}}

      @include('RRHH.honorarios.partials.fields')

      <hr>
      {{-- Acciones Btn --}}
      <div class="form-group row">
         <div class="col-sm-3">
            {!! link_to_route('honorarios.index', $title='Volver', $parameters = [] ,$attributes = [
               'id'     => 'cancelar',
               'class'  => 'btn btn-light float-left'
            ]) !!}
         </div>
         <div class="col-sm-9">
            {!! link_to('#!', $title='Editar', $attributes = [
               'id'        => 'guardar',
               'class'  => 'btn btn-primary float-right',
               'data-form' => 'form-editar'
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
</div>

@endsection

@section('contentScript')
   <script type="text/javascript">
      @include("RRHH.honorarios.script")
   </script>
@endsection
