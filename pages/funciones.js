/*=============================================
VERIFICAR ESTATUS DE LA RED
=============================================*/
$.ajaxSetup({

    error: function (jqXHR, textStatus, errorThrown) {


        if (jqXHR.status === 0) {

            NotifiError('Error de red, Problemas con el servicio de internet');
            AlertaExito('EXITO', 'EXITO');

        } else if (jqXHR.status == 404) {

            NotifiError('Servidor no econtrado 404');
            AlertaExito('EXITO', 'EXITO');

        } else if (jqXHR.status == 500) {


            NotifiError('Error interno DEL SERVIDOR... ');

        } else if (textStatus === 'parsererror') {

            console.log("ERROR : " + jqXHR.responseText + "FIN ", errorThrown);
            NotifiError('Error en la respuesta de JOSN verifique la consola .' + jqXHR.responseText);

        } else if (textStatus === 'timeout') {

            NotifiError('Error de tiempo de espera ');

        } else if (textStatus === 'abort') {

            NotifiError('Solicitud de ajax abortada .');

        } else {

            NotifiError('Error no econtrado: ' + jqXHR.responseText);

        }

    }
}); 


function NotifiError(mensaje) {
    var Toast11 = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });
    Toast11.fire({
         icon: 'error',
         title: mensaje
       })
 }

 function NotifiError2(mensaje) {
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });
    Toast.fire({
         icon: 'error',
         title: mensaje
       })
 }

function NotifiExito(mensaje) {
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });
    Toast.fire({
         icon: 'success',
         title: mensaje
       })
}

function AlertaExito(titulo, mensaje) {
    
    $("#mensaje2").hide();
}


function AlertaEspera(mensaje) {

$("#mensaje2").append("<div class='modal1'><div class='center1'> <center> <img src='../../img/gif-load.gif'>Espere porfavor...</center></div></div>");
$("#mensaje2").show();

}


function validaNumericos(event) {
    if(event.charCode >= 48 && event.charCode <= 57){
      return true;
     }
     return false;        
}


function validarEmail() {

    var valor = $("#txt_email").val();
    re=/^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/
	if(!re.exec(valor)){

        NotifiError("La dirección de email es incorrecta.");
	}
	else {
        
	}
  }


 



  function filterFloat(evt,input){
    var key = window.Event ? evt.which : evt.keyCode;    

    
    var chark = String.fromCharCode(key);
    var tempValue = input.value+chark;
    if(key >= 48 && key <= 57){
       
        if(filter(tempValue)=== false){
            return true;
           
        }else{       
            return true;
           
        }
        
    }else{
        
          if(key == 8 || key == 13 || key == 0) {   
          
              return true;   
                      
          }else if(key == 46){
     
                if(filter(tempValue)=== false){
               
                    return true;
                }else{       
                
                    return true;
                }
          }else{
              return false;
              
          }
    }
}
function filter(__val__){
    var preg = /^([0-9]+\.?[0-9]{0,2})$/; 
    if(preg.test(__val__) === true){
        return true;
    }else{
       return false;
    }
    
}

function validar_tab(e) {
    tecla = (document.all) ? e.keyCode : e.which;
    alert(tecla);
} 



function ejecutarap(valor){
    //alert(valor);
            var value = {
              cedula    :  valor
    };

  $.ajax({
        url: 'validar.php',
        type: 'POST',
        data: value,
        success: function(response) {
            if(response==1){
                var parametros =
                {
                    "txt_option": '2',
                    "table": "#table_clientes"
                
                }
                table_clientes(parametros);
            } else {

            }

}
//$("#modal1").modal('show'); 

//document.getElementById("enviardata").disabled = false;

    });

         return false;
        

}