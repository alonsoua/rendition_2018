      <div class="form-group row">
         {!! Form::label('Sostenedor', 'Es Sostenedor', ['class' => 'col-sm-3 col-form-label text-right']) !!}

         <div class="col-sm-9">
            <div class="mt-2">
               {{ Form::checkbox('sostenedor'), 0 }}
            </div>
         </div>

      </div>
{{--
      <div class="form-group row">
         {!! Form::label('Perfil', 'Perfil', ['class' => 'col-sm-3 col-form-label text-right']) !!}

         <div class="col-sm-9">
            {{ Form::select('size',
               [
                  '2' => 'Dev',
                  '1' => 'Admin'
               ], null,
               [
                  'id'           => 'lstPerfil',
                  'placeholder'  => 'Seleccione Perfil...',
                  'class'        => 'form-control'
               ])
            }}
         </div>

      </div> --}}

      <div class="form-group row">
         {!! Form::label('Rut', 'Rut', ['class' => 'col-sm-3 col-form-label text-right']) !!}
         <div class="col-sm-9">

            {!! Form::text('rut', null,
               ['id'          => 'txtRut',
               'class'        => 'form-control',
               'placeholder'  => ''])
            !!}
            <div id="vRut"><span id="msgRut" class="validacion"></span></div> {{-- Div de Validación --}}
         </div>
      </div>

      <div class="form-group row">
         {!! Form::label('Contraseña', 'Contraseña', ['class' => 'col-sm-3 col-form-label text-right']) !!}
         <div class="col-sm-9">

            {!! Form::password('pass',
               ['id'          => 'txtPass',
               'class'        => 'form-control',
               'placeholder'  => ''])
            !!}
            <div id="vPass"><span id="msgPass" class="validacion"></span></div>
            <span id="msgVacio" class="validacion">Deje el campo en blanco para no cambiar la contraseña actual</span>
         </div>
      </div>

      <div class="form-group row">
         {!! Form::label('Nombre', 'Nombre', ['class' => 'col-sm-3 col-form-label text-right']) !!}

         <div class="col-sm-9">
            {!! Form::text('nombre', null,
               ['id'          => 'txtNombre',
               'class'        => 'form-control',
               'placeholder'  => ''])
            !!}
            <div id="vNombre"><span id="msgNombre" class="validacion"></span></div>
         </div>
      </div>

      <div class="form-group row">
         {!! Form::label('Direccion', 'Dirección', ['class' => 'col-sm-3 col-form-label text-right']) !!}
         <div class="col-sm-9">

            {!! Form::text('direccion', null,
               ['id'          => 'txtDireccion',
               'class'        => 'form-control',
               'placeholder'  => ''])
            !!}
            <div id="vDireccion"><span id="msgDireccion" class="validacion"></span></div>
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
