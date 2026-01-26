<?php
class ModelCliente
{
/*=============================================
TABLE CLIENTES - QUITO CON FECHA AFECTACIÓN
=============================================*/
public function table_clientes()
{
    $conn = conexionSQL();
    $data = array();
    
    $sql = "SELECT 
        [citas].[PRTAL_Transportistas].Nombre, 
        [citas].[PRTAL_Transportistas].Cedula,
        [citas].[PRTAL_Transportistas].Razon_Social, 
        
        -- 1. OBTENER fecha_afectacion MÁS RECIENTE (NUEVO)
        (SELECT TOP 1 fecha_afectacion 
         FROM [citas].[PRTAL_Transportistas] AS pt2 
         WHERE pt2.Cedula = [citas].[PRTAL_Transportistas].Cedula 
         ORDER BY Fecha_hora_sistema DESC) AS fecha_afectacion_raw,
        
        -- 2. VALIDAR FECHA y CALCULAR ESTADO (NUEVO)
        CASE 
            -- Verificar si es NULL o vacío
            WHEN (SELECT TOP 1 fecha_afectacion 
                  FROM [citas].[PRTAL_Transportistas] AS pt2 
                  WHERE pt2.Cedula = [citas].[PRTAL_Transportistas].Cedula 
                  ORDER BY Fecha_hora_sistema DESC) IS NULL 
                 THEN 'INVALIDO'
            
            -- Verificar si tiene formato dd/mm/yyyy o d/mm/yyyy
            WHEN (SELECT TOP 1 fecha_afectacion 
                  FROM [citas].[PRTAL_Transportistas] AS pt2 
                  WHERE pt2.Cedula = [citas].[PRTAL_Transportistas].Cedula 
                  ORDER BY Fecha_hora_sistema DESC) LIKE '[0-9][0-9]/[0-9][0-9]/[0-9][0-9][0-9][0-9]'
                OR (SELECT TOP 1 fecha_afectacion 
                    FROM [citas].[PRTAL_Transportistas] AS pt2 
                    WHERE pt2.Cedula = [citas].[PRTAL_Transportistas].Cedula 
                    ORDER BY Fecha_hora_sistema DESC) LIKE '[0-9]/[0-9][0-9]/[0-9][0-9][0-9][0-9]'
                OR (SELECT TOP 1 fecha_afectacion 
                    FROM [citas].[PRTAL_Transportistas] AS pt2 
                    WHERE pt2.Cedula = [citas].[PRTAL_Transportistas].Cedula 
                    ORDER BY Fecha_hora_sistema DESC) LIKE '[0-9][0-9]/[0-9]/[0-9][0-9][0-9][0-9]'
                OR (SELECT TOP 1 fecha_afectacion 
                    FROM [citas].[PRTAL_Transportistas] AS pt2 
                    WHERE pt2.Cedula = [citas].[PRTAL_Transportistas].Cedula 
                    ORDER BY Fecha_hora_sistema DESC) LIKE '[0-9]/[0-9]/[0-9][0-9][0-9][0-9]'
            THEN 
                -- Calcular días si tiene formato válido
                CASE 
                    WHEN DATEDIFF(day, 
                        TRY_CONVERT(DATE, 
                            (SELECT TOP 1 fecha_afectacion 
                             FROM [citas].[PRTAL_Transportistas] AS pt2 
                             WHERE pt2.Cedula = [citas].[PRTAL_Transportistas].Cedula 
                             ORDER BY Fecha_hora_sistema DESC), 
                            103), -- 103 = formato dd/mm/yyyy
                        GETDATE()) > 30 
                    THEN 'VENCIDO'
                    ELSE 'VIGENTE'
                END
            ELSE 'INVALIDO'
        END AS estado_afectacion,
        
        -- Campos originales
        (SELECT TOP 1 [citas].[PRTAL_Transportistas].Estado  
         FROM [citas].[PRTAL_Transportistas] 
         WHERE cedula = [citas].[PRTAL_Transportistas].Cedula  
         ORDER BY Fecha_hora_sistema DESC) AS DocIess,
        
        (SELECT TOP 1 [citas].[FormularioSeguridad_Resultados].estado  
         FROM [citas].[FormularioSeguridad_Resultados] 
         WHERE [citas].[FormularioSeguridad_Resultados].Cedula = [citas].[PRTAL_Transportistas].Cedula  
         ORDER BY [FormularioSeguridad_Resultados].fechaIngreso DESC) AS Examen_seguridad,
        
        (SELECT TOP 1 DATEPART(dd, Fecha_de_documentacion) || '-' || DATEPART(mm, Fecha_de_documentacion)  || '-' ||  DATEPART(yyyy, Fecha_de_documentacion) 
         FROM [citas].[PRTAL_Transportistas] 
         WHERE [citas].[PRTAL_Transportistas].Cedula = [citas].[PRTAL_Transportistas].Cedula 
         ORDER BY Fecha_hora_sistema DESC) AS Fecha_documentacion,
         
        (SELECT TOP 1 DATEPART(dd, fechaIngreso) || '-' || DATEPART(mm, fechaIngreso)  || '-' ||  DATEPART(yyyy, fechaIngreso) 
         FROM [citas].FormularioSeguridad_Resultados 
         WHERE [citas].FormularioSeguridad_Resultados.Cedula = [citas].[PRTAL_Transportistas].Cedula 
         ORDER BY fechaIngreso DESC) AS fechaIngreso,
         
        Ciudad,
        
        (SELECT TOP 1 Comentario  
         FROM [citas].[RegistroPenal] 
         WHERE Cedula = [citas].[PRTAL_Transportistas].Cedula 
         ORDER BY fecha_registro DESC) AS Comentario,
         
        (SELECT TOP 1 DATEPART(dd, fecha_registro) || '-' || DATEPART(mm, fecha_registro)  || '-' ||  DATEPART(yyyy, fecha_registro)  
         FROM [citas].[RegistroPenal] 
         WHERE Cedula = [citas].[PRTAL_Transportistas].Cedula  
         ORDER BY fecha_registro DESC) AS fecha_registro,
         
        (SELECT TOP 1 Antedentes 
         FROM [citas].[RegistroPenal] 
         WHERE Cedula = [citas].[PRTAL_Transportistas].Cedula 
         ORDER BY fecha_registro DESC) AS Antedentes,
         
        (SELECT COUNT(*) as numconsulta 
         FROM [citas].[RegistroPenal] 
         WHERE Cedula = [citas].[PRTAL_Transportistas].Cedula) AS numconsulta
    
    FROM [citas].[PRTAL_Transportistas]  
    INNER JOIN [citas].[FormularioSeguridad_Resultados] ON
        [citas].[FormularioSeguridad_Resultados].Cedula = [citas].[PRTAL_Transportistas].Cedula
    WHERE [citas].[PRTAL_Transportistas].Estado != 'Inactivo' 
        AND cd LIKE '%Quito%'
    GROUP BY [citas].[PRTAL_Transportistas].Nombre, 
             [citas].[PRTAL_Transportistas].Cedula,
             [citas].[PRTAL_Transportistas].Razon_Social, 
             Ciudad
    ORDER BY fechaIngreso DESC";
    
    $resultado = sqlsrv_query($conn, $sql);
        
    $contador = 0;
    while ($fila = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC)) {
        $contador = $contador + 1;
        $data[] = $fila;
    }

    $data['totalfila'] = $contador;
    return $data;
}
}
?>