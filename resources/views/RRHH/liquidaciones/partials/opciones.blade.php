<div class="text-center">
   
      {{-- <button type="button" class="btn btn-sm btn-success " title="Imprimir" aria-haspopup="true" aria-expanded="false">
         <span class="sr-only"></span>
         <i class="fa fa-print fa-sm"></i> 
      </button>      
    --}}
   <div class="btn-group  btn-group-sm">
      <button type="button" class="btn btn-sm btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <span class="sr-only"></span>
         <i class="fa fa-cog fa-sm"></i> 
      </button>
      <div class="dropdown-menu dropdown-menu-right">      
         
         @can('liquidaciones.edit')
                                 
            {!! link_to_route('liquidaciones.edit', $title='Editar', $parameters = [
                  'id'  => $id
               ] ,$attributes = [
                  'id'     => 'editarLiquidacion',
                  'class'  => 'dropdown-item small-button'
            ]) !!}   
                  
         @endcan
            
         @can('liquidaciones.destroy')

            <a href="#!" class="dropdown-item small-button"
            id="{{ $id }}" data-nombre="{{ $funcionario['nombre'] }}" data-apellido="{{ $funcionario['apellidoPaterno'] }}"
            data-rut="{{ $funcionario['rut'] }}" data-fecha="{{ $fechaLiquidacion }}" onclick=" MensajeEliminar(event, this) ">
               Eliminar
            </a>

         @endcan
         
         @can('liquidaciones.index')
            {!! link_to_route('liquidaciones.show', $title='Descargar', $parameters = [
                  'id'  => $id
               ] ,$attributes = [
                  'id'     => 'pdfLiquidacion',
                  'class'  => 'dropdown-item small-button'
            ]) !!}       
         @endcan
      </div>      
   </div>
</div>