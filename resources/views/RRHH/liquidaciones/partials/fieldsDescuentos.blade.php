
@foreach( $funcionarioDscto as $subvencion)
  
   <h6 class="f mt-5 mb-4 ml-1 text-sm-center float-center">SUBVENCIÓN "{{ $subvencion['subvencion'] }}"</h6>
   
   
   <table class="table table-hover table-sm table-responsive-sm">
      <thead>
         <tr>
            <th scope="col" width="5%">Código</th>
            <th scope="col" width="70%">Ley</th>                                    
            <th scope="col" width="15%" style="text-align: center;">Valor</th> 
         </tr>
      </thead>
      <tbody>
         
         @foreach( $subvencion['leyes'] as $ley)  
          
            <tr>
               <td>{{ $ley['codigoLey'] }}</td>
               <td>{{ $ley['nombreLey'] }}</td>                        
               <td>          
                  
                  {{ Form::hidden('ley['.$ley['idLey'].']', $subvencion['idSubvencion']) }}        

                  <div class="input-group input-group-sm">   
                     <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon-calendar">
                           <i class="fa fa-dollar-sign form-control-feedback"></i>
                        </span>
                     </div>                      
                     {!! Form::number('valorDscto['.$ley['idLey'].']', $editar == 0 ? 0 : 0,
                        ['id'              => 'txtValorDescuento'.$ley['idLey'].'',
                        'data-valor'       => $ley['idLey'],
                        'class'            => 'form-control text-center miles',                                                                                          

                        'aria-describedby' => 'inputGroup-sizing-sm',
                        'oncopy'           => 'return false;',
                        'onpaste'          => 'return false;',
                        'ondragstart'      => 'return false;', 
                        'ondrop'           => 'return false;',
                        ])
                     !!}  
                     
                  </div>
               </td>                    
            </tr>   
         @endforeach 
      </tbody>
   </table>      
<hr>
@endforeach 


