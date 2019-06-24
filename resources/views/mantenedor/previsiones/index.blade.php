@extends('main')

@section('title', 'Previsiones')

@section('breadcrumb', 'Previsiones')

@section('content')

<main style="background-color: #eeeeee; ">
<div class="col justify-content-md-center pt-4 pr-4 pl-4 pb-4">
<div class="card">

   <div class="card-header">
      <h5 class="font-weight-light mt-2 text-sm-left float-left">Lista de Previsiones</h5>
      @can('previsiones.create')
         {!! link_to_route('previsiones.create', $title='Agregar Previsión', $parameters = [] ,$attributes = [
            'id'     => 'agregarSubvencion',
            'class'  => 'btn btn-primary mt-1 float-right'
         ]) !!}
      @endcan
   </div>

   @can('previsiones.index')
      <div class="card-body">
         <div id="alert" class="alert alert-info mt-2" style="display:none;"></div>
         <div class="table-responsive-xl">
            <table id="dataTable-prevision" class="table table-striped table-bordered table-sm">
               <thead>
                  <tr>
                     <th scope="col">Previsión</th>
                     <th scope="col">Porcentaje</th>
                     <th scope="col" width="8%" class="text-center">{{-- &nbsp; --}}opciones</th>
                  </tr>
               </thead>
            </table>
         </div>
      </div>
   @endcan

</div>
</div>
</main>

{!! Form::open(['route' => ['previsiones.destroy', ':PREVISION_ID'], 'method' => 'DELETE', 'id' => 'form-delete']) !!}
{!! Form::close() !!}

@endsection

@section('contentScript')
   <script type="text/javascript">
      @include("mantenedor.previsiones.script")
   </script>
@endsection
