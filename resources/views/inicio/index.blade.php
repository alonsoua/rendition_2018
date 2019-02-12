@extends('main')

@section('title', 'Rendiciones')

@section('breadcrumb', 'Inicio')

@section('content')

<main style="background-color: #eeeeee; ">
<div class="col justify-content-md-center pt-4 pr-4 pl-4 pb-4">
<div class="card">

    <div class="card text-center">
        {{-- <div class="card-header">
        
        </div> --}}
    <div class="card-body">
        <h5 class="card-title">{{ Auth::user()->name }} {{ Auth::user()->apellidoPaterno }} {{ Auth::user()->apellidoMaterno }}</h5>
        <p class="card-text">Bienvenido al Sistema Rendiciones</p>
        
        {{-- <a href="#" class="">Manual de Usuario</a> | <a href="#" class="">Soporte Técnico</a> --}}
        
    </div>
    {{-- <div class="card-footer text-muted">
       2 days ago
    </div> --}}
</div>

</div>
</div>
</main>
@endsection

@section('contentScript')
   <script type="text/javascript">
      @include("mantenedor.rrhhFunciones.script")
   </script>
@endsection
