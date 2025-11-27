<?php


class ControladorUsuarios{


/*==============================================

=            MOSTRAR USUARIOS DE LA EMPRESA            =

==============================================*/



	public static function ctrMostrarUsuariosRansa($tabla,$item,$valor){





		$respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla,$item,$valor);



		return $respuesta;

	}



	

	



	}

