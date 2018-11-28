@extends('main')

@section('title', 'Editar Sostenedor')

@section('breadcrumb', 'Sostenedor')

@section('content')

<main style="background-color: #eeeeee;">
<div class="container" style=" padding-top: 15px;">
<div class="row justify-content-md-center">
<div class="col col-lg-11">
<div class="card">

<div class="card-header">
   <h4 class="my-0 font-weight-light text-sm-center">Editar Sostenedor: {{ $sostenedor->nombre }} {{ $sostenedor->apellidoPaterno }}</h4>
</div>

<div class="card-body">

   @include('mantenedor.sostenedores.partials.validaciones')

   {!! Form::model($sostenedor,
      ['route'   => ['sostenedores.update', $sostenedor]
      , 'method' => 'PUT'
      , 'id'     => 'form-editar'])
   !!}

      @include('mantenedor.sostenedores.partials.fields')
      
      <hr>
      {{-- Acciones Btn --}}
      <div class="form-group row">
         <div class="col-sm-3">
            {!! link_to_route('sostenedores.index', $title='Volver', $parameters = [] ,$attributes = [
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
      @include("mantenedor.sostenedores.script")
   </script>
@endsection
