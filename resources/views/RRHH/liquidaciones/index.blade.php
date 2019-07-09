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
                     

                     {{-- 11 --}}
{{-- 12 --}}
{{-- 13 --}}
{{-- 14 --}}
{{-- 15 --}}
{{-- 16 --}}
{{-- 17 --}}
{{-- 18 --}}
{{-- 19 --}}
{{-- 20 --}}
{{-- 21 --}}
{{-- 22 --}}
{{-- 23 --}}
{{-- 24 --}}
{{-- 25 --}}
{{-- 26 --}}
{{-- 27 --}}
{{-- 28 --}}
{{-- 29 --}}

                  <tr>
                     <th scope="col" width="15%">Rut</th>                                                                              {{-- 0 --}}
                     <th scope="col">Rut Trabajador</th>                                                                               {{-- 1 --}}
                     <th scope="col">DGV Rut Trabajador</th>                                                                           {{-- 2 --}}
                     <th scope="col" width="10%">Apellido Paterno</th>                                                                 {{-- 3 --}}
                     <th scope="col" width="10%">Apellido Materno</th>                                                                 {{-- 4 --}}
                     <th scope="col" width="10%">Nombres</th>                                                                           {{-- 5 --}}           
                     <th scope="col" width="12%">Fecha</th>                                                                            {{-- 6 --}}
                     <th scope="col" width="15%">D&iacute;as Trabajados</th>                                                           {{-- 7 --}}
                     <th scope="col" width="15%">Periodo</th>                                                                          {{-- 8 --}}
                     <th scope="col" width="15%">Establecimiento</th>                                                                  {{-- 9 --}}
                     <th scope="col">RBD de trabajo ("AC", para administracion central)</th>                                           {{-- 10 --}}
                     <th scope="col">Tipo Contrato</th>                                                                                
                     <th scope="col">Horas de contrato Semanal</th>                                                                    
                     <th scope="col">Fecha Inicio Contrato</th>                                                                        
                     <th scope="col" width="10%">Funcion</th>                                                                          
                     <th scope="col">Mes de la Liquidacion</th>                                                                        
                     <th scope="col">Annio de la Liquidacion</th>                                                                      
                     <th scope="col">Dias Trabajados en el Mes</th>                                                                    
                     <th scope="col">Horas de Contrato SEP</th>                                                                        
                     <th scope="col">Fecha de inicio contrato SEP</th>                                                                 
                     <th scope="col">SUELDO BASE</th>                                                                                  
                     {{-- <th scope="col">HORAS EXTRAS</th>                                                                                 
                     <th scope="col">LEY Numero 19.933 (INCLUYE ART. 41 DFL Numero 2/98 ED.)</th>                                      
                     <th scope="col">INCREMENTO % ZONA</th>                                                                            
                     <th scope="col">BRP TITULO Y MENCION LEY Numero 20.158</th>                                                       
                     <th scope="col">LEY 19.464 ASISTENTES (INCLUYE INTERNADOS) (ART. 5I TRANS. DFL Numero 2/98 ED.)</th>              
                     <th scope="col">ASIGNACION DESEMPENO CONDICIONES DIFICILES DOCENTES</th>                                          
                     <th scope="col">SNED DOCENTES ART. 40 DFL Numero 2/98 ED.</th>                                                    
                     <th scope="col">SNED ASISTENTES EDUCACION LEY Numero 20.244</th>                                                  
                     <th scope="col">BONIFICACION DE PROFESORES ENCARGADOS, LEY Numero 19.715, ART.13</th>                             
                     <th scope="col">ASIGNACION DE EXCELENCIA PEDAGOGICA (AEP) LEY Numero 19.715</th>
                     <th scope="col">ASIGNACION POR DESEMPENO COLECTIVO, ART.18, LEY Numero 19.933</th>
                     <th scope="col">ASIGNACIONES</th>
                     <th scope="col">PAGO OTROS BONOS DOCENTES FISCALES</th>
                     <th scope="col">PAGO OTROS BONOS ASISTENTES DE LA EDUCACION FISCALES</th>
                     <th scope="col">COLACION Y MOVILIZACION</th>
                     <th scope="col">BONOS ACORDADOS  CON EL SOSTENEDOR</th>
                     <th scope="col">ASIGNACION DESEMPENO CONDICIONES DIFICILES ASISTENTES DE LA EDUCACION</th>
                     <th scope="col">PLANILLA COMPLEMENTARIA LEY Numero 19.410</th>
                     <th scope="col">BONO EXTRAORDINARIO SUBVENCION ADICIONAL ESPECIAL (BONO SAE)</th>
                     <th scope="col">PAGO BONO DE ESCOLARIAD Y ADICIONAL</th>
                     <th scope="col">PAGO AGUINALDO DE NAVIDAD</th>
                     <th scope="col">PAGO AGUINALDO DE FIESTAS PATRIAS</th>
                     <th scope="col">PAGO BONO ESPECIAL</th>
                     <th scope="col">PAGO BONO VACACIONES</th>
                     <th scope="col">PAGO BONO DESEMPENO LABORAL</th>
                     <th scope="col">OTROS BONOS NO IMPONIBLES LEY DE REAJUSTE</th>
                     <th scope="col">SUELDO BASE</th>
                     <th scope="col">HORAS EXTRAS</th>
                     <th scope="col">INCREMENTO % ZONA</th>
                     <th scope="col">BRP TÍTULO Y MENCIÓN LEY Nº 20.158</th>
                     <th scope="col">ASIGNACIONES</th>
                     <th scope="col">COLACION Y MOVILIZACION</th>
                     <th scope="col">BONOS ACORDADOS  CON EL SOSTENEDOR BONO INCENTIVO AL DESEMPEÑO LEY N°20.248 ART. 8°  N°4</th>
                     <th scope="col">SUELDO BASE</th>
                     <th scope="col">HORAS EXTRAS</th>
                     <th scope="col">LEY Numero 19.933 (INCLUYE ART. 41 DFL Numero 2/98 ED.)</th>
                     <th scope="col">INCREMENTO % ZONA</th>
                     <th scope="col">BRP TÍTULO Y MENCIÓN LEY Nº 20.158</th>
                     <th scope="col">ASIGNACIONES</th>
                     <th scope="col">COLACION Y MOVILIZACION</th>
                     <th scope="col">BONOS ACORDADOS  CON EL SOSTENEDOR</th>
                     <th scope="col">SUELDO BASE</th>
                     <th scope="col">HORAS EXTRAS</th>
                     <th scope="col">INCREMENTO % ZONA</th>
                     <th scope="col">ASIGNACIONES</th>
                     <th scope="col">COLACION Y MOVILIZACION</th>
                     <th scope="col">BONOS ACORDADOS  CON EL SOSTENEDOR</th>
                     <th scope="col">SUELDO BASE</th>
                     <th scope="col">HORAS EXTRAS</th>
                     <th scope="col">INCREMENTO % ZONA</th>
                     <th scope="col">LEY 19.464 ASISTENTES (INCLUYE INTERNADOS) (ART. 5I TRANS. DFL Numero 2/98 ED.)</th>
                     <th scope="col">ASIGNACIONES</th>
                     <th scope="col">COLACION Y MOVILIZACION</th>
                     <th scope="col">BONOS ACORDADOS  CON EL SOSTENEDOR</th>
                     <th scope="col">SUELDO BASE</th>
                     <th scope="col">HORAS EXTRAS</th>
                     <th scope="col">INCREMENTO % ZONA</th>
                     <th scope="col">ASIGNACIONES</th>
                     <th scope="col">COLACION Y MOVILIZACION</th>
                     <th scope="col">BONOS ACORDADOS  CON EL SOSTENEDOR</th>
                     <th scope="col">Haberes No Rendibles</th>
                     <th scope="col">Total Haberes</th>
                     <th scope="col">Prevision A.F.P</th>
                     <th scope="col">Ahorro A.F.P.</th>
                     <th scope="col">Prevision Isapre y/o Fonasa</th>
                     <th scope="col">Adicional Salud</th>
                     <th scope="col">Impuesto</th>
                     <th scope="col">Descuento CCAF</th>
                     <th scope="col">Descuentos Inst. Financieras</th>
                     <th scope="col">Descuentos Inst. sociales</th>
                     <th scope="col">Retencion Judicial</th>
                     <th scope="col">S. Cesantia Trabajador</th>
                     <th scope="col">Anticipo Sueldo</th>
                     <th scope="col">Otros Desc. Variables</th>
                     <th scope="col">Total Descuento</th>
                     <th scope="col">Liquido</th>
                     <th scope="col">Seguro De Accidente Del Trabajo</th>
                     <th scope="col">Seguro De Cesantia</th>
                     <th scope="col">Seguro De Invalidez Y Sobrevivencia (Sis)</th>
                     <th scope="col">Otros Aportes Previsionales Del Sostenedor</th>
                     <th scope="col">Seguro De Accidente Del Trabajo</th>
                     <th scope="col">Seguro De Cesantia</th>
                     <th scope="col">Seguro De Invalidez Y Sobrevivencia (Sis)</th>
                     <th scope="col">Otros Aportes Previsionales Del Sostenedor</th>
                     <th scope="col">Seguro De Accidente Del Trabajo</th>
                     <th scope="col">Seguro De Cesantia</th>
                     <th scope="col">Seguro De Invalidez Y Sobrevivencia (Sis)</th>
                     <th scope="col">Otros Aportes Previsionales Del Sostenedor</th>
                     <th scope="col">Seguro De Accidente Del Trabajo</th>
                     <th scope="col">Seguro De Cesantia</th>
                     <th scope="col">Seguro De Invalidez Y Sobrevivencia (Sis)</th>
                     <th scope="col">Otros Aportes Previsionales Del Sostenedor</th>
                     <th scope="col">Seguro De Accidente Del Trabajo</th>
                     <th scope="col">Seguro De Cesantia</th>
                     <th scope="col">Seguro De Invalidez Y Sobrevivencia (Sis)</th>
                     <th scope="col">Otros Aportes Previsionales Del Sostenedor</th>
                     <th scope="col">Seguro De Accidente Del Trabajo</th>
                     <th scope="col">Seguro De Cesantia</th>
                     <th scope="col">Seguro De Invalidez Y Sobrevivencia (Sis)</th>
                     <th scope="col">Otros Aportes Previsionales Del Sostenedor</th>   --}}                  

                  {{--    <th scope="col" width="15%">Rut</th>
                     <th scope="col" width="10%">Nombre</th>
                     <th scope="col" width="10%">Apellido</th>
                     <th scope="col" width="12%">Fecha</th>
                     <th scope="col" width="15%">D&iacute;as Trabajados</th> 
                     <th scope="col" width="15%">Periodo</th> 
                     <th scope="col" width="15%">Establecimiento</th>
                     <th scope="col" width="15%">Desripci&oacute;n</th>--}}
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

{!! Form::open(['route' => ['liquidaciones.destroy', ':LIQUIDACION_ID'], 'method' => 'DELETE', 'id' => 'form-delete']) !!}
{!! Form::close() !!}

@endsection

@section('contentScript')
   <script type="text/javascript">
      @include("RRHH.liquidaciones.script")
   </script>
@endsection
