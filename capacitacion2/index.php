<!DOCTYPE html>
<html lang="es" >
<head>
  <meta charset="UTF-8">
  <title>PORTAL ACCESO A TERCEROS</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet"><link rel="stylesheet" href="./style.css">

  <style> 
body {
    
background-image: url("../img/imglogin.jpg");
  /*
  background-image: url("assets/images/logologin3.jpg");
  background-image: url("assets/images/loginfondo.jpg");*/
  background-color: #cccccc;
        background-size:100% 100%;
  background-repeat: no-repeat;
}
</style>

</head>

<body>
<!-- partial:index.partial.html -->
<div class="container">
    <div class="wrapper">
      <ul class="steps">
      <li  class="is-active">Datos Personales</li>
      <li  class="">Capacitación</li>
      <li  class="">Pregunta #1</li>
      <li>Pregunta #2</li>
      <li>Pregunta #3</li>
      <li>Pregunta #4</li>
      <li>Pregunta #5</li>
      <li>Pregunta #6</li>
      <li>Pregunta #7</li>
      <li>Pregunta #8</li>
      <li>Pregunta #9</li>
      <li>Pregunta #10</li>

      </ul>
      <form class="form-wrapper">
      <fieldset class="section  is-active">
          <h3>Ingrese la siguiente información</h3>
          <div class="row cf">
            <div class="twelve col">
            <label for="r11">
                <h4>Nombre</h4>
              </label>
               <input type="text"  name="nombre" id="nombre" >
            </div>

            <div class="twelve col">
            <label for="r11">
                <h4>Cédula</h4>
              </label>
               <input type="text" onfocus="" name="ced" id="nocedmbre" >
            </div>

            <div class="twelve col">
            <label for="r11">
                <h4>Cargo</h4>
              </label>
               <input type="text" onfocus="" name="nombre" id="nombre" >
            </div>
            <div class="twelve col">
            <label for="r11">
                <h4>Centro de Distribución (CD)</h4>
              </label>
               <select name="nombre" id="nombre"  class="form-control">
                <option>Guayaquil</option>
                <option>UIO</option>
               </select>
            </div>

            <div class="twelve col">
            <label for="r11">
                <h4>Trabajo a realizar</h4>
              </label>
               <select name="nombre" id="nombre"  class="form-control">
                <option>OP1</option>
                <option>OP2</option>
               </select>
            </div>

            <div class="twelve col">
            <label for="r11">
                <h4>Observaciones</h4>
              </label>
              <input type="text" onfocus="" name="obs" id="obs" >
            </div>

          </div>
          <div class="button">Empezar!</div>
        </fieldset>


        
        <fieldset class="section"  width="800" height="400">

        <iframe src="index.html"  width="800" height="700"></iframe>
<?php 
//require 'index.html';
?>
<div class="button">Siguiente!</div>

