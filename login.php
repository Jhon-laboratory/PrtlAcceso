<?php
session_start();

// Verificar si viene de la sesión central (auto-login)
$auto_login = isset($_SESSION["logueado"]) && $_SESSION["logueado"] === TRUE;

if ($auto_login) {
    // Usar datos de sesión central
    $loginNombre = $_SESSION["correo"];
    // No necesitamos password para auto-login
} elseif (isset($_POST["enviar"])) {
    // Login tradicional
    $loginNombre = $_POST["login"];
    $loginPassword = $_POST["password"];
} else {
    header("Location: ../../index.php");
    exit;
}

require 'Conexion/conexion_mysqli.php';
$conn = conexionSQL();

// Buscar usuario (con consulta parametrizada por seguridad)
$sql = "SELECT * FROM gb_usuarios WHERE gb_usuario = ?";
$params = array($loginNombre);
$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt === false) {
    die("Error: " . print_r(sqlsrv_errors(), true));
}

$row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

// Si no existe el usuario y viene de auto-login, crearlo
if (!$row && $auto_login) {
    // Crear usuario local (misma lógica que en Opción 1)
    $perfil = determinarPerfil($_SESSION);
    
    $sql_insert = "INSERT INTO gb_usuarios (gb_usuario, gb_nombre, gb_clave, gb_id_perfil, gb_fecha_creacion) 
                   VALUES (?, ?, ?, ?, GETDATE())";
    $clave_temp = bin2hex(random_bytes(16));
    $params_insert = array($loginNombre, $_SESSION["nombre"], $clave_temp, $perfil);
    $stmt_insert = sqlsrv_query($conn, $sql_insert, $params_insert);
    
    if ($stmt_insert) {
        // Re-consultar el usuario creado
        $stmt = sqlsrv_query($conn, $sql, $params);
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    }
}

// Validar credenciales
$login_ok = false;

if ($row) {
    if ($auto_login) {
        // Auto-login: confianza plena
        $login_ok = true;
    } else {
        // Login tradicional: verificar password
        $login_ok = ($row["gb_clave"] == $loginPassword); // Considera usar password_hash()
    }
}

if ($login_ok) {
    $_SESSION["logueado_local"] = TRUE;
    $_SESSION["gb_id_user"] = $row["gb_id"];
    $_SESSION["gb_nombre"] = $row["gb_usuario"];
    $_SESSION["gb_nombre_full"] = $row["gb_nombre"];
    $_SESSION["gb_perfil"] = $row["gb_id_perfil"];
    
    // Redirigir según perfil
    $redirecciones = [
        1 => "pages/global/index.php?opc=proveedorguayaquil",
        2 => "pages/global/index.php?opc=proveedorguayaquil",
        3 => "pages/global/index.php?opc=proveedorquito",
        4 => "pages/global/index.php?opc=proveedorcd3"
    ];
    
    $perfil = $row["gb_id_perfil"];
    $destino = $redirecciones[$perfil] ?? "pages/global/index.php?opc=proveedorguayaquil";
    
    header("Location: $destino");
    exit;
} else {
    // Login fallido
    header("Location: ../../index.php?login=error_app");
    exit;
}

function determinarPerfil($session) {
    // Misma función que en Opción 1
    if (isset($session["ciudad"])) {
        if ($session["ciudad"] == 1) return 2;
        if ($session["ciudad"] == 2) return 3;
        if ($session["ciudad"] == 3) return 4;
    }
    return 1;
}
?>