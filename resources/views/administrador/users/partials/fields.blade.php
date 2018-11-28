{{-- lst ROL --}}
<div class="form-group row">
   {!! Form::label('Rol Usuario', 'Rol Usuario', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}
   
   <div class="col-sm-9">
      {{ Form::select('rol', $roles , $editar == 0 ? null : $rol,
         [
            'id'           => 'lstRol',
            'placeholder'  => 'Seleccione Rol Usuario',         
            'class'        => 'form-control select-Rol'
         ])
      }}

      <div id="vRol"><span id="msgRol" class="validacion"></span></div>
   </div>
</div> 


{{-- CHECKBOX SOSTENEDOR --}}
<div class="form-group row">
   {!! Form::label('Sostenedor', 'Es Sostenedor', ['class' => 'col-sm-3 col-form-label text-right']) !!}

   <div class="col-sm-9">
      <div class="mt-2">
         {{ Form::checkbox('sostenedor'), 0 }}
      </div>
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



{{-- CONTRASEÑA --}}
<div class="form-group row">
   {!! Form::label('Contraseña', 'Contraseña', ['class' => 'col-sm-3 col-form-label text-right']) !!}
   <div class="col-sm-9">
      {!! Form::password('password', 
         ['id'          => 'txtPass',
         'class'        => 'form-control',
         'placeholder'  => 'Contraseña',
         'autocomplete' => 'off'])
      !!}
      <div id="vPass"><span id="msgPass" class="validacion"></span></div>
      {{-- <span id="msgVacio" class="validacion" style="display:none;">Deje el campo en blanco para no cambiar la contraseña actual</span> --}}
   </div>
</div>


{{-- NOMBRE --}}
<div class="form-group row">
   {!! Form::label('Nombre', 'Nombre', ['class' => 'col-sm-3 col-form-label text-right']) !!}

   <div class="col-sm-9">
      {!! Form::text('nombre', $nombre,
         ['id'          => 'txtNombre',
         'class'        => 'form-control',
         'placeholder'  => 'Nombre'])
      !!}
      <div id="vNombre"><span id="msgNombre" class="validacion"></span></div>
   </div>
</div>


{{-- APELLIDOPATERNO --}}
<div class="form-group row">
   {!! Form::label('Apellido Paterno', 'Apellido Paterno', ['class' => 'col-sm-3 col-form-label text-right']) !!}

   <div class="col-sm-9">
      {!! Form::text('apellidoPaterno', null,
         ['id'          => 'txtApellidoPaterno',
         'class'        => 'form-control',
         'placeholder'  => 'Apellido Paterno'])
      !!}
      <div id="vApellidoPaterno"><span id="msgApellidoPaterno" class="validacion"></span></div>
   </div>
</div>


{{-- APELLIDOMATERNO --}}
<div class="form-group row">
   {!! Form::label('Apellido Materno', 'Apellido Materno', ['class' => 'col-sm-3 col-form-label text-right']) !!}

   <div class="col-sm-9">
      {!! Form::text('apellidoMaterno', null,
         ['id'          => 'txtApellidoMaterno',
         'class'        => 'form-control',
         'placeholder'  => 'Apellido Materno'])
      !!}
      <div id="vApellidoMaterno"><span id="msgApellidoMaterno" class="validacion"></span></div>
   </div>
</div>


{{-- DIRECCIÓN --}}
<div class="form-group row">
   {!! Form::label('Direccion', 'Dirección', ['class' => 'col-sm-3 col-form-label text-right']) !!}
   <div class="col-sm-9">

      {!! Form::text('direccion', null,
         ['id'          => 'txtDireccion',
         'class'        => 'form-control',
         'placeholder'  => 'Dirección'])
      !!}
      <div id="vDireccion"><span id="msgDireccion" class="validacion"></span></div>
   </div>
</div>


{{-- CORREO --}}
<div class="form-group row">
   {!! Form::label('Correo', 'Correo', ['class' => 'col-sm-3 col-form-label text-right']) !!}
   <div class="col-sm-9">         
      {!! Form::email('correo', null, 
         ['id'          => 'txtCorreo',
         'class'        => 'form-control',
         'placeholder'  => 'ejemplo@gmail.com',
         'autocomplete' => 'off'])
      !!}
      <div id="vCorreo"><span id="msgCorreo" class="validacion"></span></div>
   </div>
</div>
