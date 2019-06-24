

{{-- RBD --}}
<div class="form-group row">
   {!! Form::label('RBD', 'RBD', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}
   <div class="col-sm-9">

      {!! Form::text('rbd', null,
         ['id'          => 'txtRbd',
         'class'        => 'form-control',
         'maxlength'    => '20',
         'placeholder'  => 'RBD'])
      !!}
      <div id="vRbd"><span id="msgRbd" class="validacion"></span></div> {{-- Div de Validación --}}
   </div>
</div>

{{-- RUT --}}
<div class="form-group row">
   {!! Form::label('Rut', 'Rut', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}
   <div class="col-sm-9">

      {!! Form::text('rut', null,
         ['id'          => 'txtRut',
         'class'        => 'form-control',
         'maxlength'    => '45',
         'placeholder'  => 'Rut'])
      !!}
      <div id="vRut"><span id="msgRut" class="validacion"></span></div> {{-- Div de Validación --}}
   </div>
</div>


{{-- NOMBRE --}}
<div class="form-group row">
   {!! Form::label('Nombre', 'Nombre', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}
   <div class="col-sm-9">

      {!! Form::text('nombre', null,
         ['id'          => 'txtNombre',
         'class'        => 'form-control',
         'maxlength'    => '200',
         'placeholder'  => 'Nombre'])
      !!}
      <div id="vNombre"><span id="msgNombre" class="validacion"></span></div> {{-- Div de Validación --}}
   </div>
</div>


{{-- RAZÓN SOCIAL --}}
<div class="form-group row">
   {!! Form::label('Razón Social', 'Razón Social', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}
   <div class="col-sm-9">

      {!! Form::text('razonSocial', null,
         ['id'          => 'txtRazonSocial',
         'class'        => 'form-control',
         'maxlength'    => '150',
         'placeholder'  => 'Razón Social'])
      !!}
      <div id="vRazonSocial"><span id="msgRazonSocial" class="validacion"></span></div> {{-- Div de Validación --}}
   </div>
</div>



{{-- lst TIPO DEPENDENCIA --}}
<div class="form-group row">
   {!! Form::label('Tipo Establecimiento', 'Tipo Establecimiento', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}

   <div class="col-sm-9">
      {{ Form::select('tipoDependencia', $tipoDependencias , $editar == 0 ? null : $establecimiento->idTipoDependencia,
         [
            'id'           => 'lstTipoDependencia',
            'placeholder'  => 'Seleccione Tipo Establecimiento',         
            'class'        => 'form-control select-tipoDependencias'
         ])
      }}

      <div id="vTipoDependencia"><span id="msgTipoDependencia" class="validacion"></span></div>
   </div>
</div> 


{{-- lst SOSTENEDOR --}}
<div class="form-group row">
   {!! Form::label('Sostenedor', 'Sostenedor', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}

   <div class="col-sm-9">
      {{ Form::select('sostenedor', $sostenedores , $editar == 0 ? null : $establecimiento->idSostenedor,
         [
            'id'           => 'lstSostenedor',
            'placeholder'  => 'Seleccione Sostenedor',
            'class'        => 'form-control select-sostenedores'
         ])
      }}
      <div id="vSostenedor"><span id="msgSostenedor" class="validacion"></span></div>
   </div>
</div> 



{{-- lst COMUNA --}}
<div class="form-group row">
   {!! Form::label('Comuna', 'Comuna', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}

   <div class="col-sm-9">
      {{ Form::select('comuna', $comunas , $editar == 0 ? null : $establecimiento->idComuna,
         [
            'id'           => 'lstComuna',
            'placeholder'  => 'Seleccione Comuna',
            'class'        => 'select-comunas form-control ',
         ])
      }}
      <div id="vComuna"><span id="msgComuna" class="validacion"></span></div>
   </div>
</div> 


{{-- DIRECCIÓN --}}
<div class="form-group row">
   {!! Form::label('Direccion', 'Dirección', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}
   <div class="col-sm-9">

      {!! Form::text('direccion', null,
         ['id'          => 'txtDireccion',
         'class'        => 'form-control',
         'maxlength'    => '250',
         'placeholder'  => 'Dirección'])
      !!}
      <div id="vDireccion"><span id="msgDireccion" class="validacion"></span></div>
   </div>
</div>


{{-- TELÉFONO --}}
<div class="form-group row">
   {!! Form::label('Teléfono', 'Teléfono', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}

   <div class="col-sm-9">
      {!! Form::text('fono', null,
         ['id'          => 'txtFono',
         'class'        => 'form-control',
         'maxlength'    => '10',
         'placeholder'  => 'Teléfono'])
      !!}
      <div id="vFono"><span id="msgFono" class="validacion"></span></div>
   </div>
</div>


{{-- CORREO --}}
<div class="form-group row">
   {!! Form::label('Correo', 'Correo', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}
   <div class="col-sm-9">

      {!! Form::text('correo', null,
         ['id'          => 'txtCorreo',
         'class'        => 'form-control',
         'maxlength'    => '150',
         'placeholder'  => 'ejemplo@gmail.com'])
      !!}
      <div id="vCorreo"><span id="msgCorreo" class="validacion"></span></div>
   </div>
</div>

{{-- INSIGNIA --}}
<div class="form-group row">

   {!! Form::label('Insignia', 'Insignia', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}

<div class="col-sm-9">
      <div class="input-group mb-3">
      
      {!! Form::File('image')
         !!}
       {{-- {!! Form::File('insignia', null,
         [  'id'           => 'insignia',
            'class'        => 'form-control'])
         !!} --}}

      </div>
      <div id="vInsignia"><span id="msgInsignia" class="validacion"></span></div> {{-- Div de Validación --}}
   </div>
</div>

{{-- INSIGNIA --}}
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

