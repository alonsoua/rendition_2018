@extends('main')

@section('title', 'AFP')

@section('breadcrumb', 'AFP')

@section('content')

<main style="background-color: #eeeeee; ">
<div class="col justify-content-md-center pt-4 pr-4 pl-4 pb-4">
<div class="card">

   <div class="card-header">
      <h5 class="font-weight-light mt-2 text-sm-left float-left">Listado de AFP</h5>
      @can('afp.create')
         {!! link_to_route('afp.create', $title='Agregar AFP', $parameters = [] ,$attributes = [
            'id'     => 'agregarSubvencion',
            'class'  => 'btn btn-primary mt-1 float-right'
         ]) !!}
      @endcan
   </div>

   @can('afp.index')
      <div class="card-body">
         <div id="alert" class="alert alert-info mt-2" style="display:none;"></div>
         <div class="table-responsive-xl">
            <table id="dataTable-afp" class="table table-striped table-bordered table-sm">
               <thead>
                  <tr>
                     <th scope="col">AFP</th>
                     <th scope="col">Porcentaje</th>
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

{!! Form::open(['route' => ['afp.destroy', ':AFP_ID'], 'method' => 'DELETE', 'id' => 'form-delete']) !!}
{!! Form::close() !!}

@endsection

@section('contentScript')
   <script type="text/javascript">
      @include("mantenedor.afp.script")
   </script>
@endsection
