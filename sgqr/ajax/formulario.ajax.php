<?php
require_once "../controladores/formulario.controlador.php";
require_once "../modelos/formulario.modelo.php";

require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

require_once "../controladores/servicioransa.controlador.php";
require_once "../modelos/servicioransa.modelo.php";

require_once "../controladores/ciudad.controlador.php";
require_once "../modelos/ciudad.modelo.php";

require_once "../controladores/areas.controlador.php";
require_once "../modelos/areas.modelo.php";

require_once "../controladores/modulos_portal.controlador.php";
require_once "../modelos/modulos_portal.modelo.php";

require_once "../modelos/rutas.php";

use  PHPMailer\PHPMailer\PHPMailer ; 
use  PHPMailer\PHPMailer\Exception ;

require_once '../extensiones/PHPMailer/PHPMailer/src/Exception.php';
require_once '../extensiones/PHPMailer/PHPMailer/src/PHPMailer.php';
require_once '../extensiones/PHPMailer/PHPMailer/src/SMTP.php';

require_once  "../extensiones/PHPMailer/vendor/autoload.php";

class AjaxFormulario{

	public $_fecha;
	public $_servicio;
	public $_detalleOtas;
	public $_ciudad;
	public $_tnovedad;
	public $_nombres;
	public $_organizacion;
	public $_detalle;
	public $_correos;
	public $_celular;
	public $_fileevidencia;
	/*=======================================================
	=            INGRESO DE DATOS DEL FORMULARIO            =
	=======================================================*/
	public function ajaxIngresarForm(){		

		$urlAdmin = Ruta::ctrRutaServidorsqr();
		$fecha = date("Y-m-d",strtotime($this->_fecha)); // se da formato a la fecha
		/* PROCEDEMOS A ALMACENAR LA IMAGEN EN EL SERVIDOR */
		$rutafinal = null;
		if ($this->_fileevidencia != null) {
			$directorio = "../archivos/formulario/";

			$extension = pathinfo($this->_fileevidencia["name"],PATHINFO_EXTENSION); // obtenemos la extension del archivo
			// $extension = $infoarch["PATHINFO_EXTENSION"];
			$nombre = uniqid();
			$rutafinal = $directorio.$nombre.".".$extension;

			$resultarchivo = move_uploaded_file($this->_fileevidencia['tmp_name'],$rutafinal);
		}
// 		/*=====  OBTENER EL CODIGO UNICO GENERADO DE LA SOLICITUD  ======*/
		function uniqidReal($lenght = 4) {
		    // uniqid gives 13 chars, but you could adjust it to your needs.
		    if (function_exists("random_bytes")) {
		        $bytes = random_bytes(ceil($lenght / 2));
		    } elseif (function_exists("openssl_random_pseudo_bytes")) {
		        $bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
		    } else {
		        throw new Exception("no cryptographically secure random function available");
		    }
		    return substr(bin2hex($bytes), 0, $lenght);
		}		
			$codigoSol = ($this->_tnovedad == "Queja") ? 'Q'.uniqidReal(): 'R'.uniqidReal();
			$datos = array("fecha"=> $fecha,
							"codigoSolicitud" => $codigoSol,
							"servicio"=> $this->_servicio,
							"detalle_otras" => $this->_detalleOtas,
							"ciudad"=> $this->_ciudad,
							"tnovedad"=> $this->_tnovedad,
							"nombres"=> $this->_nombres,
							"organizacion"=> $this->_organizacion,
							"detalle"=> $this->_detalle,
							"correos"=> $this->_correos,
							// "idusuarioresponsable" => json_encode($saveUserResp,true),
							"celular"=> $this->_celular,
							"fileevidencia"=> substr($rutafinal,2));
			$rpta = ControladorFormulario::ctrInsertarFormulario($datos);
			if ($rpta == "ok") { // comprobamos se guardo la informacion en la base de datos
				/* ENVIAMOS LA NOVEDAD REPORTADA POR CORREO */
				$mail = new PHPMailer();
				$mail->IsSMTP();
				$mail->CharSet = 'UTF-8';
				$mail->SMTPSecure = 'tls';
				$mail->SMTPAuth = true;
				$mail->Host = "smtp.office365.com";// SMTP a utilizar. Por ej. smtp.elserver.com
				$mail->Username = "proyectosecuador@ransa.net"; // Correo completo a utilizar
				$mail->Password = "Didacta_123"; // Contraseña
				$mail->Port = 587; // Puerto a utilizar
				// $mail->From = "Sistema Ransa"; // Desde donde enviamos (Para mostrar)
				// $mail->FromName = "Douglas Borbor";
				// $mail->addEmbeddedImage("../vistas/img/iconos/Mesa-de-trabajo-53.png","montacarga","Mesa-de-trabajo-53.png");
				$mail->isHTML(true);					
				$mail->addEmbeddedImage("../vistas/img/plantilla/logotipo.png","logo_ransa","logotipo.png");
				/* CONSULTAMOS LOS USUARIOS */
			   /*============================================
			   =            BODY USUARIO RANSA            =
			   ============================================*/
				
			$body = 'Hola,<br><br> Se ha registrado un nuevo registro de queja/reclamo en el portal. El número de ticket generado para el seguimiento es:<br><strong style="font-size:20pt;">'.$codigoSol.'</strong><br>Tienes 24 horas como máximo para asignar al responsable de la atención a la queja/reclamo registrado.<br>Ingrese al portal para visualizar la información.<br><br>
			<p style="font-size:11pt;font-family:Calibri,sans-serif;margin:0;text-autospace:none;">
<span style="color:#009B3A;font-family:Verdana,sans-serif;">Ecuador | Km 22, vía Daule –Guayaquil </span></p>
<p style="font-size:11pt;font-family:Calibri,sans-serif;margin:0;text-autospace:none;">
<span lang="ES" style="font-size:10.0pt; font-family:Ebrima; color:#009B3A">Pbx: (593) 0997410389 | Cel: (593) 0996047252</span></p>
<p style="font-size:11pt;font-family:Calibri,sans-serif;margin:0;"><span style="color:#F29104;font-family:UniviaPro-Bold;"><a href="http://www.ransa.net/" target="_blank" rel="noopener noreferrer" data-auth="NotApplicable" data-linkindex="0"><span style="color:#F29104;">www.ransa.net</span></a></span></p>
<p style="font-size:11pt;font-family:Calibri,sans-serif;margin:0;"><span style="color:#1F497D;"><img src="cid:logo_ransa" id="x_Imagen_x0020_3" style="width: 137.24pt; height: 35.24pt; cursor: pointer;" crossorigin="use-credentials"></span><span style="color:#1F497D;font-family:Cambria,serif;"></span></p>
<p style="font-size:11pt;font-family:Calibri,sans-serif;margin:0;"><span style="color:#009A3F;font-size:10pt;font-family:Verdana,sans-serif;">Queremos mejorar tu experiencia al recibir nuestros servicios. </span></p>
<p style="font-size:11pt;font-family:Calibri,sans-serif;margin:0;"><span style="color:#009A3F;font-size:10pt;font-family:Verdana,sans-serif;">A continuación el enlace en el que puedes registrar las oportunidades de mejora detectadas en nuestros procesos.</span><span style="color:#009A3F;font-size:10.5pt;font-family:Verdana,sans-serif;">
</span><b><span style="color:#00B050;font-family:Verdana,sans-serif;"><a href="https://nam02.safelinks.protection.outlook.com/?url=https%3A%2F%2Fforms.office.com%2FPages%2FResponsePage.aspx%3Fid%3DQvsmVyaEd0WZZPE6Yq1euTuPErwV14pGkYOMUiCUOltUQlhKN0ExMFJLMUNXTTEwN0QzTVMxWFcwRC4u&amp;data=04%7C01%7CDBorborP%40ransa.net%7C433c12c9c3b941e1da0f08d8ada0b382%7C5726fb42842645779964f13a62ad5eb9%7C0%7C0%7C637450253002340063%7CUnknown%7CTWFpbGZsb3d8eyJWIjoiMC4wLjAwMDAiLCJQIjoiV2luMzIiLCJBTiI6Ik1haWwiLCJXVCI6Mn0%3D%7C1000&amp;sdata=x7bsp0cvihFHT1o1BUzMCD8p90XDJhHQYPJnkA1%2FhO4%3D&amp;reserved=0" target="_blank" rel="noopener noreferrer" data-auth="NotApplicable" data-linkindex="1">Ingresa
Aquí</a></span></b><b><span style="color:#002060;font-size:10.5pt;font-family:Verdana,sans-serif;"></span></b></p>';
				$rptaUsuarios = ControladorUsuarios::ctrMostrarUsuariosRansa("usuariosransa","","");
				for ($i=0; $i < count($rptaUsuarios) ; $i++) { // Recorremos todos los usuarios 
					$modulos = json_decode($rptaUsuarios[$i]["idmodulos"],true);
					for ($j=0; $j < count($modulos) ; $j++) {
						$rptaArea = ControladorAreas::ctrConsultarAreas("idarea",$rptaUsuarios[$i]["idareas"]);
						$rptaPortal = ControladorModulosPortal::ctrConsultarModulosPortal($modulos[$j]["idmodulos_portal"],"idmodulos_portal");
						if ($rptaPortal["nombremodulo"] == "GESTION_Q-R" && $rptaUsuarios[$i]["estado"] == 1 && $rptaArea["nombre"] == "CALIDAD" ) {
							$mail->addAddress($rptaUsuarios[$i]["email"]);
						}
					}
				}
				$mail->setFrom('smontenegrot@ransa.net', 'Steven Montenegro');
			    $mail->Subject = 'NUEVA '.strtoupper($this->_tnovedad).' INGRESADA';
			    $mail->Body    = $body;
			    $envios1 = $mail->send();

			   /*============================================
			   =            BODY USUARIO EXTERNO            =
			   ============================================*/
			$body = 'Estimado Cliente.<br><br>
Agradecemos gentilmente su tiempo en llenar el formulario. Nuestro equipo trabajará para solucionar su novedad y brindarle una pronta respuesta. A continuación, se muestra el número del ticket con el cual podrá dar seguimiento a su solicitud:<br>
<strong style="font-size:20pt;">'.$codigoSol.'</strong><br>
Además, le dejamos el enlace en el que podrá visualizar el estatus de la solicitud:<br>
<div align="center"><a class="btn btn-success " target="_blank" href="'.$urlAdmin.'Consultar-QR">Consulta de Queja/Reclamo</a><br></div>
Reforzamos nuestro compromiso de mejorar su experiencia de servicio y agradecemos la confianza depositada en nosotros.<br><br>
Ransa Ecuador.<br><br>
			<p style="font-size:11pt;font-family:Calibri,sans-serif;margin:0;text-autospace:none;">
<span style="color:#009B3A;font-family:Verdana,sans-serif;">Ecuador | Km 22, vía Daule –Guayaquil </span></p>
<p style="font-size:11pt;font-family:Calibri,sans-serif;margin:0;text-autospace:none;">
<span lang="ES" style="font-size:10.0pt; font-family:Ebrima; color:#009B3A">Pbx: (593) 0997410389 | Cel: (593) 0996047252</span></p>
<p style="font-size:11pt;font-family:Calibri,sans-serif;margin:0;"><span style="color:#F29104;font-family:UniviaPro-Bold;"><a href="http://www.ransa.net/" target="_blank" rel="noopener noreferrer" data-auth="NotApplicable" data-linkindex="0"><span style="color:#F29104;">www.ransa.net</span></a></span></p>
<p style="font-size:11pt;font-family:Calibri,sans-serif;margin:0;"><span style="color:#1F497D;"><img src="cid:logo_ransa" id="x_Imagen_x0020_3" style="width: 137.24pt; height: 35.24pt; cursor: pointer;" crossorigin="use-credentials"></span><span style="color:#1F497D;font-family:Cambria,serif;"></span></p>
<p style="font-size:11pt;font-family:Calibri,sans-serif;margin:0;"><span style="color:#009A3F;font-size:10pt;font-family:Verdana,sans-serif;">Queremos mejorar tu experiencia al recibir nuestros servicios. </span></p>
<p style="font-size:11pt;font-family:Calibri,sans-serif;margin:0;"><span style="color:#009A3F;font-size:10pt;font-family:Verdana,sans-serif;">A continuación el enlace en el que puedes registrar las oportunidades de mejora detectadas en nuestros procesos.</span><span style="color:#009A3F;font-size:10.5pt;font-family:Verdana,sans-serif;">
</span><b><span style="color:#00B050;font-family:Verdana,sans-serif;"><a href="https://nam02.safelinks.protection.outlook.com/?url=https%3A%2F%2Fforms.office.com%2FPages%2FResponsePage.aspx%3Fid%3DQvsmVyaEd0WZZPE6Yq1euTuPErwV14pGkYOMUiCUOltUQlhKN0ExMFJLMUNXTTEwN0QzTVMxWFcwRC4u&amp;data=04%7C01%7CDBorborP%40ransa.net%7C433c12c9c3b941e1da0f08d8ada0b382%7C5726fb42842645779964f13a62ad5eb9%7C0%7C0%7C637450253002340063%7CUnknown%7CTWFpbGZsb3d8eyJWIjoiMC4wLjAwMDAiLCJQIjoiV2luMzIiLCJBTiI6Ik1haWwiLCJXVCI6Mn0%3D%7C1000&amp;sdata=x7bsp0cvihFHT1o1BUzMCD8p90XDJhHQYPJnkA1%2FhO4%3D&amp;reserved=0" target="_blank" rel="noopener noreferrer" data-auth="NotApplicable" data-linkindex="1">Ingresa
Aquí</a></span></b><b><span style="color:#002060;font-size:10.5pt;font-family:Verdana,sans-serif;"></span></b></p>';

				/* SE AÑADE LOS CORREOS DE NOTIFICACIÓN */
				$mail->ClearAddresses();
				$correosasignados = json_decode($this->_correos,true);
				if (count($correosasignados) > 0) {
					for ($i=0; $i < count($correosasignados); $i++) { 
						$mail->addAddress($correosasignados[$i]);
					}
				}
			    $mail->Subject = 'NOTIFICACIÓN DE '.strtoupper($this->_tnovedad).' REPORTADA';
			    $mail->Body    = $body;
			    $envios2 = $mail->send();

			    /*===========================================================
			    =            NOTIFICACION AL USUARIO RESPONSABLE            =
			    ===========================================================*/
			 //    $body = 'Estimado/a,<br><br>Es una prueba no responder el correo.';
			 //    $mail->ClearAddresses();
				// if (count($correosResponsables) > 0) {	
				// 	for ($i=0; $i < count($correosResponsables); $i++) { 
				// 		$mail->addAddress($correosResponsables[$i]);
				// 	}
				// }
			 //    $mail->Subject = 'NOTIFICACIÓN DE '.strtoupper($this->_tnovedad).' REPORTADA';
			 //    $mail->Body    = $body;
			 //    $envios3 = $mail->send();
			    
			    if ($envios1 && $envios2) {
			    	echo 1;
			    }else {
			    	2;
			    }
				
			}
		

		
		

	}
}

if (isset($_POST['fecharegistro'])) {
	$insertarForm = new AjaxFormulario();
	$insertarForm -> _fecha  = $_POST['fecharegistro'];
	$insertarForm -> _servicio  = $_POST['servicio'];
	$insertarForm -> _detalleOtas  = $_POST['detalleotras'];
	$insertarForm -> _ciudad  = $_POST['ciudad'];
	$insertarForm -> _tnovedad  = $_POST['tnovedad'];
	$insertarForm -> _nombres  = $_POST['nombres'];
	$insertarForm -> _organizacion  = $_POST['organizacion'];
	$insertarForm -> _detalle  = $_POST['detalle'];
	$insertarForm -> _correos  = $_POST['correos'];
	$insertarForm -> _celular  = $_POST['celular'];
	$insertarForm -> _fileevidencia  = isset($_FILES['fileevidencia']) ? $_FILES['fileevidencia'] : null;
	$insertarForm -> ajaxIngresarForm();
}