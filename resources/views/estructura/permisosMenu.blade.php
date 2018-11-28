
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

        {{-- sostenedores --}}
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