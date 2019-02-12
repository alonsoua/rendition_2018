@extends('main')

@section('title', 'Subvenciones')

@section('breadcrumb', 'Subvenciones')

@section('content')

<main style="background-color: #eeeeee; ">
<div class="col justify-content-md-center pt-4 pr-4 pl-4 pb-4">
<div class="card">

   <div class="card-header">
      <h5 class="font-weight-light mt-2 text-sm-left float-left">Listado de Subvenciones</h5>
      @can('subvenciones.create')
         {!! link_to_route('subvenciones.create', $title='Agregar Subvenciones', $parameters = [] ,$attributes = [
            'id'     => 'agregarSubvencion',
            'class'  => 'btn btn-primary mt-1 float-right'
         ]) !!}
      @endcan
   </div>

   @can('subvenciones.index')
      <div class="card-body">
         <div id="alert" class="alert alert-info mt-2" style="display:none;"></div>
         <div class="table-responsive-xl">
            <table id="dataTable-subvenciones" class="table table-striped table-bordered table-sm">
               <thead>
                  <tr>
                     <th scope="col">Nombre</th>
                     <th scope="col">Porcentaje M&aacute;ximo</th>
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

{!! Form::open(['route' => ['subvenciones.destroy', ':SUBVENCION_ID'], 'method' => 'DELETE', 'id' => 'form-delete']) !!}
{!! Form::close() !!}

@endsection

@section('contentScript')
   <script type="text/javascript">
      @include("mantenedor.subvenciones.script")
   </script>
@endsection
