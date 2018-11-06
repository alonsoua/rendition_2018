<div class="text-center">
   @can('proveedores.edit')
      {!! link_to_route('proveedores.edit', $title='Editar', $parameters = [
            'id'  => $id
         ] ,$attributes = [
            'id'     => 'editarProveedor',
            'class'  => 'btn btn-outline-warning btn-sm'
      ]) !!}
   @endcan

   @can('proveedores.destroy')
      <a href="#!" id="{{ $id }}" data-rut="{{ $rut }}" data-razonSocial="{{ $razonSocial }}" onclick=" MensajeEliminar(event, this) ">
         <button type="button" class="btn btn-outline-danger btn-sm">Eliminar</button>
      </a>
   @endcan
</div>
