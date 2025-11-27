<?php
class ModelCliente
{
/*=============================================
TABLE CLIENTES
=============================================*/
public function table_clientes()
{
    $conn      = conexionSQL();
    $data        = array();
    $sql         = "SELECT [citas].[PRTAL_Transportistas].Nombre, [citas].[PRTAL_Transportistas].Cedula,
    [citas].[PRTAL_Transportistas].Razon_Social, 
	(SELECT top 1 [citas].[PRTAL_Transportistas].Estado  FROM  [citas].[PRTAL_Transportistas] WHERE cedula   =[citas].[PRTAL_Transportistas].Cedula  order by Fecha_hora_sistema desc ) as DocIess,
	(SELECT top 1 [citas].[FormularioSeguridad_Resultados].estado  FROM  [citas].[FormularioSeguridad_Resultados] WHERE [citas].[FormularioSeguridad_Resultados].Cedula   =[citas].[PRTAL_Transportistas].Cedula  order by [FormularioSeguridad_Resultados].fechaIngreso desc ) as Examen_seguridad,
    
	(  select top 1  DATEPART(dd, Fecha_de_documentacion) || '-' || DATEPART(mm, Fecha_de_documentacion)  || '-' ||  DATEPART(yyyy, Fecha_de_documentacion) from [citas].[PRTAL_Transportistas] where [citas].[PRTAL_Transportistas].Cedula=[citas].[PRTAL_Transportistas].Cedula order by Fecha_hora_sistema desc)  AS Fecha_documentacion,
		(  select top 1  DATEPART(dd, fechaIngreso) || '-' || DATEPART(mm, fechaIngreso)  || '-' ||  DATEPART(yyyy, fechaIngreso) from [citas].FormularioSeguridad_Resultados where [citas].FormularioSeguridad_Resultados.Cedula=[citas].[PRTAL_Transportistas].Cedula order by fechaIngreso desc)  AS fechaIngreso,
 Ciudad
    , (SELECT top 1 Comentario  FROM  [citas].[RegistroPenal] WHERE Cedula   =[citas].[PRTAL_Transportistas].Cedula order by fecha_registro desc ) as Comentario
    ,(SELECT top 1 DATEPART(dd, fecha_registro) || '-' || DATEPART(mm, fecha_registro)  || '-' ||  DATEPART(yyyy, fecha_registro)  AS fecha_registro FROM  [citas].[RegistroPenal] WHERE Cedula   =[citas].[PRTAL_Transportistas].Cedula  order by fecha_registro desc) as fecha_registro
    ,(SELECT top 1 Antedentes FROM  [citas].[RegistroPenal] WHERE Cedula   =[citas].[PRTAL_Transportistas].Cedula order by fecha_registro desc) as Antedentes
,(SELECT count(*) as numconsulta FROM  [citas].[RegistroPenal] WHERE Cedula   =[citas].[PRTAL_Transportistas].Cedula) as numconsulta
     FROM [citas].[PRTAL_Transportistas]  
   inner join  [citas].[FormularioSeguridad_Resultados] on
    [citas].[FormularioSeguridad_Resultados].Cedula = citas.PRTAL_Transportistas.Cedula
    where citas.PRTAL_Transportistas.Estado!='Inactivo' and cd like '%Guayaquil%'
    group by [citas].[PRTAL_Transportistas].Nombre, [citas].[PRTAL_Transportistas].Cedula,
    [citas].[PRTAL_Transportistas].Razon_Social, ciudad
    order by  fechaIngreso desc
";
    //$resultado   = $mysqli->query($sql);

    $resultado   = sqlsrv_query($conn, $sql);// $mysqli->query($sql);
        
$contador=0;
    while ($fila = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC)) {
        $contador=$contador+1;
      //  $fila['Comentario']                = $this->penal($fila['Cedula']);
       /* $fila['fecha_registro']                = $this->penal2($fila['Cedula']);
        $fila['Antedentes']                = $this->penal3($fila['Cedula']);
        $fila['numconsulta']                = $this->penal4($fila['Cedula']);
       */ $data[]   = $fila;
        
    }

    $data['totalfila']=$contador;
    //$mysqli->close();
    return $data;
}

/*
private function penal($txt_id)
{
    $mysqli = conexionSQL();
    $sql = "SELECT top 1 CASE Comentario when  'Robo' then 'SI HAY PROCESOS PENALES ASOCIADOS' else 'NO HAY PROCESOS PENALES ASOCIADOS' end as Comentario FROM  [citas].[RegistroPenal] WHERE Cedula   ='$txt_id' order by fecha_registro desc ";
    $resultado   = sqlsrv_query($mysqli, $sql);// $mysqli->query($sql);
    while ($fila = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC)) {
        return $fila['Comentario'];   
    }
}
*/

/*
private function penal2($txt_id)
{
    $mysqli = conexionSQL();
    $sql = "SELECT top 1 DATEPART(dd, fecha_registro) || '-' || DATEPART(mm, fecha_registro)  || '-' ||  DATEPART(yyyy, fecha_registro)  AS fecha_registro FROM  [citas].[RegistroPenal] WHERE Cedula   ='$txt_id' order by fecha_registro desc";
    $resultado   = sqlsrv_query($mysqli, $sql);// $mysqli->query($sql);
    while ($fila = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC)) {
        return $fila['fecha_registro'];   
    }
}

private function penal3($txt_id)
{
    $mysqli = conexionSQL();
    $sql = "SELECT top 1 Antedentes FROM  [citas].[RegistroPenal] WHERE Cedula   ='$txt_id' order by fecha_registro desc";
    $resultado   = sqlsrv_query($mysqli, $sql);// $mysqli->query($sql);
    while ($fila = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC)) {
        return $fila['Antedentes'];   
    }
}

private function penal4($txt_id)
{
    $mysqli = conexionSQL();
    $sql = "SELECT count(*) as numconsulta FROM  [citas].[RegistroPenal] WHERE Cedula   ='$txt_id' ";
    $resultado   = sqlsrv_query($mysqli, $sql);// $mysqli->query($sql);
    while ($fila = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC)) {
        return $fila['numconsulta'];   
    }
}
*/


}
?>