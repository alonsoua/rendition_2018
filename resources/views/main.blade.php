<!DOCTYPE html>
<html lang="<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>@yield('title')</title>

      	<!-- CSRF Token -->
      	<meta name="csrf-token" content="{{ csrf_token() }}">

		<!-- BootstrapCDN + DataTables CSS -->
      	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
      	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">

		<script defer src="https://use.fontawesome.com/releases/v5.1.0/js/all.js"></script>

		<link rel="stylesheet" href="{{ asset('plugins/chosen/chosen.css') }}">
		<link rel="stylesheet" href="{{ asset('css/datepicker/bootstrap-datepicker.css') }}">



	</head>

	<body style="background-color: #eeeeee;">

		<!-- NAVBAR PRINCIPAL -->
		@include('estructura.navbar')
      	<!-- FIN NAVBAR PRINCIPAL -->

      	@guest
      	@else
   			
   			<!-- MENÚ -->
   			@include('estructura.menu')
			<!-- FIN MENÚ -->

   			<!-- BREADCRUMB -->
   			{{-- @include('estructura.breadcrumb') --}}
   			<!-- FIN BREADCRUMB -->

      	@endguest


   		<!-- CONTENIDO -->
   		@yield('content')
		<!-- FIN CONTENIDO -->


      	{{-- Br para separar de Footer --}}
	    <br></br>
	    <br>
		{{-- Fin Br para separar de Footer --}}


		<!-- FOOTER -->
	   	{{-- @include('estructura.footer') --}}
		<!-- FIN FOOTER -->



		<!-- JAVASCRIPT -->
		

	      	<!-- Jquery -->
			<script src="{{ asset('js/jquery-3.3.1.slim.min.js') }}"></script>

	      	<!-- Data Tables Jquery -->
	      	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	      	<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

	      	<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
	      	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	      	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
	      	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
	      	<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>

	      	<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
	      	<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>	      


			<!-- Bootstrap 4 Jquery -->
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" 
			integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" 
			crossorigin="anonymous"></script>
			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" 
			integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" 
			crossorigin="anonymous"></script>

			<!-- Chosen -->
			<script src="{{ asset('plugins/chosen/chosen.jquery.js') }}"></script>

	      	<!-- Jquery Alert Message -->
			{!! Html::style('css/alert/jquery.alertable.css') !!}
			{!! Html::script('js/alert/jquery.alertable.js') !!}

			<!-- Bootstrap Datepicker -->
			{!! Html::script('js/datepicker/bootstrap-datepicker.min.js') !!}
			{!! Html::script('js/datepicker/bootstrap-datepicker.es.min.js') !!}
			
			<!-- Script General de la Aplicación -->
			<script src="{{ asset('js/appScript.js') }}"></script>

	      	<!-- Script del contenido -->
			@yield('contentScript')
			<!-- Fin Script del contenido -->
			
		<!-- FIN JAVASCRIPT -->

	</body>
</html>
