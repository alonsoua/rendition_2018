@extends('main')

@section('title', 'Editar Rol')

@section('breadcrumb', 'Roles')

@section('content')

<main style="background-color: #eeeeee;">
<div class="container" style=" padding-top: 15px;">
<div class="row justify-content-md-center">
<div class="col col-lg-11">
<div class="card">

<div class="card-header">
   <h6 class="my-0 font-weight-light text-sm-center">Editar Rol</h6>   
   <h5 class="my-0 font-weight-light text-sm-center">{{ $roles->name }} - {{ $roles->description }}</h5>
</div>

<div class="card-body">

   @include('administrador.roles.partials.validaciones')

   {!! Form::model($roles,
      ['route'   => ['roles.update', $roles]
      , 'method' => 'PUT'
      , 'id'     => 'form-editar'
      , 'autocomplete' => 'off'])
   !!}

      @include('administrador.roles.partials.fields')

      <hr>
      {{-- Acciones Btn --}}
      <div class="form-group row">
         <div class="col-sm-1 col-md-2">
            {!! link_to_route('roles.index', $title='Volver', $parameters = [] ,$attributes = [
               'id'     => 'cancelar',
               'class'  => 'btn btn-light'
            ]) !!}
         </div>
         <div class="col-sm-11 col-md-10">
            {!! link_to('#!', $title='Editar', $attributes = [
               'id'        => 'guardar',
               'class'     => 'btn btn-primary float-right',
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
      @include("administrador.roles.script")
   </script>

   <script>
      $(document).ready(function(){
         $('#msgVacio').css('display', 'block');
      });
   </script>
@endsection
