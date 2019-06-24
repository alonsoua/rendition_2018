@extends('main')

@section('title', 'Calcular Reajuste')

@section('breadcrumb', 'Calcular Reajuste')

@section('content')


@include('estructura.cargando')

<main style="background-color: #eeeeee;">
<div class="container" style=" padding-top: 15px;">
<div class="row justify-content-md-center">
<div class="col col-lg-11">
<div class="card">

<div class="card-header">
   <h4 class="my-0 font-weight-light text-sm-center">Calcular Reajuste</h4>
</div>

<div class="card-body">

   {{-- @include('mantenedor.reajustes.partials.validaciones') --}}

   {!! Form::open(['route' => ['reajustes.store'], 'method' => 'STORE', 'id' => 'form-agregar']) !!}

      @can('reajuste.create')
         @include('mantenedor.reajustes.partials.create')
         
         
      @endcan
      
      <hr>
      <div class="form-group row">
         <div class="col-sm-3">
            {!! link_to_route('subvenciones.index', $title='Volver', $parameters = [] ,$attributes = [
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
      @can('reajuste.index')
         @include('mantenedor.reajustes.partials.historial')                           
      @endcan     

</div>
</div>
</div>
</div>
</main>
{{-- 

<main style="background-color: #eeeeee; ">
<div class="col justify-content-md-center pt-4 pr-4 pl-4 pb-4">
<div class="card">

   <div class="card-header">
      <h5 class="font-weight-light mt-2 text-sm-left float-left">Calcular Reajuste</h5>
      
   </div>
   <div class="card-body">      
        
         {!! Form::open(['route' => ['reajustes.store'], 'method' => 'STORE', 'id' => 'form-agregar']) !!}
            @can('reajuste.create')
               @include('mantenedor.reajustes.partials.create')
               <br>               
               
            @endcan
            
            @can('reajuste.index')
               @include('mantenedor.reajustes.partials.historial')
               <br>               
               
            @endcan

         {{ Form::close() }}

   </div>
</div>
</div>
</main>
 --}}
@endsection

@section('contentScript')
   <script type="text/javascript">
      @include("mantenedor.reajustes.script")
   </script>
@endsection
