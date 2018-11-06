<div class="text-center">
   @can('documentos.edit')
      {!! link_to_route('documentos.edit', $title='Editar', $parameters = [
            'id'  => $id
         ] ,$attributes = [
            'id'     => 'editarDocumento',
            'class'  => 'btn btn-outline-warning btn-sm'
      ]) !!}
   @endcan

   @can('documentos.destroy')
      <a href="#!" id="{{ $id }}" data-codigo="{{ $codigo }}" data-nombre="{{ $nombre }}" onclick=" MensajeEliminar(event, this) ">
         <button type="button" class="btn btn-outline-danger btn-sm">Eliminar</button>
      </a>
   @endcan
</div>
