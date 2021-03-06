@extends('main')

@section('title', 'Usuarios')

@section('breadcrumb', 'Usuarios')

@section('content')

<main style="background-color: #eeeeee; ">
<div class="col justify-content-md-center pt-4 pr-4 pl-4 pb-4">
<div class="card ">

   <div class="card-header">
      <h5 class="font-weight-light mt-2 text-sm-left float-left">Lista de Usuarios</h5>
      @can('users.create')
         {!! link_to_route('users.create', $title='Agregar Usuarios', $parameters = [] ,$attributes = [
            'id'     => 'agregarUsuario',
            'class'  => 'btn btn-primary mt-1 float-right'
         ]) !!}
      @endcan
   </div>

   @can('users.index')     
  
      <div class="card-body">
         <div id="alert" class="alert alert-info mt-2" style="display:none;"></div>
         <div class="table-responsive-xl">
            <table id="dataTable-users" class="table table-striped table-bordered table-sm">
               <thead>
                  <tr>
                     <th scope="col" width="15%">Rut</th>
                     <th scope="col" width="25%">Nombre</th>             
                     <th scope="col" width="25%">Correo</th>
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

{!! Form::open(['route' => ['users.destroy', ':USER_ID'], 'method' => 'DELETE', 'id' => 'form-delete']) !!}
{!! Form::close() !!}

@endsection

@section('contentScript')
   <script type="text/javascript">
      @include("administrador.users.script")
   </script>
@endsection
