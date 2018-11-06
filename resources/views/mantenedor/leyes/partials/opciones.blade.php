<div class="text-center">
   @can('leyes.edit')
      {!! link_to_route('leyes.edit', $title='Editar', $parameters = [
            'id'  => $id
         ] ,$attributes = [
            'id'     => 'editarLey',
            'class'  => 'btn btn-outline-warning btn-sm'
      ]) !!}
   @endcan

   @can('leyes.destroy')
      <a href="#!" id="{{ $id }}" data-codigo="{{ $codigo }}" data-nombre="{{ $nombre }}" onclick=" MensajeEliminar(event, this) ">
         <button type="button" class="btn btn-outline-danger btn-sm">Eliminar</button>
      </a>
   @endcan
</div>
