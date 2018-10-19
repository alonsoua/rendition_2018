<nav class="navbar navbar-dark navbar-expand-lg sticky-top shadow bg-dark font-weight-light">
   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
   </button>
   <ul class="nav nav-pills d-lg-none" style="z-index:10000;">
      <li class="nav-item dropdown">
          <a class="dropdown-toggle font-weight-light text-white" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Alonso Ugarte </a>
        <div class="dropdown-menu dropdown-menu-right">
           <a class="dropdown-item" href="#one">Cerrar Sesi&oacute;n</a>
           </div>
      </li>
   </ul>
   <div class="collapse navbar-collapse" id="navbarSupportedContent">
       <ul class="navbar-nav mr-auto ">
         {{-- <li class="nav-item  {{ Request::is('/') ? 'active' : '' }}">
           <a class="nav-link" href="{{ url('/') }}">Inicio</a>
         </li> --}}

         <!-- Administración -->
         @can('users.index' )
         <li class="nav-item dropdown {{ Request::is('admin/*') ? 'active' : '' }}">
           <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             Administraci&oacute;n
           </a>
           <div class="dropdown-menu" aria-labelledby="navbarDropdown">           
            @can('users.index')
               <a class="dropdown-item {{ Request::is('admin/users*') ? 'active' : '' }}" href="{{ route('users.index') }}">Usuarios</a>
            @endcan

            {{-- @can('roles.index')
               <a class="dropdown-item {{ Request::is('admin/roles*') ? 'active' : '' }}" href="{{ route('roles.index') }}">Roles</a>
            @endcan --}}

           </div>
         </li>
         @endcan

         <!-- Mantenedores -->

         <li class="nav-item dropdown">
           <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             Mantenedores
           </a>
           <div class="dropdown-menu" aria-labelledby="navbarDropdown">
             <a class="dropdown-item" href="#">Sostenedores</a>
             <a class="dropdown-item" href="#">Establecimiento</a>
             <a class="dropdown-item" href="#">Subvenciones</a>
             <a class="dropdown-item" href="#">Leyes</a>
             <a class="dropdown-item" href="#">Carga Mensual</a>
             <a class="dropdown-item" href="#">C&aacute;lculo Horas</a>

             <div class="dropdown-divider"></div>
             <h6 class="dropdown-header text-center">Gastos</h6>
             <a class="dropdown-item" href="#">Cuentas</a>
             <a class="dropdown-item" href="#">Proveedores</a>
             <a class="dropdown-item" href="#">Tipos de Documentos</a>

             <div class="dropdown-divider"></div>
             <h6 class="dropdown-header text-center">RR.HH</h6>
             <a class="dropdown-item" href="#">Funciones</a>
             <a class="dropdown-item" href="#">Funcionarios</a>
           </div>
         </li>

         <!-- Gastos -->
         <li class="nav-item dropdown">
           <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             Gastos
           </a>
           <div class="dropdown-menu" aria-labelledby="navbarDropdown">
             <a class="dropdown-item" href="#">Imputaci&oacute;n</a>
             <a class="dropdown-item" href="#">Reporte</a>
           </div>
         </li>

         <!-- RR.HH. -->
         <li class="nav-item dropdown">
           <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             RR.HH.
           </a>
           <div class="dropdown-menu" aria-labelledby="navbarDropdown">
             <a class="dropdown-item" href="#">Liquidaciones</a>
             <a class="dropdown-item" href="#">Reporte</a>
           </div>
         </li>

       </ul>
   </div>
</nav>
