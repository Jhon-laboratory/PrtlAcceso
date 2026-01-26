<?php
class ModelCliente
{
/*=============================================
TABLE CLIENTES
=============================================*/
public function table_clientes()
{
    $conn = conexionSQL();
    $data = array();
    
    $sql = "SELECT 
        [citas].[FormularioSeguridad_Resultados].[cedula],
        [dbo].[CapitalizeFirstLetter]((nombre)) as nombre,
        DATEPART(dd, fecha) || '-' || DATEPART(mm, fecha)  || '-' ||  DATEPART(yyyy, fecha) AS fecha,
        DATEPART(dd, fechaIngreso) || '-' || DATEPART(mm, fechaIngreso)  || '-' ||  DATEPART(yyyy, fechaIngreso) AS fechaIngreso,
        [estado], 
        cd,
        
        -- 1. OBTENER fecha_afectacion MÁS RECIENTE (desde PRTAL_Transportistas)
        (SELECT TOP 1 fecha_afectacion 
         FROM [citas].[PRTAL_Transportistas] AS pt 
         WHERE pt.Cedula = [citas].[FormularioSeguridad_Resultados].cedula 
         ORDER BY Fecha_hora_sistema DESC) AS fecha_afectacion_raw,
        
        -- 2. VALIDAR FECHA y CALCULAR ESTADO
        CASE 
            -- Verificar si es NULL o vacío
            WHEN (SELECT TOP 1 fecha_afectacion 
                  FROM [citas].[PRTAL_Transportistas] AS pt 
                  WHERE pt.Cedula = [citas].[FormularioSeguridad_Resultados].cedula 
                  ORDER BY Fecha_hora_sistema DESC) IS NULL 
                 THEN 'INVALIDO'
            
            -- Verificar si tiene formato dd/mm/yyyy o d/mm/yyyy
            WHEN (SELECT TOP 1 fecha_afectacion 
                  FROM [citas].[PRTAL_Transportistas] AS pt 
                  WHERE pt.Cedula = [citas].[FormularioSeguridad_Resultados].cedula 
                  ORDER BY Fecha_hora_sistema DESC) LIKE '[0-9][0-9]/[0-9][0-9]/[0-9][0-9][0-9][0-9]'
                OR (SELECT TOP 1 fecha_afectacion 
                    FROM [citas].[PRTAL_Transportistas] AS pt 
                    WHERE pt.Cedula = [citas].[FormularioSeguridad_Resultados].cedula 
                    ORDER BY Fecha_hora_sistema DESC) LIKE '[0-9]/[0-9][0-9]/[0-9][0-9][0-9][0-9]'
                OR (SELECT TOP 1 fecha_afectacion 
                    FROM [citas].[PRTAL_Transportistas] AS pt 
                    WHERE pt.Cedula = [citas].[FormularioSeguridad_Resultados].cedula 
                    ORDER BY Fecha_hora_sistema DESC) LIKE '[0-9][0-9]/[0-9]/[0-9][0-9][0-9][0-9]'
                OR (SELECT TOP 1 fecha_afectacion 
                    FROM [citas].[PRTAL_Transportistas] AS pt 
                    WHERE pt.Cedula = [citas].[FormularioSeguridad_Resultados].cedula 
                    ORDER BY Fecha_hora_sistema DESC) LIKE '[0-9]/[0-9]/[0-9][0-9][0-9][0-9]'
            THEN 
                -- Calcular días si tiene formato válido
                CASE 
                    WHEN DATEDIFF(day, 
                        TRY_CONVERT(DATE, 
                            (SELECT TOP 1 fecha_afectacion 
                             FROM [citas].[PRTAL_Transportistas] AS pt 
                             WHERE pt.Cedula = [citas].[FormularioSeguridad_Resultados].cedula 
                             ORDER BY Fecha_hora_sistema DESC), 
                            103), -- 103 = formato dd/mm/yyyy
                        GETDATE()) > 30 
                    THEN 'VENCIDO'
                    ELSE 'VIGENTE'
                END
            ELSE 'INVALIDO'
        END AS estado_afectacion,
        
        -- Campos originales
        (SELECT TOP 1 Comentario 
         FROM [citas].[RegistroPenal] 
         WHERE Cedula = [citas].[FormularioSeguridad_Resultados].cedula 
         ORDER BY fecha_registro DESC) AS Comentario,
         
        (SELECT TOP 1 DATEPART(dd, fecha_registro) || '-' || DATEPART(mm, fecha_registro)  || '-' ||  DATEPART(yyyy, fecha_registro) 
         FROM [citas].[RegistroPenal] 
         WHERE Cedula = [citas].[FormularioSeguridad_Resultados].cedula  
         ORDER BY fecha_registro DESC) AS fecha_registro,
         
        (SELECT TOP 1 Antedentes 
         FROM [citas].[RegistroPenal] 
         WHERE Cedula = [citas].[FormularioSeguridad_Resultados].cedula 
         ORDER BY fecha_registro DESC) AS Antedentes,
         
        (SELECT COUNT(*) as numconsulta 
         FROM [citas].[RegistroPenal] 
         WHERE Cedula = [citas].[FormularioSeguridad_Resultados].cedula) AS numconsulta

    FROM [citas].[FormularioSeguridad_Resultados] 
    WHERE (cd LIKE '%Manta%' OR cd LIKE '%Milagro%' OR cd LIKE '%Machala%' OR cd LIKE '%Babahoyo%') 
    GROUP BY [citas].[FormularioSeguridad_Resultados].[cedula], 
             nombre, 
             fecha, 
             fechaIngreso,
             [estado], 
             cd
    ORDER BY [fecha] DESC";

    $resultado = sqlsrv_query($conn, $sql);
        
    $contador = 0;
    while ($fila = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC)) {
        $data[] = $fila;
        $contador = $contador + 1;
    }

    $data['totalfila'] = $contador;
    return $data;
}
}
?>