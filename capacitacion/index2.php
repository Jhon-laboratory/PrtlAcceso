<?php
// proxy.php
$url = 'https://srienlinea.sri.gob.ec/movil-servicios/api/v1.0/deudas/porIdentificacion/0909101743/?tipoPersona=N';

// Iniciar cURL
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Origin: https://paginaweb.sri.gob.ec', // Simulando el origen
]);

// Ejecutar la solicitud
$response = curl_exec($ch);
curl_close($ch);

// Devolver la respuesta
header('Content-Type: application/json');
echo $response;
?>