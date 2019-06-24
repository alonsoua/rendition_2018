@extends('main')

@section('title', 'Liquidaciones')

@section('breadcrumb', 'Liquidaciones')

@section('content')

<main style="background-color: #eeeeee; ">
<div class="col justify-content-md-center pt-4 pr-4 pl-4 pb-4">
<div class="card ">

   <div class="card-header ">
         
      <div class="form-group row">
         {!! Form::label('Desde: ', 'Desde: ', ['class' => 'ml-3 mr-2 col-form-label text-md-left text-sm-left']) !!}
         <div class="col-md-2 ">
            <div class="input-group">
                
               <input type="text" name="desde" id="desde" class="form-control filter-input fecha-desde" autocomplete="off" />
         
               <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon-calendar">
                     <i class="fa fa-calendar-alt form-control-feedback"></i> 
                  </span>
               </div>
            </div>
            <div id="vDesde"><span id="msgDesde" class="validacion"></span></div>
         </div>
         
         {!! Form::label('Hasta: ', 'Hasta: ', ['class' => 'ml-3 mr-2 col-form-label text-md-left text-sm-left']) !!}
         <div class="col-md-2">
            <div class="input-group">

               <input type="text" name="hasta" id="hasta" class="form-control filter-input fecha-hasta" autocomplete="off" />
         
               <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon-calendar">
                     <i class="fa fa-calendar-alt form-control-feedback"></i> 
                  </span>
               </div>
            </div>
            <div id="vHasta"><span id="msgHasta" class="validacion"></span></div>
         </div>         
         <div class="col-md-1">
            <input type="button" name="btnImprimir" id="btnImprimir" value="Imprimir" class="btn btn-success active" />
         </div>
      </div>
               
           <hr>
      <h5 class="font-weight-light mt-2 text-sm-left float-left">Lista de Liquidaciones</h5>
      @can('liquidaciones.create')
         {!! link_to_route('liquidaciones.create', $title='Nueva Liquidación', $parameters = [] ,$attributes = [
            'id'     => 'agregarLiquidacion',
            'class'  => 'btn btn-primary mt-1 float-right active'
         ]) !!}
      @endcan
   </div>
   
   @can('liquidaciones.index')
      <div class="card-body">
         <div id="alert" class="alert alert-info mt-2" style="display:none;"></div>
         <div class="table-responsive-xl">
            <table id="dataTable-liquidaciones" style="display:;" class="table table-striped table-bordered table-sm">
               <thead>
                  <tr>
                     <th scope="col" width="15%">Rut</th>
                     <th scope="col" width="10%">Nombre</th>
                     <th scope="col" width="10%">Apellido</th>
                     <th scope="col" width="12%">Fecha</th>
                     <th scope="col" width="15%">D&iacute;as Trabajados</th> 
                     <th scope="col" width="15%">Establecimiento</th>
                     {{-- <th scope="col" width="15%">Desripci&oacute;n</th>--}}
                     <th scope="col" width="15%" class="text-center">opciones</th>
                  </tr>
               </thead>
            </table>            
         </div>
      </div>
   @endcan
   
</div>
</div>
</main>

{!! Form::open(['route' => ['liquidaciones.destroy', ':ESTABLECIMIENTO_ID'], 'method' => 'DELETE', 'id' => 'form-delete']) !!}
{!! Form::close() !!}

@endsection

@section('contentScript')
   <script type="text/javascript">
      @include("RRHH.liquidaciones.script")
   </script>
@endsection
