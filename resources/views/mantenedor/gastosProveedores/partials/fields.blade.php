
{{-- TIPO PERSONA --}}
<div class="form-group row">
   {!! Form::label('Tipo Persona', 'Tipo Persona', ['class' => 'col-sm-3 col-form-label text-right']) !!}

   <div class="col-sm-9">
      {{ Form::select('tipoPersona',
         [
            'Persona Jurídica' => 'Persona Jurídica',
            'Persona Natural'  => 'Persona Natural'
         ], null,
         [
            'id'           => 'lstTipoPersona',
            'placeholder'  => 'Seleccione Tipo Persona...',
            'class'        => 'form-control'
         ])
      }}
      <div id="vTipoPersona"><span id="msgTipoPersona" class="validacion"></span></div> {{-- Div de Validación --}}
   </div>
</div> 


{{-- RUT --}}
<div class="form-group row">
   {!! Form::label('Rut', 'Rut', ['class' => 'col-sm-3 col-form-label text-right']) !!}
   <div class="col-sm-9">

      {!! Form::text('rut', null,
         ['id'          => 'txtRut',
         'class'        => 'form-control',
         'placeholder'  => 'Rut'])
      !!}
      <div id="vRut"><span id="msgRut" class="validacion"></span></div> {{-- Div de Validación --}}
   </div>
</div>


{{-- RAZÓN SOCIAL --}}
<div class="form-group row">
   {!! Form::label('Razón Social', 'Razón Social', ['class' => 'col-sm-3 col-form-label text-right']) !!}

   <div class="col-sm-9">
      {!! Form::text('razonSocial', null,
         ['id'          => 'txtRazonSocial',
         'class'        => 'form-control',
         'placeholder'  => 'Razón Social'])
      !!}
      <div id="vRazonSocial"><span id="msgRazonSocial" class="validacion"></span></div>
   </div>
</div>


{{-- GIRO --}}
<div class="form-group row">
   {!! Form::label('Giro', 'Giro', ['class' => 'col-sm-3 col-form-label text-right']) !!}

   <div class="col-sm-9">
      {!! Form::text('giro', null,
         ['id'          => 'txtGiro',
         'class'        => 'form-control',
         'placeholder'  => 'Giro'])
      !!}
      <div id="vGiro"><span id="msgGiro" class="validacion"></span></div>
   </div>
</div>


{{-- COMUNA --}}
<div class="form-group row">
   {!! Form::label('Comuna', 'Comuna', ['class' => 'col-sm-3 col-form-label text-right']) !!}

   <div class="col-sm-9">
      {{ Form::select('comuna', $comunas, null,
         [
            'id'           => 'lstComuna',
            'placeholder'  => 'Seleccione Comuna...',
            'class'        => 'form-control'
         ])
      }}
      <div id="vComuna"><span id="msgComuna" class="validacion"></span></div> {{-- Div de Validación --}}
   </div>
</div> 


{{-- DIRECCIÓN --}}
<div class="form-group row">
   {!! Form::label('Dirección', 'Dirección', ['class' => 'col-sm-3 col-form-label text-right']) !!}

   <div class="col-sm-9">
      {!! Form::text('direccion', null,
         ['id'          => 'txtDireccion',
         'class'        => 'form-control',
         'placeholder'  => 'Dirección'])
      !!}
      <div id="vDireccion"><span id="msgDireccion" class="validacion"></span></div>
   </div>
</div>


{{-- TELÉFONO --}}
<div class="form-group row">
   {!! Form::label('Teléfono', 'Teléfono', ['class' => 'col-sm-3 col-form-label text-right']) !!}

   <div class="col-sm-9">
      {!! Form::text('telefono', $telefono,
         ['id'          => 'txtTelefono',
         'class'        => 'form-control',
         'placeholder'  => 'Teléfono'])
      !!}
      <div id="vTelefono"><span id="msgTelefono" class="validacion"></span></div>
   </div>
</div>


{{-- CORREO --}}
<div class="form-group row">
   {!! Form::label('Correo', 'Correo', ['class' => 'col-sm-3 col-form-label text-right']) !!}

   <div class="col-sm-9">
      {!! Form::text('correo', null,
         ['id'          => 'txtCorreo',
         'class'        => 'form-control',
         'placeholder'  => 'Correo'])
      !!}
      <div id="vCorreo"><span id="msgCorreo" class="validacion"></span></div>
   </div>
</div>

