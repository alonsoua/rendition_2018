@extends('main')

@section('title', 'Documentos')

@section('breadcrumb', 'Tipos de Documentos')

@section('content')

<main style="background-color: #eeeeee; ">
<div class="col justify-content-md-center pt-4 pr-4 pl-4 pb-4">
<div class="card">

   <div class="card-header">
      <h5 class="font-weight-light mt-2 text-sm-left float-left">Listado de Tipos de Documentos</h5>
      @can('documentos.create')
         {!! link_to_route('documentos.create', $title='Agregar Tipo de Documento', $parameters = [] ,$attributes = [
            'id'     => 'agregarDocumento',
            'class'  => 'btn btn-primary mt-1 float-right'
         ]) !!}
      @endcan
   </div>
   
   @can('documentos.index')
      <div class="card-body">
         <div id="alert" class="alert alert-info mt-2" style="display:none;"></div>
         <div class="table-responsive-xl">
            <table id="dataTable-documentos" class="table table-striped table-bordered table-sm">
               <thead>
                  <tr>
                     <th scope="col" width="30%">C&oacute;digo</th>
                     <th scope="col" width="50%">Nombre</th>
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

{!! Form::open(['route' => ['documentos.destroy', ':DOC_ID'], 'method' => 'DELETE', 'id' => 'form-delete']) !!}
{!! Form::close() !!}

@endsection

@section('contentScript')
   <script type="text/javascript">
      @include("mantenedor.gastosDocumentos.script")
   </script>
@endsection
