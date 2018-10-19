
<div class="text-center">

   {!! link_to_route('usuarios.edit', $title='Editar', $parameters = [
         'id'  => $id
      ] ,$attributes = [
         'id'     => 'editarUsuario',
         'class'  => 'btn btn-outline-warning btn-sm'
   ]) !!}

      {{-- <button type="button" class="btn btn-outline-warning btn-sm">Editar</button> --}}

   <a href="#!" id="{{ $id }}" data-rut="{{ $rut }}" onclick=" MensajeEliminar(event, this) ">
      {{-- <span class="fa fa-trash-alt text-danger"></span> --}}
      <button type="button" class="btn btn-outline-danger btn-sm">Eliminar</button>
   </a>
</div>
