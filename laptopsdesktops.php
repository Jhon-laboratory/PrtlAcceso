<?php
//header('Content-Type: application/vnd.ms-excel;charset=utf-8');

header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename= LaptopsDesktops.xls");

//EXCEL DE AFILIADOS X SEMANA, HACIENDA, SECTOR, EMPLEADO
include 'Conexion/conexion_mysqli.php';
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<table  border="1">
  <tr>
    <th>#</th>
  <th>Fecha</th>
  <th>Empresa</th>
  <th>Ciudad</th>
  <th>Ubicación</th>
 <th>Área</th>
  <th>Departamento</th>
  <th>Responsable</th>
  <th>Cargo Responsable</th>
  <th>CECO Compra</th>
  <th>Cédula</th>
  <th>Tipo</th>
  <th>Procesador</th>
  <th>RAM</th>
  <th>Disco</th>
  <th>Marca</th>
  <th>Modelo</th>
  <th>Serie</th>
  <th>Hostname</th>
  <th>Estado</th>
  </tr>

<?php
 //SELECT CON NUEVOS CAMPOS QUE SE DESEA
//$sql_1 = "SET sql_mode='NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION'";
//$result_1 = mysqli_query($db_link, $sql_1);


$conn      = conexionSQL();
    $sql         = "select  *,  DATEPART(dd, fecha) || '-' || DATEPART(mm, fecha)  || '-' ||  DATEPART(yyyy, fecha)  AS fecha2
     FROM [IT].[act_entrega_laptop_desktop] ";
    //$resultado   = $mysqli->query($sql);

    $resultado   = sqlsrv_query($conn, $sql);// $mysqli->query($sql);
        
$contador=0;
    while ($fila = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC)) {
      //  $data[]   = $fila;
$contador=$contador+1;
echo '<tr>
      <td>'.$contador.'</td>
      <td>'.$fila['fecha2'].'</td>
      <td>'.$fila['Empresa'].'</td>
        <td>'.$fila['ciudad'].'</td>
        <td>'.$fila['ubicacion'].'</td>
        <td>'.$fila['area'].'</td>
        <td>'.$fila['departamento'].'</td>
        <td>'.$fila['responsable'].'</td>
        <td>'.$fila['cargo_responsable'].'</td>
        <td>'.$fila['ceco_compra'].'</td>
        <td>'.$fila['cedula'].'</td>
        <td>'.$fila['Tipo'].'</td>
        <td>'.$fila['procesador'].'</td>
        <td>'.$fila['memoria_ram'].'</td>
        <td>'.$fila['disco'].'</td>
        <td>'.$fila['marca'].'</td>
        <td>'.$fila['modelo'].'</td>
        <td>'.$fila['serie'].'</td>
        <td>'.$fila['hostname'].'</td>
        <td>'.$fila['estado'].'</td>
        </tr>';
            }
    
echo '</table>';


 ?>


    