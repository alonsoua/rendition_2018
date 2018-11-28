@extends('main')

@section('title', 'Cálculo Horas')

@section('breadcrumb', 'Cálculo Horas')

@section('content')

<main style="background-color: #eeeeee; ">
<div class="col justify-content-md-center pt-4 pr-4 pl-4 pb-4">
<div class="card">

   <div class="card-header">
      <h5 class="font-weight-light mt-2 text-sm-left float-left">Cálculo de Horas</h5>
      
   </div>
   <div class="card-body">      
      <div>         
         {!! Form::open(['route' => ['calculohoras.store'], 'method' => 'STORE', 'id' => 'form-agregar']) !!}
            @can('calculohoras.index')
               @include('mantenedor.calculoHoras.partials.filtros')
               <br>               
               @include('mantenedor.calculoHoras.partials.calculoHoras')
            @endcan

         {{ Form::close() }}
      </div>      
   </div>
</div>
</div>
</main>

@endsection

@section('contentScript')
   <script type="text/javascript">
      @include("mantenedor.calculoHoras.script")
   </script>
@endsection
