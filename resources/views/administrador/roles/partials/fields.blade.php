
{{-- NOMBRE --}}
<div class="form-group row">
   {!! Form::label('Nombre', 'Nombre', ['class' => 'col-sm-3 col-form-label text-right']) !!}

   <div class="col-sm-9">
      {!! Form::text('name',  $editar == 0 ? null : $roles->name,
         ['id'          => 'txtNombre',
         'class'        => 'form-control',
         'placeholder'  => 'Nombre'])
      !!}
      <div id="vNombre"><span id="msgNombre" class="validacion"></span></div>
   </div>
</div>



{{-- DESCRIPCIÓN --}}
<div class="form-group row">
   {!! Form::label('Descripción', 'Descripción', ['class' => 'col-sm-3 col-form-label text-right']) !!}

   <div class="col-sm-9">
      {!! Form::textarea('descripcion',  $editar == 0 ? null : $roles->description,
         ['id'          => 'txtDescripcion',
         'class'        => 'form-control',
         'placeholder'  => 'Descripción',
         'rows'         => 4 ,
         'cols'         => 4 ])
      !!}
      <div id="vDescripcion"><span id="msgDescripcion" class="validacion"></span></div>
   </div>
</div>



<hr>
<div class="form-group row">
   
   {!! Form::label('Listado de Permisos', 'Listado de Permisos', ['class' => 'col-sm-12 col-form-label text-center']) !!}

   <div class="col-sm-12">      
      <div class="table-responsive-xl">
         <table id="dataTable-permisos" class="table  table-bordered table-sm">
            <thead>
               <tr>
                  <th scope="col" width="15%">Panel</th>
                  <th scope="col" width="20%">Nombre</th>
                  <th scope="col" width="10%" class="text-center">Ver</th>
                  <th scope="col" width="10%" class="text-center">Crear</th>
                  <th scope="col" width="10%" class="text-center">Editar</th>
                  <th scope="col" width="10%" class="text-center">Eliminar</th>
                  {{-- <th scope="col" width="10%" class="text-center">Todo</th>       --}}    
               </tr>
            </thead>
            <tbody>
            
               {{-- ADMINISTRADOR --}}
               <td rowspan="3">Administrador</td>                     
               @foreach($permissionsAdmin as $nombrePermiso)
                  
                  <tr id="{{ $nombrePermiso->description }}">
                    
                     <td>
                        @if($nombrePermiso->description == 'users')
                           {{ 'Usuarios' }}
                        @else
                           {{ ucfirst($nombrePermiso->description) }}
                        @endif
                     </td>
                    
                     @foreach($permissions as $permission)

                        @if(
                              $permission->description == $nombrePermiso->description 
                           && $permission->id <= 99 
                           && $permission->slug != $permission->description.'.show' 
                        )

                              <td class="text-center">

                                 @if($permission->slug == $permission->description.'.index')
                                    
                                    {{ Form::checkbox('permissions[]', $permission->id, null, ['class' => $permission->description]) }}
                                 
                                 @elseif($permission->slug == $permission->description.'.create')
                                    
                                    {{ Form::checkbox('permissions[]', $permission->id, null, ['class' => $permission->description]) }}
                                 
                                 @elseif($permission->slug == $permission->description.'.edit')
                                    
                                    {{ Form::checkbox('permissions[]', $permission->id, null, ['class' => $permission->description]) }}
                                 
                                 @elseif($permission->slug == $permission->description.'.destroy')
                                    
                                    {{ Form::checkbox('permissions[]', $permission->id, null, ['class' => $permission->description]) }}
                                 
                                 @endif

                              </td>

                        @endif
                     @endforeach
                     {{-- <td class="text-center">
                        
                        {{ Form::checkbox('todo', $nombrePermiso->description, null) }}

                     </td> --}}
                  </tr>
               @endforeach

               
               {{-- MANTENEDOR --}}
               <td rowspan="15">Mantenedor</td>                     
               @foreach($permissionsMante as $nombrePermiso)
                  
                  <tr id="{{ $nombrePermiso->description }}">
                     
                     <td>
                        @if($nombrePermiso->description == 'calculohoras')
                           {{ 'Cálculo Horas' }}
                        @elseif($nombrePermiso->description == 'funcionarios')
                           {{ 'Contratos' }}
                        @elseif($nombrePermiso->description == 'sned')
                           {{ 'Calcular Sned' }}
                        @elseif($nombrePermiso->description == 'reajuste')
                           {{ 'Calcular Reajuste' }}
                        @elseif($nombrePermiso->description == 'documentos')
                           {{ 'Tipos de Documentos' }}
                        @else
                           {{ ucfirst($nombrePermiso->description) }}
                        @endif


                     </td>
                     
                     @foreach($permissions as $permission)
                       
                        @if(
                              $permission->description == $nombrePermiso->description 
                           && $permission->id >= 100
                           && $permission->id <= 199 
                           && $permission->slug != $permission->description.'.show' 
                        )
                              
                              <td class="text-center">
                                 
                                 @if($permission->slug == $permission->description.'.index')
                                    
                                    {{ Form::checkbox('permissions[]', $permission->id, null) }}
                                 
                                 @elseif($permission->slug == $permission->description.'.create')
                                    
                                    {{ Form::checkbox('permissions[]', $permission->id, null) }}
                                 
                                 @elseif($permission->slug == $permission->description.'.edit')
                                    
                                    {{ Form::checkbox('permissions[]', $permission->id, null) }}
                                 
                                 @elseif($permission->slug == $permission->description.'.destroy')
                                    
                                    {{ Form::checkbox('permissions[]', $permission->id, null) }}

                                 @endif
                              
                              </td>
                        
                        @endif                        
                     @endforeach                        
                     {{-- <td class="text-center">
                        
                        {{ Form::checkbox('todo', $nombrePermiso->description, null) }}

                     </td> --}}
                  </tr>
               @endforeach


               {{-- GASTOS --}}
               <td rowspan="3">Gastos</td>                     
               @foreach($permissionsGasto as $nombrePermiso)
                  
                  <tr id="{{ $nombrePermiso->description }}">
                     
                     <td>
                        @if($nombrePermiso->description == 'reportesgastos')
                           {{ 'Reportes' }}
                        @else
                           {{ ucfirst($nombrePermiso->description) }}
                        @endif
                     </td>
                     
                     @foreach($permissions as $permission)
                       
                        @if(
                              $permission->description == $nombrePermiso->description 
                           && $permission->id >= 200
                           && $permission->id <= 299 
                           && $permission->slug != $permission->description.'.show' 
                        )
                              
                              <td class="text-center">
                                 
                                 @if($permission->slug == $permission->description.'.index')
                                    
                                    {{ Form::checkbox('permissions[]', $permission->id, null) }}
                                 
                                 @elseif($permission->slug == $permission->description.'.create')
                                    
                                    {{ Form::checkbox('permissions[]', $permission->id, null) }}
                                 
                                 @elseif($permission->slug == $permission->description.'.edit')
                                    
                                    {{ Form::checkbox('permissions[]', $permission->id, null) }}
                                 
                                 @elseif($permission->slug == $permission->description.'.destroy')
                                    
                                    {{ Form::checkbox('permissions[]', $permission->id, null) }}
                                 
                                 @endif

                              </td>

                        @endif
                     @endforeach
                     {{-- <td class="text-center">
                        
                        {{ Form::checkbox('todo', $nombrePermiso->description, null) }}

                     </td> --}}
                  </tr>
               @endforeach


               {{-- RR.HH. --}}
               <td rowspan="4">RR.HH.</td>                     
               @foreach($permissionsRrhh as $nombrePermiso)
                  
                  <tr id="{{ $nombrePermiso->description }}">
                    
                     <td>
                        @if($nombrePermiso->description == 'reportesrrhh')
                           {{ 'Reportes' }}
                        @else
                           {{ ucfirst($nombrePermiso->description) }}
                        @endif
                     </td>
                    
                     @foreach($permissions as $permission)
                      
                        @if(
                              $permission->description == $nombrePermiso->description 
                           && $permission->id >= 300
                           && $permission->id <= 399 
                           && $permission->slug != $permission->description.'.show' 
                        )
                              
                              <td class="text-center">
                                 
                                 @if($permission->slug == $permission->description.'.index')
                                  
                                    {{ Form::checkbox('permissions[]', $permission->id, null) }}
                                 
                                 @elseif($permission->slug == $permission->description.'.create')
                                  
                                    {{ Form::checkbox('permissions[]', $permission->id, null) }}
                                 
                                 @elseif($permission->slug == $permission->description.'.edit')
                                  
                                    {{ Form::checkbox('permissions[]', $permission->id, null) }}
                                 
                                 @elseif($permission->slug == $permission->description.'.destroy')
                                  
                                    {{ Form::checkbox('permissions[]', $permission->id, null) }}
                                 
                                 @endif

                              </td>

                        @endif
                     @endforeach
                     {{-- <td class="text-center">

                        {{ Form::checkbox('todo', $nombrePermiso->description, null) }}

                     </td> --}}
                  </tr>
               @endforeach  
            </tbody>       
         </table>
      </div>
   </div>
</div>
