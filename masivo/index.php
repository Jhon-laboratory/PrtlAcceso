

<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<title>Capacitación y Evaluación</title>
</head>
<body>
    
<nav class="navbar" style="background-color: #13a72f">
  <div class="container-fluid">
    <a class="navbar-brand" style="color:white">Inducción, Capacitación y Evaluación - RANSA</a>
    <button class="navbar-toggler" style="border-color: #13a72f;" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
   <img src="img/solor.png" style="background-color: white;">
    </button>

  </div>
</nav>

<div class="container" id="div0" >
<br>
<form class="row g-12" action="envio.php" method="post">


<div class="col-sm-12 col-md-12 col-lg-2">
                  <div class="form-group">
                      <button type="button" id="btn_importar" onclick="document.getElementById('frmExcelImport').style.display='inherit';" class="btn btn-outline-info btn-block btn-flat"><i class="fas fa-file"></i> Importar</button>                    

<form  style="display: none" action="" method="post" name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
            <div>
                <label>Elija Archivo Excel</label> <input type="file" name="file" required=""
                    id="file" accept=".xlsx">
                <br><BR><button type="submit" id="submit" onclick="cargando()" class="mb-xs mt-xs mr-xs btn btn-success"  name="import"
                       >Importar Registros (.xlsx)</button>
                       <button type="button" style="display:none" id="importando"  class="mb-xs mt-xs mr-xs btn btn-info" 
                       >Cargando...</button>
            <hr>

            </div>
</form>
                  </div>
                </div>



  <div class="col-md-5">
    <label for="inputEmail4" class="form-label">Nombre<span style="color:#ff0000;">*</span></label>
    <input type="text"   name="nombre" id="nombre"  class="form-control" placeholder="Ingrese su nombre..." aria-label="City">
  </div>
  <div class="col-md-3">
    <label for="inputPassword4" class="form-label">Cédula<span style="color:#ff0000;">*</span></label>
    <input type="text"   name="cedula" id="cedula" class="form-control" placeholder="Ingrese su cédula..." aria-label="State">
  </div>
  <div class="col-4">
    <label for="inputAddress" class="form-label">Cargo</label>
    <input type="text"   name="cargo" id="cargo"  class="form-control" placeholder="Ingrese su cargo..." aria-label="Zip">
  </div>


  <div class="col-3">
    <label for="inputAddress2" class="form-label">CD<span style="color:#ff0000;">*</span></label>
    <select name="cd" id="cd"  class="form-select">
    <option>Guayaquil CD1: Almacenes</option>
                    <option>Quito CD Parque Industrial Sur - Guamaní</option>
                    
    <option>Manta</option>
    <option>Machala</option>
    <option>Babahoyo</option>
    <option>Milagro</option>

               </select>
              </div>
  <div class="col-md-6">
    <label for="inputCity" class="form-label">Trabajo a realizar<span style="color:#ff0000;">*</span></label>

    <select name="trabajo" id="trabajo"  class="form-select">      
                <option>Visita en Almacén</option>
                <option>Visita en Administración</option>
                <option>Visita en el Comedor</option>
                <option>Visita al Patio de Maniobra</option>
                <option>Visita Posterior del Almacén</option>
                <option>Cotización de Trabajo</option>
                <option>Trabajo en Altura</option>
                <option>Trabajo Eléctrico</option>
                <option>Trabajo en Caliente</option>
                <option>Trabajo en el Generador Eléctrico</option>
                <option>Trabajo en el Cuarto de Bomba</option>
                <option>Trabajos Varios</option>
                
               </select>
              </div>
  <div class="col-md-12">
    <label for="inputState" class="form-label">Observaciones</label>
    <textarea type="text" class="form-control"  name="obs" id="obs" >
    </textarea>
  </div>
  <br>

  <div class="col-12">  <br>
    <button type="button" class="btn btn-success" onclick="cambiar(1)" style="background-color: green">Empezar Capacitación!</button>
    <button type="button" class="btn btn-success" onclick="cambiar(2)" style="background-color: #13a72f">Realizar la evaluación!</button>
  </div>
  <br>

