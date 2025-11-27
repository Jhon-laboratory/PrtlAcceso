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
    $sql         = "select [citas].[FormularioSeguridad_Resultados].[cedula], nombre as nombre,
    cd
        , (SELECT top 1 DATEPART(dd, fecha) || '-' || DATEPART(mm, fecha)  || '-' ||  DATEPART(yyyy, fecha) from [citas].[FormularioSeguridad_Resultados] where [citas].[FormularioSeguridad_Resultados].cedula= cedula order by [citas].[FormularioSeguridad_Resultados].fecha desc ) as fecha
        , (SELECT top 1 DATEPART(dd, fechaIngreso) || '-' || DATEPART(mm, fechaIngreso)  || '-' ||  DATEPART(yyyy, fechaIngreso) from [citas].[FormularioSeguridad_Resultados] where [citas].[FormularioSeguridad_Resultados].cedula= cedula order by [citas].[FormularioSeguridad_Resultados].fechaIngreso desc ) as fechaIngreso
       , (SELECT top 1  estado FROM  [citas].[FormularioSeguridad_Resultados] WHERE cedula   =[citas].[FormularioSeguridad_Resultados].cedula and estado <>'Negado'  order by citas.[FormularioSeguridad_Resultados].fechaIngreso desc ) as estado
   , (SELECT top 1  Comentario FROM  [citas].[RegistroPenal] WHERE Cedula   =[citas].[FormularioSeguridad_Resultados].cedula order by fecha_registro desc ) as Comentario
   ,(SELECT top 1 DATEPART(dd, fecha_registro) || '-' || DATEPART(mm, fecha_registro)  || '-' ||  DATEPART(yyyy, fecha_registro)  AS fecha_registro FROM  [citas].[RegistroPenal] WHERE Cedula   =[citas].[FormularioSeguridad_Resultados].cedula  order by fecha_registro desc) as fecha_registro
   ,(SELECT top 1 Antedentes FROM  [citas].[RegistroPenal] WHERE Cedula   =[citas].[FormularioSeguridad_Resultados].cedula order by fecha_registro desc) as Antedentes
,(SELECT count(*) as numconsulta FROM  [citas].[RegistroPenal] WHERE Cedula   =[citas].[FormularioSeguridad_Resultados].cedula) as numconsulta
  
FROM [citas].[FormularioSeguridad_Resultados] 
where cd like '%Quito%' 
group by  [citas].[FormularioSeguridad_Resultados].[cedula], nombre, 
cd
";
    //$resultado   = $mysqli->query($sql);

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