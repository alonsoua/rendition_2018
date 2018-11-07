<div class="text-center">
   @can('sostenedores.edit')
      {!! link_to_route('sostenedores.edit', $title='Editar', $parameters = [
            'id'  => $id
         ] ,$attributes = [
            'id'     => 'editarSostenedor',
            'class'  => 'btn btn-outline-warning btn-sm'
      ]) !!}
   @endcan

   @can('sostenedores.destroy')
      <a href="#!" id="{{ $id }}" data-rut="{{ $rut }}" data-nombre="{{ $nombre }}" onclick=" MensajeEliminar(event, this) ">
         <button type="button" class="btn btn-outline-danger btn-sm">Eliminar</button>
      </a>
   @endcan
</div>
