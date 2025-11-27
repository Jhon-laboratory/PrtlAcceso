<?php

$url = "https://www.ecuadorlegalonline.com/modulo/consultar-cedula.php";
$data = [
    'name' => '09582009',
    'tipo' => 'I'
];

$options = [
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => http_build_query($data),
    CURLOPT_HTTPHEADER => [
        "Accept: */*",
        "Accept-Language: es,es-ES;q=0.9,en;q=0.8,en-GB;q=0.7,en-US;q=0.6",
        "Content-Type: application/x-www-form-urlencoded",
        "Sec-CH-UA: \"Microsoft Edge\";v=\"131\", \"Chromium\";v=\"131\", \"Not_A Brand\";v=\"24\"",
        "Sec-CH-UA-Mobile: ?0",
        "Sec-CH-UA-Platform: \"Windows\"",
        "Sec-Fetch-Dest: empty",
        "Sec-Fetch-Mode: cors",
        "Sec-Fetch-Site: same-origin",
        "X-Requested-With: XMLHttpRequest",
        "Referer: https://www.ecuadorlegalonline.com/consultas/registro-civil/consultar-cedulas/",
        "Referrer-Policy: strict-origin-when-cross-origin"
    ],
];

$ch = curl_init();
curl_setopt_array($ch, $options);
$response = curl_exec($ch);
curl_close($ch);

//echo $response;
$datox = explode(" ",$response);
//print_r($datox);

// Crear un nuevo DOMDocument
$dom = new DOMDocument;

// Cargar el HTML
libxml_use_internal_errors(true); // Para evitar advertencias de HTML mal formado
$dom->loadHTML($response);
libxml_clear_errors();

// Buscar el elemento con ID 'ci0'
$ciElement = $dom->getElementById('name0');

// Obtener el texto dentro del elemento
$ciValue = trim($ciElement->textContent); // Usar trim() para eliminar espacios en blanco

echo $ciValue; // Esto mostrará '0909101743'

?>