</div>




<div class="container" id="div1" style="display: none;">

<div id="carouselExampleFade" class="carousel slide carousel-fade"  >
  <div class="carousel-inner">
    <div class="carousel-item active">
    <img src="img/slides/Diapositiva1.JPG" class="d-block w-100" alt="..." >
    </div>
    <div class="carousel-item">
    <img src="img/slides/Diapositiva2.JPG" class="d-block w-100" alt="..." >    </div>
    <div class="carousel-item">
    <img src="img/slides/Diapositiva3.JPG" class="d-block w-100" alt="..." >    </div>
    <div class="carousel-item">
    <img src="img/slides/Diapositiva4.JPG" class="d-block w-100" alt="..." >    </div>
    <div class="carousel-item">
    <img src="img/slides/Diapositiva5.JPG" class="d-block w-100" alt="..." >    </div>
    <div class="carousel-item">
    <img src="img/slides/Diapositiva6.JPG" class="d-block w-100" alt="..." >    </div>
    <div class="carousel-item">
    <img src="img/slides/Diapositiva7.JPG" class="d-block w-100" alt="..." >    </div>
    <div class="carousel-item">
    <img src="img/slides/Diapositiva8.JPG" class="d-block w-100" alt="..." >    </div>
    <div class="carousel-item">
    <img src="img/slides/Diapositiva9.JPG" class="d-block w-100" alt="..." >    </div>
    <div class="carousel-item">
    <img src="img/slides/Diapositiva10.JPG" class="d-block w-100" alt="..." >    </div>
    <div class="carousel-item">
    <img src="img/slides/Diapositiva11.JPG" class="d-block w-100" alt="..." >    </div>
    <div class="carousel-item">
    <img src="img/slides/Diapositiva12.JPG" class="d-block w-100" alt="..." >    </div>
    <div class="carousel-item">
    <img src="img/slides/Diapositiva13.JPG" class="d-block w-100" alt="..." >    </div>
    <div class="carousel-item">
    <img src="img/slides/Diapositiva14.JPG" class="d-block w-100" alt="..." >    </div>
    <div class="carousel-item">
    <img src="img/slides/Diapositiva15.JPG" class="d-block w-100" alt="..." >    </div>
    <div class="carousel-item">
    <img src="img/slides/Diapositiva16.JPG" class="d-block w-100" alt="..." >    </div>
    <div class="carousel-item">
    <img src="img/slides/Diapositiva17.JPG" class="d-block w-100" alt="..." >    </div>
    <div class="carousel-item">
    <img src="img/slides/Diapositiva18.JPG" class="d-block w-100" alt="..." >    </div>
    <div class="carousel-item">
    <img src="img/slides/Diapositiva19.JPG" class="d-block w-100" alt="..." >    </div>
    <div class="carousel-item">
    <img src="img/slides/Diapositiva20.JPG" class="d-block w-100" alt="..." >    </div>
    <div class="carousel-item">
    <img src="img/slides/Diapositiva21.JPG" class="d-block w-100" alt="..." >    </div>
    <div class="carousel-item">
    <img src="img/slides/Diapositiva22.JPG" class="d-block w-100" alt="..." >    </div>
    <div class="carousel-item">
    <img src="img/slides/Diapositiva23.JPG" class="d-block w-100" alt="..." >    </div>
    <div class="carousel-item">
    <img src="img/slides/Diapositiva24.JPG" class="d-block w-100" alt="..." >    </div>
    <div class="carousel-item">
    <img src="img/slides/Diapositiva25.JPG" class="d-block w-100" alt="..." >    </div>
    <div class="carousel-item">
    <img src="img/slides/Diapositiva26.JPG" class="d-block w-100" alt="..." >    </div>
    <div class="carousel-item">
    <img src="img/slides/Diapositiva27.JPG" class="d-block w-100" alt="..." >    </div>
    <div class="carousel-item">
    <img src="img/slides/Diapositiva28.JPG" class="d-block w-100" alt="..." >    </div>
    <div class="carousel-item">
    <img src="img/slides/Diapositiva29.JPG" class="d-block w-100" alt="..." >    </div>
    <div class="carousel-item">
    <img src="img/slides/Diapositiva30.JPG" class="d-block w-100" alt="..." >    </div>
    <div class="carousel-item">
    <img src="img/slides/Diapositiva31.JPG" class="d-block w-100" alt="..." >    </div>
    <div class="carousel-item">
    <img src="img/slides/Diapositiva32.JPG" class="d-block w-100" alt="..." >    </div>
    <div class="carousel-item">
    <img src="img/slides/Diapositiva33.JPG" class="d-block w-100" alt="..." >    </div>
    <div class="carousel-item">
    <img src="img/slides/Diapositiva34.JPG" class="d-block w-100" alt="..." >    </div>
    <div class="carousel-item">
    <img src="img/slides/Diapositiva35.JPG" class="d-block w-100" alt="..." >    </div>
    <div class="carousel-item">
    <img src="img/slides/Diapositiva36.JPG" class="d-block w-100" alt="..." >    </div>
    <div class="carousel-item">
    <img src="img/slides/Diapositiva37.JPG" class="d-block w-100" alt="..." >    </div>
    <div class="carousel-item">
    <img src="img/slides/Diapositiva38.JPG" class="d-block w-100" alt="..." >    </div>
    <div class="carousel-item">
    <img src="img/slides/Diapositiva39.JPG" class="d-block w-100" alt="..." >    </div>
    <div class="carousel-item">
    <img src="img/slides/Diapositiva40.JPG" class="d-block w-100" alt="..." >    </div>
    <div class="carousel-item">
    <img src="img/slides/Diapositiva41.JPG" class="d-block w-100" alt="..." >    </div>
    <div class="carousel-item">
    <img src="img/slides/Diapositiva42.JPG" class="d-block w-100" alt="..." >    </div>
    <div class="carousel-item">
    <img src="img/slides/Diapositiva43.JPG" class="d-block w-100" alt="..." >    </div>
    <div class="carousel-item">
    <img src="img/slides/Diapositiva44.JPG" class="d-block w-100" alt="..." >    </div>
    <div class="carousel-item">
    <img src="img/slides/Recomendaciones.JPG" class="d-block w-100" alt="..." >    </div>
    <div class="carousel-item">
    <img src="img/slides/comunicación emergencia.jpg" class="d-block w-100" alt="..." >    </div>
    <div class="carousel-item">
    <img src="img/slides/libre_humo2.jpg" class="d-block w-100" alt="..." > 
    <br>  
    <button type="button" class="btn btn-success" onclick="cambiar(2)" style="background-color: #13a72f">Realizar la evaluación!</button>
  </div>

