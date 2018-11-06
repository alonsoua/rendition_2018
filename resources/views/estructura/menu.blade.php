<nav class="navbar navbar-dark navbar-expand-lg sticky-top shadow bg-dark font-weight-light">

<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
 aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>

<ul class="nav nav-pills d-lg-none" style="z-index:10000;">
    @include('estructura.userAuth')
</ul>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto ">
     
        {{-- Inicio --}}
        {{-- <li class="nav-item  {{ Request::is('/') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/') }}">Inicio</a>
        </li> --}}


        <!-- Administración -->
        @can(  'users.index' 
            || 'roles.index'
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
                    @endcan

                    @can('roles.index')
                       <a class="dropdown-item {{ Request::is('admin/roles*') ? 'active' : '' }}" 
                       href="{{ route('roles.index') }}">Roles</a>
                    @endcan

                </div>
            </li>
        @endcan

        <!-- Mantenedores -->
        @can(  'sostenedores.index' 
            || 'establecimientos.index'
            || 'subvenciones.index'
            || 'leyes.index'
            || 'cargamensual.index'
            || 'calculohoras.index'
            || 'cuentas.index'
            || 'proveedores.index'
            || 'documentos.index'
            || 'funciones.index'
            || 'funcionarios.index'
        )

            <li class="nav-item dropdown {{ Request::is('mantenedores/*') ? 'active' : '' }}">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" 
                aria-haspopup="true" aria-expanded="false">
                    Mantenedores
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    
                    @can('sostenedores.index')
                        <a class="dropdown-item {{ Request::is('mantenedores/sostenedores*') ? 'active' : '' }}" 
                        href="{{ route('sostenedores.index') }}">Sostenedores</a>
                    @endcan

                    @can('establecimientos.index')
                        <a class="dropdown-item {{ Request::is('mantenedores/establecimientos*') ? 'active' : '' }}"
                        href="{{ route('establecimientos.index') }}">Establecimientos</a>
                    @endcan

                    @can('subvenciones.index')
                        <a class="dropdown-item {{ Request::is('mantenedores/subvenciones*') ? 'active' : '' }}"
                        href="{{ route('subvenciones.index') }}">Subvenciones</a>
                    @endcan

                    @can('leyes.index')
                        <a class="dropdown-item {{ Request::is('mantenedores/leyes*') ? 'active' : '' }}"
                        href="{{ route('leyes.index') }}">Leyes</a>
                    @endcan

                    @can('cargamensual.index')
                        <a class="dropdown-item {{ Request::is('mantenedores/cargamensual*') ? 'active' : '' }}"
                        href="{{ route('cargamensual.index') }}">Carga Mensual</a>
                    @endcan

                    @can('calculohoras.index')
                        <a class="dropdown-item {{ Request::is('mantenedores/calculohoras*') ? 'active' : '' }}"
                        href="{{ route('calculohoras.index') }}">C&aacute;lculo Horas</a>
                    @endcan

                {{-- Gastos --}}
                @can(  'cuentas.index' 
                    || 'proveedores.index'
                    || 'documentos.index'
                )
                    <div class="dropdown-divider"></div>
                    <h6 class="dropdown-header text-center">Gastos</h6>
                @endcan

                    @can('cuentas.index')
                        <a class="dropdown-item {{ Request::is('mantenedores/cuentas*') ? 'active' : '' }}"
                        href="{{ route('cuentas.index') }}">Cuentas</a>
                    @endcan

                    @can('proveedores.index')
                        <a class="dropdown-item {{ Request::is('mantenedores/proveedores*') ? 'active' : '' }}"
                        href="{{ route('proveedores.index') }}">Proveedores</a>
                    @endcan

                    @can('documentos.index')
                        <a class="dropdown-item {{ Request::is('mantenedores/documentos*') ? 'active' : '' }}"
                        href="{{ route('documentos.index') }}">Tipos de Documentos</a>
                    @endcan

                {{-- RR.HH --}}
                @can(  'funciones.index' 
                    || 'funcionarios.index'
                )
                    <div class="dropdown-divider"></div>
                    <h6 class="dropdown-header text-center">RR.HH</h6>
                @endcan

                    @can('funciones.index')
                        <a class="dropdown-item {{ Request::is('mantenedores/funciones*') ? 'active' : '' }}"
                        href="{{ route('funciones.index') }}">Funciones</a>
                    @endcan

                    @can('funcionarios.index')
                        <a class="dropdown-item {{ Request::is('mantenedores/funcionarios*') ? 'active' : '' }}"
                        href="{{ route('funcionarios.index') }}">Funcionarios</a>
                    @endcan

                </div>
            </li>
        @endcan


        <!-- Gastos -->
        @can(  'imputaciones.index'
            || 'reportesgastos.index'
        )
            <li class="nav-item dropdown {{ Request::is('gastos/*') ? 'active' : '' }}">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" 
                aria-haspopup="true" aria-expanded="false">
                    Gastos
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                    @can('imputaciones.index')
                        <a class="dropdown-item {{ Request::is('gastos/imputaciones*') ? 'active' : '' }}"
                        href="{{ route('imputaciones.index') }}">Imputaci&oacute;n</a>
                    @endcan

                    @can('reportesgastos.index')
                        <a class="dropdown-item {{ Request::is('gastos/reportesgastos*') ? 'active' : '' }}"
                        href="{{ route('reportesgastos.index') }}">Reporte</a>
                    @endcan

                </div>
            </li>
        @endcan

        <!-- RR.HH. -->
        @can(  'liquidaciones.index'
            || 'reportesrrhh.index'
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
                    @endcan

                    @can('reportesrrhh.index')
                        <a class="dropdown-item {{ Request::is('rrgg/reportesrrhh*') ? 'active' : '' }}"
                        href="{{ route('reportesrrhh.index') }}">Reporte</a>
                    @endcan

                </div>
            </li>
        @endcan

        </ul>
    </div>
</nav>