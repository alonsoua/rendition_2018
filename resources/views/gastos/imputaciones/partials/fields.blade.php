{{-- lst ESTABLECIMIENTO --}}
<div class="form-group row">
   {!! Form::label('Establecimiento', 'Establecimiento', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}

   <div class="col-sm-9">
      {{ Form::select('establecimiento', $establecimientos , $editar == 0 ? null : null,
         [
            'id'           => 'lstEstablecimiento',
            'placeholder'  => 'Seleccione Establecimiento',
            'class'        => 'form-control select-establecimientos'
         ])
      }}
      <div id="vEstablecimiento"><span id="msgEstablecimiento" class="validacion"></span></div>
   </div>
</div> 


{{-- lst SUBVENCIÓN --}}
<div class="form-group row">
   {!! Form::label('Subvención', 'Subvención', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}

   <div class="col-sm-9">
      {{ Form::select('subvencion', $subvenciones, $editar == 0 ? null : null,
         [
            'id'           => 'lstSubvencion',
            'placeholder'  => 'Seleccione Subvención',
            'class'        => 'select-subvencion form-control'
         ])
      }}

      <div id="vSubvencion"><span id="msgSubvencion" class="validacion"></span></div> {{-- Div de Validación --}}
   
   </div>

</div> 


{{-- lst CUENTA --}}
<div class="form-group row">
   {!! Form::label('Cuenta', 'Cuenta', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}

   <div class="col-sm-9">
      {{ Form::select('cuenta', $cuentas, $editar == 0 ? null : null,
         [
            'id'           => 'lstCuenta',
            'placeholder'  => 'Seleccione Cuenta',
            'class'        => 'select-cuenta form-control',
            'disabled'
         ])
      }}

      <div id="vCuenta"><span id="msgCuenta" class="validacion"></span></div> {{-- Div de Validación --}}
   
   </div>

</div> 




{{-- lst TIPO DOCUMENTO --}}
<div class="form-group row">
   {!! Form::label('Tipo Documento', 'Tipo Documento', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}

   <div class="col-sm-9">
      {{ Form::select('tipoDocumento', $tipoDocumentos, $editar == 0 ? null : null,
         [
            'id'           => 'lstTipoDocumento',
            'placeholder'  => 'Seleccione Subvención',
            'class'        => 'select-tipoDocumento form-control'
         ])
      }}

      <div id="vTipoDocumento"><span id="msgTipoDocumento" class="validacion"></span></div>
   
   </div>

</div> 


{{-- N° DOCUMENTO --}}
<div class="form-group row">
   {!! Form::label('N° Documento', 'N° Documento', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}
   <div class="col-sm-9">      
      {!! Form::number('numDocumento', $editar == 0 ? null : null,
                     ['id'              => 'txtNumDocumento',
                     'class'            => 'form-control text-left',
                     'maxlength'        => 50,                        
                     'placeholder'      => 'N° Documento',
                     'aria-describedby' => 'inputGroup-sizing-sm'])
      !!}  

      <div id="vNumDocumento"><span id="msgNumDocumento" class="validacion"></span></div> {{-- Div de Validación --}}
   </div>
</div>


{{-- FECHA DOCUMENTO --}}
<div class="form-group row ">
   {!! Form::label('Fecha Documento', 'Fecha Documento', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}

   <div class="col-sm-9">
      <div class="input-group">
        
      {!! Form::text('fechaDocumento'         
         , $editar == 0 ? null : date("d-m-Y", strtotime(null)),
         ['id'          => 'txtFechaDocumento',
         'class'        => 'form-control fecha-documento',
         'placeholder'  => 'dd-mm-yyyy'])
      !!}
         
         <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon-calendar">
               <i class="fa fa-calendar-alt form-control-feedback"></i> 
            </span>
         </div>
      </div>
      <div id="vFechaDocumento"><span id="msgFechaDocumento" class="validacion"></span></div>
   </div>
</div>


{{-- FECHA PAGO --}}
<div class="form-group row ">
   {!! Form::label('Fecha Pago', 'Fecha Pago', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}

   <div class="col-sm-9">
      <div class="input-group">
        
      {!! Form::text('fechaPago'         
         , $editar == 0 ? null : date("d-m-Y", strtotime(null)),
         ['id'          => 'txtFechaPago',
         'class'        => 'form-control fecha-pago',
         'placeholder'  => 'dd-mm-yyyy'])
      !!}
         
         <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon-calendar">
               <i class="fa fa-calendar-alt form-control-feedback"></i> 
            </span>
         </div>
      </div>
      <div id="vFechaPago"><span id="msgFechaPago" class="validacion"></span></div>
   </div>
</div>



{{-- DESCRIPCIÓN --}}
<div class="form-group row">
   {!! Form::label('Descripción', 'Descripción', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}
   <div class="col-sm-9">

      {!! Form::textarea('descripcion', null,
         ['id'          => 'txtDescripcion',
         'class'        => 'form-control',
         'placeholder'  => 'Descripción',
         'rows'         => 4 ,
         'cols'         => 4 ])
      !!}
      <div id="vDescripcion"><span id="msgDescripcion" class="validacion"></span></div>
   </div>
</div>


{{-- lst PROVEEDOR --}}
<div class="form-group row">
   {!! Form::label('Proveedor', 'Proveedor', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}

   <div class="col-sm-9">
      {{ Form::select('proveedor', $proveedores, $editar == 0 ? null : null,
         [
            'id'           => 'lstProveedor',
            'placeholder'  => 'Seleccione Proveedor',
            'class'        => 'select-proveedor form-control'
         ])
      }}

      <div id="vProveedor"><span id="msgProveedor" class="validacion"></span></div> {{-- Div de Validación --}}
   
   </div>

</div> 


{{-- MONTO GASTO --}}
<div class="form-group row">
   {!! Form::label('Monto Gasto', 'Monto Gasto', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}
   <div class="col-sm-9 input-group">
      
      <div class="input-group-prepend">
         <span class="input-group-text" id="basic-addon-calendar">
             <i class="fa fa-dollar-sign form-control-feedback"></i> 
         </span>
      </div>
   

      {!! Form::number('montoGasto', $editar == 0 ? null : null,
                     ['id'              => 'txtMontoGasto',
                     'class'            => 'form-control text-left miles',
                     'maxlength'        => 50,                        
                     'placeholder'      => 'Monto Gasto',
                     'aria-describedby' => 'inputGroup-sizing-sm'])
      !!}  

      <div id="vMontoGasto"><span id="msgMontoGasto" class="validacion"></span></div> {{-- Div de Validación --}}
   </div>
</div>


{{-- MONTO DOCUMENTO --}}
<div class="form-group row">
   {!! Form::label('Monto Documento', 'Monto Documento', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}
   <div class="col-sm-9 input-group">

      <div class="input-group-prepend">
         <span class="input-group-text" id="basic-addon-calendar">
             <i class="fa fa-dollar-sign form-control-feedback"></i> 
         </span>
      </div>
   

      {!! Form::number('montoDocumento', $editar == 0 ? null : null,
                     ['id'              => 'txtMontoDocumento',
                     'class'            => 'form-control text-left miles',
                     'maxlength'        => 50,                        
                     'placeholder'      => 'Monto Documento',
                     'aria-describedby' => 'inputGroup-sizing-sm'])
      !!}  

      <div id="vMontoDocumento"><span id="msgMontoDocumento" class="validacion"></span></div> {{-- Div de Validación --}}
   </div>
</div>


{{-- DOCUMENTO --}}
{{-- <div class="form-group row">
   {!! Form::label('Insignia', 'Insignia', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}
   <div class="col-sm-9">
   
       {!! Form::File('insignia', null,
         [  'id'           => 'fileInsignia',
            'class'        => 'form-control',
            'placeholder'  => 'Seleccione una imagen'])
         !!}
      <div id="vInsignia"><span id="msgInsignia" class="validacion"></span></div>
   </div>
</div> --}}


{{-- ESTADO --}}
<div class="form-group row">

@can('imputaciones.index')
   @php
      $opcion = null;
      $disabled = "";
   @endphp   
@else 
   @php
      $opcion = "Por Aprobar";
      $disabled = "disabled";
   @endphp   
@endcan

   {!! Form::label('Estado', 'Estado', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}

   <div class="col-sm-9">
      {{ Form::select('estado', 
         [
            'Por Aprobar' => 'Por Aprobar',
            'Aprobado'    => 'Aprobado',
            'Rechazado'   => 'Rechazado'
         ], $editar == 0 ? $opcion : $opcion,
         [
            'id'           => 'lstEstado',
            'class'        => 'select-estado form-control',
            $disabled
         ])
      }}

      <div id="vEstado"><span id="msgEstado" class="validacion"></span></div> {{-- Div de Validación --}}
  
   </div>

</div> 