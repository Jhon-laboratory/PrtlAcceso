<?php
//header('Content-Type: application/vnd.ms-excel;charset=utf-8');
header('Content-Type: application/vnd.ms-excel');
$afiliados = $_REQUEST['txt_afiliado'];
//$sector = $_REQUEST['sector'];
//$hacienda = $_REQUEST['hacienda'];
$semana = $_REQUEST['txt_semana'];
$nombrearchivo = $afiliados.' AFILIADOS SEMANA '.$semana;
header("Content-Disposition: attachment; filename=$nombrearchivo.xls");
//EXCEL DE AFILIADOS X SEMANA, HACIENDA, SECTOR, EMPLEADO
include 'db3.php';
$rest = substr($semana, 1,1);
$contador =1;
$sql_1    = "SELECT * FROM cf_semanas WHERE semana LIKE '%$semana%'";
$result_1 = mysqli_query($db_link, $sql_1);
while($row = mysqli_fetch_assoc($result_1)) {


    $fecha        = explode('-',$row['fecha']);
    $row['fecha'] = $fecha[2].'/'.$fecha[1].'/'.$fecha[0];

    /** ARMAMOS DIAS **/
    if($contador == 1)
    {
        $lunes = $row['fecha'];
    }

    if($contador == 2)
    {
        $martes = $row['fecha'];
    }

    if($contador == 3)
    {
        $miercoles = $row['fecha'];
    }

    if($contador == 4)
    {
        $jueves = $row['fecha'];
    }

    if($contador == 5)
    {
        $viernes = $row['fecha'];
    }

    if($contador == 6)
    {
        $sabado = $row['fecha'];
    }


    if($contador == 7)
    {
        $domingo = $row['fecha'];
    }
    $contador++;
}

?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>


<table width="1083" border="1">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="8" ><strong><div align="center">Campo</div></strong></td>
    <td colspan="8"><strong><div align="center">Cuadrilla</div></strong></td>
  </tr>
  <tr>
    <td colspan="21">&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Semana</strong></td>
    <td><strong>Fecha</strong></td>
    <td><strong>Hacienda Sector</strong></td>
    <td><strong>Empleado</strong></td>
    <td><strong>C&eacute;dula</strong></td>
    <td><strong><?php echo $lunes; ?></strong></td>
    <td><strong><?php echo $martes; ?></strong></td>
    <td><strong><?php echo $miercoles; ?></strong></td>
    <td><strong><?php echo $jueves; ?></strong></td>
    <td><strong><?php echo $viernes; ?></strong></td>
    <td><strong><?php echo $sabado; ?></strong></td>
    <td><strong><?php echo $domingo; ?></strong></td>
    <td><strong>Total Pagar</strong></td>
    <td><strong><?php echo $lunes; ?></strong></td>
    <td><strong><?php echo $martes; ?></strong></td>
    <td><strong><?php echo $miercoles; ?></strong></td>
    <td><strong><?php echo $jueves; ?></strong></td>
    <td><strong><?php echo $viernes; ?></strong></td>
    <td><strong><?php echo $sabado; ?></strong></td>
    <td><strong><?php echo $domingo; ?></strong></td>
    <td><strong>Total Pagar</strong></td>
    <td><strong>Horas Extras</strong></td>
  </tr>
<?php
 
$validar = '';
$ssql='';
$concatenar = '';
$sisector = '';
$a =1;
//if ($sector>0){
//$sisector = 'and cfsec.id_sector='.$sector;    
//}

//ESTE SELECT ES EL ANTES DE FECHA NUEVA
// $sql = 'SELECT semana, cft.fecha as fechatarea, cfh.nombre_hacienda, cfsec.sector, cfsec.id_sector, cfe.nombre as nombre_emp, cfe.cedula, round(sum((cft.valor_labor*cft.cantidad)),2) as valor_pagar
//FROM `cf_tareas` cft
//left join cf_empleados cfe on
//cft.id_cfempleadofk = cfe.id_empleado
//left join cf_labores cfl ON
//cft.id_cflaborfk = cfl.id_labor
//left join cf_haciendas cfh ON
//cft.id_cfhaciendafk =  cfh.id_hacienda
//left join cf_sector cfsec ON
//cfsec.id_sector = cft.id_cfsectorfk
//where asegurado like "%'.$afiliados.'%"  and semana="'.$semana.'" and cft.estado<>"I"
//group by semana, nombre_hacienda, sector, id_sector, cfe.nombre, cfe.cedula
//order by semana, nombre_hacienda, sector, nombre asc';
 
 //SELECT CON NUEVOS CAMPOS QUE SE DESEA
 
