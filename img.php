<?php
// Código PHP para generar un diagrama SVG aproximado del sistema de control del robot
// Basado en el código TikZ proporcionado. Se usa SVG para renderizarlo en HTML.
// Esto crea una página HTML con el diagrama embebido, que se puede ver en un navegador.

header('Content-Type: text/html; charset=utf-8');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Diagrama de Bloques del Sistema de Control del Robot</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; background-color: #f0f0f0; }
        svg { border: 1px solid #ccc; background-color: white; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        .label { font-size: 12px; fill: #333; }
        .block { fill: #e3f2fd; stroke: #1976d2; stroke-width: 2; rx: 10; ry: 10; }
        .sum { fill: #fff3e0; stroke: #f57c00; stroke-width: 2; }
        .arrow { stroke: #333; stroke-width: 2; marker-end: url(#arrowhead); }
        .feedback { stroke: #666; stroke-width: 1.5; stroke-dasharray: 5,5; }
    </style>
</head>
<body>
    <h1>Diagrama de Bloques Vertical del Sistema de Control del Robot</h1>
    <svg width="600" height="800" viewBox="0 0 600 800">
        <defs>
            <marker id="arrowhead" markerWidth="10" markerHeight="7" refX="9" refY="3.5" orient="auto">
                <polygon points="0 0, 10 3.5, 0 7" fill="#333" />
            </marker>
        </defs>

        <!-- Bloques verticales -->
        <rect x="250" y="50" width="100" height="40" class="block" />
        <text x="300" y="75" text-anchor="middle" class="label">r(t)</text>

        <circle cx="300" cy="130" r="20" class="sum" />
        <text x="300" y="135" text-anchor="middle" class="label">Σ</text>

        <rect x="250" y="180" width="100" height="50" class="block" />
        <text x="300" y="205" text-anchor="middle" class="label">Compensador</text>
        <text x="300" y="220" text-anchor="middle" class="label">Lag</text>

        <rect x="250" y="260" width="100" height="50" class="block" />
        <text x="300" y="285" text-anchor="middle" class="label">Controlador</text>
        <text x="300" y="300" text-anchor="middle" class="label">Difuso</text>

        <rect x="250" y="340" width="100" height="50" class="block" />
        <text x="300" y="365" text-anchor="middle" class="label">Correcciones</text>

        <rect x="250" y="420" width="100" height="50" class="block" />
        <text x="300" y="445" text-anchor="middle" class="label">PID Ruedas</text>

        <rect x="250" y="500" width="100" height="50" class="block" />
        <text x="300" y="525" text-anchor="middle" class="label">Planta</text>
        <text x="300" y="540" text-anchor="middle" class="label">Robot</text>

        <rect x="250" y="580" width="100" height="40" class="block" />
        <text x="300" y="605" text-anchor="middle" class="label">y(t)</text>

        <!-- Retroalimentación lateral -->
        <rect x="100" y="500" width="100" height="50" class="block" />
        <text x="150" y="525" text-anchor="middle" class="label">Sensores</text>

        <rect x="100" y="130" width="100" height="50" class="block" />
        <text x="150" y="155" text-anchor="middle" class="label">Cálculo</text>
        <text x="150" y="170" text-anchor="middle" class="label">Errores</text>

        <!-- Conexiones verticales principales -->
        <line x1="300" y1="90" x2="300" y2="110" class="arrow" />
        <line x1="300" y1="150" x2="300" y2="180" class="arrow" />
        <line x1="300" y1="230" x2="300" y2="260" class="arrow" />
        <line x1="300" y1="310" x2="300" y2="340" class="arrow" />
        <line x1="300" y1="390" x2="300" y2="420" class="arrow" />
        <line x1="300" y1="470" x2="300" y2="500" class="arrow" />
        <line x1="300" y1="550" x2="300" y2="580" class="arrow" />

        <!-- Retroalimentación -->
        <path d="M 350 525 Q 400 525 400 200 Q 400 130 320 130" class="feedback" marker-end="url(#arrowhead)" />
        <path d="M 200 525 Q 50 525 50 155 Q 50 130 220 130" class="feedback" marker-end="url(#arrowhead)" />

        <!-- Etiquetas de niveles -->
        <text x="150" y="205" text-anchor="middle" class="label" font-weight="bold">Nivel 2: Compensación</text>
        <text x="150" y="285" text-anchor="middle" class="label" font-weight="bold">Nivel 3: Control Difuso</text>
        <text x="150" y="365" text-anchor="middle" class="label" font-weight="bold">Nivel 4: Correcciones</text>
        <text x="150" y="445" text-anchor="middle" class="label" font-weight="bold">Nivel 5: PID</text>
    </svg>
    <p>Diagrama generado dinámicamente con PHP y SVG. Para exportar como imagen, guarda la página o usa una herramienta como "Guardar como PNG" en el navegador.</p>
</body>
</html>
