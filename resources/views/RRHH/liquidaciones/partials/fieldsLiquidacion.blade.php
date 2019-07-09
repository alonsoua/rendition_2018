{{-- NAV HIDDEN --}}
{!! Form::text('navHidden'         
         , 'navLiquidacion',
         ['id'          => 'navHidden',
         'class'        => 'form-control d-none'])
!!}
{{-- EDITAR HIDDEN --}}
{!! Form::text('editar'         
         , $editar,
         ['id'          => 'editar',
         'class'        => 'form-control d-none'])
!!}
{{-- SNED HIDDEN --}}
{{-- {!! Form::text('snedHidden'         
         , $editar == 0 ? null : $sned,
         ['id'          => 'snedHidden',
         'class'        => 'form-control d-none'])
!!} --}}



{{-- lst ESTABLECIMIENTO --}}
<div class="form-group row">
   {!! Form::label('Establecimiento', 'Establecimiento', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}
   @php
      if ($editar == 0) {
         $disabledEst = '';
      } else {
         $disabledEst = '';            
         
      }
   @endphp
   <div class="col-sm-9">
      {{ Form::select('establecimiento', $establecimientos , $editar == 0 ? null : $liquidacion->idEstablecimiento,
         [
            'id'           => 'lstEstablecimiento',
            'placeholder'  => 'Seleccione Establecimiento',
            'class'        => 'form-control select-establecimientos', 
            $disabledEst           
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
         $disabledFun = 'disabled';
      } else {
         $disabledFun = '';            
         
      }
   @endphp
   <div class="col-sm-9">
      {{ Form::select('funcionario', $funcionarios, $editar == 0 ? null : $liquidacion->idFuncionario,
         [
            'id'           => 'lstFuncionario',
            'placeholder'  => 'Seleccione Funcionario',
            'class'        => 'select-funcionarios form-control',
            $disabledFun
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
   @php
      if ($editar == 0) {
         $disabledPe = 'disabled';
      } else {
         $disabledPe = '';            
         
      }
   @endphp
   <div class="col-sm-9">
      {{ Form::select('periodo', $periodos, $editar == 0 ? null : $liquidacion->idPeriodo,
         [
            'id'           => 'lstPeriodo',
            'placeholder'  => 'Seleccione Periodo',
            'class'        => 'select-periodos form-control',
            $disabledPe
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

{{-- SNED Y REAJUSTE --}}
   {{-- DISPLAY SNEDS --}}
 {{--   @php
         if ($editar == 1 && $liquidacion->sned == null) {
            $displaySned = $sned == 0 ? 'd-none' : '';                        
         } else {
            $displaySned   = $editar == 0 ? 'd-none' : ($liquidacion->sned == null ? 'd-none' : '');            
         }
            $displayReajusteSned = $editar == 0 ? 'd-none' : ($liquidacion->reajusteSned == null ? 'd-none' : '');      
   @endphp

   
   <div class="form-group row {{ $displaySned }} divInputSned">
      {!! Form::label('Sned', 'Sned', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}
      <div class="col-sm-9 input-group">
         <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon-calendar">
                <i class="fa fa-dollar-sign form-control-feedback"></i> 
            </span>
         </div>   
         {!! Form::number('sned', $editar == 0 ? null : null,
                        ['id'              => 'txtSned',
                        'class'            => 'form-control text-left',
                        'max'              => 1500000,                            
                        'onKeyup'          => 'return maxLenght(txtSned, 1500000)',
                        'placeholder'      => 'Sned',
                        'aria-describedby' => 'inputGroup-sizing-sm',
                        'oncopy'           => 'return false',
                        'onpaste'          => 'return false',
                        'ondragstart'      => 'return false;', 
                        'ondrop'           => 'return false'])
         !!}  

         <div id="vSned"><span id="msgSned" class="validacion"></span></div> 
      </div>
   </div>


   
   <div class="form-group row {{ $displayReajusteSned }} divInputReliquidacionSned">
      {!! Form::label('Reliquidación Sned', 'Reliquidación Sned', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}
      <div class="col-sm-9 input-group">
         <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon-calendar">
                <i class="fa fa-dollar-sign form-control-feedback"></i> 
            </span>
         </div>

         {!! Form::number('reliquidacionSned', $editar == 0 ? null : null,
                        ['id'              => 'txtReliquidacionSned',
                        'class'            => 'form-control text-left',
                        'max'              => 1500000,                            
                        'onKeyup'          => 'return maxLenght(txtReliquidacionSned, 1500000)',
                        'placeholder'      => 'Reliquidación Sned',
                        'aria-describedby' => 'inputGroup-sizing-sm',
                        'oncopy'           => 'return false',
                        'onpaste'          => 'return false',
                        'ondragstart'      => 'return false;', 
                        'ondrop'           => 'return false'])
         !!}  

         <div id="vReliquidacionSned"><span id="msgReliquidacionSned" class="validacion"></span></div> 
      </div>
   </div> --}}


{{-- CHECKBOX NO IMPONIBLES --}}
   <br>
   <hr>   
      <h5 class="card-title text-center">No Imponibles</h5>
   <hr>
   <br>

   <div class="form-group row">
{{--    @foreach ($funcionarioLey as $Ley)
      @foreach ($Ley['leyesNoImponible'] as $noImponible)
        
         {!! Form::label( $noImponible->nombreLey, $noImponible->nombreLey , ['class' => 'col-sm-2  col-form-label text-md-right text-sm-right']) !!}
         <div class="col-sm-1 mt-2">            
            {{ Form::checkbox('chkAsignacionFamiliar', null, $editar == 0 ? null : ($liquidacion->asignacionFamiliar == null ? null : true), ['class' => 'chk']) }}
         </div>
      @endforeach
   @endforeach
 --}}
   @php
      $displayChkBonoSae                  = $editar == 0 ? 'd-none' : ($liquidacion->bonoSae == null ? 'd-none' : '');
      $displayChkBonoVacaciones           = $editar == 0 ? 'd-none' : ($liquidacion->bonoVacaciones == null ? 'd-none' : '');
      $displayChkAguinaldoFiestasPatrias  = $editar == 0 ? 'd-none' : ($liquidacion->aguinaldoFiestasPatrias == null ? 'd-none' : '');
      $displayChkAguinaldoNavidad         = $editar == 0 ? 'd-none' : ($liquidacion->aguinaldoNavidad == null ? 'd-none' : '');
   @endphp

      {!! Form::label('Asignación Familiar', 'Asignación Familiar', ['class' => 'col-sm-2  col-form-label text-md-right text-sm-right']) !!}
      <div class="col-sm-1 mt-2">            
         {{ Form::checkbox('chkAsignacionFamiliar', null, $editar == 0 ? null : ($liquidacion->asignacionFamiliar == null ? null : true), ['class' => 'chk']) }}
      </div>
      
      {!! Form::label('Bono Escolaridad', 'Bono Escolaridad', ['class' => 'col-sm-2 col-form-label text-md-right text-sm-right']) !!}
      <div class="col-sm-1 mt-2">            
         {{ Form::checkbox('chkBonoEscolaridad', null, $editar == 0 ? null : ($liquidacion->bonoEscolaridad == null ? null : true), ['class' => 'chk']) }}
      </div>

      {!! Form::label('Bono Movilización', 'Bono Movilización', ['class' => 'col-sm-2 col-form-label text-md-right text-sm-right']) !!}
      <div class="col-sm-1 mt-2">            
         {{ Form::checkbox('chkBonoMovilizacion', null, $editar == 0 ? null : ($liquidacion->bonoMovilizacion == null ? null : true), ['class' => 'chk']) }}
      </div>

      {!! Form::label('Bono Colación', 'Bono Colación', ['class' => 'col-sm-2 col-form-label text-md-right text-sm-right']) !!}
      <div class="col-sm-1 mt-2">            
         {{ Form::checkbox('chkBonoColacion', null, $editar == 0 ? null : ($liquidacion->bonoColacion == null ? null : true), ['class' => 'chk']) }}
      </div>

      {!! Form::label('Bono Adicional', 'Bono Adicional', ['class' => 'col-sm-2  col-form-label text-md-right text-sm-right']) !!}
      <div class="col-sm-1 mt-2">            
         {{ Form::checkbox('chkBonoAdicional', null, $editar == 0 ? null : ($liquidacion->bonoAdicional == null ? null : true), ['class' => 'chk']) }}
      </div>
      
      {!! Form::label('Bono Especial', 'Bono Especial', ['class' => 'col-sm-2 col-form-label text-md-right text-sm-right']) !!}
      <div class="col-sm-1 mt-2">            
         {{ Form::checkbox('chkBonoEspecial', null, $editar == 0 ? null : ($liquidacion->bonoEspecial == null ? null : true), ['class' => 'chk']) }}
      </div>
      
      @php
         $classBonoSae = $displayChkBonoSae.' bonoSae col-sm-2 col-form-label text-md-right text-sm-right';
      @endphp
      {!! Form::label('Bono Sae', 'Bono Sae', ['class' => $classBonoSae]) !!}
      <div class="col-sm-1 mt-2 bonoSae  {{ $displayChkBonoSae }}">            
         {{ Form::checkbox('chkBonoSae', null, $editar == 0 ? null : ($liquidacion->bonoSae == null ? null : true), ['class' => 'chk']) }}
      </div>
            
      @php
         $classBonoVacaciones = $displayChkBonoVacaciones.' bonoVacaciones col-sm-2 col-form-label text-md-right text-sm-right';
      @endphp
      {!! Form::label('Bono Vacaciones', 'Bono Vacaciones', ['class' => $classBonoVacaciones]) !!}
      <div class="col-sm-1 mt-2 bonoVacaciones {{ $displayChkBonoVacaciones }}">            
         {{ Form::checkbox('chkBonoVacaciones', null, $editar == 0 ? null : ($liquidacion->bonoVacaciones == null ? null : true), ['class' => 'chk']) }}
      </div>   
      
      @php
         $classAguinaldoFiestasPatrias = $displayChkAguinaldoFiestasPatrias.' aguinaldoPatria col-sm-2 col-form-label text-md-right text-sm-right';
      @endphp
      {!! Form::label('Aguinaldo Fiestas Patrias', 'Aguinaldo Fiestas Patrias', ['class' => $classAguinaldoFiestasPatrias]) !!}
      <div class="col-sm-1 mt-2 aguinaldoPatria  {{ $displayChkAguinaldoFiestasPatrias }}">            
         {{ Form::checkbox('chkAguinaldoPatria', null, $editar == 0 ? null : ($liquidacion->aguinaldoFiestasPatrias == null ? null : true), ['class' => 'chk']) }}
      </div>  

      @php
         $classAguinaldoNavidad = $displayChkAguinaldoNavidad.' aguinaldoNavidad col-sm-2 col-form-label text-md-right text-sm-right';
      @endphp
      {!! Form::label('Aguinaldo Navidad', 'Aguinaldo Navidad', ['class' => $classAguinaldoNavidad]) !!}
      <div class="col-sm-1 mt-2 aguinaldoNavidad  {{ $displayChkAguinaldoNavidad }}">            
         {{ Form::checkbox('chkAguinaldoNavidad', null, $editar == 0 ? null : ($liquidacion->aguinaldoNavidad == null ? null : true), ['class' => 'chk']) }}
      </div>

   </div>

   @php
      $displayAsignacionFamiliar       = $editar == 0 ? 'd-none' : ($liquidacion->asignacionFamiliar == null ? 'd-none' : '');
      $displayBonoEscolaridad          = $editar == 0 ? 'd-none' : ($liquidacion->bonoEscolaridad == null ? 'd-none' : '');
      $displayBonoMovilizacion         = $editar == 0 ? 'd-none' : ($liquidacion->bonoMovilizacion == null ? 'd-none' : '');
      $displayBonoColacion             = $editar == 0 ? 'd-none' : ($liquidacion->bonoColacion == null ? 'd-none' : '');
      $displayBonoAdicional            = $editar == 0 ? 'd-none' : ($liquidacion->bonoAdicional == null ? 'd-none' : '');
      $displayBonoEspecial             = $editar == 0 ? 'd-none' : ($liquidacion->bonoEspecial == null ? 'd-none' : '');
      $displayBonoSae                  = $editar == 0 ? 'd-none' : ($liquidacion->bonoSae == null ? 'd-none' : '');
      $displayBonoVacaciones           = $editar == 0 ? 'd-none' : ($liquidacion->bonoVacaciones == null ? 'd-none' : '');
      $displayAguinaldoFiestasPatrias  = $editar == 0 ? 'd-none' : ($liquidacion->aguinaldoFiestasPatrias == null ? 'd-none' : '');
      $displayAguinaldoNavidad         = $editar == 0 ? 'd-none' : ($liquidacion->aguinaldoNavidad == null ? 'd-none' : '');
   @endphp

{{-- INPUTS NO IMPONIBLES --}}

   <hr style="width: 85%;" class="justify-content-right"> 
   <br> 
   {{-- ASIGNACIÓN FAMILIAR --}}
   <div class="form-group row {{ $displayAsignacionFamiliar }} divInputAsignacionFamiliar" >
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
                        'max'              => 1500000,                            
                        'onKeyup'          => 'return maxLenght(txtAsignacion, 1500000)',
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


   {{-- Bono Escolaridad --}}
   <div class="form-group row {{ $displayBonoEscolaridad }} divInputBonoEscolaridad">
      {!! Form::label('Bono Escolaridad', 'Bono Escolaridad', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}
      <div class="col-sm-9 input-group">
         <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon-calendar">
                <i class="fa fa-dollar-sign form-control-feedback"></i> 
            </span>
         </div>   
         {!! Form::number('bonoEscolaridad', $editar == 0 ? null : $liquidacion->bonoEscolaridad,
                        ['id'              => 'txtBonoEscolaridad',
                        'class'            => 'form-control text-left',
                        'max'              => 1500000,                            
                        'onKeyup'          => 'return maxLenght(txtBonoEscolaridad, 1500000)',
                        'placeholder'      => 'Bono Escolaridad',
                        'aria-describedby' => 'inputGroup-sizing-sm',
                        'oncopy'           => 'return false',
                        'onpaste'          => 'return false',
                        'ondragstart'      => 'return false;', 
                        'ondrop'           => 'return false'])
         !!}  

         <div id="vBonoEscolaridad"><span id="msgBonoEscolaridad" class="validacion"></span></div> {{-- Div de Validación --}}
      </div>
   </div>


   {{-- Bono Movilizacion --}}
   <div class="form-group row {{ $displayBonoMovilizacion }} divInputBonoMovilizacion">
      {!! Form::label('Bono Movilización', 'Bono Movilización', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}
      <div class="col-sm-9 input-group">
         <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon-calendar">
                <i class="fa fa-dollar-sign form-control-feedback"></i> 
            </span>
         </div>   
         {!! Form::number('bonoMovilizacion', $editar == 0 ? null : $liquidacion->bonoMovilizacion,
                        ['id'              => 'txtBonoMovilizacion',
                        'class'            => 'form-control text-left',
                        'max'              => 1500000,                            
                        'onKeyup'          => 'return maxLenght(txtBonoMovilizacion, 1500000)',
                        'placeholder'      => 'Bono Movilización',
                        'aria-describedby' => 'inputGroup-sizing-sm',
                        'oncopy'           => 'return false',
                        'onpaste'          => 'return false',
                        'ondragstart'      => 'return false;', 
                        'ondrop'           => 'return false'])
         !!}  

         <div id="vBonoMovilizacion"><span id="msgBonoMovilizacion" class="validacion"></span></div> {{-- Div de Validación --}}
      </div>
   </div>


   {{-- Bono Colacion --}}
   <div class="form-group row {{ $displayBonoColacion }} divInputBonoColacion">
      {!! Form::label('Bono Colación', 'Bono Colación', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}
      <div class="col-sm-9 input-group">
         <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon-calendar">
                <i class="fa fa-dollar-sign form-control-feedback"></i> 
            </span>
         </div>   
         {!! Form::number('bonoColacion', $editar == 0 ? null : $liquidacion->bonoColacion,
                        ['id'              => 'txtBonoColacion',
                        'class'            => 'form-control text-left',
                        'max'              => 1500000,                            
                        'onKeyup'          => 'return maxLenght(txtBonoColacion, 1500000)',
                        'placeholder'      => 'Bono Colación',
                        'aria-describedby' => 'inputGroup-sizing-sm',
                        'oncopy'           => 'return false',
                        'onpaste'          => 'return false',
                        'ondragstart'      => 'return false;', 
                        'ondrop'           => 'return false'])
         !!}  

         <div id="vBonoColacion"><span id="msgBonoColacion" class="validacion"></span></div> {{-- Div de Validación --}}
      </div>
   </div>
   

   {{-- Bono Adicional --}}
   <div class="form-group row {{ $displayBonoAdicional }} divInputBonoAdicional">
      {!! Form::label('Bono Adicional', 'Bono Adicional', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}
      <div class="col-sm-9 input-group">
         <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon-calendar">
                <i class="fa fa-dollar-sign form-control-feedback"></i> 
            </span>
         </div>   
         {!! Form::number('bonoAdicional', $editar == 0 ? null : $liquidacion->bonoAdicional,
                        ['id'              => 'txtBonoAdicional',
                        'class'            => 'form-control text-left',
                        'max'              => 1500000,                            
                        'onKeyup'          => 'return maxLenght(txtBonoAdicional, 1500000)',
                        'placeholder'      => 'Bono Adicional',
                        'aria-describedby' => 'inputGroup-sizing-sm',
                        'oncopy'           => 'return false',
                        'onpaste'          => 'return false',
                        'ondragstart'      => 'return false;', 
                        'ondrop'           => 'return false'])
         !!}  

         <div id="vBonoAdicional"><span id="msgBonoAdicional" class="validacion"></span></div> {{-- Div de Validación --}}
      </div>
   </div>
   

   {{-- Bono Especial --}}
   <div class="form-group row {{ $displayBonoEspecial }} divInputBonoEspecial">
      {!! Form::label('Bono Especial', 'Bono Especial', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}
      <div class="col-sm-9 input-group">
         <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon-calendar">
                <i class="fa fa-dollar-sign form-control-feedback"></i> 
            </span>
         </div>   
         {!! Form::number('bonoEspecial', $editar == 0 ? null : $liquidacion->bonoAdicional,
                        ['id'              => 'txtBonoEspecial',
                        'class'            => 'form-control text-left',
                        'max'              => 1500000,                            
                        'onKeyup'          => 'return maxLenght(txtBonoEspecial, 1500000)',
                        'placeholder'      => 'Bono Especial',
                        'aria-describedby' => 'inputGroup-sizing-sm',
                        'oncopy'           => 'return false',
                        'onpaste'          => 'return false',
                        'ondragstart'      => 'return false;', 
                        'ondrop'           => 'return false'])
         !!}  

         <div id="vBonoEspecial"><span id="msgBonoEspecial" class="validacion"></span></div> {{-- Div de Validación --}}
      </div>
   </div>


   {{-- Bono Sae --}}
   <div class="form-group row {{ $displayBonoSae }} divInputBonoSae">
      {!! Form::label('Bono Sae', 'Bono Sae', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}
      <div class="col-sm-9 input-group">
         <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon-calendar">
                <i class="fa fa-dollar-sign form-control-feedback"></i> 
            </span>
         </div>   
         {!! Form::number('bonoSae', $editar == 0 ? null : $liquidacion->bonoSae,
                        ['id'              => 'txtBonoSae',
                        'class'            => 'form-control text-left',
                        'max'              => 1500000,                            
                        'onKeyup'          => 'return maxLenght(txtBonoSae, 1500000)',
                        'placeholder'      => 'Bono Sae',
                        'aria-describedby' => 'inputGroup-sizing-sm',
                        'oncopy'           => 'return false',
                        'onpaste'          => 'return false',
                        'ondragstart'      => 'return false;', 
                        'ondrop'           => 'return false'])
         !!}  

         <div id="vBonoSae"><span id="msgBonoSae" class="validacion"></span></div> {{-- Div de Validación --}}
      </div>
   </div>
   

   {{-- Bono Vacaciones --}}
   <div class="form-group row {{ $displayBonoVacaciones }} divInputBonoVacaciones">
      {!! Form::label('Bono Vacaciones', 'Bono Vacaciones', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}
      <div class="col-sm-9 input-group">
         <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon-calendar">
                <i class="fa fa-dollar-sign form-control-feedback"></i> 
            </span>
         </div>   
         {!! Form::number('bonoVacaciones', $editar == 0 ? null : $liquidacion->bonoVacaciones,
                        ['id'              => 'txtBonoVacaciones',
                        'class'            => 'form-control text-left',
                        'max'              => 1500000,                            
                        'onKeyup'          => 'return maxLenght(txtBonoVacaciones, 1500000)',
                        'placeholder'      => 'Bono Vacaciones',
                        'aria-describedby' => 'inputGroup-sizing-sm',
                        'oncopy'           => 'return false',
                        'onpaste'          => 'return false',
                        'ondragstart'      => 'return false;', 
                        'ondrop'           => 'return false'])
         !!}  

         <div id="vBonoVacaciones"><span id="msgBonoVacaciones" class="validacion"></span></div> {{-- Div de Validación --}}
      </div>
   </div>


   {{-- AGUINALDO FIESTAS PATRIAS --}}
   <div class="form-group row {{ $displayAguinaldoFiestasPatrias }} divInputAguinaldoFiestasPatrias">
      {!! Form::label('Aguinaldo Fiestas Patrias', 'Aguinaldo Fiestas Patrias', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}
      <div class="col-sm-9 input-group">
         <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon-calendar">
                <i class="fa fa-dollar-sign form-control-feedback"></i> 
            </span>
         </div>   
         {!! Form::number('aguinaldoFiestasPatrias', $editar == 0 ? null : $liquidacion->aguinaldoFiestasPatrias,
                        ['id'              => 'txtAguinaldoFiestasPatrias',
                        'class'            => 'form-control text-left',
                        'max'              => 1500000,                            
                        'onKeyup'          => 'return maxLenght(txtAguinaldoFiestasPatrias, 1500000)',
                        'placeholder'      => 'Aguinaldo Fiestas Patrias ',
                        'aria-describedby' => 'inputGroup-sizing-sm',
                        'oncopy'           => 'return false',
                        'onpaste'          => 'return false',
                        'ondragstart'      => 'return false;', 
                        'ondrop'           => 'return false'])
         !!}  

         <div id="vAguinaldoFiestasPatrias"><span id="msgAguinaldoFiestasPatrias" class="validacion"></span></div> {{-- Div de Validación --}}
      </div>
   </div>
   

   {{-- AGUINALDO NAVIDAD --}}
   <div class="form-group row {{ $displayAguinaldoNavidad }} divInputAguinaldoNavidad">
      {!! Form::label('Aguinaldo Navidad', 'Aguinaldo Navidad', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}
      <div class="col-sm-9 input-group">
         <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon-calendar">
                <i class="fa fa-dollar-sign form-control-feedback"></i> 
            </span>
         </div>   
         {!! Form::number('aguinaldoNavidad', $editar == 0 ? null : $liquidacion->aguinaldoNavidad,
                        ['id'              => 'txtAguinaldoNavidad',
                        'class'            => 'form-control text-left',
                        'max'              => 1500000,                            
                        'onKeyup'          => 'return maxLenght(txtAguinaldoNavidad, 1500000)',
                        'placeholder'      => 'Aguinaldo Navidad ',
                        'aria-describedby' => 'inputGroup-sizing-sm',
                        'oncopy'           => 'return false',
                        'onpaste'          => 'return false',
                        'ondragstart'      => 'return false;', 
                        'ondrop'           => 'return false'])
         !!}  

         <div id="vAguinaldoNavidad"><span id="msgAguinaldoNavidad" class="validacion"></span></div> {{-- Div de Validación --}}
      </div>
   </div>



{{-- CHECKBOX OTROS DESCUENTOS --}}  
   <br>
   <hr>   
      <h5 class="card-title text-center">Otros Descuentos</h5>
   <hr>
   <br>
   <div class="form-group row">

      {!! Form::label('Permiso sin goce de sueldo', 'Permiso sin goce de sueldo', ['class' => 'col-sm-2  col-form-label text-md-right text-sm-right']) !!}
      <div class="col-sm-1 mt-2">            
         {{ Form::checkbox('chkPermisoSinSueldo', null, $editar == 0 ? null : ($liquidacion->permisoSinSueldo == null ? null : true) , ['class' => 'chk']) }}
      </div>
      
      {!! Form::label('Atrasos', 'Atrasos', ['class' => 'col-sm-2 col-form-label text-md-right text-sm-right']) !!}
      <div class="col-sm-1 mt-2">            
         {{ Form::checkbox('chkAtrasos', null, $editar == 0 ? null : ($liquidacion->atrasos == null ? null : true) , ['class' => 'chk']) }}
      </div>
      
      {!! Form::label('Préstamos', 'Préstamos', ['class' => 'col-sm-2 col-form-label text-md-right text-sm-right']) !!}
      <div class="col-sm-1 mt-2">            
         {{ Form::checkbox('chkPrestamos', null, $editar == 0 ? null : ($liquidacion->prestamos == null ? null : true), ['class' => 'chk']) }}
      </div>

      {!! Form::label('Otros', 'Otros', ['class' => 'col-sm-2 col-form-label text-md-right text-sm-right']) !!}
      <div class="col-sm-1 mt-2">            
         {{ Form::checkbox('chkOtros', null, $editar == 0 ? null : ($liquidacion->otros == null ? null : true), ['class' => 'chk']) }}
      </div>

   </div>


   @php
      $displayPermisoSinSueldo = $editar == 0 ? 'd-none' : ($liquidacion->permisoSinSueldo == null ? 'd-none' : '');
      $displayAtrasos          = $editar == 0 ? 'd-none' : ($liquidacion->atrasos == null ? 'd-none' : '');
      $displayPrestamos        = $editar == 0 ? 'd-none' : ($liquidacion->prestamos == null ? 'd-none' : '');
      $displayOtros            = $editar == 0 ? 'd-none' : ($liquidacion->otros == null ? 'd-none' : '');

   @endphp

{{-- INPUTS OTROS DESCUENTOS --}}   
   <hr style="width: 85%;" class="justify-content-right"> 
   <br> 
   {{-- PERMISO SIN GOCE DE SUELDO --}}
   <div class="form-group row {{ $displayPermisoSinSueldo }} divInputPermisoSinSueldo">
      {!! Form::label('Permiso sin Goce de Sueldo', 'Permiso sin Goce de Sueldo', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}
      <div class="col-sm-9 input-group">
         <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon-calendar">
                <i class="fa fa-dollar-sign form-control-feedback"></i> 
            </span>
         </div>

         {!! Form::number('permisoSinSueldo', $editar == 0 ? null : $liquidacion->permisoSinSueldo,
                        ['id'              => 'txtPermisoSinSueldo',
                        'class'            => 'form-control text-left',
                        'max'              => 1500000,                            
                        'onKeyup'          => 'return maxLenght(txtPermisoSinSueldo, 1500000)',
                        'placeholder'      => 'Permiso sin Goce de Sueldo',
                        'aria-describedby' => 'inputGroup-sizing-sm',
                        'oncopy'           => 'return false',
                        'onpaste'          => 'return false',
                        'ondragstart'      => 'return false;', 
                        'ondrop'           => 'return false'])
         !!}  

         <div id="vPermisoSinSueldo"><span id="msgPermisoSinSueldo" class="validacion"></span></div> {{-- Div de Validación --}}
      </div>
   </div>


   {{-- ATRASOS --}}
   <div class="form-group row {{ $displayAtrasos }} divInputAtrasos">
      {!! Form::label('Atrasos', 'Atrasos', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}
      <div class="col-sm-9 input-group">
         <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon-calendar">
                <i class="fa fa-dollar-sign form-control-feedback"></i> 
            </span>
         </div>

         {!! Form::number('atrasos', $editar == 0 ? null : $liquidacion->atrasos,
                        ['id'              => 'txtAtrasos',
                        'class'            => 'form-control text-left',
                        'max'              => 1500000,                            
                        'onKeyup'          => 'return maxLenght(txtAtrasos, 1500000)',
                        'placeholder'      => 'Atrasos',
                        'aria-describedby' => 'inputGroup-sizing-sm',
                        'oncopy'           => 'return false',
                        'onpaste'          => 'return false',
                        'ondragstart'      => 'return false;', 
                        'ondrop'           => 'return false'])
         !!}  

         <div id="vAtrasos"><span id="msgAtrasos" class="validacion"></span></div> {{-- Div de Validación --}}
      </div>
   </div>


   {{-- PRSTAMOS --}}
   <div class="form-group row {{ $displayPrestamos }} divInputPrestamos">
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
                        'max'              => 1500000,                            
                        'onKeyup'          => 'return maxLenght(txtPrestamos, 1500000)',
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


   {{-- OTROS --}}
   <div class="form-group row {{ $displayOtros }} divInputOtros">
      {!! Form::label('Otros', 'Otros', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}
      <div class="col-sm-9 input-group">
         <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon-calendar">
                <i class="fa fa-dollar-sign form-control-feedback"></i> 
            </span>
         </div>

         {!! Form::number('otros', $editar == 0 ? null : $liquidacion->otros,
                        ['id'              => 'txtOtros',
                        'class'            => 'form-control text-left',
                        'max'              => 1500000,                            
                        'onKeyup'          => 'return maxLenght(txtOtros, 1500000)',
                        'placeholder'      => 'Otros',
                        'aria-describedby' => 'inputGroup-sizing-sm',
                        'oncopy'           => 'return false',
                        'onpaste'          => 'return false',
                        'ondragstart'      => 'return false;', 
                        'ondrop'           => 'return false'])
         !!}  

         <div id="vOtros"><span id="msgOtros" class="validacion"></span></div> {{-- Div de Validación --}}
      </div>
   </div>

{{-- MODAL --}}
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