@extends('main')

@section('title', 'Liquidaciones')

@section('breadcrumb', 'Liquidaciones')

@section('content')

<main style="background-color: #eeeeee; ">
<div class="col justify-content-md-center pt-4 pr-4 pl-4 pb-4">
<div class="card">

   <div class="card-header">
      <h5 class="font-weight-light mt-2 text-sm-left float-left">Listado de Liquidaciones</h5>
      @can('liquidaciones.create')
         {!! link_to_route('liquidaciones.create', $title='Agregar Liquidación', $parameters = [] ,$attributes = [
            'id'     => 'agregarLiquidacion',
            'class'  => 'btn btn-primary mt-1 float-right'
         ]) !!}
      @endcan
   </div>
   
   @can('liquidaciones.index')
      <div class="card-body">
         <div id="alert" class="alert alert-info mt-2" style="display:none;"></div>
         <div class="table-responsive-xl">
            <table id="dataTable-liquidaciones" class="table table-striped table-bordered table-sm">
               <thead>
                  <tr>
                     <th scope="col" width="15%">Establecimiento</th>
                     <th scope="col" width="10%">Funcionario</th>
                     <th scope="col" width="12%">Mes</th>
                     {{-- <th scope="col" width="15%">Desripci&oacute;n</th>--}}
                     <th scope="col" width="15%">D&iacute;as Trabajados</th> 
                     <th scope="col" width="15%" class="text-center">opciones</th>
                  </tr>
               </thead>
            </table>
         </div>
      </div>
   @endcan
   
</div>
</div>
</main>

{!! Form::open(['route' => ['liquidaciones.destroy', ':ESTABLECIMIENTO_ID'], 'method' => 'DELETE', 'id' => 'form-delete']) !!}
{!! Form::close() !!}

@endsection

@section('contentScript')
   <script type="text/javascript">
      @include("RRHH.liquidaciones.script")
   </script>
@endsection
