<!DOCTYPE html>
<html lang="<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>@yield('title', config('app.name'))</title>

      	<!-- CSRF Token -->
      	<meta name="csrf-token" content="{{ csrf_token() }}">

		<!-- BootstrapCDN + DataTables CSS -->
		{{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
 --}}
      	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
      	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">

		<script defer src="https://use.fontawesome.com/releases/v5.1.0/js/all.js"></script>

	</head>

	<body style="background-color: #eeeeee;">

		<!-- NAVBAR PRINCIPAL -->
		@include('estructura.navbar')
      	<!-- FIN -->

      	@guest
      	@else
   			<!-- MENÚ -->
   			@include('estructura.menu')

   			<!-- BREADCRUMB -->
   			@include('estructura.breadcrumb')
      	@endguest


   		<!-- CONTENIDO -->
   		@yield('content')

      	{{-- Br para separar de  --}}
      	<br></br>
      	<br>

		<!-- FOOTER -->
	   	{{-- @include('estructura.footer') --}}


		<!-- JAVASCRIPT -->
      	<!-- Jquery -->
		<script src="{{ asset('js/jquery-3.3.1.slim.min.js') }}"></script>
		{{-- <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> --}}

      	<!-- Data Tables Jquery y Bootstrap 4 -->
      	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
      	<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>



		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

      	<!-- Jquery Alert Message -->
		{!! Html::style('css/alert/jquery.alertable.css') !!}
		{!! Html::script('js/alert/jquery.alertable.js') !!}

      	<!-- Script del contenido -->
		@yield('contentScript')

		<!-- FIN JAVASCRIPT -->
	</body>
</html>
