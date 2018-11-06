<div class="text-center">
   @can('subvenciones.edit')
      {!! link_to_route('subvenciones.edit', $title='Editar', $parameters = [
            'id'  => $id
         ] ,$attributes = [
            'id'     => 'editarSubvencion',
            'class'  => 'btn btn-outline-warning btn-sm'
      ]) !!}
   @endcan

   @can('subvenciones.destroy')
      <a href="#!" id="{{ $id }}" data-nombre="{{ $nombre }}" onclick=" MensajeEliminar(event, this) ">
         <button type="button" class="btn btn-outline-danger btn-sm">Eliminar</button>
      </a>
   @endcan
</div>
