
{{-- CÓDIGO --}}
<div class="form-group row">
   {!! Form::label('Código', 'Código', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}
   <div class="col-sm-9">

      {!! Form::text('codigo', null,
         ['id'          => 'txtCodigo',
         'class'        => 'form-control',
         'maxlength'    => '10',
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
         'maxlength'    => '100',
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



{{-- lst SUBVENCIONES --}}
<div class="form-group row">
   {!! Form::label('Subvenciones', 'Subvenciones', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}

   <div class="col-sm-9">
    {{--   <select name="subvenciones[]" id="lstSubvencion" multiple
      tabindex="-1" class="select-subvenciones form-control">
         
         @foreach($subvenciones as $subvencion)

             <option value="{{$subvencion->id}}">{{$subvencion->nombre}}</option>
         @endforeach      
      </select> --}}



      {{ Form::select('subvenciones[]', $subvenciones ,  $editar == 0 ? null : $cuentaSub
         ,[
            'id'           => 'lstSubvencion',                  
            'class'        => 'select-subvenciones form-control',
            'multiple' 
         ])
      }}

      <div id="vSubvencion"><span id="msgSubvencion" class="validacion"></span></div>
   </div>
</div> 



{{-- lst TIPO DOCUMENTO --}}
<div class="form-group row">
   {!! Form::label('Tipo Documento', 'Tipo Documento', ['class' => 'col-sm-3 col-form-label text-md-right text-sm-left']) !!}

   <div class="col-sm-9">

      {{ Form::select('documentos[]', $documentos ,  $editar == 0 ? null : $cuentaDocs
         ,[
            'id'           => 'lstDocumento',                  
            'class'        => 'select-documentos form-control',
            'multiple' 
         ])
      }}

      <div id="vDocumento"><span id="msgDocumento" class="validacion"></span></div>
   </div>
</div> 