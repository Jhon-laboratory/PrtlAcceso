<?php
require '../Conexion/conexion_mysqli.php';
include('../control_session.php');
include('../Model/Model_gb_global.php');
include('../Model/Model_proveedorgye.php'); // Asegúrate que sea este archivo, no "proveedoruio.php"

if (isset($_GET["txt_option"]) || isset($_POST["txt_option"])) {
    if (isset($_GET["txt_option"])) {
        $opt = $_GET["txt_option"];
    } else {
        $opt = $_POST["txt_option"];
    }

    switch ($opt) {
        case "2":
            table_clientes();
            break;
        default:
            echo "{failure:true}";
            break;
    }
}

/*=============================================
TABLE CLIENTES
=============================================*/
function table_clientes()
{ 
    $Consult = new ModelCliente();
    $movements = $Consult->table_clientes();
    $file = array();
    
    $x = 0;
    
    for ($i = 0; $i < ($movements['totalfila']); $i++) { 
        $x++;
        $dato['id'] = $x;
        $dato['Nombre'] = $movements[$i]['Nombre'];
        
        // Cédula con botón SVG
        $dato['Cedula'] = $movements[$i]['Cedula'] . ' <button type="button" class="btn btn-secondary" onclick="ejecutarap(this.value)" value="'.$movements[$i]['Cedula'].'">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
<path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41m-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9"></path>
<path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5 5 0 0 0 8 3M3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9z"></path>
</svg></button>';
        
        // Razón Social con conversión UTF-8
        $dato['Razon_Social'] = iconv('ISO-8859-1', 'UTF-8', $movements[$i]['Razon_Social']);
        $dato['DocIess'] = $movements[$i]['DocIess'];
        
        // **CAMBIOS AQUÍ**: periodo_raw en lugar de fecha_afectacion_raw
        $dato['periodo_raw'] = isset($movements[$i]['periodo_raw']) ? $movements[$i]['periodo_raw'] : 'N/A';
        $dato['estado_afectacion'] = isset($movements[$i]['estado_afectacion']) ? $movements[$i]['estado_afectacion'] : 'INVALIDO';
        
        // Campos existentes
        $dato['Fecha_de_documentacion'] = isset($movements[$i]['Fecha_documentacion']) ? $movements[$i]['Fecha_documentacion'] : 'N/A';
        $dato['fechaIngreso'] = isset($movements[$i]['fechaIngreso']) ? $movements[$i]['fechaIngreso'] : 'N/A';
        $dato['fecha_registro'] = isset($movements[$i]['fecha_registro']) ? $movements[$i]['fecha_registro'] : 'N/A';
        $dato['numconsulta'] = isset($movements[$i]['numconsulta']) ? $movements[$i]['numconsulta'] : 0;
        $dato['fechaCap'] = "";
        
        // Antecedentes (con botones HTML)
        if(isset($movements[$i]['Antedentes']) && $movements[$i]['Antedentes'] != 'No'){
            $dato['Antedentes'] = '<button type="button" style="color:white;background-color:#F39200" class="pull-right btn btn-default" id="sendEmail">Sí</button>';
            $dato['Comentario'] = 'SÍ HAY PROCESOS PENALES ASOCIADOS';
        } else {
            $dato['Antedentes'] = '<button type="button" style="color:white;background-color:#009A3F" class="pull-right btn btn-default" id="sendEmail">No</button>';
            $dato['Comentario'] = 'NO HAY PROCESOS PENALES ASOCIADOS';
        }

        // Examen de seguridad (con botones HTML)
        if(isset($movements[$i]['Examen_seguridad']) && $movements[$i]['Examen_seguridad'] == 'Aprobado'){
            $dato['Examen_seguridad'] = '<button type="button" style="color:white;background-color:#009A3F" class="pull-right btn btn-default" id="sendEmail">Aprobado</button>';
        } else {
            $dato['Examen_seguridad'] = '<button type="button" style="color:white;background-color:#F39200" class="pull-right btn btn-default" id="sendEmail">No existe registro</button>';
        }
        
        $file[] = $dato;
    }
    
    $result = array('data' => $file);
    echo json_encode($result);
}
?>