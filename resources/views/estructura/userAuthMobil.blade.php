<li class="nav-item dropdown">
    
    {{-- Pantalla Grande --}}
    <a class="dropdown-toggle font-weight-light text-dark d-none d-lg-block" data-toggle="dropdown" href="#" 
    role="button" aria-haspopup="true" aria-expanded="false">
        
        {{ Auth::user()->name }} {{ Auth::user()->apellidoPaterno }} 
    
    </a>

    {{-- Pantalla Mobile --}}
    <a class="dropdown-toggle font-weight-light text-white d-lg-none" data-toggle="dropdown" href="#" role="button" 
    aria-haspopup="true" aria-expanded="false">
    
        {{ Auth::user()->name }} {{ Auth::user()->apellidoPaterno }} 
    
    </a>

    <div class="dropdown-menu dropdown-menu-right" >
        <a class="dropdown-item" href="{{ route('logout') }}"
            onclick="LogOut(event)">
            Cerrar Sesi&oacute;n
        </a>

        <form id="form-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </div>

</li>
<script>
    function LogOut(event) {
        event.preventDefault();
        document.getElementById('form-logout').submit();
    }
</script>