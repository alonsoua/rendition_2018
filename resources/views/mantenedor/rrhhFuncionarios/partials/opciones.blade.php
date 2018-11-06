<div class="text-center">
   @can('funcionarios.edit')
      {!! link_to_route('funcionarios.edit', $title='Editar', $parameters = [
            'id'  => $id
         ] ,$attributes = [
            'id'     => 'editarFuncionario',
            'class'  => 'btn btn-outline-warning btn-sm'
      ]) !!}
   @endcan

   @can('funcionarios.destroy')
      <a href="#!" id="{{ $id }}" data-rut="{{ $rut }}" onclick=" MensajeEliminar(event, this) ">
         <button type="button" class="btn btn-outline-danger btn-sm">Eliminar</button>
      </a>
   @endcan
</div>
