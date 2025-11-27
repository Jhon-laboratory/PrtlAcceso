			<?php 
			
			require '../Conexion/conexion_mysqli.php';
			$mysqli=conexionMySQL();
			
			$semana         = $_GET['semana'];
			
			if($semana != '')
			{
				$semana         = $_GET['semana'];
			}
			else
			{
				$sql ="SELECT semana FROM gb_semanas WHERE fecha='".date('Y-m-d')."'";
				$sqlR=$mysqli->query($sql);
				$sqlR=$sqlR->fetch_assoc();
				$semana         = $sqlR['semana'];
			}

			$txt_vapor      = $_GET['txt_vapor'];
			$txt_contenedor = $_GET['txt_contenedor'];
			
			ini_set('max_execution_time', 9000000);
				
			
			$tabla = '';
			
		
			$tabla .= '
	
		
			
	<form action="../../Controller/ficheroExcel.php" method="post" target="_blank" id="Formularioexcel" class="no_impresion" style="display:float;">
	
				<div class="col-md-5"></div>
							
				<div class="col-md-4">
					<button type="button" id="btnExportar" class="btn btn-success btn-sm  ">
						<i class="fa fa-file-excel-o fa-1x"></i>
					</button>
				
				</div>

			<input type="hidden" id="datofact" name="datofact" />
	</form>
	
	
			
		
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class ="table"  bgcolor="#fff" >
			  
			  
			  <tr>
			  <br>
				<td align="center" valign="top">
				
				<table width="100%" border="1" align="center" cellpadding="1" cellspacing="1" id="Exportar_a_Excel"
				class="contenedor display responsive nowrap table table-striped table-bordered table-hover">
					
					<tr bgcolor="#FFFFFF"> 
						<td width="30%" colspan="4"><div align="left"  style="font-size:20px;"><b></b></div></td>
					</tr>
					
					<tr bgcolor="#DDEBFF"> 
						<td width="30%" colspan="4"><div align="center"  style="font-size:20px;"><b>Reporte Operaciones</b></div></td>
					</tr>
					
					
					<tr bgcolor="#DDEBFF"> 
						<td width="60%"	><div align="left" class ="condcon"  style="font-size:16px;"></div></td>
						<td width="30%"  colspan="3"><div align="left"  class ="condcon"  style="font-size:16px;"></div></td>
					</tr>';

					if($txt_vapor != '')
					{
						$tabla .= '
						
						<tr bgcolor="#fff" > 
						<td align="left"><span class = "texnomb" style="font-size:16px;"><b>Vapor</b></span></td>							
						<td align="left" colspan="3"><span class = "texnomb"  style="font-size:16px;"><b>'.$txt_vapor.'</b></span></td>
					</tr>';
					}
					

					if($txt_contenedor != '')
					{
						$tabla .= '
						
						<tr bgcolor="#fff" > 
						<td align="left"><span class = "texnomb" style="font-size:16px;"><b>Contenedor</b></span></td>							
						<td align="left" colspan="3"><span class = "texnomb"  style="font-size:16px;"><b>'.$txt_contenedor.'</b></span></td>
					</tr>';
					}

					


					$tabla .= '
					<tr bgcolor="#fff" > 
						<td align="left"><span class = "texnomb" style="font-size:16px;"><b>Semana</b></span></td>							
						<td align="left" colspan="3"><span class = "texnomb"  style="font-size:16px;"><b>'.$semana.'</b></span></td>
					</tr>

					<tr bgcolor="#fff" > 
						<td align="left"><span  style="font-size:14px;"><b>Etiqueta De Fila</b></span></td>							
						<td align="left"><span  style="font-size:14px;"><b>suma de cantidad</b></span></td>
						<td align="left"><span 	style="font-size:14px;"><b>Promedio de precio</b></span></td>
						<td align="left"><span  style="font-size:14px;"><b>suma total</b></span></td>
					</tr> 
							';
									
	
		$sql_1 = "SET sql_mode='NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION'";
		$sql_1r=$mysqli->query($sql_1);

						$rp_detallescl = " 	SELECT c.log_nombre, c.log_id 
											from log_clientes c, log_detalle_req r
											where r.log_id_cliente = c.log_id
											and log_semana = '".$semana."' and  r.log_estatus = 2 "  ;		
							
							if($txt_vapor != '')
							{
								$rp_detallescl .= " AND r.log_vapor='".$txt_vapor."' ";
							}

							if($txt_contenedor != '')
							{
								$rp_detallescl .= " AND  r.log_contenedor='".$txt_contenedor."'";
							}
							$rp_detallescl .= " GROUP BY c.log_id ORDER BY c.log_nombre ASC";


						$query_detallescl=$mysqli->query($rp_detallescl);
						$t= $query_detallescl->num_rows;
						if($t>0)
						{
							while ($registro_detallescl=$query_detallescl->fetch_assoc())
							{
						$tabla .= '<tr bgcolor="#fff" > 
										<td align="left"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.($registro_detallescl["log_nombre"]).'</b></td>
										<td align="left"></td>
										<td align="left"></td>
										<td align="left"></td>
									</tr> ';
									
								$rp_detallesmod = " SELECT s.log_id_modalidad, s.log_id
															from  log_detalle_req r, log_servicios s
															WHERE r.log_id_servicio = s.log_id
															and r.log_semana = '".$semana."' 
															and r.log_id_cliente = '".$registro_detallescl["log_id"]."'
															and r.log_estatus = 2 " ;	
														if($txt_vapor != '')
														{
															$rp_detallesmod .= " AND r.log_vapor='".$txt_vapor."' ";
														}
							
														if($txt_contenedor != '')
														{
															$rp_detallesmod .= " AND  r.log_contenedor='".$txt_contenedor."'";
														}
														$rp_detallesmod .= " group by s.log_id_modalidad";

		
										$query_detallesmd = $mysqli->query($rp_detallesmod);
										$f= $query_detallesmd->num_rows;
										if($f>0)
										{
											while ($registro_detallesmd=$query_detallesmd->fetch_assoc())
											{	
													//// datos modalidades
													$modalida	=	"	SELECT log_id, log_nombre FROM log_modalidades 
																		WHERE log_id = '".$registro_detallesmd["log_id_modalidad"]."'
																		group by log_id
																		order by log_nombre desc";


													$modalida   = $mysqli->query($modalida);
													$modalida 	= $modalida->fetch_assoc();
				
													$tabla .= '
											
													<tr bgcolor="#fff" > 
														<td align="center"><b>'.($modalida['log_nombre']).'</b></td>
														<td align="left"></td>
														<td align="left"></td>
														<td align="left"></td>
													</tr> ';
																		
													$rp_detallessev = " SELECT COUNT(log_precio) AS contador, SUM(r.log_precio) AS SUMA, SUM(r.log_cantidad) cantidad_t, s.log_id_modalidad, 
																		s.log_id, s.log_nombre, r.log_precio 
																		FROM log_detalle_req r, log_servicios s 
																		WHERE r.log_id_servicio = s.log_id and r.log_semana = '".$semana."' 
																		AND r.log_id_cliente = '".$registro_detallescl["log_id"]."'  
																		AND s.log_id_modalidad = '".$modalida["log_id"]."'
                                                                        AND r.log_estatus='2'
                                                                        " ;	
																		
																		
													    if($txt_vapor != '')
														{
															$rp_detallesmod .= " AND r.log_vapor='".$txt_vapor."' ";
														}
							
														if($txt_contenedor != '')
														{
															$rp_detallesmod .= " AND  r.log_contenedor='".$txt_contenedor."'";
														}
														$rp_detallesmod .= " GROUP BY log_id, log_precio";


													$cantidad = 0;
													$totalsum = 0;
													$log_precio = 0;
													$query_detallessrv = $mysqli->query($rp_detallessev);
													$g= $query_detallessrv->num_rows;
													if($g>0)
													{
														while ($registro_detallessv=$query_detallessrv->fetch_assoc())
														{
															
																$total = $registro_detallessv['cantidad_t'] * $registro_detallessv['log_precio'];
																
																$tabla .= '
																	<tr bgcolor="#fff" > 
																		<td align="center">'.sanear_string($registro_detallessv['log_nombre']).'</td>
																		<td align="center">'.($registro_detallessv['cantidad_t']).'</td>
																		<td align="left">'.($registro_detallessv['log_precio']).'</td>
																		<td align="left">'.number_format($total, 2, ',', '.').'</td>
																	</tr> ';
																	
															$cantidad = $cantidad + $registro_detallessv['cantidad_t'];
															$log_precio = $log_precio + $registro_detallessv['SUMA'];
															$totalsum = $totalsum + $total;
														}
														
															$tabla .= '
																	<tr bgcolor="#fff" > 
																		<td align="center"></td>
																		<td align="center"><b>'.($cantidad).'</b></td>
																		<td align="left"><b>'.number_format(($totalsum/$cantidad), 2, ',', '.').'</b></td>
																		<td align="left"><b>'.number_format($totalsum, 2, ',', '.').'</b></td>
																	</tr> ';
													}														
													
												
									
											}
										}

							}
						}


	$tabla .= '';
	
		
		$mysqli->close();	
	
		$tabla .= '
	
			
				</table>
			
			</td>
	  </tr>
	 
	</table>
	 
	
	';

				

			$r=0;
			echo $tabla;		
	
	
		
	function invertirFechaT($Fecha)
		{
			$Fecha=explode("-",$Fecha);
			$fec=$Fecha[2]."-".$Fecha[1]."-".$Fecha[0];
			return $fec;
		}	
	
	
	function sanear_string($string)
		{
 
			$string = trim($string);
		 
			$string = str_replace(
				array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
				array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
				$string
			);
		 
			$string = str_replace(
				array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
				array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
				$string
			);
		 
			$string = str_replace(
				array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
				array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
				$string
			);
		 
			$string = str_replace(
				array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
				array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
				$string
			);
		 
			$string = str_replace(
				array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
				array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
				$string
			);
		 
			$string = str_replace(
				array('ñ', 'Ñ', 'ç', 'Ç'),
				array('n', 'N', 'c', 'C',),
				$string
			);
		 		 
			return $string;
		}
		
	?>	