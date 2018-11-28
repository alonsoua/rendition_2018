{{--       <div class="form-group row">
         {!! Form::label('Sostenedor', 'Es Sostenedor', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}

         <div class="col-sm-9">
            <div class="mt-2">
               {{ Form::checkbox('sostenedor'), 0 }}
            </div>
         </div>

      </div> --}}
{{--
      <div class="form-group row">
         {!! Form::label('Perfil', 'Perfil', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}

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

{{-- CÓDIGO --}}
<div class="form-group row">
   {!! Form::label('Código', 'Código', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}
   <div class="col-sm-9">

      {!! Form::text('codigo', null,
         ['id'          => 'txtCodigo',
         'class'        => 'form-control',
         'placeholder'  => 'Código'])
      !!}
      <div id="vCodigo"><span id="msgCodigo" class="validacion"></span></div> {{-- Div de Validación --}}
   </div>
</div>


{{-- NOMBRE --}}
<div class="form-group row">
   {!! Form::label('Nombre', 'Nombre', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}

   <div class="col-sm-9">
      {!! Form::text('nombre', null,
         ['id'          => 'txtNombre',
         'class'        => 'form-control',
         'placeholder'  => 'Nombre'])
      !!}
      <div id="vNombre"><span id="msgNombre" class="validacion"></span></div>
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


{{-- CHECKBOX EXENTO --}}
<div class="form-group row">
   {!! Form::label('Exento', 'Exento', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}

   <div class="col-sm-9">
      <div class="mt-2">
         {{ Form::checkbox('exento'), 0 }}
      </div>
   </div>

</div>