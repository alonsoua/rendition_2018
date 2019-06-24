

<html>
	<head>
		<title>
			{{ $funcionario->nombre }}
			{{ $funcionario->apellidoPaterno }}
			{{ $funcionario->apellidoMaterno }}
			
		</title>		
		<style>
			td {
				padding-left:10px;
				padding-right:10px;
			}
		</style>
	</head>	
	<body>
		<div>			
			<!--> CABECERA DE PÁGINA </!-->
			<table style="font-size: 14px; width: 100%;">
				
				<!--> DATOS COLEGIO </!-->
				<tr>
					<td style="text-align: left; width:90%;">
						
						CORPORACIÓN EDUCACIONAL<br>						
						"{{ strtoupper($establecimiento->nombre) }}"<br>
						RUT {{ strtoupper($establecimiento->rut) }}<br>
						DIRECCIÓN {{ strtoupper($establecimiento->direccion) }}<br>
						{{ strtoupper($comuna->nombre) }}<br>
						
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
					{{ $funcionario->nombre }}
					{{ $funcionario->apellidoPaterno }}
					{{ $funcionario->apellidoMaterno }}
					</strong></td>
					<td style="text-align: left; width:40%;"></td>
					<td style="text-align: center; width:10%;"></td>
				</tr>			    
		  
		    	<tr>
					<td style="text-align: left; width:50%;">RUT: {{ $funcionario->rut }}</td>
					<td style="text-align: left; width:40%;">Hras Subv. G.:</td>
					<td style="text-align: center; width:10%;">{{ $horas['horasSubvGeneral'] }}</td>
				</tr>			    			

		  		<tr>
					<td style="text-align: left; width:50%;">Cargo: {{ $funcion->nombre }}</td>
					<td style="text-align: left; width:40%;">Hras Subv. SEP.:</td>
					<td style="text-align: center; width:10%;">{{ $horas['horasSubvSep'] }}</td>
				</tr>

		  		<tr>
					<td style="text-align: left; width:50%;">Fecha Ingreso: {{ $funcionario->fechaInicioContrato }}</td>
					<td style="text-align: left; width:40%;">Hras Subv. PIE.:</td>
					<td style="text-align: center; width:10%;">{{ $horas['horasSubvPie'] }}</td>
				</tr>		

				<tr>
					<td style="text-align: left; width:50%;">Fecha Termino: {{ $funcionario->fechaTerminoContrato }}</td>
					<td style="text-align: left; width:40%;"><strong>Horas Contrato Semanal:</strong></td>
					<td style="text-align: center; width:10%;"><strong>{{ $funcionario->horasCtoSemanal }} hras</strong></td>
				</tr>			    

				<tr>
					<td style="text-align: left; width:50%;"><strong>{{ $tipoContrato->tipoContrato }}</strong></td>
					<td style="text-align: left; width:40%;">Días Trabajados:</td>
					<td style="text-align: center; width:10%;">{{ $liquidacion->diasTrabajados }}</td>
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
	

			@php
				$sueldoBase = 432830;
				$ley199333  = 153628;
				$ley19410   = 66503;
				$brp 		= 65505;
				$hrspie 	= 49300;

				$sned 		= 0;

				$totalImp = $sueldoBase + $ley199333 + $ley19410 + $brp + $hrspie + $sned;
				$totalImponibles = (integer)round($totalImp);

				$dsctoAfp 	    = (($afp->porcentaje / 100) * (integer)round($totalImponibles));
				$dsctoPrevision = (($prevision->porcentaje / 100) * (integer)round($totalImponibles));
				$dsctoSeguroCes = (0.6 / 100) * (integer)round($totalImponibles);

				$totalDescuentos = $dsctoAfp + $dsctoPrevision + $dsctoSeguroCes;

				$sueldoLiquido = $totalImponibles - $totalDescuentos;
			@endphp

			<!--> DATOS LIQUIDACIÓN </!-->
			<table style="font-size: 14px; width: 100%; margin-top: 5px;">
				<tr>
					<td style="text-align: left; width:30%;">Sueldo Base</td>
					<td style="text-align: right; width:30%;">{{ number_format($sueldoBase, 0, '', '.') }}</td>

					<td style="text-align: left; width:30%;">{{ $afp->porcentaje }}% A.F.P. {{ $afp->nombre }}</td>
					<td style="text-align: right; width:10%;">{{ number_format($dsctoAfp, 0, '', '.') }}</td>
				</tr>
		  	
				<tr>
					<td style="text-align: left; width:30%;">L. 19,933</td>
					<td style="text-align: right; width:20%;">{{ number_format($ley199333, 0, '', '.') }}</td>

					<td style="text-align: left; width:30%;">{{ $prevision->porcentaje }}% Isapre {{ $prevision->nombre }}</td>
					<td style="text-align: right; width:20%;">{{ number_format($dsctoPrevision, 0, '', '.') }}</td>
				</tr>			    
		  	
				<tr>
					<td style="text-align: left; width:30%;">L. 19,410</td>
					<td style="text-align: right; width:20%;">{{ number_format($ley19410, 0, '', '.') }}</td>

					<td style="text-align: left; width:30%;">0,6% Seguro de Cesantia</td>
					<td style="text-align: right; width:20%;">{{ number_format($dsctoSeguroCes, 0, '', '.') }}</td>
				</tr>
		 
				<tr>
					<td style="text-align: left; width:30%;">B.R.P. s/m</td>
					<td style="text-align: right; width:20%;">{{ number_format($brp, 0, '', '.') }}</td>

					<td style="text-align: left; width:30%;">Impt. Único</td>
					<td style="text-align: right; width:20%;">-</td>
				</tr>
		  	
				<tr>
					<td style="text-align: left; width:30%;">Horas PIE</td>
					<td style="text-align: right; width:20%;">{{ number_format($hrspie, 0, '', '.') }}</td>

					<td style="text-align: left; width:30%;"></td>
					<td style="text-align: right; width:20%;"></td>
				</tr>
		  
				<tr>
					<td style="text-align: left; width:30%;">SNED Docente 2018 - 2018</td>
					<td style="text-align: right; width:20%;">{{ number_format($sned, 0, '', '.') }}</td>

					<td style="text-align: left; width:30%;"></td>
					<td style="text-align: right; width:20%;"></td>
				</tr>
		  	
				<tr>
					<td style="text-align: center; width:30%;"><strong>TOTAL IMPONIBLES</strong></td>
					<td style="text-align: right; width:20%;"><strong>{{ number_format($totalImponibles, 0, '', '.') }}</strong></td>

					<td style="text-align: center; width:40%;"><strong>TOTAL DESCUENTOS LEGALES</strong></td>
					<td style="text-align: right; width:10%;"><strong>{{ number_format($totalDescuentos, 0, '', '.') }}</strong></td>
				</tr>
		  	</table>
			  	
			----------------------------------------------------------------------------------------------------------------------------------------			
			@php

				$asignacionFamiliar = ($liquidacion->asignacionFamiliar == null) ? 0 : $liquidacion->asignacionFamiliar;

				$prestamos = ($liquidacion->prestamos == null) ? 0 : $liquidacion->prestamos;
				

				$totalNoImponibles = $asignacionFamiliar;

				$totalOtrosDescuentos = $prestamos;

				$sueldoLiquido = $totalImponibles - $totalDescuentos;



				$totalHaberes = $totalNoImponibles + $totalImponibles; 
				$totalDescuento = $totalOtrosDescuentos + $totalDescuentos;

			@endphp

			<table style="font-size: 14px; width: 100%; margin-bottom: 10px;">
				<tr>
					<td style="text-align: center; width:50%;"><strong>NO IMPONIBLES</strong></td>

					<td style="text-align: center; width:50%;"><strong>OTROS DESCUENTOS</strong></td>
				</tr>
		  	</table>
			
			<table style="font-size: 14px; width: 100%;">
				<tr>
					<td style="text-align: left; width:30%;">Asignación Familiar</td>
					<td style="text-align: right; width:20%;">{{ number_format($asignacionFamiliar, 0, '', '.') }}</td>

					<td style="text-align: left; width:30%;">Préstamos</td>
					<td style="text-align: right; width:20%;">{{ number_format($prestamos, 0, '', '.') }}</td>
				</tr>
		  	</table>
					
			
			----------------------------------------------------------------------------------------------------------------------------------------
		  	<table style="font-size: 14px; width: 100%;">
				<tr>
					<td style="text-align: left; width:30%;"><strong>TOTAL NO IMPONIBLES</strong></td>
					<td style="text-align: right; width:20%;"><strong>{{ number_format($totalNoImponibles, 0, '', '.') }}</strong></td>

					<td style="text-align: left; width:40%;"><strong>TOTAL OTROS DESCUENTOS</strong></td>
					<td style="text-align: right; width:10%;"><strong>{{ number_format($totalOtrosDescuentos, 0, '', '.') }}</strong></td>
				</tr>
		  	</table>
			----------------------------------------------------------------------------------------------------------------------------------------
			
			
			<table style="font-size: 14px; width: 100%; margin-top: 10px;">
				<tr>
					<td style="text-align: left; width:30%;"><strong>TOTAL HABERES</strong></td>
					<td style="text-align: right; width:20%;"><strong>{{ number_format($totalHaberes, 0, '', '.') }}</strong></td>

					<td style="text-align: left; width:30%;"><strong>TOTAL DESCUENTOS</strong></td>
					<td style="text-align: right; width:20%;"><strong>{{ number_format($totalDescuento, 0, '', '.') }}</strong></td>
				</tr>
		  	</table>

			<table style="font-size: 14px; width: 100%; margin-top: 30px;">
				<tr>
					<td style="text-align: left; width:60%;"><strong>Fecha: {{ $liquidacion->fechaLiquidacion }}</strong></td>					

					<td style="text-align: left; width:20%;"><strong>LÍQUIDO A PAGAR</strong></td>
					<td style="text-align: right; width:20%;">${{ number_format($sueldoLiquido, 0, '', '.') }}</td>
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
	</body>
</html>
