@extends('main')

@section('title', 'Cuentas')

@section('breadcrumb', 'Cuentas')

@section('content')

<main style="background-color: #eeeeee; ">
<div class="col justify-content-md-center pt-4 pr-4 pl-4 pb-4">
<div class="card">

   <div class="card-header">
      <h5 class="font-weight-light mt-2 text-sm-left float-left">Lista de Cuentas</h5>
      @can('cuentas.create')
         {!! link_to_route('cuentas.create', $title='Agregar Cuentas', $parameters = [] ,$attributes = [
            'id'     => 'agregarCuenta',
            'class'  => 'btn btn-primary mt-1 float-right'
         ]) !!}
      @endcan
   </div>
   @can('cuentas.index')
      <div class="card-body">
         <div id="alert" class="alert alert-info mt-2" style="display:none;"></div>
         <div class="table-responsive-xl">
            <table id="dataTable-cuentas" class="table table-bordered table-striped table-hover table-sm ">
               <thead>
                  <tr>
                     <th scope="col" width="5%">C&oacute;digo</th>
                     <th scope="col" width="40%">Nombre</th>                     
                     <th scope="col" width="60%">Subvenciones</th>                     
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

{!! Form::open(['route' => ['cuentas.destroy', ':CUENTA_ID'], 'method' => 'DELETE', 'id' => 'form-delete']) !!}
{!! Form::close() !!}

@endsection

@section('contentScript')
   <script type="text/javascript">
      @include("mantenedor.gastosCuentas.script")
   </script>
@endsection
