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

      <div class="form-group row">
         {!! Form::label('Nombre', 'Nombre', ['class' => 'col-sm-3 col-form-label text-right']) !!}
         <div class="col-sm-9">

            {!! Form::text('nombre', null,
               ['id'          => 'txtNombre',
               'class'        => 'form-control',
               'placeholder'  => 'Nombre'])
            !!}
            <div id="vNombre"><span id="msgNombre" class="validacion"></span></div> {{-- Div de Validación --}}
         </div>
      </div>

      <div class="form-group row">
         {!! Form::label('ApellidoPaterno', 'Apellido Paterno', ['class' => 'col-sm-3 col-form-label text-right']) !!}
         <div class="col-sm-9">

            {!! Form::text('apellidoPaterno', null,
               ['id'          => 'txtApellidoPaterno',
               'class'        => 'form-control',
               'placeholder'  => 'Apellido Paterno'])
            !!}
            <div id="vApellidoPaterno"><span id="msgApellidoPaterno" class="validacion"></span></div>
         </div>
      </div>
 
      <div class="form-group row">
         {!! Form::label('ApellidoMaterno', 'Apellido Materno', ['class' => 'col-sm-3 col-form-label text-right']) !!}
         <div class="col-sm-9">

            {!! Form::text('apellidoMaterno', null,
               ['id'          => 'txtApellidoMaterno',
               'class'        => 'form-control',
               'placeholder'  => 'Apellido Materno'])
            !!}
            <div id="vApellidoMaterno"><span id="msgApellidoMaterno" class="validacion"></span></div>
         </div>
      </div>

      <div class="form-group row">
         {!! Form::label('Comuna', 'Comuna', ['class' => 'col-sm-3 col-form-label text-right']) !!}

         <div class="col-sm-9">
               {{-- {{ $comunas }} --}}
            {{ Form::select('comuna', $comunas , null,
               [
                  'id'           => 'lstComuna',
                  'placeholder'  => 'Seleccione Comuna...',
                  'class'        => 'form-control'
               ])
            }}
            <div id="vComuna"><span id="msgComuna" class="validacion"></span></div>
         </div>
      </div> 

      <div class="form-group row">
         {!! Form::label('Direccidion', 'Dirección', ['class' => 'col-sm-3 col-form-label text-right']) !!}
         <div class="col-sm-9">

            {!! Form::text('direccion', null,
               ['id'          => 'txtDireccion',
               'class'        => 'form-control',
               'placeholder'  => 'Dirección'])
            !!}
            <div id="vDireccion"><span id="msgDireccion" class="validacion"></span></div>
         </div>
      </div>
      
      <div class="form-group row">
         {!! Form::label('fono', 'Teléfono', ['class' => 'col-sm-3 col-form-label text-right']) !!}
         <div class="col-sm-9">

            {!! Form::text('fono', null,
               ['id'          => 'txtFono',
               'class'        => 'form-control',
               'placeholder'  => 'Teléfono'])
            !!}
            <div id="vFono"><span id="msgFono" class="validacion"></span></div>
         </div>
      </div>

      <div class="form-group row">
         {!! Form::label('Correo', 'Correo', ['class' => 'col-sm-3 col-form-label text-right']) !!}
         <div class="col-sm-9">

            {!! Form::text('correo', null,
               ['id'          => 'txtCorreo',
               'class'        => 'form-control',
               'placeholder'  => 'ejemplo@gmail.com'])
            !!}
            <div id="vCorreo"><span id="msgCorreo" class="validacion"></span></div>
         </div>
      </div>
