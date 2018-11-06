@extends('main')

@section('title', 'Funcionarios')

@section('breadcrumb', 'Funcionarios')

@section('content')

<main style="background-color: #eeeeee; ">
<div class="col justify-content-md-center pt-4 pr-4 pl-4 pb-4">
<div class="card">

   <div class="card-header">
      <h5 class="font-weight-light mt-2 text-sm-left float-left">Listado de Funcionarios</h5>
      @can('funcionarios.create')
         {!! link_to_route('funcionarios.create', $title='Agregar Funcionarios', $parameters = [] ,$attributes = [
            'id'     => 'agregarFuncionario',
            'class'  => 'btn btn-success mt-1 float-right btn-sm'
         ]) !!}
      @endcan
   </div>
   <div class="card-body">

      <div id="alert" class="alert alert-info mt-2" style="display:none;"></div>
      <div class="table-responsive-xl">
         <table id="dataTable-funcionarios" class="table table-striped table-bordered table-sm">
            <thead>
               <tr>
                  <th scope="col" width="20%">Establecimiento</th>
                  <th scope="col" width="15%">Rut</th>
                  <th scope="col" width="20%">Nombre</th>
                  <th scope="col" width="15%">Tipo Contrato</th>
                  <th scope="col" width="15%">Funci&oacute;n</th>
                  <th scope="col" width="10%" class="text-center">{{-- &nbsp; --}}opciones</th>
               </tr>
            </thead>
         </table>
      </div>
   </div>

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
