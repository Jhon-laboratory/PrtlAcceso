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
            [citas].[PRTAL_Transportistas].Nombre, 
            [citas].[PRTAL_Transportistas].Cedula,
            [citas].[PRTAL_Transportistas].Razon_Social, 
            
            -- 1. OBTENER periodo MÁS RECIENTE de iess_detalle
            -- Quitamos el primer carácter '0' de la cédula de PRTAL_Transportistas
            (SELECT TOP 1 
                periodo
             FROM [citas].[iess_detalle] AS id2 
             WHERE id2.cedula = RIGHT([citas].[PRTAL_Transportistas].Cedula, LEN([citas].[PRTAL_Transportistas].Cedula) - 1)
             ORDER BY periodo DESC) AS periodo_raw,
            
            -- 2. VALIDAR PERIODO y CALCULAR ESTADO
            CASE 
                -- Verificar si es NULL o vacío
                WHEN (SELECT TOP 1 periodo 
                      FROM [citas].[iess_detalle] AS id2 
                      WHERE id2.cedula = RIGHT([citas].[PRTAL_Transportistas].Cedula, LEN([citas].[PRTAL_Transportistas].Cedula) - 1)
                      ORDER BY periodo DESC) IS NULL 
                     THEN 'INVALIDO'
                
                -- Verificar si tiene formato dd/mm/yyyy
                WHEN (SELECT TOP 1 periodo 
                      FROM [citas].[iess_detalle] AS id2 
                      WHERE id2.cedula = RIGHT([citas].[PRTAL_Transportistas].Cedula, LEN([citas].[PRTAL_Transportistas].Cedula) - 1)
                      ORDER BY periodo DESC) LIKE '__/__/____'
                THEN 
                    -- Es formato dd/mm/yyyy, calcular días
                    CASE 
                        WHEN DATEDIFF(day, 
                            CONVERT(DATE, 
                                (SELECT TOP 1 periodo 
                                 FROM [citas].[iess_detalle] AS id2 
                                 WHERE id2.cedula = RIGHT([citas].[PRTAL_Transportistas].Cedula, LEN([citas].[PRTAL_Transportistas].Cedula) - 1)
                                 ORDER BY periodo DESC), 
                                103), -- 103 = formato dd/mm/yyyy
                            GETDATE()) > 30 
                        THEN 'VENCIDO'
                        ELSE 'VIGENTE'
                    END
                
                -- Verificar si es una fecha en otro formato
                WHEN ISDATE((SELECT TOP 1 periodo 
                             FROM [citas].[iess_detalle] AS id2 
                             WHERE id2.cedula = RIGHT([citas].[PRTAL_Transportistas].Cedula, LEN([citas].[PRTAL_Transportistas].Cedula) - 1)
                             ORDER BY periodo DESC)) = 1
                THEN 
                    -- Es una fecha válida en otro formato
                    CASE 
                        WHEN DATEDIFF(day, 
                            CONVERT(DATE, 
                                (SELECT TOP 1 periodo 
                                 FROM [citas].[iess_detalle] AS id2 
                                 WHERE id2.cedula = RIGHT([citas].[PRTAL_Transportistas].Cedula, LEN([citas].[PRTAL_Transportistas].Cedula) - 1)
                                 ORDER BY periodo DESC)),
                            GETDATE()) > 30 
                        THEN 'VENCIDO'
                        ELSE 'VIGENTE'
                    END
                    
                ELSE 'INVALIDO'
            END AS estado_afectacion,
            
            -- Campos originales de tu consulta
            (SELECT TOP 1 [citas].[PRTAL_Transportistas].Estado  
             FROM [citas].[PRTAL_Transportistas] 
             WHERE cedula = [citas].[PRTAL_Transportistas].Cedula  
             ORDER BY Fecha_hora_sistema DESC) AS DocIess,
            
            (SELECT TOP 1 [citas].[FormularioSeguridad_Resultados].estado  
             FROM [citas].[FormularioSeguridad_Resultados] 
             WHERE [citas].[FormularioSeguridad_Resultados].Cedula = [citas].[PRTAL_Transportistas].Cedula  
             ORDER BY [FormularioSeguridad_Resultados].fechaIngreso DESC) AS Examen_seguridad,
            
            (SELECT TOP 1 
                CONVERT(VARCHAR(2), DATEPART(dd, Fecha_de_documentacion)) + '-' + 
                CONVERT(VARCHAR(2), DATEPART(mm, Fecha_de_documentacion)) + '-' + 
                CONVERT(VARCHAR(4), DATEPART(yyyy, Fecha_de_documentacion))
             FROM [citas].[PRTAL_Transportistas] 
             WHERE [citas].[PRTAL_Transportistas].Cedula = [citas].[PRTAL_Transportistas].Cedula 
             ORDER BY Fecha_hora_sistema DESC) AS Fecha_documentacion,
             
            (SELECT TOP 1 
                CONVERT(VARCHAR(2), DATEPART(dd, fechaIngreso)) + '-' + 
                CONVERT(VARCHAR(2), DATEPART(mm, fechaIngreso)) + '-' + 
                CONVERT(VARCHAR(4), DATEPART(yyyy, fechaIngreso))
             FROM [citas].FormularioSeguridad_Resultados 
             WHERE [citas].FormularioSeguridad_Resultados.Cedula = [citas].[PRTAL_Transportistas].Cedula 
             ORDER BY fechaIngreso DESC) AS fechaIngreso,
             
            Ciudad,
            
            (SELECT TOP 1 Comentario  
             FROM [citas].[RegistroPenal] 
             WHERE Cedula = [citas].[PRTAL_Transportistas].Cedula 
             ORDER BY fecha_registro DESC) AS Comentario,
             
            (SELECT TOP 1 
                CONVERT(VARCHAR(2), DATEPART(dd, fecha_registro)) + '-' + 
                CONVERT(VARCHAR(2), DATEPART(mm, fecha_registro)) + '-' + 
                CONVERT(VARCHAR(4), DATEPART(yyyy, fecha_registro))
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
            AND cd LIKE '%Guayaquil%'
        GROUP BY [citas].[PRTAL_Transportistas].Nombre, 
                 [citas].[PRTAL_Transportistas].Cedula,
                 [citas].[PRTAL_Transportistas].Razon_Social, 
                 Ciudad,
                 cd
        ORDER BY fechaIngreso DESC";
        
        $resultado = sqlsrv_query($conn, $sql);
        
        if ($resultado === false) {
            $errors = sqlsrv_errors();
            error_log("ERROR EN CONSULTA SQL:");
            foreach ($errors as $error) {
                error_log("  - Código: " . $error['code'] . " | Mensaje: " . $error['message']);
            }
            return array('totalfila' => 0);
        }
            
        $contador = 0;
        while ($fila = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC)) {
            $contador = $contador + 1;
            $data[] = $fila;
        }

        $data['totalfila'] = $contador;
        
        // DEBUG COMPLETO - MUESTRA TODOS LOS CAMPOS DEL PRIMER REGISTRO
        if (!empty($data) && isset($data[0])) {
            error_log("=== DEBUG COMPLETO MODELO PROVEEDORGYE ===");
            error_log("Total de registros obtenidos: " . $contador);
            error_log("Primer registro - Cedula: " . ($data[0]['Cedula'] ?? 'N/A'));
            error_log("Cedula sin primer dígito: " . substr(($data[0]['Cedula'] ?? ''), 1));
            
            // Verificar todos los campos disponibles
            error_log("=== CAMPOS DISPONIBLES EN EL PRIMER REGISTRO ===");
            foreach ($data[0] as $campo => $valor) {
                error_log("  - " . $campo . " = '" . ($valor ?? 'NULL') . "'");
            }
            
            // Información específica de periodo
            error_log("=== INFORMACIÓN PERIODO ===");
            error_log("periodo_raw: '" . ($data[0]['periodo_raw'] ?? 'NO EXISTE') . "'");
            error_log("¿Existe periodo_raw?: " . (isset($data[0]['periodo_raw']) ? 'SÍ' : 'NO'));
            error_log("estado_afectacion: '" . ($data[0]['estado_afectacion'] ?? 'NO EXISTE') . "'");
            
            // Verificar también si hay algún campo con nombre similar
            $camposSimilares = array();
            foreach ($data[0] as $campo => $valor) {
                if (stripos($campo, 'periodo') !== false || stripos($campo, 'fecha') !== false || stripos($campo, 'afectacion') !== false) {
                    $camposSimilares[] = $campo;
                }
            }
            
            if (!empty($camposSimilares)) {
                error_log("=== CAMPOS SIMILARES ENCONTRADOS ===");
                foreach ($camposSimilares as $campo) {
                    error_log("  - " . $campo . " = '" . ($data[0][$campo] ?? 'NULL') . "'");
                }
            }
            
            error_log("=== FIN DEBUG ===");
            
            // Debug adicional: mostrar valores para el primer registro
            if (isset($data[0]['Cedula'])) {
                $cedulaSinCero = substr($data[0]['Cedula'], 1);
                error_log("Para cédula " . $data[0]['Cedula'] . " (sin cero: " . $cedulaSinCero . ")");
                error_log("periodo_raw obtenido: '" . ($data[0]['periodo_raw'] ?? 'NULL') . "'");
                error_log("estado calculado: '" . ($data[0]['estado_afectacion'] ?? 'NULL') . "'");
            }
        } else {
            error_log("=== DEBUG MODELO ===");
            error_log("No se obtuvieron datos o el primer registro está vacío");
            error_log("=== FIN DEBUG ===");
        }
        
        return $data;
    }
}
?>