</div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
    <span style="background-color: #13a72f;"  class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Anterior</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
    <span style="background-color: #13a72f;" class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Siguiente</span>
  </button>
</div>

<div class="container" id="div2" style="display: none;">

    <div id="p1">
<h5>Qué equipo de protección personal debo utilizar al ingresar a las operaciones?</h5>
<input type="radio" class="btn-check"  name="r1" id="r11"  autocomplete="off" value="Calzado de seguridad + cofia" >
              <label class="btn btn-outline-success"  for="r11">
               Calzado de seguridad + cofia
              </label><br>
<br>
<input type="radio" class="btn-check"  name="r1" id="r12"  autocomplete="off" value="Calzado de seguridad + Chaleco o ropa reflectiva + casco + mascarilla" >
              <label class="btn btn-outline-success"  for="r12">
              Calzado de seguridad + Chaleco o ropa reflectiva + casco + mascarilla
              </label><br>
<br>
<input type="radio" class="btn-check"  name="r1" id="r13"  autocomplete="off" value="Ninguno/a">
              <label class="btn btn-outline-success"  for="r13">
              Ninguno/a
              </label>
<br><br>




<h5>La siguiente señalética es de tipo:</h5>
<img src="img/slides/prohibicion.jpg" style="background-color: white;" width="100" height="100">
<br>
<input type="radio" class="btn-check"  name="r2" id="r21"  autocomplete="off" value="Advertencia" >
              <label class="btn btn-outline-success"  for="r21">
              Advertencia
              </label><br>
