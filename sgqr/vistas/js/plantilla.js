var rutaOculta = $("#rutaOculta").val();
/*===============================================
=            SELECCIONAR DÍA DEL MES            =
===============================================*/
$('.datemes').datetimepicker({
	startView: 2,
	autoclose: true,
	minView: 2,
	maxView: 2,
	language: 'es',
    format: "dd-mm-yyyy"
})
/*====================================================
=            FUNCION PARA VALIDAR CORREOS            =
====================================================*/
function validateEmail(email) {
       var regixExp = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
      // $(".reqEmail").css("border","solid 1px red");
       $("#ReceAppEmail").html("Invalid Email!!");
       return regixExp.test(email);
}
/*=============================================
=            SELECT MULTIPLE            =
=============================================*/
$(".chosenmultiple").chosen();
/*==================================
=            TAG INPUTS            =
==================================*/
$(".multipleinput").tagsinput();
/*=========================================
=            MASK DE TELEFONOS            =
=========================================*/
$('.celular').mask('000 000 0000');







