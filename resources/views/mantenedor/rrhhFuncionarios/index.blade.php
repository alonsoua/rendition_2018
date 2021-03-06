@extends('main')

@section('title', 'Funcionarios Contratados')

@section('breadcrumb', 'Funcionarios Contratados')

@section('content')

<main style="background-color: #eeeeee; ">
<div class="col justify-content-md-center pt-4 pr-4 pl-4 pb-4">
<div class="card">

   <div class="card-header">
      <h5 class="font-weight-light mt-2 text-sm-left float-left">Lista de Funcionarios Contratados</h5>
      @can('funcionarios.create')
         {!! link_to_route('funcionarios.create', $title='Nuevo Contrato', $parameters = [] ,$attributes = [
            'id'     => 'agregarFuncionario',
            'class'  => 'btn btn-primary mt-1 float-right'
         ]) !!}
      @endcan
   </div>

   @can('funcionarios.index')
      <div class="card-body">
         <div id="alert" class="alert alert-info mt-2" style="display:none;"></div>
         <div class="table-responsive-xl">
            <table id="dataTable-funcionarios" class="table table-striped table-bordered table-sm">
               <thead>
                  <tr>
                     <th scope="col" width="25%">Establecimiento</th>
                     <th scope="col" width="9%">Rut</th>
                     <th scope="col" width="20%">Nombre</th>
                     <th scope="col" width="15%">Tipo Contrato</th>
                     <th scope="col" width="10%">Funci&oacute;n</th>
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

{!! Form::open(['route' => ['funcionarios.destroy', ':USER_ID'], 'method' => 'DELETE', 'id' => 'form-delete']) !!}
{!! Form::close() !!}

@endsection

@section('contentScript')
   <script type="text/javascript">
      @include("mantenedor.rrhhFuncionarios.script")
   </script>
@endsection
