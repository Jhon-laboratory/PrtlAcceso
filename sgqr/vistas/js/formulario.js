/*=========================================================
=            MOSTRAR EL TEXTO AL COLOCAR OTRAS            =
=========================================================*/
$("#selservicio").chosen().change(function(e,valor){
	var result = $("#selservicio option[value="+valor.selected+"]").text()
	if (result == "Otros") {
		$(".detalleotras").show();
	}else{
		$(".detalleotras").hide();
	}
	
});


/*================================================================
=            CABECERA PARA LOS MSJ CON EL ICONO RANSA            =
================================================================*/
if(!alertify.msjNotificacion){
//define a new errorAlert base on alert
alertify.dialog('msjNotificacion',function factory(){
return{
        build:function(){
            var errorHeader = '<img src="'+rutaOculta+'vistas/img/icono.png"> Sistema Quejas y Reclamos';
            this.setHeader(errorHeader);
        }
    };
},true,'alert');
}
/*=============================================
=            VALIDACION DE CORREOS            =
=============================================*/
$("#inputcorreos").on('beforeItemAdd', function(event) {
/*=====  VALIDAMOS SI ES CORREO EN CASO DE NO SER CORREO NO SE AGREGA  ======*/
	if (!validateEmail(event.item)){
	event.cancel =true;
	
//launch it.
// since this was transient, we can launch another instance at the same time.
alertify
    .msjNotificacion("El correo de electrónico no cumple con su el formato correcto, por favor vuelva a intentarlo!");               
	}
});
/*===========================================================
=            FUNCION PARA HACER SUBMIT EN FORMULARIO            =
===========================================================*/
$(".btnRegistroqr").click(function(){
	/* OBTENER DATOS DEL FORMULARIO */
	var fecha = $("#fechaNovedad").val();
	var servicio = $("#selservicio option:selected").toArray().map(item => item.value); // obtener todos los valores seleccionados en un array
	var detalleotras = $("#detalleOtras").val();
	var ciudad = $("#selciudad option:selected").toArray().map(item => item.value); // obtener todos los valores seleccionados en un array
	var tnovedad = $("#seltnovedad option:selected").val();
	var nombres = $("#nombreapellido").val();
	var organizacion = $("#organizacion").val();
	var detalle = $("#detallenovedad").val();
	var correos = $("#inputcorreos").tagsinput('items');
	var celular = $("#celular").val();
	var fileevidencia = $("#soporte")[0].files[0];
	if (fecha != "" && servicio.length != 0 && ciudad != "Escoge una opción" && tnovedad != "" && nombres != "" && organizacion != "" && detalle != "" && correos != "" && celular != "") {
		/* ENVIAMOS AL SERVIDOR LOS DATOS CON AJAX */
		var datos = new FormData();
        datos.append("fecharegistro",fecha);
        datos.append("servicio",JSON.stringify(servicio));
        datos.append("detalleotras",detalleotras);
        datos.append("ciudad",JSON.stringify(ciudad));
        datos.append("tnovedad",tnovedad);
        datos.append("nombres",nombres);
        datos.append("organizacion",organizacion);
        datos.append("detalle",detalle);
        datos.append("correos",JSON.stringify(correos));
        datos.append("celular",celular);
        datos.append("fileevidencia",fileevidencia);

	    $.ajax({
	      data: datos,
	      url: rutaOculta+"ajax/formulario.ajax.php",
	      type: "POST",
	      contentType: false,
	      processData: false,
		  //beforeSend: function(){
			  // document.getElementById("conte_loading").style.display = "block";
		  //},
	      success: function(respuesta) {
	      	if (respuesta == 1){
				document.getElementById("formQR").reset();
				$(".chosenmultiple").trigger("chosen:updated");//reiniciar servicio
				$('#inputcorreos').tagsinput('removeAll');
				//document.getElementById("conte_loading").style.display = "none";
	      	}else{
	      		alertify.msjNotificacion("No se ha podido enviar la solicitud correctamente");
	      	}

	      }

	    });
		
	}else{
		alertify.msjNotificacion("Es Necesario completar todos los campos obligatorios");
		return false;
	}

	
})



