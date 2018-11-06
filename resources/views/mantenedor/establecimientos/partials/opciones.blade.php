<div class="text-center">
   @can('establecimientos.edit')
      {!! link_to_route('establecimientos.edit', $title='Editar', $parameters = [
            'id'  => $id
         ] ,$attributes = [
            'id'     => 'editarEstablecimiento',
            'class'  => 'btn btn-outline-warning btn-sm'
      ]) !!}
   @endcan

   @can('establecimientos.destroy')
      <a href="#!" id="{{ $id }}" data-rbd="{{ $rbd }}" data-nombre="{{ $nombre }}" onclick=" MensajeEliminar(event, this) ">
         <button type="button" class="btn btn-outline-danger btn-sm">Eliminar</button>
      </a>
   @endcan
</div>
