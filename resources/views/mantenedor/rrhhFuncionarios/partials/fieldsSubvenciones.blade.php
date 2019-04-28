
@foreach( $funcionarioLey as $subvencion)
  
   <h6 class="f mt-5 mb-4 ml-1 text-sm-center float-center">SUBVENCIÓN "{{ $subvencion['subvencion'] }}"</h6>
   
   
   <table class="table table-hover table-sm table-responsive-sm">
      <thead>
         <tr>
            <th scope="col" width="5%">Código</th>
            <th scope="col" width="70%">Ley</th>                        
            <th scope="col" width="10%">Horas Contrato Semanal</th>                        
            <th scope="col" width="10%" style="text-align: center;">Tope por Horas</th> 
         </tr>
      </thead>
      <tbody>
         
         @foreach( $subvencion['leyes'] as $ley)  
          
            <tr>
               <td>{{ $ley['codigoLey'] }}</td>
               <td>{{ $ley['nombreLey'] }}</td>                  
               <td>  
                  
                  {{ Form::hidden('idSubvencion['.$ley['idLey'].']', $subvencion['idSubvencion']) }}

                  @if ($ley['codigoLey'] == 410105) 
                     <div class="input-group input-group-sm">                       
                        {!! Form::text('horas['.$ley['idLey'].']', $editar == 0 ? $horas : $ley['horas'],
                           ['id'              => 'txtHoras'.$ley['idLey'].'',
                           'class'            => 'form-control text-center miles',
                           'onKeyup'          => 'topeHoras('.$ley['idLey'].', value); return maxLenght(txtHoras'.$ley['idLey'].', 30); ',                            
                           'max'              => 30,                        
                           'min'              => 0,
                           'aria-describedby' => 'inputGroup-sizing-sm',
                           'oncopy'           => 'return false;',
                           'onpaste'          => 'return false;',
                           'ondragstart'      => 'return false;', 
                           'ondrop'           => 'return false;'])
                        !!}  
                        
                     </div>                    
                  @else
                     <div class="input-group input-group-sm">                       
                        {!! Form::text('horas['.$ley['idLey'].']', $editar == 0 ? $horas : $ley['horas'],
                           ['id'              => 'txtHoras'.$ley['idLey'].'',
                           'class'            => 'form-control text-center miles',
                           'onKeyup'          => 'topeHoras('.$ley['idLey'].', value); return maxLenght(txtHoras'.$ley['idLey'].', 44); ',                            
                           'max'              => 44,                        
                           'min'              => 0,
                           'aria-describedby' => 'inputGroup-sizing-sm',
                           'oncopy'           => 'return false;',
                           'onpaste'          => 'return false;',
                           'ondragstart'      => 'return false;', 
                           'ondrop'           => 'return false;'])
                        !!}  
                        
                     </div>
                  @endif    

               </td> 
               <td>                  
                  <div class="input-group input-group-sm">                       
                        {!! Form::number('topeHoras['.$ley['idLey'].']', $editar == 0 ? $ley['topeHora'] : $ley['topeHora'],
                           ['id'              => 'txtTopeHoras'.$ley['idLey'].'',
                           'data-topeHora'    => $ley['topeHora'],
                           'class'            => 'form-control text-center',                                                                                          
                           'aria-describedby' => 'inputGroup-sizing-sm',
                           'oncopy'           => 'return false;',
                           'onpaste'          => 'return false;',
                           'ondragstart'      => 'return false;', 
                           'ondrop'           => 'return false;',
                           'readonly'])
                        !!}  
                        
                     </div>
               </td>                    
            </tr>   
         @endforeach 
      </tbody>
   </table>      
<hr>
@endforeach 


