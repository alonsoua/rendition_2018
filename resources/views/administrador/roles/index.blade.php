@extends('main')

@section('title', 'Roles')

@section('breadcrumb', 'Roles')

@section('content')

<main style="background-color: #eeeeee; ">
<div class="col justify-content-md-center pt-4 pr-4 pl-4 pb-4">
<div class="card">

   <div class="card-header">
      <h5 class="font-weight-light mt-2 text-sm-left float-left">Lista de Roles</h5>
      @can('roles.create')
         {!! link_to_route('roles.create', $title='Agregar Roles', $parameters = [] ,$attributes = [
            'id'     => 'agregarRol',
            'class'  => 'btn btn-primary mt-1 float-right'
         ]) !!}
      @endcan
   </div>

   @can('roles.index')
      <div class="card-body">
         <div id="alert" class="alert alert-info mt-2" style="display:none;"></div>
         <div class="table-responsive-xl">
            <table id="dataTable-roles" class="table table-striped table-bordered table-sm">
               <thead>
                  <tr>
                     {{-- <th scope="col" width="15%">Rut</th> --}}
                     <th scope="col" width="40%">Nombre</th>
                     <th scope="col" width="45%">Descripción</th>
                     {{-- <th scope="col" width="15%">Perfil</th> --}}
                     {{-- <th scope="col" width="15%">Correo</th> --}}
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

{!! Form::open(['route' => ['roles.destroy', ':ROL_ID'], 'method' => 'DELETE', 'id' => 'form-delete']) !!}
{!! Form::close() !!}

@endsection

@section('contentScript')
   <script type="text/javascript">
      @include("administrador.roles.script")
   </script>
@endsection
