
{{-- SETEO PERMISOS --}}


{{-- Administración  --}}
        
    {{-- usuarios --}}
        @can('usuarios.index')
            @php    $usuariosIndex = 'true';     @endphp
        @else
            @php    $usuariosIndex = 'false';    @endphp
        @endcan
        @can('usuarios.create')
            @php    $usuariosCreate = 'true';     @endphp
        @else
            @php    $usuariosCreate = 'false';    @endphp
        @endcan

    {{-- roles --}}
        @can('roles.index')
            @php    $rolesIndex = 'true';     @endphp
        @else
            @php    $rolesIndex = 'false';    @endphp
        @endcan
        @can('roles.create')
            @php    $rolesCreate = 'true';     @endphp
        @else
            @php    $rolesCreate = 'false';    @endphp
        @endcan


{{-- Mantenedores --}}
    
    {{-- AFP --}}
        @can('afp.index')
            @php    $afpIndex = 'true';     @endphp
        @else
            @php    $afpIndex = 'false';    @endphp
        @endcan
        @can('afp.create')
            @php    $afpCreate = 'true';     @endphp
        @else
            @php    $afpCreate = 'false';    @endphp
        @endcan

    {{-- Prevision --}}
        @can('previsiones.index')
            @php    $previsionesIndex = 'true';     @endphp
        @else
            @php    $previsionesIndex = 'false';    @endphp
        @endcan
        @can('previsiones.create')
            @php    $previsionesCreate = 'true';     @endphp
        @else
            @php    $previsionesCreate = 'false';    @endphp
        @endcan


    {{-- Reajuste --}}
        @can('reajuste.index')
            @php    $reajusteIndex = 'true';     @endphp
        @else
            @php    $reajusteIndex = 'false';    @endphp
        @endcan
    
    {{-- Sned --}}

        @can('send.index')
            @php    $snedIndex = 'true';     @endphp
        @else
            @php    $snedIndex = 'false';    @endphp
        @endcan
    
    {{-- Sostenedores --}}
        @can('sostenedores.index')
            @php    $sostenedoresIndex = 'true';     @endphp
        @else
            @php    $sostenedoresIndex = 'false';    @endphp
        @endcan
        @can('sostenedores.create')
            @php    $sostenedoresCreate = 'true';     @endphp
        @else
            @php    $sostenedoresCreate = 'false';    @endphp
        @endcan

    {{-- establecimientos --}}
        @can('establecimientos.index')
            @php    $establecimientosIndex = 'true';     @endphp
        @else
            @php    $establecimientosIndex = 'false';    @endphp
        @endcan
        @can('establecimientos.create')
            @php    $establecimientosCreate = 'true';     @endphp
        @else
            @php    $establecimientosCreate = 'false';    @endphp
        @endcan

    {{-- subvenciones --}}
        @can('subvenciones.index')
            @php    $subvencionesIndex = 'true';     @endphp
        @else
            @php    $subvencionesIndex = 'false';    @endphp
        @endcan
        @can('subvenciones.create')
            @php    $subvencionesCreate = 'true';     @endphp
        @else
            @php    $subvencionesCreate = 'false';    @endphp
        @endcan

    {{-- cuentas --}}
        @can('cuentas.index')
            @php    $cuentasIndex = 'true';     @endphp
        @else
            @php    $cuentasIndex = 'false';    @endphp
        @endcan
        @can('cuentas.create')
            @php    $cuentasCreate = 'true';     @endphp
        @else
            @php    $cuentasCreate = 'false';    @endphp
        @endcan

    {{-- proveedores --}}
        @can('proveedores.index')
            @php    $proveedoresIndex = 'true';     @endphp
        @else
            @php    $proveedoresIndex = 'false';    @endphp
        @endcan
        @can('proveedores.create')
            @php    $proveedoresCreate = 'true';     @endphp
        @else
            @php    $proveedoresCreate = 'false';    @endphp
        @endcan

    {{-- documentos --}}
        @can('documentos.index')
            @php    $documentosIndex = 'true';     @endphp
        @else
            @php    $documentosIndex = 'false';    @endphp
        @endcan
        @can('documentos.create')
            @php    $documentosCreate = 'true';     @endphp
        @else
            @php    $documentosCreate = 'false';    @endphp
        @endcan

    {{-- funciones --}}
        @can('funciones.index')
            @php    $funcionesIndex = 'true';     @endphp
        @else
            @php    $funcionesIndex = 'false';    @endphp
        @endcan
        @can('funciones.create')
            @php    $funcionesCreate = 'true';     @endphp
        @else
            @php    $funcionesCreate = 'false';    @endphp
        @endcan

    {{-- funcionarios --}}
        @can('funcionarios.index')
            @php    $funcionariosIndex = 'true';     @endphp
        @else
            @php    $funcionariosIndex = 'false';    @endphp
        @endcan
        @can('funcionarios.create')
            @php    $funcionariosCreate = 'true';     @endphp
        @else
            @php    $funcionariosCreate = 'false';    @endphp
        @endcan


