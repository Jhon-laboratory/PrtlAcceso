<?php      
include '../Portal-Acceso/Conexion/conexion_mysqli.php';

$conx      = conexionSQL();

///,date('Y-m-d h:i:s')

$calificacion=0;
if($_POST['r1']=='Calzado de seguridad + Chaleco o ropa reflectiva + casco + mascarilla'){
    $calificacion=$calificacion+1; 
}
if($_POST['r2']=='Prohibición'){
    $calificacion=$calificacion+1; 
}
if($_POST['r3']=='Falso'){
    $calificacion=$calificacion+1; 
}
if($_POST['r10']=='Probabilidad de que un peligro se materialice en determinadas condiciones y genere daños a las personas, equipos y al ambiente'){
    $calificacion=$calificacion+1; 
}
if($_POST['r4']=='Toda condición en el entorno del trabajo que puede causar un accidente'){
    $calificacion=$calificacion+1; 
}
if($_POST['r5']=='Todo suceso repentino que sobrevenga por causa o con ocasión del trabajo y que produzca en el trabajador una lesión orgánica, una perturbación funcional, una invalidez o la muerte'){
    $calificacion=$calificacion+1; 
}
if($_POST['r6']=='Físico'){
    $calificacion=$calificacion+1; 
}
if($_POST['r7']=='Mecánico'){
    $calificacion=$calificacion+1; 
}
if($_POST['r8']=='Trabajos en altura'){
    $calificacion=$calificacion+1; 
}
if($_POST['r9']=='Prohibido el ingreso y consumo de alimentos'){
    $calificacion=$calificacion+1; 
}
if($calificacion>=7){
    $estado='Aprobado';
    $textox=' puede acceder a las instalaciones de Ransa.';
} else {
    $estado='Negado';
    $textox=' NO puede acceder a las instalaciones de Ransa. Por favor, intente nuevamente responder las preguntas del formulario.';
}
$sqlx = "INSERT INTO [citas].[FormularioSeguridad_Resultados]
([cedula]
,[nombre]
,[fecha]
,[cargo]
,[cd]
,[pregunta1]
,[pregunta2]
,[pregunta3]
,[pregunta4]
,[pregunta5]
,[pregunta6]
,[pregunta7]
,[pregunta8]
,[pregunta9]
,[pregunta10]
,[calificacion]
,[estado]
,[fechaIngreso]
,[consultaAntecedentes]
,[trabajo_realizar]
,[observaciones])
VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $paramsx = array( $_POST['cedula'],$_POST['nombre'],date('Y-m-d'),
    $_POST['cargo'],$_POST['cd'], $_POST['r1'],$_POST['r2']
    ,$_POST['r3'],$_POST['r10'],$_POST['r4'],$_POST['r5'],$_POST['r6']
    ,$_POST['r7'],$_POST['r8'],$_POST['r9'],$calificacion,$estado,date('Y-m-d h:i:s'),'NA',$_POST['trabajo'],$_POST['obs']
);

$stmtx = sqlsrv_prepare($conx, $sqlx, $paramsx);
if (sqlsrv_execute( $stmtx ) === false) {
  
}


//EJECUTAMOS SCRIPT DE ANTECEDENTES

//PARA API CONECTAR Y ENVIAR LOS DATOS
$curl = curl_init();

$cedulademandado= $_POST['cedula'];

//quitamos un caracter a la cadena
curl_setopt_array($curl, [
  CURLOPT_URL => "https://api.funcionjudicial.gob.ec/EXPEL-CONSULTA-CAUSAS-SERVICE/api/consulta-causas/informacion/buscarCausas?page=1&size=50",
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

$buscar1='ROBO,ASESINATO,HURTO,FEMICIDIO,ARMAS,DROGAS,ILICITO,ESTUPEFACIENTES,CONTRA LA VIDA,HOMICIDIO,DELITO,ESCANDALO,FALSIFICACION,PORNOGRAFIA,INFANTIL,SEXUAL,INGRESO DE ARTICULOS PROHIBIDOS';
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
,[Comentario])
VALUES(?,?,?)";
    $paramsx = array( $_POST['cedula'],$estado,$delitosquetiene);

$stmtx = sqlsrv_prepare($conx, $sqlx, $paramsx);
if (sqlsrv_execute( $stmtx ) === false) {
  
}




echo 'Su calificación fue de '. $calificacion.', por lo que'.$textox;
echo '<br>Usted tiene la siguiente cantidad de delitos '.$cantidaddelitos.' <br>';
echo'<br><a href="index.php">Volver al inicio</a>';