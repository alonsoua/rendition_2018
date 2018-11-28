<div class="text-center">
   <div class="btn-group">  
      <button type="button" class="btn btn-sm btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <span class="sr-only"></span>
         <i class="fa fa-cog fa-sm"></i> 
      </button>
      <div class="dropdown-menu dropdown-menu-right">      
         
         @can('establecimientos.edit')
                                 
            {!! link_to_route('establecimientos.edit', $title='Editar', $parameters = [
                  'id'  => $id
               ] ,$attributes = [
                  'id'     => 'editarEstablecimiento',
                  'class'  => 'dropdown-item small-button'
            ]) !!}   
                  
         @endcan
         
         @can('establecimientos.destroy')

            <a href="#!" class="dropdown-item small-button"
            id="{{ $id }}" data-rbd="{{ $rbd }}" data-nombre="{{ $nombre }}" onclick=" MensajeEliminar(event, this) ">
               Eliminar
            </a>

         @endcan

      </div>      
   </div>
</div>