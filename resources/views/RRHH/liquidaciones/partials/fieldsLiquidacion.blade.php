{{-- lst ESTABLECIMIENTO --}}
<div class="form-group row">
   {!! Form::label('Establecimiento', 'Establecimiento', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}

   <div class="col-sm-9">
      {{ Form::select('establecimiento', $establecimientos , $editar == 0 ? null : $liquidacion->idEstablecimiento,
         [
            'id'           => 'lstEstablecimiento',
            'placeholder'  => 'Seleccione Establecimiento',
            'class'        => 'form-control select-establecimientos'
         ])
      }}
      <div id="vEstablecimiento"><span id="msgEstablecimiento" class="validacion"></span></div>
   </div>
</div> 




{{-- lst FUNCIONARIO --}}
<div class="form-group row">
   {!! Form::label('Funcionario', 'Funcionario', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}
   @php
      if ($editar == 0) {
         $disabled = 'disabled';
      } else {
         $disabled = '';            
         
      }
   @endphp
   <div class="col-sm-9">
      {{ Form::select('funcionario', $funcionarios, $editar == 0 ? null : $liquidacion->idFuncionario,
         [
            'id'           => 'lstFuncionario',
            'placeholder'  => 'Seleccione Funcionario',
            'class'        => 'select-funcionarios form-control',
            $disabled
         ])
      }}

      <div id="vFuncionario"><span id="msgFuncionario" class="validacion"></span></div>
   
   </div>

</div> 




{{-- lst PERIODO LIQUIDACIÓN --}}
<div class="form-group row">
   {!! Form::label('Periodo', 'Periodo', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}

   <div class="col-sm-9">
      {{ Form::select('periodo', $periodos, $editar == 0 ? null : $liquidacion->idPeriodo,
         [
            'id'           => 'lstPeriodo',
            'placeholder'  => 'Seleccione Periodo',
            'class'        => 'select-periodos form-control',
            $disabled
         ])
      }}

      <div id="vPeriodo"><span id="msgPeriodo" class="validacion"></span></div>
   
   </div>

</div> 






{{-- FECHA LIQUIDACIÓN --}}
<div class="form-group row ">
   {!! Form::label('Fecha Liquidación', 'Fecha Liquidación', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}

   <div class="col-sm-9">
      <div class="input-group">
        
      {!! Form::text('fechaLiquidacion'         
         , $editar == 0 ? null : date("d-m-Y", strtotime($liquidacion->fechaLiquidacion)),
         ['id'          => 'txtFechaLiquidacion',
         'class'        => 'form-control fecha-liquidacion',
         'placeholder'  => 'dd-mm-yyyy'])
      !!}
         
         <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon-calendar">
               <i class="fa fa-calendar-alt form-control-feedback"></i> 
            </span>
         </div>
      </div>
      <div id="vFechaLiquidacion"><span id="msgFechaLiquidacion" class="validacion"></span></div>
   </div>
</div>



{{-- DÍAS TRABAJADOS --}}
<div class="form-group row">
   {!! Form::label('Días Trabajados', 'Días Trabajados', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}
   <div class="col-sm-9">      
      {!! Form::number('diasTrabajados', $editar == 0 ? null : $liquidacion->diasTrabajados,
                     ['id'              => 'txtDiasTrabajados',
                     'class'            => 'form-control text-left',
                     'maxlength'        => 50,                        
                     'placeholder'      => 'Días Trabajados',
                     'aria-describedby' => 'inputGroup-sizing-sm'])
      !!}  

      <div id="vDiasTrabajados"><span id="msgDiasTrabajados" class="validacion"></span></div> {{-- Div de Validación --}}
   </div>
</div>

