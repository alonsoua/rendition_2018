<div class="text-center">
   @can('funciones.edit')
      {!! link_to_route('funciones.edit', $title='Editar', $parameters = [
            'id'  => $id
         ] ,$attributes = [
            'id'     => 'editarFuncion',
            'class'  => 'btn btn-outline-warning btn-sm'
      ]) !!}
   @endcan

   @can('funciones.destroy')
      <a href="#!" id="{{ $id }}" data-codigo="{{ $codigo }}" data-nombre="{{ $nombre }}" onclick=" MensajeEliminar(event, this) ">
         <button type="button" class="btn btn-outline-danger btn-sm">Eliminar</button>
      </a>
   @endcan
</div>
