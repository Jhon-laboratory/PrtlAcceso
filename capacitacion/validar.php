<?php

// Variable de identificación
$numeroIdentificacion = $_REQUEST['dato'];

// Inicializar cURL
$ch = curl_init();

// Configurar la URL
curl_setopt($ch, CURLOPT_URL, "https://srienlinea.sri.gob.ec/sri-registro-civil-servicio-internet/rest/DatosRegistroCivil/obtenerDatosCompletosPorNumeroIdentificacionConToken?numeroIdentificacion=$numeroIdentificacion");

// Configurar las opciones de cURL
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Accept: application/json, text/plain, */*",
    "Accept-Language: es,es-ES;q=0.9,en;q=0.8,en-GB;q=0.7,en-US;q=0.6",
    "Authorization: eyJhbGciOiJIUzI1NiJ9.eyJqdGkiOiJERUNMQVJBQ0lPTkVTIiwiaWF0IjoxNzM0MzYzMTM3LCJzdWIiOiJERUNMQVJBVE9SSUEgUFJFU0NSSVBDSU9OIEhFUkVOQ0lBIiwiZXhwIjoxNzM0MzYzNzM3fQ.XMb9rFKHt7xXmZxtUvUqylPAfMI301dauJGb3iruvMU",
    "Cache-Control: no-cache, no-store, must-revalidate",
    "Connection: keep-alive",
    "Content-Type: application/json; charset=utf-8",
    "Expires: Sat, 01 Jan 2000 00:00:00 GMT",
    "If-Modified-Since: 0",
    "Pragma: no-cache",
    "Referer: https://srienlinea.sri.gob.ec/sri-en-linea/SriPagosWeb/ConsultaDeudasFirmesImpugnadas/Consultas/consultaDeudasFirmesImpugnadas",
    "Sec-Fetch-Dest: empty",
    "Sec-Fetch-Mode: cors",
    "Sec-Fetch-Site: same-origin",
]);

// Ejecutar la solicitud
$response = curl_exec($ch);

// Verificar si hubo un error
if (curl_errno($ch)) {
    //echo 'Error:' . curl_error($ch);
    echo '';
} else {
    // Procesar la respuesta
    //echo $response;
    $data = json_decode($response, true);
// Acceder al campo 'nombreCompleto'
$nombreCompleto = $data['nombreCompleto'];

// Mostrar el nombre completo
//echo "Nombre Completo: " . $nombreCompleto;
echo  $nombreCompleto;
}

// Cerrar cURL
curl_close($ch);
?>