</fieldset>



         <fieldset class="section">
          <h3>Qué equipo de protección personal debo utilizar al ingresar a las operaciones?</h3>
          <div class="row cf">
            <div class="four col">
              <input type="radio"  name="r1[]" id="r11" >
              <label for="r11">
                <h4>Calzado de seguridad + cofia</h4>
              </label>
            </div>
            <div class="four col">
              <input type="radio" name="r1[]" id="r12"><label for="r12">
              <h4>Calzado de seguridad + Chaleco o ropa reflectiva + casco + mascarilla</h4>
              </label>
            </div>
            <div class="four col">
              <input type="radio" name="r1[]" id="r13"><label for="r13">
                <h4>Ninguno/a</h4>
              </label>
            </div>
          </div>
          <div class="button">Siguiente!</div>
        </fieldset>




        
        <fieldset class="section">
          <h3>La siguiente señalética es de tipo:</h3>
          <div class="row cf">
            <div class="four col">
              <input type="radio" name="r2[]" id="r21" >
              <label for="r21">
                <h4>Advertencia</h4>
              </label>
            </div>
            <div class="four col">
              <input type="radio" name="r2[]" id="r22">
              <label for="r22">
                <h4>Prohibición</h4>
              </label>
            </div>
            <div class="four col">
              <input type="radio" name="r2[]" id="r23">
              <label for="r23">
                <h4>Ninguno/a</h4>
              </label>
            </div>
          </div>
          <div class="button">Siguiente!</div>
        </fieldset>

        <fieldset class="section">
          <h3>Puedo hacer uso de mi equipo celular en almacén sin problema?</h3>
          <div class="row cf">
            <div class="six col">
              <input type="radio" name="r2[]" id="r21" >
              <label for="r21">
                <h4>Verdadero</h4>
              </label>
            </div>
            <div class="six col">
              <input type="radio" name="r2[]" id="r22">
              <label for="r22">
                <h4>Falso</h4>
              </label>
            </div>
          </div>
          <div class="button">Siguiente!</div>
        </fieldset>

        <fieldset class="section">
          <h3>El riesgo es:</h3>
          <div class="row cf">
            <div class="five col">
              <input type="radio" name="r2[]" id="r21" >
              <label for="r21">
              <h4>Situación o característica intrínseca de algo capaz de ocasionar daños a las personas, equipos, procesos y ambiente.</h4>
     </label>
            </div>
            <div class="five col">
              <input type="radio" name="r2[]" id="r22">
              <label for="r22">
              <h4>Probabilidad de que un peligro s ematerialice en determinadas condiciones y genere daños a las personas, equipos y al ambiente.</h4>
    </label>
            </div>

            <div class="two col">
              <input type="radio" name="r2[]" id="r22">
              <label for="r22">
              <h4>Ninguna</h4>
 </label>
            </div>
            
          </div>
          <div class="button">Siguiente!</div>
        </fieldset>
        
        <fieldset class="section">
          <h3>La condición subestándar o insegura es:</h3>
          <div class="row cf">
            <div class="five col">
              <input type="radio" name="r2[]" id="r21" >
              <label for="r21">
              <h4>Toda condición en el entorno del trabajo que puede causar un accidente.</h4>
     </label>
            </div>
            <div class="five col">
              <input type="radio" name="r2[]" id="r22">
              <label for="r22">
              <h4>Todas las actividades que causan accidentes de trabajo.</h4>
    </label>
            </div>

            <div class="two col">
              <input type="radio" name="r2[]" id="r22">
              <label for="r22">
              <h4>Ninguna</h4>
 </label>
            </div>
            
          </div>
          <div class="button">Siguiente!</div>
        </fieldset>

        <fieldset class="section">
          <h3>El accidente es:</h3>
          <div class="row cf">
            <div class="five col">
              <input type="radio" name="r2[]" id="r21" >
              <label for="r21">
              <h4>Suceso repentino que no trae afectaciones a la salud de los trabajadores.</h4>
     </label>
            </div>
            <div class="five col">
              <input type="radio" name="r2[]" id="r22">
              <label for="r22">
              <h4>Todo suceso repentino que sobrevenga por causa o con ocasión del trabajo y que produzca en el trabajador una lesión orgánica, peturbación funcional, invalidez o la muerte.</h4>
    </label>
            </div>

            <div class="two col">
              <input type="radio" name="r2[]" id="r22">
              <label for="r22">
              <h4>Ninguna</h4>
 </label>
            </div>
            
          </div>
          <div class="button">Siguiente!</div>
        </fieldset>


        <fieldset class="section">
          <h3>Postura forzada, esfuerzo, manipulación de cargas y movimiento repetitivo, se relaciona con el riesgo:</h3>
          <div class="row cf">
            <div class="four col">
              <input type="radio" name="r2[]" id="r21" >
              <label for="r21">
              <h4>Físico</h4>
     </label>
            </div>
            <div class="four col">
              <input type="radio" name="r2[]" id="r22">
              <label for="r22">
              <h4>Químico</h4>
    </label>
            </div>

            <div class="four col">
              <input type="radio" name="r2[]" id="r22">
              <label for="r22">
              <h4>Ninguna</h4>
 </label>
            </div>
            
          </div>
          <div class="button">Siguiente!</div>
        </fieldset>

        <fieldset class="section">
          <h3>La siguiente señalética hace referencia al Riesgo:</h3>
          <div class="row cf">
            <div class="four col">
              <input type="radio" name="r2[]" id="r21" >
              <label for="r21">
              <h4>Ergonómico</h4>
     </label>
            </div>
            <div class="four col">
              <input type="radio" name="r2[]" id="r22">
              <label for="r22">
              <h4>Mecánico</h4>
    </label>
            </div>

            <div class="four col">
              <input type="radio" name="r2[]" id="r22">
              <label for="r22">
              <h4>Psicosocial</h4>
 </label>
            </div>
            
          </div>
          <div class="button">Siguiente!</div>
        </fieldset>

        <fieldset class="section">
          <h3>Seleccione un trabajo considerado como riesgo especial:</h3>
          <div class="row cf">
            <div class="four col">
              <input type="radio" name="r2[]" id="r21" >
              <label for="r21">
              <h4>Estiba</h4>
     </label>
            </div>
            <div class="four col">
              <input type="radio" name="r2[]" id="r22">
              <label for="r22">
              <h4>Trabajos en altura</h4>
    </label>
            </div>

            <div class="four col">
              <input type="radio" name="r2[]" id="r22">
              <label for="r22">
              <h4>Limpieza</h4>
 </label>
            </div>
            
          </div>
          <div class="button">Siguiente!</div>
        </fieldset>

        <fieldset class="section">
          <h3>Seleccione una de las prohibiciones al ingreso a las instalaciones de Ransa:</h3>
          <div class="row cf">
            <div class="four col">
              <input type="radio" name="r2[]" id="r21" >
              <label for="r21">
              <h4>Prohibido mantener reuniones.</h4>
     </label>
            </div>
            <div class="four col">
              <input type="radio" name="r2[]" id="r22">
              <label for="r22">
              <h4>Prohibido el ingreso y consumo de alimentos.</h4>
    </label>
            </div>

            <div class="four col">
              <input type="radio" name="r2[]" id="r22">
              <label for="r22">
              <h4>Ninguna</h4>
 </label>
            </div>
            
          </div>
          <div class="button">Finalizar!</div>
        </fieldset>

        <fieldset class="section">
          <h3>Datos enviados!</h3>
          <p>Por favor, después de responder las preguntas, acerquese a Garita para continuar con el acceso.</p>
          <div class="button" >Entendido!</div>
        </fieldset>
      </form>
    </div>
  </div>
<!-- partial -->
<script  src="./script.js"></script>
<script src='../plugins/jquery/jquery.min.js'></script><script  src="./script.js"></script>

</body>
</html>
