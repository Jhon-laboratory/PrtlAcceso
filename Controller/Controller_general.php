<?php
require '../Conexion/conexion_mysqli.php';
include('../Model/Model_gb_global.php');
include('../Model/Model_general.php');
if (isset($_GET["txt_option"]) || isset($_POST["txt_option"])) {

    if (isset($_GET["txt_option"])) {
        $opt = $_GET["txt_option"];
    } else {
        $opt = $_POST["txt_option"];
    }

    switch ($opt) {

        case "1":
            table_general();
            break;


        case "2":
            actualizar_estatus();
            break;


        case "3":
            proceso();
            break;
    



        default:
            echo "{failure:true}";
            break;
    }
}

/*=============================================
TABLE USER
=============================================*/
function table_general()
{ 
	$Consult          = new ModelGeneral();
    $movements        = $Consult->table_general();
    $file             = array();
    $total_inversion =0;

    $i            = 0;
    foreach ($movements as $data) {

        $i++;
        $dato['id']            = $i;
        $dato['proceso']       =  $data['proceso'];
		$dato['descripcion']   =  $data['descripcion'];
		$dato['estatus']       =  $data['estatus'];
        $file[]                = $dato;
    }

    $result = array('data' => $file);
    echo json_encode($result);
}


/*=============================================
PROCESO 1
=============================================*/
function actualizar_estatus()
{
    $mysqli  = conexionMySQL();
    $Consult = new ModelGeneral();

    
    $movements  = $Consult->actualizar_estatus($_POST['txt_i']);
    foreach ($movements as $movement) {

        $dato["result"]   = $movement["result"];
        $dato["error"]    = $movement["error"];
    }
    echo json_encode($dato);
}


/*=============================================
PROCESO 1
=============================================*/
function proceso()
{
    $mysqli  = conexionMySQL();
    $Consult = new ModelGeneral();

    switch ($_POST['txt_proceso']) {

        case "1":
            $movements  = $Consult->proceso1(1);
        break;

/* 
        case "2":
            $movements  = $Consult->proceso2($_POST['txt_contador']);
        break;


        case "3":
            $movements  = $Consult->proceso3($_POST['txt_contador']);
        break;


        case "4":
            $movements  = $Consult->proceso4($_POST['txt_manual'],$_POST['txt_contador']);
        break;

        case "5":
            $movements  = $Consult->proceso5($_POST['txt_contador']);
        break;

        case "6":
            $movements  = $Consult->proceso6($_POST['txt_contador']);
        break;
 */

        default:
            echo "{failure:true}";
            break;
    }
    
    foreach ($movements as $movement) {

        $dato["result"]   = $movement["result"];
        $dato["error"]    = $movement["error"];
    }
    echo json_encode($dato);
}