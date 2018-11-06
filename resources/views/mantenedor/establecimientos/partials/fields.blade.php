
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
         {!! Form::label('RBD', 'RBD', ['class' => 'col-sm-3 col-form-label text-right']) !!}
         <div class="col-sm-9">

            {!! Form::text('rbd', null,
               ['id'          => 'txtRbd',
               'class'        => 'form-control',
               'placeholder'  => 'RBD'])
            !!}
            <div id="vRbd"><span id="msgRbd" class="validacion"></span></div> {{-- Div de Validación --}}
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
         {!! Form::label('Razón Social', 'Razón Social', ['class' => 'col-sm-3 col-form-label text-right']) !!}
         <div class="col-sm-9">

            {!! Form::text('razonSocial', null,
               ['id'          => 'txtRazonSocial',
               'class'        => 'form-control',
               'placeholder'  => 'Razón Social'])
            !!}
            <div id="vRazonSocial"><span id="msgRazonSocial" class="validacion"></span></div> {{-- Div de Validación --}}
         </div>
      </div>

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
         {!! Form::label('Tipo Dependencia', 'Tipo Dependencia', ['class' => 'col-sm-3 col-form-label text-right']) !!}

         <div class="col-sm-9">
            {{ Form::select('tipoDependencia', $tipoDependencias , null,
               [
                  'id'           => 'lstTipoDependencia',
                  'placeholder'  => 'Seleccione Tipo Dependencia...',
                  'class'        => 'form-control'
               ])
            }}
            <div id="vTipoDependencia"><span id="msgTipoDependencia" class="validacion"></span></div>
         </div>
      </div> 

      <div class="form-group row">
         {!! Form::label('Sostenedor', 'Sostenedor', ['class' => 'col-sm-3 col-form-label text-right']) !!}

         <div class="col-sm-9">
            {{ Form::select('sostenedor', $sostenedores , null,
               [
                  'id'           => 'lstSostenedor',
                  'placeholder'  => 'Seleccione Sostenedor...',
                  'class'        => 'form-control'
               ])
            }}
            <div id="vSostenedor"><span id="msgSostenedor" class="validacion"></span></div>
         </div>
      </div> 
      
      <div class="form-group row">
         {!! Form::label('Comuna', 'Comuna', ['class' => 'col-sm-3 col-form-label text-right']) !!}

         <div class="col-sm-9">
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

      <div class="form-group row">
         {!! Form::label('Teléfono', 'Teléfono', ['class' => 'col-sm-3 col-form-label text-right']) !!}

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
