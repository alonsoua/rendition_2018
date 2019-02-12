@extends('main')

@section('title', 'Leyes')

@section('breadcrumb', 'Leyes')

@section('content')

<main style="background-color: #eeeeee; ">
<div class="col justify-content-md-center pt-4 pr-4 pl-4 pb-4">
<div class="card">

   <div class="card-header">
      <h5 class="font-weight-light mt-2 text-sm-left float-left">Listado de Leyes</h5>
      @can('leyes.create')
         {!! link_to_route('leyes.create', $title='Agregar Leyes', $parameters = [] ,$attributes = [
            'id'     => 'agregarLey',
            'class'  => 'btn btn-primary mt-1 float-right'
         ]) !!}
      @endcan
   </div>
   
   @can('leyes.index')
      <div class="card-body">
         <div id="alert" class="alert alert-info mt-2" style="display:none;"></div>
         <div class="table-responsive-xl">
            <table id="dataTable-leyes" class="table table-striped table-bordered table-sm">
               <thead>
                  <tr>
                     <th scope="col" width="10%">C&oacute;digo</th>
                     <th scope="col" width="50%">Nombre</th>
                     <th scope="col" width="8%">Tipo</th>
                     <th scope="col" width="15%">Subvenci&oacute;n</th>
                     <th scope="col" width="8%" class="text-center">{{-- &nbsp; --}}Opciones</th>
                  </tr>
               </thead>
            </table>
         </div>
      </div>
   @endcan

</div>
</div>
</main>

{!! Form::open(['route' => ['leyes.destroy', ':LEYES_ID'], 'method' => 'DELETE', 'id' => 'form-delete']) !!}
{!! Form::close() !!}

@endsection

@section('contentScript')
   <script type="text/javascript">
      @include("mantenedor.leyes.script")
   </script>
@endsection