// 
$sql_1 = "SET sql_mode='NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION'";
$result_1 = mysqli_query($db_link, $sql_1);

 $sql = '(SELECT cft.id_cfsectorfk AS id_sector,0 as id_empaque,cft.id_cfempleadofk,cft.id_cfhaciendafk,cft.fecha , cft.semana,  cfh.nombre_hacienda, (0) as sector,cfe.gb_nombre as nombre_emp, cfe.gb_cedula, round(sum((cft.valor_labor*cft.cantidad)),2) as valor_pagar, sum(0) as valor_cuadrilla, IF(cfl.labor  like "%extra%", sum(cantidad) , sum(0) ) as conteo_hextra, sum(0) as total_hextra
 FROM `cf_tareas` cft
 left join gb_empleados cfe on
 cft.id_cfempleadofk = cfe.gb_id_empleado
 left join cf_labores cfl ON
 cft.id_cflaborfk = cfl.id_labor
 left join cf_haciendas cfh ON
 cft.id_cfhaciendafk =  cfh.id_hacienda
 where  upper(gb_asegurado) like "%'.$afiliados.'%" and semana="'.$semana.'" and cft.estado<>"I"
 group by  cft.semana,  nombre_hacienda,cft.id_cfsectorfk, cfe.gb_nombre, cfe.gb_cedula
 order by  valor_pagar ASC)
 union
 (SELECT cfempaq.id_cfsectorfk AS id_sector,cfempaq.id_empaque  , cfempq.id_cfempleadofk as id_cfempleadofk,cfempaq.id_cfhaciendafk as id_cfhaciendafk,cfempaq.fecha, cfempaq.semana,  cfhac.nombre_hacienda, (0) as sector, cfemple.gb_nombre as nombre_emp, cfemple.gb_cedula, sum(0) as valor_pagar, sum(valor_cajaemp) as valor_cuadrilla,  sum(0) as conteo_hextra, sum(0) as total_hextra  FROM cf_empaques cfempaq
 inner join cf_haciendas cfhac on
 cfhac.id_hacienda = cfempaq.id_cfhaciendafk
 inner join cf_empaque_empleados cfempq on
 cfempq.id_cfempaquefk = cfempaq.id_empaque
 inner join gb_empleados cfemple on
 cfemple.gb_id_empleado  = cfempq.id_cfempleadofk
 where  gb_asegurado like "%'.$afiliados.'%"  and cfempaq.estado_cfc<>"I"   and semana="'.$semana.'"
 group by cfempaq.semana, cfhac.nombre_hacienda,cfempaq.id_cfsectorfk,cfemple.gb_nombre,cfemple.gb_cedula
 order by valor_cuadrilla ASC)';



