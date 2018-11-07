<nav class="navbar navbar-light bg-white justify-content-between">
    {{-- Espacio Pantalla Mobile --}}
    <a class="d-lg-none"></a>

    {{-- Pantalla Grande --}}
	<a class="navbar-brand mb-0 font-weight-light text-dark d-none d-lg-block" href="{{ url('/') }}">
        <strong>Soft</strong>Innova
    </a>

    {{-- Pantalla Mobile --}}
    <a class="navbar-brand mb-0 font-weight-light text-dark d-lg-none" href="{{ url('/') }}" style="">
        <strong>Soft</strong>Innova
    </a>

	<ul class="nav nav-pills d-none d-lg-block" style="z-index:10000;">
        
        @guest

            <li class="nav-item">
            
                <a class="dropdown-item" href="{{ route('login') }}">{{ __('Ingresar') }}</a>
            
            </li>

            <li class="nav-item">
                
                @if (Route::has('register'))

                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                
                @endif
            
            </li>

        @else

   	        @include('estructura.userAuth')

        @endguest

	</ul>

    {{-- Espacio Pantalla Mobile --}}
    <a class="d-lg-none"></a>

</nav>