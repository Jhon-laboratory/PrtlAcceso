<?php

require_once "conexion.php";

class ModeloFormulario{
	/*===================================================================
	=            INSERTAR NUEVA SOLICITUD DE QUEJA - RECLAMO            =
	===================================================================*/
	static public function mdlInsertarFormulario($tabla,$datos){
		/**
		 *
		 * ESTADO 1 => NUEVO REGISTRO
		 *
		 */
		
		// var_dump($datos)."<br>";
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (fecha_novedad,codigoSolicitud,idservicioransa,detalle_otras,idciudad,tipo_novedad,nombre_regist,organizacion,detalle_novedad,correo_noti,num_telefono,achivo,fecha_registro,estado) VALUES (:fecha_novedad,:codigoSolicitud,:idservicioransa,:detalle_otras,:idciudad,:tipo_novedad,:nombre_regist,:organizacion,:detalle_novedad,:correo_noti,:num_telefono,:achivo,GETDATE(),1)");

		$stmt->bindParam(":fecha_novedad",$datos["fecha"], PDO::PARAM_STR);
		$stmt->bindParam(":idservicioransa",$datos["servicio"], PDO::PARAM_STR);
		$stmt->bindParam(":detalle_otras",$datos["detalle_otras"], PDO::PARAM_STR);
		$stmt->bindParam(":idciudad",$datos["ciudad"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo_novedad",$datos["tnovedad"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre_regist",$datos["nombres"], PDO::PARAM_STR);
		$stmt->bindParam(":organizacion",$datos["organizacion"], PDO::PARAM_STR);
		$stmt->bindParam(":detalle_novedad",$datos["detalle"], PDO::PARAM_STR);
		$stmt->bindParam(":correo_noti",$datos["correos"], PDO::PARAM_STR);
		$stmt->bindParam(":num_telefono",$datos["celular"], PDO::PARAM_STR);
		$stmt->bindParam(":achivo",$datos["fileevidencia"], PDO::PARAM_STR);
		$stmt->bindParam(":codigoSolicitud",$datos["codigoSolicitud"], PDO::PARAM_STR);
	    //$stmt->bindParam("idusuarioresponsable",$datos["idusuarioresponsable"], PDO::PARAM_STR);
		// var_dump($stmt);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}
	

		$stmt -> close();

		$stmt = null;


	}	
	
	



}