// echo $sql;
         $result = mysqli_query($db_link, $sql);
         if (mysqli_num_rows($result) > 0) { //existe ese id
            while($row = mysqli_fetch_assoc($result)) {


                /** BUSCAMOS SECTOR  **/
                $sql_sector    = "SELECT sector	 FROM cf_sector WHERE id_sector='".$row["id_sector"]."' ";
                $result_sector = mysqli_query($db_link, $sql_sector);
                if (mysqli_num_rows($result) > 0) {
                    $row_sector    = mysqli_fetch_assoc($result_sector);
                    $sector =$row_sector['sector'];
                }
                else
                {
                    $sector ='';
                }
                


$hacysec         = $row["nombre_hacienda"].' '.$sector;
$semana          = $row["semana"];
$fechatarea      = $row["fecha"];
$nombre          = $row["nombre_emp"];
$ced             = $row["gb_cedula"];
$valor_pagar     = $row["valor_pagar"];
$conteo_hextra   = $row["conteo_hextra"];
$valor_cuadrilla = $row["valor_cuadrilla"];
$id_cfempleadofk = $row["id_cfempleadofk"];
$id_cfhaciendafk = $row["id_cfhaciendafk"];
$id_semana_cuadrilla = $row["id_empaque"];

/** CONTEO DE HORAS EXTRAS **/
$sql_extra       = "SELECT SUM(cantidad) AS horas_extra FROM cf_tareas WHERE semana='".$semana."' AND id_cfempleadofk='".$id_cfempleadofk."' AND id_cfhaciendafk='".$id_cfhaciendafk."' AND id_cflaborfk IN (13,67,91,137) ";
$result_extra    = mysqli_query($db_link, $sql_extra);
$row_extra       = mysqli_fetch_assoc($result_extra);
$conteo_hextra   = $row_extra['horas_extra'];



        if($valor_pagar >0)
        {
            $dias           = dias_pago($semana,$id_cfempleadofk,$id_cfhaciendafk,$row["id_sector"]);
            $conteo_hextra  = $conteo_hextra;
        }
        else
        {
            $dias['lunes']     = '0.00';
            $dias['martes']    = '0.00';
            $dias['miercoles'] = '0.00';
            $dias['jueves']    = '0.00';
            $dias['viernes']   = '0.00';
            $dias['sabado']    = '0.00';
            $dias['domingo']   = '0.00';

        }


                    $dias_lunes     = '0.00';
                    $dias_martes    = '0.00';
                    $dias_miercoles = '0.00';
                    $dias_jueves    = '0.00';
                    $dias_viernes   = '0.00';
                    $dias_sabado    = '0.00';
                    $dias_domingo   = '0.00';

        

                    $total_cuadrilla =0;
                if ($valor_cuadrilla > 0) {
                    $dias_cuadrilla = dias_cuadrilla($id_cfhaciendafk, $semana, $id_cfempleadofk,$row["id_sector"]);
                    $conteo_hextra     = 0;
               
                    
                    $dias_lunes     = $dias_cuadrilla['lunes']     +  $dias_lunes;
                    $dias_martes    = $dias_cuadrilla['martes']    +  $dias_martes;
                    $dias_miercoles = $dias_cuadrilla['miercoles'] +  $dias_miercoles;
                    $dias_jueves    = $dias_cuadrilla['jueves']    +  $dias_jueves;
                    $dias_viernes   = $dias_cuadrilla['viernes']   +  $dias_viernes;
                    $dias_sabado    = $dias_cuadrilla['sabado']    +  $dias_sabado;
                    $dias_domingo   = $dias_cuadrilla['domingo']   +  $dias_domingo;
               
                    $total_cuadrilla = $dias_lunes + $dias_martes + $dias_miercoles + $dias_jueves +  $dias_viernes + $dias_sabado + $dias_domingo + $total_cuadrilla;
               
               
                } else {
                    $dias_lunes     = '0.00';
                    $dias_martes    = '0.00' ;
                    $dias_miercoles = '0.00';
                    $dias_jueves    = '0.00';
                    $dias_viernes   = '0.00';
                    $dias_sabado    = '0.00';
                    $dias_domingo   = '0.00';

                    $total_cuadrilla = $dias_lunes + $dias_martes + $dias_miercoles + $dias_jueves +  $dias_viernes + $dias_sabado + $dias_domingo + $total_cuadrilla;
                }
            

        

        

        echo '<tr>
        <td>'.$semana.'</td>
        <td>'.$fechatarea.'</td>
        <td>'.$hacysec.'</td>
        <td>'.$nombre.'</td>
        <td>'.$ced.'</td>
        <td>'.number_format($dias['lunes'],2,".", "").'</td>
        <td>'.number_format($dias['martes'],2,".", "").'</td>
        <td>'.number_format($dias['miercoles'],2,".", "").'</td>
        <td>'.number_format($dias['jueves'],2,".", "").'</td>    
        <td>'.number_format($dias['viernes'],2,".", "").'</td>   
        <td>'.number_format($dias['sabado'],2,".", "").'</td>    
        <td>'.number_format($dias['domingo'],2,".", "").'</td>    
        <td>'.number_format($valor_pagar,2,".", "").'</td> 
        <td>'.number_format($dias_lunes,2,".", "").'</td>
        <td>'.number_format($dias_martes,2,".", "").'</td>
        <td>'.number_format($dias_miercoles,2,".", "").'</td>
        <td>'.number_format($dias_jueves,2,".", "").'</td>    
        <td>'.number_format($dias_viernes,2,".", "").'</td>   
        <td>'.number_format($dias_sabado,2,".", "").'</td>    
        <td>'.number_format($dias_domingo,2,".", "").'</td>     
        <td>'.number_format($total_cuadrilla,2,".", "").'</td>
        <td>'.number_format($conteo_hextra,2,".", "").'</td>
        </tr>';

            }
         }

    
