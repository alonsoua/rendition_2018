	<html>
	<head>
		<title>
			Liquidación {{ $desde }} - {{ $hasta }}
			
		</title>		
		<style>
			td {
				padding-left:10px;
				padding-right:10px;
			}
		</style>
	</head>	
	<body>
@foreach ($imprimir as $element)
	
		<div>			
			<!--> CABECERA DE PÁGINA </!-->
			<table style="font-size: 14px; width: 100%;">
				
				<!--> DATOS COLEGIO </!-->
				<tr>
					<td style="text-align: left; width:90%;">
						
						CORPORACIÓN EDUCACIONAL<br>						
						"{{ strtoupper($element['establecimiento']->nombre) }}"<br>
						RUT {{ strtoupper($element['establecimiento']->rut) }}<br>
						DIRECCIÓN {{ strtoupper($element['establecimiento']->direccion) }}<br>
						{{ strtoupper($element['comuna']->nombre) }}<br>
						
					</td>
					<td style="text-align: right; width:10%;">
			    		<div style="float: right;">logo</div>
					</td>
				</tr>


				<!--> LOGO </!-->
				<tr>
					<td style="text-align: left; width:20%;">										
						<strong><hr style="color: #000000! important;"></hr></strong>
					</td>
					<td style="text-align: right; width:80%;">
			    	
					</td>
				</tr>
			</table>	
	
			<!-- TITULO -->
		    <h4 style="text-align: center;">
		    	CONTRATACIÓN SUBV. GENERAL
		    	LIQUIDACIÓN DE REMUNERACIONES
		    	MES AÑO
		    </h4>
			
			<!--> DATOS DOCENTE </!-->
			<table style="font-size: 14px; width: 100%; margin-top: 0px; margin-bottom: 10px;">
				<tr>
					<td style="text-align: left; width:50%;"><strong>
					{{ $element['funcionario']->nombre }}
					{{ $element['funcionario']->apellidoPaterno }}
					{{ $element['funcionario']->apellidoMaterno }}
					</strong></td>
					<td style="text-align: left; width:40%;"></td>
					<td style="text-align: center; width:10%;"></td>
				</tr>			    
		  
		    	<tr>
					<td style="text-align: left; width:50%;">RUT: {{ $element['funcionario']->rut }}</td>
					<td style="text-align: left; width:40%;">Hras Subv. G.:</td>
					<td style="text-align: center; width:10%;">39</td>
				</tr>			    			

		  		<tr>
					<td style="text-align: left; width:50%;">Cargo: {{ $element['funcion']->nombre }}</td>
					<td style="text-align: left; width:40%;">Hras Subv. SEP.:</td>
					<td style="text-align: center; width:10%;">0</td>esta
				</tr>

		  		<tr>
					<td style="text-align: left; width:50%;">Fecha Ingreso: {{ $element['funcionario']->fechaInicioContrato }}</td>
					<td style="text-align: left; width:40%;">Hras Subv. PIE.:</td>
					<td style="text-align: center; width:10%;">3</td>
				</tr>		

				<tr>
					<td style="text-align: left; width:50%;">Fecha Termino: {{ $element['funcionario']->fechaTerminoContrato }}</td>
					<td style="text-align: left; width:40%;"><strong>Horas Contrato:</strong></td>
					<td style="text-align: center; width:10%;"><strong>{{ $element['funcionario']->horasCtoSemanal }} hras</strong></td>
				</tr>			    

				<tr>
					<td style="text-align: left; width:50%;"><strong>{{ $element['tipoContrato']->tipoContrato }}</strong></td>
					<td style="text-align: left; width:40%;">Días Trabajados:</td>
					<td style="text-align: center; width:10%;">30</td>
				</tr>
		  	</table>


			----------------------------------------------------------------------------------------------------------------------------------------
			<table style="font-size: 14px; width: 100%;">
				<tr>
					<td style="text-align: center; width:50%;"><strong>HABERES</strong></td>
					<td style="text-align: center; width:50%;"><strong>DESCUENTOS</strong></td>					
				</tr>			    
		  	</table>
			
			----------------------------------------------------------------------------------------------------------------------------------------
			
			<table style="font-size: 14px; width: 100%;">
				<tr>
					<td style="text-align: center; width:50%;"><strong>IMPONIBLES</strong></td>
					<td style="text-align: center; width:50%;"><strong>DESCUENTOS LEGALES</strong></td>					
				</tr>			    
		  	</table>

			<!--> DATOS LIQUIDACIÓN </!-->
			<table style="font-size: 14px; width: 100%; margin-top: 5px;">
				<tr>
					<td style="text-align: left; width:30%;">Sueldo Base</td>
					<td style="text-align: right; width:30%;">447.755</td>

					<td style="text-align: left; width:30%;">10,41%A.F.P. Planvital</td>
					<td style="text-align: right; width:10%;">105.840</td>
				</tr>
		  	
				<tr>
					<td style="text-align: left; width:30%;">L. 19,933</td>
					<td style="text-align: right; width:20%;">447.755</td>

					<td style="text-align: left; width:30%;">Isapre Consaludl</td>
					<td style="text-align: right; width:20%;">105.840</td>
				</tr>			    
		  	
				<tr>
					<td style="text-align: left; width:30%;">L. 19,410</td>
					<td style="text-align: right; width:20%;">447.755</td>

					<td style="text-align: left; width:30%;">0,6% Seguro de Cesantia</td>
					<td style="text-align: right; width:20%;">105.840</td>
				</tr>
		 
				<tr>
					<td style="text-align: left; width:30%;">B.R.P. s/m</td>
					<td style="text-align: right; width:20%;">447.755</td>

					<td style="text-align: left; width:30%;">Impt. Único</td>
					<td style="text-align: right; width:20%;">105.840</td>
				</tr>
		  	
				<tr>
					<td style="text-align: left; width:30%;">Horas PIE</td>
					<td style="text-align: right; width:20%;">51.755</td>

					<td style="text-align: left; width:30%;"></td>
					<td style="text-align: right; width:20%;"></td>
				</tr>
		  
				<tr>
					<td style="text-align: left; width:30%;">SNED Docente 2018 - 2018</td>
					<td style="text-align: right; width:20%;">222.755</td>

					<td style="text-align: left; width:30%;"></td>
					<td style="text-align: right; width:20%;"></td>
				</tr>
		  	
				<tr>
					<td style="text-align: center; width:30%;"><strong>TOTAL IMPONIBLES</strong></td>
					<td style="text-align: right; width:20%;"><strong>1.447.755</strong></td>

					<td style="text-align: center; width:40%;"><strong>TOTAL DESCUENTOS LEGALES</strong></td>
					<td style="text-align: right; width:10%;"><strong>190.755</strong></td>
				</tr>
		  	</table>
			  	
			----------------------------------------------------------------------------------------------------------------------------------------			

			<table style="font-size: 14px; width: 100%; margin-bottom: 10px;">
				<tr>
					<td style="text-align: center; width:50%;"><strong>NO IMPONIBLES</strong></td>

					<td style="text-align: center; width:50%;"><strong>OTROS DESCUENTOS</strong></td>
				</tr>
		  	</table>
			
			<table style="font-size: 14px; width: 100%;">
				<tr>
					<td style="text-align: left; width:30%;">Asignación Familiar</td>
					<td style="text-align: right; width:20%;">0</td>

					<td style="text-align: left; width:30%;">Préstamos</td>
					<td style="text-align: right; width:20%;">0</td>
				</tr>
		  	</table>
					
			
			----------------------------------------------------------------------------------------------------------------------------------------
		  	<table style="font-size: 14px; width: 100%;">
				<tr>
					<td style="text-align: left; width:30%;"><strong>TOTAL NO IMPONIBLES</strong></td>
					<td style="text-align: right; width:20%;"><strong>0</strong></td>

					<td style="text-align: left; width:40%;"><strong>TOTAL OTROS DESCUENTOS</strong></td>
					<td style="text-align: right; width:10%;"><strong>0</strong></td>
				</tr>
		  	</table>
			----------------------------------------------------------------------------------------------------------------------------------------
			
			
			<table style="font-size: 14px; width: 100%; margin-top: 10px;">
				<tr>
					<td style="text-align: left; width:30%;"><strong>TOTAL HABERES</strong></td>
					<td style="text-align: right; width:20%;"><strong>1.016.714</strong></td>

					<td style="text-align: left; width:30%;"><strong>TOTAL DESCUENTOS</strong></td>
					<td style="text-align: right; width:20%;"><strong>190.784</strong></td>
				</tr>
		  	</table>

			<table style="font-size: 14px; width: 100%; margin-top: 30px;">
				<tr>
					<td style="text-align: left; width:60%;"><strong>Fecha: {{ $element['liquidacion']->fechaLiquidacion }}</strong></td>					

					<td style="text-align: left; width:20%;"><strong>LÍQUIDO A PAGAR</strong></td>
					<td style="text-align: right; width:20%;">$890.784</td>
				</tr>
				<tr>
					<td style="text-align: left; width:50%;"></td>										
					<td colspan="2" style="text-align: right; width:50%;"><strong><hr style="color: #000000! important;"></hr></strong></td>					
				</tr>
		  	</table> 
					
		  	<table style="font-size: 14px; width: 100%; margin-top: 10px;">
				<tr>
					<td style="text-align: center; width:100%;">SON: Ochocientos mil novecientos treinta pesos.</td>					
				</tr>
		  	</table> 

		  	<hr style="color: #000000! important; "></hr>
			
			<table style="font-size: 14px; width: 100%; margin-bottom: 30px;">
				<tr>
					<td style="text-align: left; width:100%;">Recibi conforme el alcance líquido de la presente liquidación, no teniendo cargo o cobro alguno que hacer por otro concepto.</td>					
				</tr>
		  	</table>

			<table style="position: absolute; bottom: 50px; font-size: 14px; width: 100%;">
				<tr>
					<td style="text-align: center; width:50%;"><strong>_______________________________________</strong></td>					

					<td style="text-align: center; width:50%;"><strong>_______________________________________</strong></td>					
				</tr>
				<tr>
					<td style="text-align: center; width:50%;"><strong>FIRMA DE EMPLEADOR</strong></td>					

					<td style="text-align: center; width:50%;"><strong>FIRMA DE TRABAJADOR</strong></td>					
				</tr>
		  	</table> 

		  	<table style="position: absolute; bottom: 0px; font-size: 13px; width: 100%;">		
				<tr>					
					<td style="text-align: center; width:100%;">Administración</td>
				</tr>
		  	</table> 					
		</div>		


@endforeach
	</body>
</html>