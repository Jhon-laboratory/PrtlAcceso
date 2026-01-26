<?php
require '../Conexion/conexion_mysqli.php';
include('../control_session.php');
include('../Model/Model_gb_global.php');
include('../Model/Model_proveedores.php'); // El nuevo modelo

if (isset($_GET["txt_option"]) || isset($_POST["txt_option"])) {
    if (isset($_GET["txt_option"])) {
        $opt = $_GET["txt_option"];
    } else {
        $opt = $_POST["txt_option"];
    }

    switch ($opt) {
        case "1":
            table_proveedores();
            break;
        default:
            echo json_encode(array('failure' => true, 'message' => 'Opción inválida'));
            break;
    }
}

/*=============================================
TABLE PROVEEDORES
=============================================*/
function table_proveedores()
{ 
    $Consult = new ModelProveedor();
    $movements = $Consult->table_proveedores();
    $file = array();
    
    $x = 0;
    
    for ($i = 0; $i < ($movements['totalfila']); $i++) { 
        $x++;
        
        $dato['id'] = $x;
        $dato['ruc'] = $movements[$i]['ruc'];
        $dato['razon_social'] = iconv('ISO-8859-1', 'UTF-8', $movements[$i]['razon_social']);
        $dato['concepto'] = $movements[$i]['concepto'];
        
        // Vigencia con estado
        $vigencia = isset($movements[$i]['vigencia']) ? $movements[$i]['vigencia'] : 'N/A';
        $estadoVigencia = isset($movements[$i]['estado_vigencia']) ? $movements[$i]['estado_vigencia'] : 'SIN VIGENCIA';
        
        $dato['vigencia'] = $vigencia;
        $dato['estado_vigencia'] = $estadoVigencia;
        $dato['dias_diferencia'] = isset($movements[$i]['dias_diferencia']) ? $movements[$i]['dias_diferencia'] : 0;
        
        // Periodo de pago
        $periodoPago = isset($movements[$i]['periodo_pago']) ? $movements[$i]['periodo_pago'] : 'N/A';
        $estadoPago = isset($movements[$i]['estado_pago']) ? $movements[$i]['estado_pago'] : 'SIN PAGO';
        $mesPago = isset($movements[$i]['mes_pago']) ? $movements[$i]['mes_pago'] : 'NO ESPECIFICADO';
        
        $dato['periodo_pago'] = $periodoPago;
        $dato['estado_pago'] = $estadoPago;
        $dato['mes_pago'] = $mesPago;
        
        // Fechas formateadas
        $dato['fecha_registro'] = isset($movements[$i]['fecha_registro_formatted']) ? 
                                  $movements[$i]['fecha_registro_formatted'] : 'N/A';
        $dato['año_registro'] = isset($movements[$i]['año_registro']) ? 
                                $movements[$i]['año_registro'] : date('Y');
        
        // Total de registros
        $dato['total_registros'] = isset($movements[$i]['total_registros_ruc']) ? 
                                   $movements[$i]['total_registros_ruc'] : 1;
        
        // Determinar color según estado
        $colorVigencia = 'btn-success'; // Verde por defecto
        if ($estadoVigencia === 'VENCIDO') {
            $colorVigencia = 'btn-danger';
        } elseif ($estadoVigencia === 'SIN VIGENCIA' || $estadoVigencia === 'FORMATO INVÁLIDO') {
            $colorVigencia = 'btn-warning';
        }
        
        $colorPago = 'btn-success';
        if ($estadoPago === 'PAGO ATRASADO') {
            $colorPago = 'btn-danger';
        } elseif ($estadoPago === 'SIN PAGO' || $estadoPago === 'FORMATO INVÁLIDO') {
            $colorPago = 'btn-warning';
        }
        
        // Botones HTML para estados
        $dato['boton_vigencia'] = '<button type="button" class="btn btn-xs ' . $colorVigencia . '" style="color:white;">' . 
                                 $estadoVigencia . '</button>';
        
        $dato['boton_pago'] = '<button type="button" class="btn btn-xs ' . $colorPago . '" style="color:white;">' . 
                             $estadoPago . '</button>';
        
        // Estado general del proveedor
        if ($estadoVigencia === 'VIGENTE' && $estadoPago === 'PAGO AL DÍA') {
            $dato['estado_general'] = 'ACTIVO';
            $dato['color_general'] = '#28a745'; // Verde
        } elseif ($estadoVigencia === 'VENCIDO' || $estadoPago === 'PAGO ATRASADO') {
            $dato['estado_general'] = 'INACTIVO';
            $dato['color_general'] = '#dc3545'; // Rojo
        } else {
            $dato['estado_general'] = 'PENDIENTE';
            $dato['color_general'] = '#ffc107'; // Amarillo
        }
        
        $file[] = $dato;
    }
    
    $result = array('data' => $file);
    echo json_encode($result);
}
?>