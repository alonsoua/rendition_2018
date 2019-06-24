@include('estructura.cargando')


<div class="card-header" style="border-top: 1px solid rgba(0, 0, 0, 0.1);">
   <h4 class="my-0 font-weight-light text-sm-center">Historial Reajustes</h4>
</div>

<div class="card-body">
   {{-- Formulario --}}
   <div class="form-group row">
      

         
         <div class="col-sm-12" >                     
            <div class="col-sm-12">
               <div class="mt-2">
                  <table class="table table-hover table-sm table-responsive-sm">
                     <thead>
                        <tr>
                           <th scope="col" width="40%" style="text-align: center;">Año</th>
                           <th scope="col" width="40%" style="text-align: center;">Porcentaje</th>
                           {{-- <th scope="col" width="20%">Opciones</th> --}}
                           
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($reajustes as $element)
                           
                           <tr>
                              <td style="text-align: center;">{{ $element->ano['ano'] }}</td>
                              <td style="text-align: center;">{{ $element->porcentajeReajuste }}</td>
                              {{-- <td></td> --}}
                           </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      
      
      <div class="col-sm-12" id="rowHistorial" style="display: none;"></div>
         
      
   </div>

</div>

