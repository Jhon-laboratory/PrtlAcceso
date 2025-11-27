<?php      
include '../../Conexion/conexion_mysqli.php';

$conx      = conexionSQL();

//EJECUTAMOS SCRIPT DE ANTECEDENTES

//PARA API CONECTAR Y ENVIAR LOS DATOS
$curl = curl_init();

$cedulademandado= $_REQUEST['cedula'];

//quitamos un caracter a la cadena
curl_setopt_array($curl, [
  CURLOPT_URL => "https://api.funcionjudicial.gob.ec/EXPEL-CONSULTA-CAUSAS-SERVICE/api/consulta-causas/informacion/buscarCausas?page=1&size=10",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => '{"numeroCausa":"","actor":{"cedulaActor":"","nombreActor":""},
  "demandado":{"cedulaDemandado":"'.$cedulademandado.'","nombreDemandado":""},"provincia":"","numeroFiscalia":"","recaptcha":"verdad","first":1,"pageSize":10}
  ',
  CURLOPT_HTTPHEADER => [
    "Content-Type: application/json"
  ],
]);


$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  //echo "cURL Error #:" . $err;
} else {
}

//echo ($response);
$nuevo = json_decode($response, true);

//$nuevo = json_decode($response);

//echo 'okokokokok<br>';
//print_r($nuevo);
//echo 'cedula:'.$cedulademandado.'<br>';
$cantidaddelitos = 0;

$buscar1='NUEVABUSQUEDAX,ASESINATO,ROBO,HURTO,FEMICIDIO,ARMAS,DROGAS,ILICITO,ESTUPEFACIENTES,CONTRA LA VIDA,HOMICIDIO,DELITO,ESCANDALO,FALSIFICACION,PORNOGRAFIA,INFANTIL,SEXUAL,INGRESO DE ARTICULOS PROHIBIDOS';
$buscar = explode(",", $buscar1);
$delitosquetiene='';
for ($i=0; $i <  count($nuevo); $i++) { 

    //echo $nuevo[$i]['nombreDelito'].'<br>';
  $texto = strval($nuevo[$i]['nombreDelito']);
  $texto = preg_replace('/[0-9]+/', '', $texto);
  

    if(in_array(trim($texto), $buscar)){
       //echo 'Existe la cadena ' .$texto.' <br>'; // .$buscar;
       $delitosquetiene= $delitosquetiene. $texto .', ';
 $cantidaddelitos=$cantidaddelitos+1;
    }else{
      // echo 'NO Existe la cadena ' .$texto.' <br>';//  .$buscar;
    }


}
//echo $cantidaddelitos;




if($cantidaddelitos>0){
    $estado='Si';
} else {
    $estado='No';
}
$sqlx = "INSERT INTO [citas].[RegistroPenal]
([Cedula]
,[Antedentes]
,[Comentario]
,fecha_registro)
VALUES(?,?,?,?)";
    $paramsx = array( $_REQUEST['cedula'],$estado,$delitosquetiene,date('Y-m-d h:i:s'));

$stmtx = sqlsrv_prepare($conx, $sqlx, $paramsx);
if (sqlsrv_execute( $stmtx ) === false) {
  
}


echo 1;
