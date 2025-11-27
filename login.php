<?php
if (isset($_POST["enviar"])) {
	require 'Conexion/conexion_mysqli.php';
	$conn = conexionSQL();
	$loginNombre   = $_POST["login"];
	$loginPassword = ($_POST["password"]);

	/** VALIDAMOS DATOS DEL USUARIO **/
	
	$sql = " SELECT * FROM gb_usuarios WHERE gb_usuario='$loginNombre' AND gb_clave='$loginPassword' ";
    $stmt = sqlsrv_query($conn, $sql);

    if ($stmt === false) {
        echo "Error al ejecutar la consulta: " . sqlsrv_errors();
    } else {
        // Recorrer los resultados
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
       /*     echo "ID: " . $row['id'] . "<br>";
            echo "Nombre: " . $row['nombre'] . "<br>";
     */
		session_start();
		$_SESSION["logueado"]    = TRUE;
		$_SESSION["gb_id_user"]  = $row["gb_id"];
		$_SESSION["gb_nombre"]   = $row["gb_usuario"];
		$_SESSION["gb_nombre_full"]   = $row["gb_nombre"];
		$_SESSION["gb_perfil"]   = $row["gb_id_perfil"];

		if ($row["gb_id_perfil"]==2){
			header("Location: pages/global/index.php?opc=proveedorguayaquil");
		}
		
		if ($row["gb_id_perfil"]==3){
			header("Location: pages/global/index.php?opc=proveedorquito");
		}

		if ($row["gb_id_perfil"]==4){
			header("Location: pages/global/index.php?opc=proveedorcd3");
		}

		if ($row["gb_id_perfil"]==1){
			header("Location: pages/global/index.php?opc=proveedorguayaquil");
		}
		
	
}
}
	//$mysqli->close();
}	
