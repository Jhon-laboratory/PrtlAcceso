<?php
class ControladorFormulario{
	/*============================================
	=            REGISTRAR FORMULARIO            =
	============================================*/
	static public function ctrInsertarFormulario($datos){
		$tabla = "solicitudes_qr";

		$rpta = ModeloFormulario::mdlInsertarFormulario($tabla,$datos);

		return $rpta;
	}
}