
{{-- NAV VALORHORATOTAL HIDDEN --}}
<div class="form-group row">
  
   {!! Form::label('Total Imponible', 'Total Imponible', ['class' => 'col-sm-12 col-form-label text-md-center text-sm-center']) !!}   
   <div class="col-sm-12 d-flex justify-content-center align-items-center">
      <div class="input-group input-group-sm col-sm-3">   
         <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon-calendar">
               <i class="fa fa-dollar-sign form-control-feedback"></i>
            </span>
         </div>                                           
         {!! Form::number('totalImponible', $editar == 0 ? 0 : $valorHoraTotal,
            ['id'              => 'totalImponible',         
            'class'            => 'form-control text-center valorTotalImponible',                                                                                          
            'aria-describedby' => 'inputGroup-sizing-sm',
            'oncopy'           => 'return false;',
            'onpaste'          => 'return false;',
            'ondragstart'      => 'return false;', 
            'ondrop'           => 'return false;',
            'readonly'])
         !!}  
         
      </div>
   </div> 
</div> 

@foreach( $funcionarioLey as $subvencion)
   
   <h6 class="f mt-5 mb-4 ml-1 text-sm-center float-center subvencion{{ $subvencion['idSubvencion'] }}">SUBVENCIÓN "{{ $subvencion['subvencion'] }}"</h6>


   <table class="table table-hover table-sm table-responsive-sm subvencion{{ $subvencion['idSubvencion'] }}">
      <thead>
         <tr>
            <th scope="col" width="5%">Código</th>
            <th scope="col" width="70%">Ley</th>                        
            <th scope="col" width="10%" style="text-align: center;">Horas Contrato</th>                        
            <th scope="col" width="15%" style="text-align: center;">Valor</th> 
         </tr>
      </thead>
      <tbody>         
         @foreach( $subvencion['leyes'] as $ley)  
            
            @if ($editar != 0)
               @php
                  // $valorC = $valorContrato[$ley['idLey']];                     
                  $valorTotal = $ley['horasContrato'];           
               @endphp
            @endif

            <tr id="tr{{ $ley['idLey'] }}" class = "{{ $ley['codigoLey'] }}">
               <td>{{ $ley['codigoLey'] }}</td>
               <td>{{ $ley['nombreLey'] }}</td>                  
               <td>  
                  
                  {{ Form::hidden('ley['.$ley['idLey'].']', $subvencion['idSubvencion']) }}

                  @if ($ley['codigoLey'] == 410105) 
                     <div class="input-group input-group-sm">    
                                         
                        {!! Form::text('horasContrato['.$ley['idLey'].']', $editar == 0 ? $horas : $ley['horasContrato'],
                           ['id'              => 'txtHoras'.$ley['idLey'].'',
                           'class'            => 'form-control text-center',
                           'onKeyup'          => ' maxLenght(txtHoras'.$ley['idLey'].', 30); calcularValorSueldo('.$ley['idLey'].');', 
                           'max'              => 30,      
                           'min'              => 0,                  
                           'aria-describedby' => 'inputGroup-sizing-sm',
                           'oncopy'           => 'return false',
                           'onpaste'          => 'return false',
                           'ondragstart'      => 'return false;', 
                           'ondrop'           => 'return false'])
                        !!}                          
                     </div>                     
                  @else
                     <div class="input-group input-group-sm">

                        {!! Form::text('horasContrato['.$ley['idLey'].']', $editar == 0 ? $horas : $ley['horasContrato'],
                           ['id'              => 'txtHoras'.$ley['idLey'].'',
                           'class'            => 'form-control text-center',
                           'onKeyup'          => ' maxLenght(txtHoras'.$ley['idLey'].', 44); calcularValorSueldo('.$ley['idLey'].');',                            
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
                     <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon-calendar">
                           <i class="fa fa-dollar-sign form-control-feedback"></i>
                        </span>
                     </div>                                           
                     {!! Form::number('valor['.$ley['idLey'].']', $editar == 0 ? 0 : $ley['valorHora'],
                        ['id'              => 'txtValor'.$ley['idLey'].'',
                        'data-valorHora'   => $editar == 0 ? 0 : $ley['valorHoraCalculo'],
                        'class'            => 'form-control text-center valorHora',                                                                                          
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


