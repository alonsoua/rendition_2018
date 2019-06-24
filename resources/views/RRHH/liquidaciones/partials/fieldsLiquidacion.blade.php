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

  {{--  <div class="col-sm-1">
      <button type="button" class="btn btn-sm float-right" id="nuevoFuncionario" title="Nuevo Funcionario" 
         aria-haspopup="true" aria-expanded="false" data-toggle="modal" data-target="#modalFuncionarios">
         <span class="sr-only"></span>
         <i class="fa fa-plus fa-sm "></i> 
      </button>      
   
   </div> --}}

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
         'placeholder'  => 'Fecha Liquidación'])
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
                     'max'              => 30,                            
                     'onKeyup'          => 'return maxLenght(txtDiasTrabajados, 30)',
                     'placeholder'      => 'Días Trabajados',
                     'aria-describedby' => 'inputGroup-sizing-sm',
                     'oncopy'           => 'return false',
                     'onpaste'          => 'return false',
                     'ondragstart'      => 'return false;', 
                     'ondrop'           => 'return false'])
      !!}  

      <div id="vDiasTrabajados"><span id="msgDiasTrabajados" class="validacion"></span></div> {{-- Div de Validación --}}
   </div>
</div>

{{-- ASIGNACIÓN FAMILIAR --}}
<div class="form-group row">
   {!! Form::label('Asignación Familiar', 'Asignación Familiar', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}
   <div class="col-sm-9 input-group">
      <div class="input-group-prepend">
         <span class="input-group-text" id="basic-addon-calendar">
             <i class="fa fa-dollar-sign form-control-feedback"></i> 
         </span>
      </div>   
      {!! Form::number('asignacion', $editar == 0 ? null : $liquidacion->asignacionFamiliar,
                     ['id'              => 'txtAsignacion',
                     'class'            => 'form-control text-left',
                     'max'              => 1000000,                            
                     'onKeyup'          => 'return maxLenght(txtAsignacion, 1000000)',
                     'placeholder'      => 'Asignación Familiar',
                     'aria-describedby' => 'inputGroup-sizing-sm',
                     'oncopy'           => 'return false',
                     'onpaste'          => 'return false',
                     'ondragstart'      => 'return false;', 
                     'ondrop'           => 'return false'])
      !!}  

      <div id="vAsignacion"><span id="msgAsignacion" class="validacion"></span></div> {{-- Div de Validación --}}
   </div>
</div>


{{-- ASIGNACIÓN FAMILIAR --}}
<div class="form-group row">
   {!! Form::label('Préstamos', 'Préstamos', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}
   <div class="col-sm-9 input-group">
      <div class="input-group-prepend">
         <span class="input-group-text" id="basic-addon-calendar">
             <i class="fa fa-dollar-sign form-control-feedback"></i> 
         </span>
      </div>

      {!! Form::number('prestamos', $editar == 0 ? null : $liquidacion->prestamos,
                     ['id'              => 'txtPrestamos',
                     'class'            => 'form-control text-left',
                     'max'              => 1000000,                            
                     'onKeyup'          => 'return maxLenght(txtPrestamos, 1000000)',
                     'placeholder'      => 'Préstamos',
                     'aria-describedby' => 'inputGroup-sizing-sm',
                     'oncopy'           => 'return false',
                     'onpaste'          => 'return false',
                     'ondragstart'      => 'return false;', 
                     'ondrop'           => 'return false'])
      !!}  

      <div id="vPrestamos"><span id="msgPrestamos" class="validacion"></span></div> {{-- Div de Validación --}}
   </div>
</div>


<div class="modal fade" id="modalFuncionarios" tabindex="-1" role="dialog">
   <div class="modal-dialog" role="documento"> 
      <div class="modal-content">
         {{-- @include('mantenedor.rrhhFuncionarios.create') --}}
         <div class="modal-header">
            <h5 class="modal-title">Nuevo Contrato</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <p>Modal body text goes here.</p>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
         </div>
      </div>
   </div>
</div>