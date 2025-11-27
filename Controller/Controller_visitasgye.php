<?php
require '../Conexion/conexion_mysqli.php';
include('../control_session.php');
include('../Model/Model_gb_global.php');
include('../Model/Model_visitasgye.php');
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
	$Consult          = new ModelCliente();
    $movements        = $Consult->table_clientes();
    $file             = array();
    $total_inversion =0;

    $i            = 0;

//print_r($movements[0]['Nombre']);
$x=0;
// ($movements['totalfila']-1)
for ($i=0; $i < ($movements['totalfila']); $i++) { 
       // echo ($data['Nombre']).'1<br>';
        $x++;
        $dato['id']               = $x;
        $dato['Nombre']           =  $movements[$i]['nombre'];//        mb_convert_encoding($movements[$i]['Nombre'], 'UTF-8', mb_list_encodings()); //utf8_encode(utf8_decode();// $movements[$i]['Nombre'];
      //  $dato['Nombre']           =  iconv('ISO-8859-1', 'UTF-8', $movements[$i]['nombre']);//        mb_convert_encoding($movements[$i]['Nombre'], 'UTF-8', mb_list_encodings()); //utf8_encode(utf8_decode();// $movements[$i]['Nombre'];
        //utf8_encode(utf8_decode($Variable['campo']))
        $dato['Cedula']        =  $movements[$i]['cedula'] . ' <button type="button" class="btn btn-secondary"  onclick="ejecutarap(this.value)" value="'.$movements[$i]['cedula'].'">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
<path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41m-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9"></path>
<path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5 5 0 0 0 8 3M3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9z"></path>
</svg>';  /* $dato['Antedentes']         = $movements[$i]['Antedentes'];
        $dato['estado']         = $movements[$i]['estado'];
       */
       $dato['fecha']         = $movements[$i]['fecha'];
        $dato['fechaIngreso']         = $movements[$i]['fechaIngreso'];
        $dato['fecha_registro']         = $movements[$i]['fecha_registro'];
        $dato['numconsulta']         = $movements[$i]['numconsulta'];
      
        if($movements[$i]['Antedentes']!='No'){
            //SI TIENE
            //$dato['Antedentes']         ='<label style="color:white;background-color:red">Sí</label>';
            $dato['Antedentes']         = '<button type="button" style="color:white;background-color:#F39200" class="pull-right btn btn-default" id="sendEmail">Sí
            </button>';
            $dato['Comentario']         =  'SÍ HAY PROCESOS PENALES ASOCIADOS';
        } else {
            $dato['Antedentes']         = '<button type="button" style="color:white;background-color:#009A3F" class="pull-right btn btn-default" id="sendEmail">No
            </button>';
            $dato['Comentario']         =  'NO HAY PROCESOS PENALES ASOCIADOS';
        }

       if($movements[$i]['estado']=='Aprobado'){
        //SI TIENE
        //$dato['Antedentes']         ='<label style="color:white;background-color:red">Sí</label>';
        $dato['estado']         = '<button type="button" style="color:white;background-color:#009A3F" class="pull-right btn btn-default" id="sendEmail">Aprobado
        </button>';
       } else {
        $dato['estado']         = '<button type="button" style="color:white;background-color:#F39200" class="pull-right btn btn-default" id="sendEmail">No existe registro
        </button>';
        }

        
       // $dato['Comentario']         =  iconv('ISO-8859-1', 'UTF-8', $movements[$i]['Comentario']); 
        /*$dato['button']        =  '

                             <button type="button" log_id="'.$data['id'].'" 
                                                       log_nombre="'.$data['nombre'].'"  log_identificacion="'.$data['codigo'].'"
                                                       class="btn btn-xs btn-warning btn_load_edit_cliente"><acronym title="Editar Cliente!" lang="es"><i class="far fa-edit"></i></acronym></button>
                                  <button type="button" log_id ="'.$data['id'].'" log_nombre="'.$data['nombre'].'" log_identificacion="'.$data['codigo'].'"    class="btn btn-xs btn-danger btn_delete_cliente"><acronym title="Eliminar cliente!" lang="es"><i class="fa fa-trash" aria-hidden="true"></i></acronym></button>';
                                  */
        $file[]               = $dato;
    }
    $result = array('data' => $file);
    echo json_encode($result);
}



?>