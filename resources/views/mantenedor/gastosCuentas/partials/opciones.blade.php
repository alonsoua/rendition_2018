<div class="text-center">
   @can('cuentas.edit')
      {!! link_to_route('cuentas.edit', $title='Editar', $parameters = [
            'id'  => $id
         ] ,$attributes = [
            'id'     => 'editarCuenta',
            'class'  => 'btn btn-outline-warning btn-sm'
      ]) !!}
   @endcan

   @can('cuentas.destroy')
      <a href="#!" id="{{ $id }}" data-codigo="{{ $codigo }}" data-nombre="{{ $nombre }}" onclick=" MensajeEliminar(event, this) ">
         <button type="button" class="btn btn-outline-danger btn-sm">Eliminar</button>
      </a>
   @endcan
</div>
