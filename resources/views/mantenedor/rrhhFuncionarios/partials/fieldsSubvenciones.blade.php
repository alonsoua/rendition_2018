
@foreach( $funcionarioLey as $subvencion)
  
   <h6 class="f mt-3 mb-4 ml-1 text-sm-left float-left">{{ $subvencion['subvencion'] }}</h6>
   
   
   <table class="table table-hover table-sm table-responsive-sm">
      <thead>
         <tr>
            <th scope="col" width="5%">Código</th>
            <th scope="col" width="80%">Nombre</th>                        
            <th scope="col" width="8%">Horas</th>                        
         </tr>
      </thead>
      <tbody>
         {{-- @php
            var_dump($subvencion['leyes']['idLey']);
         @endphp --}}
         @foreach( $subvencion['leyes'] as $ley)  
         {{--    @php
            var_dump($ley['idLey']);
         @endphp --}}
            <tr>
               <td>{{ $ley['codigoLey'] }}</td>
               <td>{{ $ley['nombreLey'] }}</td>                  
               <td>  
                  
                  {{ Form::hidden('idSubvencion['.$ley['idLey'].']', $subvencion['idSubvencion']) }}

                  <div class="input-group input-group-sm">                       
                     {!! Form::number('horas['.$ley['idLey'].']', $editar == 0 ? $horas : $ley['horas'],
                        ['id'              => 'txtHoras',
                        'class'            => 'form-control text-center',
                        'maxlength'        => 50,                        
                        'placeholder'      => '',
                        'aria-describedby' => 'inputGroup-sizing-sm'])
                     !!}  
                     
                  </div>
               </td>                     
            </tr>   
         @endforeach 
      </tbody>
   </table>      
<hr>
@endforeach 