<br>
<input type="radio" class="btn-check"  name="r2" id="r22"  autocomplete="off" value="Prohibición" >
              <label class="btn btn-outline-success"  for="r22">
              Prohibición
              </label><br>
<br>
<input type="radio" class="btn-check"  name="r2" id="r23"  autocomplete="off" value="Ninguno/a">
              <label class="btn btn-outline-success"  for="r23">
              Ninguno/a
              </label>
<br><br>




<h5>Puedo hacer uso de mi equipo celular en almacén sin problema?</h5>
<input type="radio" class="btn-check"  name="r3" id="r31"  autocomplete="off" value="Verdadero" >
              <label class="btn btn-outline-success"  for="r31">
              Verdadero
              </label><br>
<br>
<input type="radio" class="btn-check"  name="r3" id="r32"  autocomplete="off" value="Falso">
              <label class="btn btn-outline-success"  for="r32">
              Falso
              </label>
<br><br>



<h5>El riesgo es:</h5>
<input type="radio" class="btn-check"  name="r10" id="r101"  autocomplete="off" value="Situación o característica intrínseca de algo capaz de ocasionar daños a las personas, equipos, procesos y ambiente" >
              <label class="btn btn-outline-success"  for="r101">
              Situación o característica intrínseca de algo capaz de ocasionar daños a las personas, equipos, procesos y ambiente
              </label><br>
<br>
<input type="radio" class="btn-check"  name="r10" id="r102"  autocomplete="off" value="Probabilidad de que un peligro se materialice en determinadas condiciones y genere daños a las personas, equipos y al ambiente" >
              <label class="btn btn-outline-success"  for="r102">
              Probabilidad de que un peligro se materialice en determinadas condiciones y genere daños a las personas, equipos y al ambiente
              </label><br>
<br>
<input type="radio" class="btn-check"  name="r10" id="r103"  autocomplete="off" value="Ninguno/a">
              <label class="btn btn-outline-success"  for="r103">
              Ninguno/a
              </label>
<br><br>



<h5>La condición subestándar o insegura es:</h5>
<input type="radio" class="btn-check"  name="r4" id="r41"  autocomplete="off" value="Toda condición en el entorno del trabajo que puede causar un accidente">
              <label class="btn btn-outline-success"  for="r41">
              Toda condición en el entorno del trabajo que puede causar un accidente
              </label><br>
<br>
<input type="radio" class="btn-check"  name="r4" id="r42"  autocomplete="off" value="Todas las actividades que causan accidentes de trabajo" >
              <label class="btn btn-outline-success"  for="r42">
              Todas las actividades que causan accidentes de trabajo
              </label><br>
<br>
<input type="radio" class="btn-check"  name="r4" id="r43"  autocomplete="off" value="Ninguno/a">
              <label class="btn btn-outline-success"  for="r43">
              Ninguno/a
              </label>
<br><br>


<h5>El accidente es:</h5>
<input type="radio" class="btn-check"  name="r5" id="r51"  autocomplete="off" value="Suceso repentino que no trae afectaciones a la salud de los trabajadores" >
              <label class="btn btn-outline-success"  for="r51">
              Suceso repentino que no trae afectaciones a la salud de los trabajadores
              </label><br>
<br>
<input type="radio" class="btn-check"  name="r5" id="r52"  autocomplete="off" value="Todo suceso repentino que sobrevenga por causa o con ocasión del trabajo y que produzca en el trabajador una lesión orgánica, peturbación funcional, invalidez o la muerte">
              <label class="btn btn-outline-success"  for="r52">
              Todo suceso repentino que sobrevenga por causa o con ocasión del trabajo y que produzca en el trabajador una lesión orgánica, peturbación funcional, invalidez o la muerte
              </label><br>
