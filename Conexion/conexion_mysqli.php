<?php 
date_default_timezone_set('America/Lima');

function conexionSQL()
{

$serverName="Jorgeserver.database.windows.net";
$databaseName= "DPL";
$username="Jmmc";
$password= "ChaosSoldier01";

// Conexión a la base de datos
$conn = sqlsrv_connect($serverName, array("Database" => $databaseName, "UID" => $username, "PWD" => $password,  "CharacterSet"=>"UTF-8"));

if ($conn === false) {
   // echo "No se pudo conectar a la base de datos: " . sqlsrv_errors();
    die();
} else {
   // echo "Conectado correctamente a la base de datos.";
}
   return $conn;
 }
 ?>