echo '</tr>   
</table>';












function dias_pago($semana,$id_cfempleadofk,$id_cfhaciendafk,$id_cfsectorfk)
{
   
    include 'db3.php';
/**  REALIZAMOS CONSULTA DE LOS PAGOS POR LA SEMANA VERIFICANDO LOS DIAS**/ 
$sql_pago_empleado = "SELECT round(sum((valor_labor*cantidad)),2) as valor_pagar,fecha FROM cf_tareas WHERE semana = '".$semana."' AND `id_cfempleadofk` = '".$id_cfempleadofk."' AND `id_cfhaciendafk` = '".$id_cfhaciendafk."'AND `id_cfsectorfk` = '".$id_cfsectorfk."'  AND estado<>'I' GROUP BY fecha";


$result_pago_empleado = mysqli_query($db_link, $sql_pago_empleado);
 if (mysqli_num_rows($result_pago_empleado) > 0) { 


        $lunes     = '0.00';
        $martes    = '0.00';
        $miercoles = '0.00';
        $jueves    = '0.00';
        $viernes   = '0.00';
        $sabado    = '0.00';
        $domingo   = '0.00';

    while($row_pago_empleado = mysqli_fetch_assoc($result_pago_empleado)) {


        $salida     = date('l', strtotime($row_pago_empleado['fecha']));
        switch ($salida) {

            case "Monday":
                $lunes = ($row_pago_empleado['valor_pagar']);
                break;
    
    
            case "Tuesday":
                $martes= ($row_pago_empleado['valor_pagar']);
                break;
    
            case "Wednesday":
                $miercoles = ($row_pago_empleado['valor_pagar']);
                break;
    
            case "Thursday":
                $jueves = ($row_pago_empleado['valor_pagar']);
                break;
    
            case "Friday":
                $viernes = ($row_pago_empleado['valor_pagar']);
                break;
    
    
            case "Saturday":
                $sabado = ($row_pago_empleado['valor_pagar']);
                break;
    
            case "Sunday":
                $domingo = ($row_pago_empleado['valor_pagar']);
                break;
        }

        if($lunes == '0.00')
        {
            $dias['lunes']     = '0.00';
        }
        else
        {
            $dias['lunes']     = $lunes;
        }


        if($martes == '0.00')
        {
            $dias['martes']     = '0.00';
        }
        else
        {
            $dias['martes']     = $martes;
        }


        if($miercoles == '0.00')
        {
            $dias['miercoles']     = '0.00';
        }
        else
        {
            $dias['miercoles']     = $miercoles;
        }

        if($jueves == '0.00')
        {
            $dias['jueves']     = '0.00';
        }
        else
        {
            $dias['jueves']     = $jueves;
        }

        if($viernes == '0.00')
        {
            $dias['viernes']     = '0.00';
        }
        else
        {
            $dias['viernes']     = $viernes;
        }

        if($sabado == '0.00')
        {
            $dias['sabado']     = '0.00';
        }
        else
        {
            $dias['sabado']     = $sabado;
        }

        if($domingo == '0.00')
        {
            $dias['domingo']     = '0.00';
        }
        else
        {
            $dias['domingo']     = $domingo;
        }

    }
 }
 else
 {
    $dias['lunes']     = '0.00';
    $dias['martes']    = '0.00';
    $dias['miercoles'] = '0.00';
    $dias['jueves']    = '0.00';
    $dias['viernes']   = '0.00';
    $dias['sabado']    = '0.00';
    $dias['domingo']   = '0.00';
 }

 return $dias;
}



