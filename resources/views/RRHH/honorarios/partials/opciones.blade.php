<div class="text-center">
<table>
   <tr>
      <td>
         <div class="btn-group  btn-group-sm ">
            <button type="button" class="btn btn-sm btn-success dropdown-toggle dropdown-toggle-split mr-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <span class="sr-only"></span>
               <i class="fa fa-flag fa-sm"></i> 
            </button>
            <div class="dropdown-menu dropdown-menu-right">                              
               @if ( $estado != 'Aprobado' )
                  <a href="#!" class="dropdown-item small-button"
                  id="{{ $id }}" data-estado ="Aprobar" onclick=" ModificarEstado(event, this) ">
                     Aprobar
                  </a>                                    
               @endif

               @if ( $estado != 'Rechazado' )
                  <a href="#!" class="dropdown-item small-button"
                  id="{{ $id }}" data-estado ="Rechazar" onclick=" ModificarEstado(event, this) ">
                     Rechazar
                  </a>              
               @endif

               @if ( $estado != 'Por Aprobar' )
                  <a href="#!" class="dropdown-item small-button"
                  id="{{ $id }}" data-estado ="Rechazar" onclick=" ModificarEstado(event, this) ">
                     Por Aprobar
                  </a>  
               @endif               
            </div>     
         </div>
      </td>
      <td>
         <div class="btn-group  btn-group-sm">
      <button type="button" class="btn btn-sm btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <span class="sr-only"></span>
         <i class="fa fa-cog fa-sm"></i> 
      </button>
      <div class="dropdown-menu dropdown-menu-right">      
         
         @can('honorarios.edit')
                                 
            {!! link_to_route('honorarios.edit', $title='Editar', $parameters = [
                  'id'  => $id
               ] ,$attributes = [
                  'id'     => 'editarHonorario',
                  'class'  => 'dropdown-item small-button'
            ]) !!}   
                  
         @endcan
         
         @can('honorarios.destroy')

            <a href="#!" class="dropdown-item small-button"
            id="{{ $id }}" data-descripcion="{{ $descripcion }}" onclick=" MensajeEliminar(event, this) ">
               Eliminar
            </a>

         @endcan

      </div>      
   </div>
      </td>
   </tr>
</table>
   

   
</div>