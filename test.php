<?php

// Ruta del archivo PDF
$filePath = "/aviso.pdf";

// Extracción de información del PDF
$info = exec("pdfinfo $filePath");

// Búsqueda del texto en la información
//$text = preg_match_all("Av", $info, $matches);
//$text = $matches[1][0];

// Impresión del texto
print_r($info);
//echo $text;