<div class="text-center">
   <div class="btn-group">  
      <button type="button" class="btn btn-sm btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <span class="sr-only"></span>
         <i class="fa fa-cog fa-sm"></i> 
      </button>
      <div class="dropdown-menu dropdown-menu-right">      
         
         @can('proveedores.edit')
                                 
            {!! link_to_route('proveedores.edit', $title='Editar', $parameters = [
                  'id'  => $id
               ] ,$attributes = [
                  'id'     => 'editarProveedor',
                  'class'  => 'dropdown-item small-button'
            ]) !!}   
                  
         @endcan
         
         @can('proveedores.destroy')

            <a href="#!" class="dropdown-item small-button"
            id="{{ $id }}" data-rut="{{ $rut }}" data-razonSocial="{{ $razonSocial }}" onclick=" MensajeEliminar(event, this) ">
               Eliminar
            </a>

         @endcan

      </div>      
   </div>
</div>