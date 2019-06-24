@extends('main')

@section('title', 'Editar Usuario')

@section('breadcrumb', 'Usuarios')

@section('content')

@include('estructura.cargando')

<main style="background-color: #eeeeee;">
<div class="container" style=" padding-top: 15px;">
<div class="row justify-content-md-center">
<div class="col col-lg-11">
<div class="card">

<div class="card-header">
   <h6 class="my-0 font-weight-light text-sm-center">Editar Usuario</h6>
   <h5 class="my-0 font-weight-light text-sm-center">{{ $usuario->rut }} - {{ $usuario->name }} 
   {{ $usuario->apellidoPaterno }} {{ $usuario->apellidoMaterno }}</h5>
   
</div>

<div class="card-body">

   @include('administrador.users.partials.validaciones')

   {!! Form::model($usuario,
      ['route'   => ['users.update', $usuario]
      , 'method' => 'PUT'
      , 'id'     => 'form-editar'])
   !!}

      @include('administrador.users.partials.fields')

      <hr>
      {{-- Acciones Btn --}}
      <div class="form-group row">
         <div class="col-sm-3">
            {!! link_to_route('users.index', $title='Volver', $parameters = [] ,$attributes = [
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
      @include("administrador.users.script")
   </script>

   <script>
      $(document).ready(function(){
         $('#msgVacio').css('display', 'block');
      });
   </script>
@endsection
