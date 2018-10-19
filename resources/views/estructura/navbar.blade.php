<nav class="navbar navbar-light bg-white justify-content-between">
   <a class="d-lg-none"></a>
	<a class="navbar-brand mb-0 font-weight-light text-dark d-none d-lg-block" href="{{ url('/') }}">
      <strong>Soft</strong>Innova
   </a>
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
   	    <li class="nav-item dropdown">
   		    <a class="dropdown-toggle font-weight-light text-dark" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }} </a>

            <div class="dropdown-menu dropdown-menu-right" >
   	        	<a class="dropdown-item" href="{{ route('logout') }}"
                  onclick="event.preventDefault(); document.getElementById('logout-form').submit();
               ">{{ __('Cerrar Sesión') }} </a>
               <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                   @csrf
               </form>
   	      </div>
   	    </li>
      @endguest
	</ul>
   <a class="d-lg-none"></a>
</nav>
