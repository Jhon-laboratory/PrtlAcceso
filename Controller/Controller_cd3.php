<?php
require '../Conexion/conexion_mysqli.php';
include('../control_session.php');
include('../Model/Model_gb_global.php');
include('../Model/Model_cd3.php');

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
        
        // --- CAMPOS COMPATIBLES CON FRONTEND GUAYAQUIL ---
        
        // 1. NOMBRE (asegurar clave 'Nombre' con mayúscula)
        $dato['Nombre'] = $movements[$i]['nombre'];
        
        // 2. CÉDULA (asegurar clave 'Cedula' con mayúscula y botón SVG)
        $dato['Cedula'] = $movements[$i]['cedula'] . ' <button type="button" class="btn btn-secondary" onclick="ejecutarap(this.value)" value="'.$movements[$i]['cedula'].'">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
<path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41m-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9"></path>
<path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5 5 0 0 0 8 3M3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9z"></path>
</svg></button>';
        
        // 3. RAZÓN SOCIAL (campo obligatorio en frontend - usar CD como placeholder)
        $dato['Razon_Social'] = isset($movements[$i]['cd']) ? $movements[$i]['cd'] : 'CD3';
        
        // 4. DOC IESS (mapear 'estado' de CD3 a 'DocIess' que espera frontend)
        if(isset($movements[$i]['estado']) && $movements[$i]['estado'] == 'Aprobado'){
            $dato['DocIess'] = '<button type="button" style="color:white;background-color:#488753" class="pull-right btn btn-default" id="sendEmail">Activo</button>';
        } else {
            $dato['DocIess'] = '<button type="button" style="color:white;background-color:#9F4C44" class="pull-right btn btn-default" id="sendEmail">Inactivo</button>';
        }
        
        // 5. EXAMEN SEGURIDAD (usar mismo campo 'estado' pero con diferente texto)
        if(isset($movements[$i]['estado']) && $movements[$i]['estado'] == 'Aprobado'){
            $dato['Examen_seguridad'] = '<button type="button" style="color:white;background-color:#488753" class="pull-right btn btn-default" id="sendEmail">Aprobado</button>';
        } else {
            $dato['Examen_seguridad'] = '<button type="button" style="color:white;background-color:#9F4C44" class="pull-right btn btn-default" id="sendEmail">No existe registro</button>';
        }
        
        // 6. FECHA DOCUMENTACIÓN (usar 'fecha' de CD3)
        $dato['Fecha_de_documentacion'] = isset($movements[$i]['fecha']) ? $movements[$i]['fecha'] : 'N/A';
        
        // 7. CIUDAD (usar 'cd' de CD3)
        $dato['Ciudad'] = isset($movements[$i]['cd']) ? $movements[$i]['cd'] : 'CD3';
        
        // --- CAMPOS NUEVOS (ESENCIALES) ---
        
        // 8. FECHA AFECTACIÓN y ESTADO
        $dato['fecha_afectacion_raw'] = isset($movements[$i]['fecha_afectacion_raw']) ? $movements[$i]['fecha_afectacion_raw'] : 'N/A';
        
        // Renombrar para evitar conflicto con campo 'estado' existente
        $dato['estado_afectacion'] = isset($movements[$i]['estado_afectacion']) ? $movements[$i]['estado_afectacion'] : 'INVALIDO';
        
        // --- CAMPOS EXISTENTES DE CD3 ---
        
        // 9. FECHA REGISTRO
        $dato['fecha_registro'] = isset($movements[$i]['fecha_registro']) ? $movements[$i]['fecha_registro'] : 'N/A';
        
        // 10. NUMERO CONSULTA
        $dato['numconsulta'] = isset($movements[$i]['numconsulta']) ? $movements[$i]['numconsulta'] : 0;
        
        // 11. ANTECEDENTES (importante: en CD3 es "Si", en Guayaquil es "No")
        if(isset($movements[$i]['Antedentes']) && $movements[$i]['Antedentes'] != 'Si'){
            $dato['Antedentes'] = '<button type="button" style="color:white;background-color:#488753" class="pull-right btn btn-default" id="sendEmail">No</button>';
            $dato['Comentario'] = 'NO HAY PROCESOS PENALES ASOCIADOS';
        } else {
            $dato['Antedentes'] = '<button type="button" style="color:white;background-color:#9F4C44" class="pull-right btn btn-default" id="sendEmail">Sí</button>';
            $dato['Comentario'] = 'SÍ HAY PROCESOS PENALES ASOCIADOS';
        }
        
        // 12. FECHA INGRESO
        $dato['fechaIngreso'] = isset($movements[$i]['fechaIngreso']) ? $movements[$i]['fechaIngreso'] : 'N/A';
        
        // 13. Campo adicional 'fechaCap' que espera frontend
        $dato['fechaCap'] = "";
        
        // 14. Campo 'cd' original de CD3 (por si acaso)
        $dato['cd'] = isset($movements[$i]['cd']) ? $movements[$i]['cd'] : 'N/A';
        
        $file[] = $dato;
    }
    
    $result = array('data' => $file);
    echo json_encode($result);
}
?>