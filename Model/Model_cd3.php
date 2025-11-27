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

    /*
    $sql         = "select [citas].[FormularioSeguridad_Resultados].[cedula],[dbo].[CapitalizeFirstLetter] ((nombre)) as nombre,
    DATEPART(dd, fecha) || '-' || DATEPART(mm, fecha)  || '-' ||  DATEPART(yyyy, fecha)  AS fecha,
    DATEPART(dd, fechaIngreso) || '-' || DATEPART(mm, fechaIngreso)  || '-' ||  DATEPART(yyyy, fechaIngreso)  AS fechaIngreso,
    [estado],[Antedentes],
    CASE comentario when  'Robo' then 'SI HAY PROCESOS PENALES ASOCIADOS' else 'NO HAY PROCESOS PENALES ASOCIADOS' end as Comentario , cd
    FROM [citas].[FormularioSeguridad_Resultados] 
    INNER JOIN [citas].[RegistroPenal] ON [citas].[FormularioSeguridad_Resultados].[Cedula] = [citas].[RegistroPenal].[Cedula] 
    where (cd like '%Manta%' or cd like '%Milagro%'  or  cd like '%Machala%' or cd like '%Babahoyo%'   ) ORDER BY [fecha] DESC  ";
    //$resultado   = $mysqli->query($sql);
*/
$sql         = "select [citas].[FormularioSeguridad_Resultados].[cedula],[dbo].[CapitalizeFirstLetter] ((nombre)) as nombre,
DATEPART(dd, fecha) || '-' || DATEPART(mm, fecha)  || '-' ||  DATEPART(yyyy, fecha)  AS fecha,
DATEPART(dd, fechaIngreso) || '-' || DATEPART(mm, fechaIngreso)  || '-' ||  DATEPART(yyyy, fechaIngreso)  AS fechaIngreso,
[estado], cd
, (SELECT top 1 Comentario FROM  [citas].[RegistroPenal] WHERE Cedula   =[citas].[FormularioSeguridad_Resultados].cedula order by fecha_registro desc ) as Comentario
,(SELECT top 1 DATEPART(dd, fecha_registro) || '-' || DATEPART(mm, fecha_registro)  || '-' ||  DATEPART(yyyy, fecha_registro)  AS fecha_registro FROM  [citas].[RegistroPenal] WHERE Cedula   =[citas].[FormularioSeguridad_Resultados].cedula  order by fecha_registro desc) as fecha_registro
,(SELECT top 1 Antedentes FROM  [citas].[RegistroPenal] WHERE Cedula   =[citas].[FormularioSeguridad_Resultados].cedula order by fecha_registro desc) as Antedentes
,(SELECT count(*) as numconsulta FROM  [citas].[RegistroPenal] WHERE Cedula   =[citas].[FormularioSeguridad_Resultados].cedula) as numconsulta

FROM [citas].[FormularioSeguridad_Resultados] 
where  (cd like '%Manta%' or cd like '%Milagro%'  or  cd like '%Machala%' or cd like '%Babahoyo%'   ) 

group by  [citas].[FormularioSeguridad_Resultados].[cedula], nombre, fecha, fechaIngreso,
[estado], cd
ORDER BY [fecha] DESC  ";


    $resultado   = sqlsrv_query($conn, $sql);// $mysqli->query($sql);
        
$contador=0;
    while ($fila = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC)) {
        $data[]   = $fila;
        $contador=$contador+1;
    }

    $data['totalfila']=$contador;
    //$mysqli->close();
    return $data;
}




}
?>