function dias_cuadrilla($id_cfhaciendafk,$semana,$id_cfempleadofk,$id_sector)
{
    include 'db3.php';
    /**  REALIZAMOS CONSULTA DE LOS PAGOS POR LA SEMANA VERIFICANDO LOS DIAS**/ 
    $sql_pago_empleado = "SELECT sum(valor_cajaemp) as valor_pagar,fecha FROM cf_empaque_empleados , cf_empaques WHERE id_cfhaciendafk='".$id_cfhaciendafk."' AND semana='".$semana."' AND id_empaque=id_cfempaquefk AND `id_cfempleadofk` = '".$id_cfempleadofk."' AND id_cfsectorfk='".$id_sector."' AND estado_cfee<>'I'   GROUP BY id_cfempleadofk,fecha";
   
  
   
    $result_pago_empleado = mysqli_query($db_link, $sql_pago_empleado);
    if (mysqli_num_rows($result_pago_empleado) > 0) { 


        $lunes     = '0.00';
        $martes    = '0.00';
        $miercoles = '0.00';
        $jueves    = '0.00';
        $viernes   = '0.00';
        $sabado    = '0.00';
        $domingo   = '0.00';

    while($row_pago_empleado = mysqli_fetch_assoc($result_pago_empleado)) {

        $fecha = explode(' ',$row_pago_empleado['fecha']);
        $salida     = date('l', strtotime($fecha[0]));
        switch ($salida) {

            case "Monday":
                $lunes = ($row_pago_empleado['valor_pagar'] +  $lunes);
                break;
    
    
            case "Tuesday":
                $martes= ($row_pago_empleado['valor_pagar'] +  $martes);
                break;
    
            case "Wednesday":
                $miercoles = ($row_pago_empleado['valor_pagar'] +  $miercoles);
                break;
    
            case "Thursday":
                $jueves = ($row_pago_empleado['valor_pagar'] +  $jueves);
                break;
    
            case "Friday":
                $viernes = ($row_pago_empleado['valor_pagar'] +  $viernes);
                break;
    
    
            case "Saturday":
                $sabado = ($row_pago_empleado['valor_pagar'] +  $sabado);
                break;
    
            case "Sunday":
                $domingo = ($row_pago_empleado['valor_pagar'] +  $domingo);
                break;
        }

        

    }

    if($lunes == '0.00')
        {
            $dias['lunes']     = '0.00';
        }
        else
        {
            $dias['lunes']     = $lunes;
        }


        if($martes == '0.00')
        {
            $dias['martes']     = '0.00';
        }
        else
        {
            $dias['martes']     = $martes;
        }


        if($miercoles == '0.00')
        {
            $dias['miercoles']     = '0.00';
        }
        else
        {
            $dias['miercoles']     = $miercoles;
        }

        if($jueves == '0.00')
        {
            $dias['jueves']     = '0.00';
        }
        else
        {
            $dias['jueves']     = $jueves;
        }

        if($viernes == '0.00')
        {
            $dias['viernes']     = '0.00';
        }
        else
        {
            $dias['viernes']     = $viernes;
        }

        if($sabado == '0.00')
        {
            $dias['sabado']     = '0.00';
        }
        else
        {
            $dias['sabado']     = $sabado;
        }

        if($domingo == '0.00')
        {
            $dias['domingo']     = '0.00';
        }
        else
        {
            $dias['domingo']     = $domingo;
        }
 }
 else
 {
    $dias['lunes']     = '0.00';
    $dias['martes']    = '0.00';
    $dias['miercoles'] = '0.00';
    $dias['jueves']    = '0.00';
    $dias['viernes']   = '0.00';
    $dias['sabado']    = '0.00';
    $dias['domingo']   = '0.00';
 }


 return $dias;
}
 ?>


    