{{-- Gastos --}}

    {{-- imputaciones --}}
        @can('imputaciones.index')
            @php    $imputacionesIndex = 'true';     @endphp
        @else
            @php    $imputacionesIndex = 'false';    @endphp
        @endcan
        @can('imputaciones.create')
            @php    $imputacionesCreate = 'true';     @endphp
        @else
            @php    $imputacionesCreate = 'false';    @endphp
        @endcan

    {{-- reportes --}}
        @can('reportesgastos.index')
            @php    $reportesGastosIndex = 'true';     @endphp
        @else
            @php    $reportesGastosIndex = 'false';    @endphp
        @endcan


{{-- RR.HH --}}

    {{-- leyes --}}
        @can('leyes.index')
            @php    $leyesIndex = 'true';     @endphp
        @else
            @php    $leyesIndex = 'false';    @endphp
        @endcan
        @can('leyes.create')
            @php    $leyesCreate = 'true';     @endphp
        @else
            @php    $leyesCreate = 'false';    @endphp
        @endcan

        {{-- calculohoras --}}
        @can('calculohoras.index')
            @php    $calculohorasIndex = 'true';     @endphp
        @else
            @php    $calculohorasIndex = 'false';    @endphp
        @endcan        

    {{-- Honorarios --}}
        @can('honorarios.index')
            @php    $honorariosIndex = 'true';     @endphp
        @else
            @php    $honorariosIndex = 'false';    @endphp
        @endcan
        @can('honorarios.create')
            @php    $honorariosCreate = 'true';     @endphp
        @else
            @php    $honorariosCreate = 'false';    @endphp
        @endcan

    {{-- liquidaciones --}}
        @can('liquidaciones.index')
            @php    $liquidacionesIndex = 'true';     @endphp
        @else
            @php    $liquidacionesIndex = 'false';    @endphp
        @endcan
        @can('liquidaciones.create')
            @php    $liquidacionesCreate = 'true';     @endphp
        @else
            @php    $liquidacionesCreate = 'false';    @endphp
        @endcan

    {{-- reportes --}}
        @can('reportesrrhh.index')
            @php    $reportesRrhhIndex = 'true';     @endphp
        @else
            @php    $reportesRrhhIndex = 'false';    @endphp
        @endcan


<nav class="navbar navbar-dark navbar-expand-lg sticky-top shadow bg-dark font-weight-light">

<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
 aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>

<ul class="nav nav-pills d-lg-none" style="z-index:10000;">
    @include('estructura.userAuthMobil')
