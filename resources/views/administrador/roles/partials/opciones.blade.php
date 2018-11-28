<div class="text-center">
   
   @if ($id != 1 && $id != 2)
   
      <div class="btn-group">  
         <button type="button" class="btn btn-sm btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="sr-only"></span>
            <i class="fa fa-cog fa-sm"></i> 
         </button>
         <div class="dropdown-menu dropdown-menu-right">      
            
            @can('roles.edit')
                                    
               {!! link_to_route('roles.edit', $title='Editar', $parameters = [
                     'id'  => $id
                  ] ,$attributes = [
                     'id'     => 'editarRol',
                     'class'  => 'dropdown-item small-button'
               ]) !!}   
                     
            @endcan
            
            @can('roles.destroy')

               <a href="#!" class="dropdown-item small-button"
               id="{{ $id }}" data-nombre="{{ $name }}" onclick=" MensajeEliminar(event, this) ">
                  Eliminar
               </a>

            @endcan

         </div>      
      </div>

   @endif

</div>