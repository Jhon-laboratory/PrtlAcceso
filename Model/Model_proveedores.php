<?php
class ModelProveedor
{
    /*=============================================
    TABLA PROVEEDORES - IESS PAGO
    =============================================*/
    public function table_proveedores()
    {
        $conn = conexionSQL();
        $data = array();
        
        $sql = "SELECT 
            -- Información básica
            ruc,
            razon_social,
            concepto,
            
            -- Fechas y periodos
            vigencia,
            periodo_pago,
            fecha_registro,
            
            -- Calcular estado de vigencia
            CASE 
                WHEN vigencia IS NULL OR vigencia = '' THEN 'SIN VIGENCIA'
                WHEN ISDATE(vigencia) = 1 THEN
                    CASE 
                        WHEN DATEDIFF(day, CONVERT(DATE, vigencia), GETDATE()) > 30 
                        THEN 'VENCIDO'
                        ELSE 'VIGENTE'
                    END
                ELSE 'FORMATO INVÁLIDO'
            END AS estado_vigencia,
            
            -- Calcular días restantes/expirados
            CASE 
                WHEN ISDATE(vigencia) = 1 THEN
                    DATEDIFF(day, GETDATE(), CONVERT(DATE, vigencia))
                ELSE NULL
            END AS dias_diferencia,
            
            -- Estado del pago basado en periodo_pago
            CASE 
                WHEN periodo_pago IS NULL OR periodo_pago = '' THEN 'SIN PAGO'
                WHEN ISDATE(periodo_pago) = 1 THEN
                    CASE 
                        WHEN DATEDIFF(month, CONVERT(DATE, periodo_pago), GETDATE()) > 3 
                        THEN 'PAGO ATRASADO'
                        ELSE 'PAGO AL DÍA'
                    END
                ELSE 'FORMATO INVÁLIDO'
            END AS estado_pago,
            
            -- Mes del pago
            CASE 
                WHEN ISDATE(periodo_pago) = 1 THEN
                    DATENAME(MONTH, CONVERT(DATE, periodo_pago)) + ' ' + 
                    DATENAME(YEAR, CONVERT(DATE, periodo_pago))
                ELSE 'NO ESPECIFICADO'
            END AS mes_pago,
            
            -- Año de registro
            YEAR(fecha_registro) AS año_registro,
            
            -- Formatear fechas para mostrar
            CONVERT(VARCHAR(10), fecha_registro, 103) AS fecha_registro_formatted,
            
            -- Contador de registros por RUC (para tarjetas)
            COUNT(*) OVER(PARTITION BY ruc) AS total_registros_ruc
            
        FROM [citas].[iess_pago]
        WHERE ruc IS NOT NULL 
          AND ruc != ''
        ORDER BY fecha_registro DESC, razon_social";
        
        $resultado = sqlsrv_query($conn, $sql);
        
        if ($resultado === false) {
            $errors = sqlsrv_errors();
            error_log("ERROR EN CONSULTA PROVEEDORES:");
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
        
        // Debug opcional
        if (!empty($data) && isset($data[0])) {
            error_log("=== DEBUG PROVEEDORES ===");
            error_log("Total de registros: " . $contador);
            error_log("Primer RUC: " . ($data[0]['ruc'] ?? 'N/A'));
            error_log("=== FIN DEBUG ===");
        }
        
        return $data;
    }
}
?>