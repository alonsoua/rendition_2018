@extends('main')

@section('title', 'Proveedores')

@section('breadcrumb', 'Proveedores')

@section('content')

<main style="background-color: #eeeeee; ">
<div class="col justify-content-md-center pt-4 pr-4 pl-4 pb-4">
<div class="card">

   <div class="card-header">
      <h5 class="font-weight-light mt-2 text-sm-left float-left">Listado de Proveedores</h5>
      @can('proveedores.create')
         {!! link_to_route('proveedores.create', $title='Agregar Proveedores', $parameters = [] ,$attributes = [
            'id'     => 'agregarProveedor',
            'class'  => 'btn btn-success mt-1 float-right btn-sm'
         ]) !!}
      @endcan
   </div>
   <div class="card-body">

      <div id="alert" class="alert alert-info mt-2" style="display:none;"></div>
      <div class="table-responsive-xl">
         <table id="dataTable-proveedores" class="table table-striped table-bordered table-sm">
            <thead>
               <tr>
                  <th scope="col" width="15%">Rut</th>
                  <th scope="col" width="20%">Raz&oacute;n Social</th>
                  <th scope="col" width="20%">Giro</th>
                  <th scope="col" width="15%">Direcci&oacute;n</th>
                  <th scope="col" width="15%">Tel&eacute;fono</th>
                  <th scope="col" width="10%" class="text-center">{{-- &nbsp; --}}opciones</th>
               </tr>
            </thead>
         </table>
      </div>
   </div>

</div>
</div>
</main>

{!! Form::open(['route' => ['proveedores.destroy', ':PROVEEDOR_ID'], 'method' => 'DELETE', 'id' => 'form-delete']) !!}
{!! Form::close() !!}

@endsection

@section('contentScript')
   <script type="text/javascript">
      @include("mantenedor.gastosProveedores.script")
   </script>
@endsection
