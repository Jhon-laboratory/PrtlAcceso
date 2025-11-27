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
    $sql         = "
		select [citas].[FormularioSeguridad_Resultados].[cedula],[dbo].[CapitalizeFirstLetter] ((nombre)) as nombre,
    DATEPART(dd, fecha) || '-' || DATEPART(mm, fecha)  || '-' ||  DATEPART(yyyy, fecha)  AS fecha,
    DATEPART(dd, fechaIngreso) || '-' || DATEPART(mm, fechaIngreso)  || '-' ||  DATEPART(yyyy, fechaIngreso)  AS fechaIngreso,
    [estado]
	   , (SELECT top 1  Comentario FROM  [citas].[RegistroPenal] WHERE Cedula   =[citas].[FormularioSeguridad_Resultados].cedula order by fecha_registro desc ) as Comentario
   , (SELECT top 1  [Antedentes] FROM  [citas].[RegistroPenal] WHERE Cedula   =[citas].[FormularioSeguridad_Resultados].cedula order by fecha_registro desc ) as Antedentes
, cd
  ,
  (SELECT top 1  DATEPART(dd, fecha_registro) || '-' || DATEPART(mm, fecha_registro)  || '-' ||  DATEPART(yyyy, fecha_registro) FROM  [citas].[RegistroPenal] WHERE Cedula   =[citas].[FormularioSeguridad_Resultados].cedula order by fecha_registro desc )
    AS fecha_registro

    ,(SELECT count(*) as numconsulta FROM  [citas].[RegistroPenal] WHERE Cedula   =[citas].[FormularioSeguridad_Resultados].cedula) as numconsulta
    FROM [citas].[FormularioSeguridad_Resultados] 
    where  (cd='Manta' or cd='Milagro'  or  cd='Machala' or cd='Babahoyo' )  ORDER BY [fecha] DESC   ";
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