</ul>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto ">
     
        {{-- Inicio --}}
        {{-- <li class="nav-item  {{ Request::is('/') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/') }}">Inicio</a>
        </li> --}}



        {{-- Administración --}}

        @if (  
            $usuariosIndex  == 'true' || 
            $usuariosCreate == 'true' ||
            $rolesIndex     == 'true' || 
            $rolesCreate    == 'true' 
        )
            <li class="nav-item dropdown {{ Request::is('admin/*') ? 'active' : '' }}">
                
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" 
                aria-haspopup="true" aria-expanded="false">
                    Administraci&oacute;n
                </a>

                <div class="dropdown-menu" aria-labelledby="navbarDropdown">           
                
                    @can('users.index')
                       <a class="dropdown-item {{ Request::is('admin/users*') ? 'active' : '' }}" 
                       href="{{ route('users.index') }}">Usuarios</a>
                    @else
                        @can('users.create')
                            <a class="dropdown-item {{ Request::is('admin/users*') ? 'active' : '' }}" 
                        href="{{ route('users.create') }}">Agregar Usuario</a>                        
                        @endcan
                    @endcan

                    @can('roles.index')
                       <a class="dropdown-item {{ Request::is('admin/roles*') ? 'active' : '' }}" 
                       href="{{ route('roles.index') }}">Roles</a>
                    @else
                        @can('roles.create')
                            <a class="dropdown-item {{ Request::is('admin/roles*') ? 'active' : '' }}" 
                        href="{{ route('roles.create') }}">Agregar Rol</a>                        
                        @endcan
                    @endcan

                </div>
            </li>
        @endif



        {{-- MANTENEDORES  --}}

        @if (
            $afpIndex               === 'true' ||
            $afpCreate              === 'true' ||
            $previsionesIndex       === 'true' ||
            $previsionesCreate      === 'true' ||
            $reajusteIndex          === 'true' ||
            $snedIndex              === 'true' ||
            $sostenedoresIndex      === 'true' ||
            $sostenedoresCreate     === 'true' ||
            $establecimientosIndex  === 'true' ||
            $establecimientosCreate === 'true' ||
            $subvencionesIndex      === 'true' ||
            $subvencionesCreate     === 'true' ||
            $cuentasIndex           === 'true' ||
            $cuentasCreate          === 'true' ||
            $proveedoresIndex       === 'true' ||
            $proveedoresCreate      === 'true' ||
            $documentosIndex        === 'true' ||
            $documentosCreate       === 'true' ||
            $leyesIndex             === 'true' ||
            $leyesCreate            === 'true' ||
            $calculohorasIndex      === 'true' ||            
            $funcionesIndex         === 'true' ||
            $funcionesCreate        === 'true' ||
            $funcionariosIndex      === 'true' ||
            $funcionariosCreate     === 'true' 

        )
            <li class="nav-item dropdown {{ Request::is('mantenedores/*') ? 'active' : '' }}">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" 
                aria-haspopup="true" aria-expanded="false">
                    Mantenedores
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">                    
                   
                    @can('afp.index')
                        <a class="dropdown-item {{ Request::is('mantenedores/afp*') ? 'active' : '' }}" 
                        href="{{ route('afp.index') }}">AFP</a>
                    @else
                        @can('afp.create')
                            <a class="dropdown-item {{ Request::is('mantenedores/afp*') ? 'active' : '' }}" 
                        href="{{ route('afp.create') }}">Agregar AFP</a>                        
                        @endcan
                    @endcan

                    @can('previsiones.index')                        
                        <a class="dropdown-item {{ Request::is('mantenedores/previsiones*') ? 'active' : '' }}"
                        href="{{ route('previsiones.index') }}">Previsiones</a>
                    @else
                        @can('previsiones.create')
                            <a class="dropdown-item {{ Request::is('mantenedores/previsiones*') ? 'active' : '' }}" 
                        href="{{ route('previsiones.create') }}">Agregar Previsión</a>                        
                        @endcan
                    @endcan
                    
                    @can('reajuste.create')
                        <a class="dropdown-item {{ Request::is('mantenedores/reajustes*') ? 'active' : '' }}" 
                        href="{{ route('reajustes.index') }}">Calcular Reajuste</a>                    
                    @endcan
                    
                    @can('sned.create')
                        <a class="dropdown-item {{ Request::is('mantenedores/sneds*') ? 'active' : '' }}" 
                        href="{{ route('sned.index') }}">Calcular Sned</a>                    
                    @endcan

                    
                    @can('sostenedores.index')
                        <a class="dropdown-item {{ Request::is('mantenedores/sostenedores*') ? 'active' : '' }}"
                        href="{{ route('sostenedores.index') }}">Sostenedores</a>
                    @else
                        @can('sostenedores.create')
                            <a class="dropdown-item {{ Request::is('mantenedores/sostenedores*') ? 'active' : '' }}" 
                        href="{{ route('sostenedores.create') }}">Agregar Sostenedor</a>
                        @endcan    
                    @endcan

                    @can('establecimientos.index')
                        <a class="dropdown-item {{ Request::is('mantenedores/establecimientos*') ? 'active' : '' }}"
                        href="{{ route('establecimientos.index') }}">Establecimientos</a>
                    @else
                        @can('establecimientos.create')
                            <a class="dropdown-item {{ Request::is('mantenedores/establecimientos*') ? 'active' : '' }}" 
                        href="{{ route('establecimientos.create') }}">Agregar Establecimiento</a>
                        @endcan    
                    @endcan

                    @can('subvenciones.index')
                        <a class="dropdown-item {{ Request::is('mantenedores/subvenciones*') ? 'active' : '' }}"
                        href="{{ route('subvenciones.index') }}">Subvenciones</a>
                    @else
                        @can('subvenciones.create')
                            <a class="dropdown-item {{ Request::is('mantenedores/subvenciones*') ? 'active' : '' }}" 
                        href="{{ route('subvenciones.create') }}">Agregar Subvenci&oacute;n</a>
                        @endcan    
                    @endcan                

                {{-- Gastos --}}
            
                @if ( 
                    $cuentasIndex === 'true' ||
                    $cuentasCreate === 'true' ||
                    $proveedoresIndex === 'true' ||
                    $proveedoresCreate === 'true' ||
                    $documentosIndex === 'true' ||
                    $documentosCreate === 'true'
                 )
                
                    <div class="dropdown-divider"></div>
                    <h6 class="dropdown-header text-center">Gastos</h6>

                    @can('documentos.index')
                        <a class="dropdown-item {{ Request::is('mantenedores/documentos*') ? 'active' : '' }}"
                        href="{{ route('documentos.index') }}">Tipos de Documentos</a>
                    @else
                        @can('documentos.create')
                            <a class="dropdown-item {{ Request::is('mantenedores/documentos*') ? 'active' : '' }}" 
                        href="{{ route('documentos.create') }}">Agregar Documento</a>
                        @endcan  
                    @endcan
                    
                    @can('cuentas.index')
                        <a class="dropdown-item {{ Request::is('mantenedores/cuentas*') ? 'active' : '' }}"
                        href="{{ route('cuentas.index') }}">Cuentas</a>
                    @else
                        @can('cuentas.create')
                            <a class="dropdown-item {{ Request::is('mantenedores/cuentas*') ? 'active' : '' }}" 
                        href="{{ route('cuentas.create') }}">Agregar Cuenta</a>
                        @endcan  
                    @endcan

                    @can('proveedores.index')
                        <a class="dropdown-item {{ Request::is('mantenedores/proveedores*') ? 'active' : '' }}"
                        href="{{ route('proveedores.index') }}">Proveedores</a>
                    @else
                        @can('proveedores.create')
                            <a class="dropdown-item {{ Request::is('mantenedores/proveedores*') ? 'active' : '' }}" 
                        href="{{ route('proveedores.create') }}">Agregar Proveedor</a>
                        @endcan  
                    @endcan                

                @endif

                {{-- RR.HH --}}
             

                @if(
                    $leyesIndex         === 'true' ||
                    $leyesCreate        === 'true' ||
                    $calculohorasIndex  === 'true' ||
                    $funcionesIndex     === 'true' ||
                    $funcionesCreate    === 'true' ||
                    $funcionariosIndex  === 'true' ||
                    $funcionariosCreate === 'true' 
                )

                    <div class="dropdown-divider"></div>
                    <h6 class="dropdown-header text-center">RR.HH</h6>
                    
                    @can('funciones.index')
                        <a class="dropdown-item {{ Request::is('mantenedores/funciones*') ? 'active' : '' }}"
                        href="{{ route('funciones.index') }}">Funciones</a>
                    @else
                        @can('funciones.create')
                            <a class="dropdown-item {{ Request::is('mantenedores/funciones*') ? 'active' : '' }}" 
                        href="{{ route('funciones.create') }}">Agregar Función</a>
                        @endcan  
                    @endcan
                    
                    @can('leyes.index')
                        <a class="dropdown-item {{ Request::is('mantenedores/leyes*') ? 'active' : '' }}"
                        href="{{ route('leyes.index') }}">Leyes</a>
                    @else
                        @can('leyes.create')
                            <a class="dropdown-item {{ Request::is('mantenedores/leyes*') ? 'active' : '' }}" 
                        href="{{ route('leyes.create') }}">Agregar Ley</a>
                        @endcan   
                    @endcan

                    @can('calculohoras.index')
                        <a class="dropdown-item {{ Request::is('mantenedores/calculohoras*') ? 'active' : '' }}"
                        href="{{ route('calculohoras.index') }}">C&aacute;lculo Horas</a>
                    @endcan                

                    @can('funcionarios.index')
                        <a class="dropdown-item {{ Request::is('mantenedores/funcionarios*') ? 'active' : '' }}"
                        href="{{ route('funcionarios.index') }}">Contratos</a>
                    @else
                        @can('funcionarios.create')
                            <a class="dropdown-item {{ Request::is('mantenedores/funcionarios*') ? 'active' : '' }}" 
                        href="{{ route('funcionarios.create') }}">Nuevo Contrato</a>
                        @endcan  
                    @endcan

                @endif
                </div>
            </li>
        @endif


        <!-- Gastos -->
        @if(  
            $imputacionesIndex      === 'true' ||
            $imputacionesCreate     === 'true' 
        )

            <li class="nav-item dropdown {{ Request::is('gastos/*') ? 'active' : '' }}">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" 
                aria-haspopup="true" aria-expanded="false">
                    Gastos
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                    @can('imputaciones.index')
                        <a class="dropdown-item {{ Request::is('gastos/imputaciones*') ? 'active' : '' }}"
                        href="{{ route('imputaciones.index') }}">Imputaciones</a>
                    @else
                        @can('imputaciones.create')
                            <a class="dropdown-item {{ Request::is('mantenedores/imputaciones*') ? 'active' : '' }}" 
                        href="{{ route('imputaciones.create') }}">Imputar Gasto</a>
                        @endcan  
                    @endcan

               {{--      @can('reportesgastos.index')
                        <a class="dropdown-item {{ Request::is('gastos/reportesgastos*') ? 'active' : '' }}"
                        href="{{ route('reportesgastos.index') }}">Reporte</a>
                    @endcan --}}

                </div>
            </li>
        @endif

        <!-- RR.HH. -->
        @if( 
            $honorariosIndex        === 'true' ||
            $honorariosCreate       === 'true' ||
            $liquidacionesIndex     === 'true' ||
            $liquidacionesCreate    === 'true' 
        )

            <li class="nav-item dropdown {{ Request::is('rrhh/*') ? 'active' : '' }}">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" 
                aria-haspopup="true" aria-expanded="false">
                    RR.HH.
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                    @can('liquidaciones.index')
                        <a class="dropdown-item {{ Request::is('rrhh/liquidaciones*') ? 'active' : '' }}"
                        href="{{ route('liquidaciones.index') }}">Liquidaciones</a>
                    @else
                        @can('liquidaciones.create')
                            <a class="dropdown-item {{ Request::is('mantenedores/liquidaciones*') ? 'active' : '' }}" 
                        href="{{ route('liquidaciones.create') }}">Nueva Liquidaci&oacute;n</a>
                        @endcan  
                    @endcan

                    @can('honorarios.index')
                        <a class="dropdown-item {{ Request::is('rrhh/honorarios*') ? 'active' : '' }}"
                        href="{{ route('honorarios.index') }}">Boleta Honorario</a>
                    @else
                        @can('honorarios.create')
                            <a class="dropdown-item {{ Request::is('mantenedores/honorarios*') ? 'active' : '' }}" 
                        href="{{ route('honorarios.create') }}">Nueva Boleta Honorario</a>
                        @endcan  
                    @endcan                    

                 {{--    @can('reportesrrhh.index')
                        <a class="dropdown-item {{ Request::is('rrgg/reportesrrhh*') ? 'active' : '' }}"
                        href="{{ route('reportesrrhh.index') }}">Reporte</a>
                    @endcan --}}

                </div>
            </li>        
        @endif
        </ul>
    </div>
</nav>