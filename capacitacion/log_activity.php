<?php

// Define the filename for the log file
$logFile = 'activity_capacitacion.txt';

    // Obtener la dirección IP del cliente
    $ipaddress = $_SERVER['REMOTE_ADDR'];
    
    function anonymizeIp($ip) {
        // Verificar si es una dirección IPv4
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            // Anonimizar la IP IPv4 (por ejemplo, 192.168.1.123 se convierte en 192.168.1.0)
            $ipParts = explode('.', $ip);
            $ipParts[3] = '0'; // Reemplaza el último octeto por 0
            return implode('.', $ipParts);
        }
    
        // Verificar si es una dirección IPv6
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            // Anonimizar la IP IPv6 (por ejemplo, 2001:0db8:85a3:0000:0000:8a2e:0370:7334 se convierte en 2001:0db8:85a3:0000:0000:0000:0000:0000)
            $ipParts = explode(':', $ip);
            for ($i = 1; $i < count($ipParts); $i++) {
                $ipParts[$i] = '0'; // Reemplaza los segmentos por 0
            }
            return implode(':', $ipParts);
        }
    
        // Si no es una IP válida, retornar null
        return null;
    }
    
    // Anonimizar la dirección IP
    $anonimizedIp = anonymizeIp($ipaddress);
    
    // Mostrar resultados
  /* echo "Dirección IP original: $ipaddress\n";
    echo "Dirección IP anonimizada: $anonimizedIp\n";
    */
   $ipfinal= $anonimizedIp;
//$ipAddress = $_SERVER['REMOTE_ADDR'];

    $userAgent = $_SERVER['HTTP_USER_AGENT'];

    // Log the user's activity
    logUserActivity($logFile, $ipfinal, $userAgent, '');
// Function to log user activity
function logUserActivity($logFile, $ipAddress, $userAgent, $action) {
$dato=$_REQUEST['dato'];
// Create a log message
    $logMessage = date('Y-m-d H:i:s') . " | IP: $ipAddress | Action: $action - $dato  | User-Agent: $userAgent" . PHP_EOL;

    // Write the log message to the file
    file_put_contents($logFile, $logMessage, FILE_APPEND | LOCK_EX);
}

?>