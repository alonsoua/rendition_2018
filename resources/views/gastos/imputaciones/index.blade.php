@extends('main')

@section('title', 'Imputación de Gastos')

@section('breadcrumb', 'Imputación de Gastos')

@section('content')

<main style="background-color: #eeeeee; ">
<div class="col justify-content-md-center pt-4 pr-4 pl-4 pb-4">
<div class="card">

   <div class="card-header">
      <h5 class="font-weight-light mt-2 text-sm-left float-left">Listado de Gastos</h5>
      @can('imputaciones.create')
         {!! link_to_route('imputaciones.create', $title='Imputar Gasto', $parameters = [] ,$attributes = [
            'id'     => 'agregarGasto',
            'class'  => 'btn btn-primary mt-1 float-right'
         ]) !!}
      @endcan
   </div>
   
   @can('imputaciones.index')
      <div class="card-body">
         <div id="alert" class="alert alert-info mt-2" style="display:none;"></div>
         <div class="table-responsive-xl">
            <table id="dataTable-imputaciones" class="table table-striped table-bordered table-sm">
               <thead>
                  <tr>
                     <th scope="col" width="20%">Establecimiento</th>
                     <th scope="col" width="5%">Rbd</th>
                     <th scope="col" width="10%">Subvenci&oacute;n</th>
                     <th scope="col" width="10%">C&oacute;digo Cuenta</th>
                     <th scope="col" width="10%">Tipo Documento</th>
                     <th scope="col" width="5%">N° Documento</th>
                     <th scope="col" width="5%">Fecha Documento</th>
                     <th scope="col" width="5%">Fecha Pago</th>
                     <th scope="col" width="15%">Descripci&oacute;n Gasto</th>
                     <th scope="col" width="20%">Rut Proveedor</th>
                     <th scope="col" width="20%">Nombre Proveedor</th>
                     <th scope="col" width="10%">Monto Gasto</th>
                     <th scope="col" width="10%">Monto Documento</th>
                     <th scope="col" width="10%">Estado</th>
                     <th scope="col" width="15%" class="text-center opciones">opciones</th>
                  </tr>
               </thead>
            </table>
         </div>
      </div>
   @endcan
   
</div>
</div>
</main>

{!! Form::open(['route' => ['imputaciones.destroy', ':IMPUTACION_ID'], 'method' => 'DELETE', 'id' => 'form-delete']) !!}
{!! Form::close() !!}

{{-- {!! Form::open(['route' => ['imputaciones.modificarEstado', ':IMPUTACIONMODIFICADA_ID'], 'method' => 'DELETE', 'id' => 'form-modificarEstado']) !!}
{!! Form::close() !!} --}}

@endsection

@section('contentScript')
   <script type="text/javascript">
      @include("gastos.imputaciones.script")
   </script>
@endsection