<br>
<input type="radio" class="btn-check"  name="r5" id="r53"  autocomplete="off" value="Ninguno/a">
              <label class="btn btn-outline-success"  for="r53">
              Ninguno/a
              </label>
<br><br>


<h5>Postura forzada, esfuerzo, manipulación de cargas y movimiento repetitivo, se relaciona con el riesgo:</h5>
<input type="radio" class="btn-check"  name="r6" id="r61"  autocomplete="off" value="Físico">
              <label class="btn btn-outline-success"  for="r61">
              Físico
              </label><br>
<br>
<input type="radio" class="btn-check"  name="r6" id="r62"  autocomplete="off" value="Químico">
              <label class="btn btn-outline-success"  for="r62">
              Químico
              </label><br>
<br>
<input type="radio" class="btn-check"  name="r6" id="r63"  autocomplete="off" value="Ninguno/a">
              <label class="btn btn-outline-success"  for="r63">
              Ninguno/a
              </label>
<br><br>


<h5>La siguiente señalética hace referencia al Riesgo:</h5>
<img src="img/slides/mecanico.JPG" style="background-color: white;" width="100" height="100">
<br>
<input type="radio" class="btn-check"  name="r7" id="r71"  autocomplete="off" value="Ergonómico">
              <label class="btn btn-outline-success"  for="r71">
              Ergonómico
              </label><br>
<br>
<input type="radio" class="btn-check"  name="r7" id="r72"  autocomplete="off" value="Mecánico" >
              <label class="btn btn-outline-success"  for="r72">
              Mecánico
              </label><br>
<br>
<input type="radio" class="btn-check"  name="r7" id="r73"  autocomplete="off" value="Psicosocial" >
              <label class="btn btn-outline-success"  for="r73">
              Psicosocial
              </label>
<br><br>

<h5>Seleccione un trabajo considerado como riesgo especial:</h5>
<input type="radio" class="btn-check"  name="r8" id="r81"  autocomplete="off" value="Estiba">
              <label class="btn btn-outline-success"  for="r81">
              Estiba
              </label><br>
<br>
<input type="radio" class="btn-check"  name="r8" id="r82"  autocomplete="off" value="Trabajos en altura" >
              <label class="btn btn-outline-success"  for="r82">
              Trabajos en altura
              </label><br>
<br>
<input type="radio" class="btn-check"  name="r8" id="r83"  autocomplete="off" value="Limpieza" >
              <label class="btn btn-outline-success"  for="r83">
              Limpieza
              </label>
<br><br>


<h5>Seleccione una de las prohibiciones al ingreso a las instalaciones de Ransa:</h5>
<input type="radio" class="btn-check"  name="r9" id="r91"  autocomplete="off" value="Prohibido mantener reuniones">
              <label class="btn btn-outline-success"  for="r91">
              Prohibido mantener reuniones
              </label><br>
<br>
<input type="radio" class="btn-check"  name="r9" id="r92"  autocomplete="off" value="Prohibido el ingreso y consumo de alimentos">
              <label class="btn btn-outline-success"  for="r92">
              Prohibido el ingreso y consumo de alimentos
              </label><br>
<br>
<input type="radio" class="btn-check"  name="r9" id="r93"  autocomplete="off" value="Ninguno/a">
              <label class="btn btn-outline-success"  for="r93">
              Ninguno/a
              </label>
<br><br>




<br>
<div class="col-12">
    <button type="submit" class="btn btn-success" onclick="cambiar(3)" style="background-color: #13a72f">Enviar respuestas!</button>
  </div>
</div>
</div>
<br><br>


</body>
</html>


<script>

    function cambiar(val){
if(val==1){
    document.getElementById('div0').style.display='none';
    document.getElementById('div1').style.display='inherit';
}

if(val==2){
    document.getElementById('div0').style.display='none';
    document.getElementById('div1').style.display='none';
    document.getElementById('div2').style.display='inherit';
}
    }
</script>