@extends('main')

@section('title', 'Editar Contrato Funcionario')

@section('breadcrumb', 'Contrato Funcionarios')

@section('content')

@include('estructura.cargando')

<main style="background-color: #eeeeee;">
<div class="container" style=" padding-top: 15px;">
<div class="row justify-content-md-center">
<div class="col col-lg-11">
<div class="card">


@php   
   if ($editar == 1) {
      if ($funcionario->idTipoContrato == 3) {                     
         $navSubvencionesDisplay = 'display:none;';
      } else {
         $navSubvencionesDisplay = 'display:block;';
      }   
   } else {
      $navSubvencionesDisplay = 'display:block;';
   }
@endphp



   <div class="card-header">
      <h4 class="my-0 font-weight-light text-sm-center">
         Editar Contrato Funcionario: {{ $funcionario->rut }} - {{ $funcionario->nombre }}
      </h4>
      <ul class="nav nav-tabs card-header-tabs">
         <li class="nav-item" style="cursor:pointer;">
            <a class="nav-link active" id="navPersonal">Personal</a>
         </li>               
         <li class="nav-item" style="cursor:pointer;"">
            <a class="nav-link" id="navSubvenciones" style="{{ $navSubvencionesDisplay }}">Horas Subvención</a>
         </li>
      </ul>
   </div>

<div class="card-body">

   @include('mantenedor.rrhhFuncionarios.partials.validaciones')

   {!! Form::model($funcionario,
      ['route'   => ['funcionarios.update', $funcionario]
      , 'method' => 'PUT'
      , 'id'     => 'form-editar'])
   !!}

      <div id="personal" style="display: block;">
         @include('mantenedor.rrhhFuncionarios.partials.fieldsPersonal')               
      </div>
      <div id="subvenciones" style="display: none;">
         @include('mantenedor.rrhhFuncionarios.partials.fieldsSubvenciones')               
      </div>  

      {{-- Acciones Btn --}}
      <div class="form-group row">
         <div class="col-sm-2 col-md-3">
            {!! link_to_route('funcionarios.index', $title='Volver', $parameters = [] ,$attributes = [
               'id'     => 'cancelar',
               'class'  => 'btn btn-light float-md-left float-sm-left'
            ]) !!}
         </div>
         <div class="col-sm-10 col-md-9">
            {!! link_to('#!', $title='Editar', $attributes = [
               'id'        => 'guardar',
               'class'     => 'btn btn-primary float-right ',
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
      @include("mantenedor.rrhhFuncionarios.script")
   </script>
@endsection
