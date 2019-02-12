@extends('main')

@section('title', 'Sostenedores')

@section('breadcrumb', 'Sostenedores')

@section('content')

<main style="background-color: #eeeeee; ">
<div class="col justify-content-md-center pt-4 pr-4 pl-4 pb-4">
<div class="card">

   <div class="card-header">
      <h5 class="font-weight-light mt-2 text-sm-left float-left">Listado de Sostenedores</h5>
      @can('sostenedores.create')
         {!! link_to_route('sostenedores.create', $title='Agregar Sostenedores', $parameters = [] ,$attributes = [
            'id'     => 'agregarSostenedor',
            'class'  => 'btn btn-primary mt-1 float-right'
         ]) !!}
      @endcan
   </div>

   @can('sostenedores.index')
      <div class="card-body">
         <div id="alert" class="alert alert-info mt-2" style="display:none;"></div>
         <div class="table-responsive-xl">
            <table id="dataTable-sostenedores" class="table table-striped table-bordered table-sm">
               <thead>
                  <tr>
                     <th scope="col" width="10%">Rut</th>
                     <th scope="col" width="15%">Nombre</th>
                     <th scope="col" width="15%">Apellido</th>
                     <th scope="col" width="30%">Direcci&oacute;n</th>
                     <th scope="col" width="8%">Tel&eacute;fono</th>
                     <th scope="col" width="10%">Correo</th>
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

{!! Form::open(['route' => ['sostenedores.destroy', ':SOSTENEDOR_ID'], 'method' => 'DELETE', 'id' => 'form-delete']) !!}
{!! Form::close() !!}

@endsection

@section('contentScript')
   <script type="text/javascript">
      @include("mantenedor.sostenedores.script")
   </script>
@endsection
