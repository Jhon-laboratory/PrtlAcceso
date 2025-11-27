


<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>



     <!-- Include Select2 js library and its CSS files -->
     <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
     <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>



<title>Capacitación y Evaluación</title>
<style>
  
  </style>
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
<form class="row g-12" id="registro1" name="registro1" >
  <div class="col-md-5">
    <label for="inputEmail4" class="form-label">Nombre<span style="color:#ff0000;">*</span></label>
    <input type="text"   name="nombre" id="nombre"  onblur="llamarlog('Nombres: '  +this.value);" class="form-control" placeholder="Ingrese su nombre..." aria-label="City">
  </div>

  <div class="col-3">
    <label for="inputAddress2" class="form-label">Nacionalidad<span style="color:#ff0000;">*</span></label>
    <select  name="nacionalidad" id="nacionalidad"  onblur="llamarlog('Nacionalidad seleccionada: ' + this.value)"  class="form-select">
                    <option value="1">Ecuatoriano/a</option>
                    <option value="2">Extranjero</option>
               </select>
              </div>

  <div class="col-md-3">
    <label for="inputPassword4" class="form-label">Cédula<span style="color:#ff0000;">*</span></label>
    <input type="text"   name="cedula" minlength="8" onblur="llamarlog('Cedula: '  +this.value);validarnombres(this.value);"  onkeypress="return valideKey(event);"  maxlength="10" id="cedula" class="form-control" placeholder="Ingrese su cédula..." aria-label="State">
  </div>
  <div class="col-4">
    <label for="inputAddress" class="form-label">Cargo</label>
    <input type="text"   name="cargo" id="cargo"  onblur="llamarlog('Cargo: ' + this.value)"  class="form-control" placeholder="Ingrese su cargo..." aria-label="Zip">
  </div>


  <div class="col-3">
    <label for="inputAddress2" class="form-label">CD<span style="color:#ff0000;">*</span></label>
    <select  onblur="llamarlog('CD seleccionada: ' + this.value)"  name="cd" id="cd"  class="form-select">
      <option value="">Seleccione una opción...</option>
    <option>Guayaquil CD1: Almacenes</option>
                    <option>Quito CD Parque Industrial Sur - Guamaní</option>
                    
    <option>Manta</option>
    <option>Machala</option>
    <option>Babahoyo</option>
    <option>Milagro</option>
               </select>
              </div>
  <div class="col-md-3">
    <label for="inputCity" class="form-label">Trabajo a realizar<span style="color:#ff0000;">*</span></label>

    <select  onblur="llamarlog('Trabajo seleccionado: ' + this.value)"  name="trabajo" id="trabajo"  class="form-select">      
                <option>Visita a Almacén</option>
                <option>Visita a Administración</option>
                <option>Visita en el Comedor</option>
                <option>Visita al Patio de Maniobra</option>
                <option>Visita Posterior del Almacén</option>
                <option>Cotización de Trabajo</option>
                <option>Trabajo en Altura</option>
                <option>Trabajo Eléctrico</option>
                <option>Trabajo en Caliente</option>
                <option>Trabajo en el Generador Eléctrico</option>
                <option>Trabajo en el Cuarto de Bomba</option>
                <option>Estiba</option>
                <option>Maquila</option>
                <option>Mantenimiento</option>
                <option>Alimentación</option>
                <option>Aseo</option>
                <option>Complementarios</option>
                <option>Trabajos Varios</option>
                <option>Retiro y/o Entrega de Mercadería</option>
               </select>
              </div>

              <div class="col-md-6">
    <label for="inputCity" class="form-label">Nombre de la persona a visitar</label>
    
      <select  onblur="llamarlog('Persona a visitar seleccionada: ' + this.value)" name="personavisita" id="personavisita"  class="form-select">    
      <option value="noaplica">Seleccione una opción...</option>  
<option>Alberto Segundo Palta Tangua</option>
<option>Ana Maria Zapata Castro</option>
<option>Andres Galeas Atiencia</option>
<option>Angelica Patricia Montenegro Guaraca</option>
<option>Anthony William Moncayo Aristega</option>
<option>Atención al Cliente EC</option>
<option>Beydy Mariuxi Moreira Macias</option>
<option>Carlos Vinicio Lasinquiza Jailaca</option>
<option>Charle Jonathan Bozada Perez</option>
<option>Charlie Leon Toledo</option>
<option>Christian Salvador Cañar Mena</option>
<option>Cristian Byron Encalada Castro</option>
<option>Cristian Eduardo Moreta Tipan</option>
<option>Cristian Emanuel Armijos Lara</option>
<option>Dario Javier Paz Anchundia</option>
<option>Darmin Vera Torres</option>
<option>Darwin Leonel Chele Chilan</option>
<option>Diana Indelira Parraga Olvera</option>
<option>Diego Marcelo Carchichabla Carchichabla</option>
<option>Eduardo Tene Soque</option>
<option>Emanuel Jusef Vera Vera</option>
<option>Emilio César Sandoval Chalén</option>
<option>Erick Robert Baque Choez</option>
<option>Ericka Marilin Coll Soliz</option>
<option>Erwin Fernando Figueroa Barahona</option>
<option>Esteban Andrés Dorado Montoya</option>
<option>Evelyn Lizette Ganan Rugel</option>
<option>Fabian Alejandro Tandazo Tandazo</option>
<option>Franklin Dennis Gamboa Medina</option>
<option>Franklin Eduardo Vega Honores</option>
<option>Freddy Arturo Paladines Larco</option>
<option>Gabriel Alexander Perez Aguay</option>
<option>Gabriel Danilo Correa Freire</option>
<option>Geovanny Carguaquishpe Garciaguido</option>
<option>Geovanny Santiago Huaraca Cruz</option>
<option>German Rolando Espinosa Ambuludi</option>
<option>Jaime Huera Cuasapaz</option>
<option>Jandry Wilmer Chele Tumbaco</option>
<option>Jazmin Esperanza Borja Espinoza</option>
<option>Jeimy Geovanna Vivar Murillo</option>
<option>Jeronimo Oswaldo Sanchez Salazar</option>
<option>Jesus Gregorio Pachay Hernandez</option>
<option>Jhon Kennett Figueroa Tavarez</option>
<option>Jordy Alexander Cefla Valdivieso</option>
<option>Jordy Jair Quimis Castro</option>
<option>Jorge Antonio Pivaque Rodriguez</option>
<option>Jorge Miguel Monserratte Contreras</option>
<option>Jose Diogenes Vega Guaman</option>
<option>Jose Luis Rojano Guaña</option>
<option>Juan Carlos Rugel Torres</option>
<option>Juan Plutarco Moran Retto</option>
<option>Kasby Domenica Gonzalez Sotomayor</option>
<option>Kelvin Voltaire Quichimbo Rodriguez</option>
<option>Kenneth Josue Choez Huayamave</option>
<option>Kevin Andres Siñalin Aguayza</option>
<option>Kevin Javier Gavilanez Guaman</option>
<option>Kevin Ricardo Sevilla Ochoa</option>
<option>Lenin Jeison Itaz Chango</option>
<option>Lidise Janeth Ascencio Mero</option>
<option>Luis Alberto Cabrera Arellano</option>
<option>Luis Alexander Beltran Lozano</option>
<option>Luis Muñoz de la Torre</option>
<option>Luis Vicente Carchipulla Moya</option>
<option>Magaly Marlene Guzman Quimi</option>
<option>Maitte Margarita Montalvo Tutiven</option>
<option>Maria Gabriela Alvarado Mendoza</option>
<option>Mario Javier Taco Paca</option>
<option>Marlon Bryan Quijije Acebo</option>
<option>Marlon Javier Santana Chele</option>
<option>Martha Cecilia Borbor Aldaz</option>
<option>Martin Kleber Anchundia Arreaga</option>
<option>Miguel Angel Quispe Chiguano</option>
<option>Miguel Angel Ronquillo Franco</option>
<option>Odalys Lorena Cortez Huacon</option>
<option>Oswaldo Jose Campos Meza</option>
<option>Pamela Giulyana Ordoñez Acosta</option>
<option>Paulina Betsabe Samaniego Cañar</option>
<option>Pedro Pablo Angulo Mora</option>
<option>Pedro Raul Gonzalez Ramos</option>
<option>Richar Alexander Perez Villamar</option>
<option>Ronald Ramon Solis Burgos</option>
<option>Ronny Javier Barzola Chavez</option>
<option>Rosa Lastenia Tumbaco Mejía</option>
<option>Sandra Catalina Arango Sanchez</option>
<option>Sonnia Veronica Zapata Alarcon</option>
<option>Steeven Ricardo Lopez Gutierrez</option>
<option>Steven Bryan Valarezo Moncayo</option>
<option>Steven Ronaldo Montenegro Torres</option>
<option>Stiven Samuel Segura Santana</option>
<option>Tania Elizabeth Mora Garcia</option>
<option>Tom Enrique Calderon Ramos</option>
<option>Walter Emilio Fuentes Bustos</option>
<option>William Gerardo Gonzaga Martinez</option>
<option>William Romario Pincay Delgado</option>
<option>Wilmer Wilmington Cruz Hinostroza</option>
<option>Yaldri Manuel Arias Yagual</option>
<option>Yessica Lastenia Almeida Ortega</option>
<option>Rosa Angelica Guerrero Litardo</option>
<option>Xavier Alexander Gonzalez Carnedas</option>
<option>Bianca Denisse Galarraga Peña</option>

               </select>

              </div>

  <div class="col-md-12">
    <label for="inputState" class="form-label">Observaciones</label>
    <textarea  onblur="llamarlog('Observaciones: '  +this.value);" type="text" class="form-control"  name="obs" id="obs" ></textarea>
  </div>
  <br>



  <div class="col-md-12">
  <label class=" btn-outline-success"  for="checksi">
  <input onclick="validarcheck()" type="checkbox" class="form"  name="checksi" id="checksi" value="1">
  Acepto términos, condiciones y autorización para el tratamiento de datos por RANSA.
              </label>
</label>
  </div>
  <a href="https://www.ransa.biz/wp-content/uploads/2024/06/Pol%C3%ADtica-PDP-Proveedores-EC-jun2024.pdf" target="_blank">Revisa la política de uso de datos personales (Proveedores) aquí</a>
  <a href="https://www.ransa.biz/wp-content/uploads/2024/06/Pol%C3%ADtica-PDP-Clientes-EC-jun2024.pdf" target="_blank">Revisa la política de uso de datos personales (Clientes) aquí</a>


 

  <div class="col-12">  <br>
    <button type="button" class="btn btn-success" onclick="cambiar(1)" style="background-color: green">Empezar Capacitación!</button>
    <button type="button" class="btn btn-success" onclick="cambiar(2)" style="background-color: #13a72f">Realizar la evaluación!</button>
  </div>

  <br>
<div class="col-12">  <br>
  <p id="textoamostrar" style="color: red"></p></div>
  
</div>




<div class="container" id="div1" style="display: none;">

<div id="carouselExampleFade" class="carousel slide carousel-fade"  data-bs-interval="0"  >
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
    <img src="img/slides/encasodeaccidente.jpg" class="d-block w-100" alt="..." >    </div>

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
    <div class="carousel-item"  data-bs-interval="0">
    <img src="img/slides/libre_humo2.jpg" class="d-block w-100" alt="..." > 
   </div>

   <div class="carousel-item"  data-bs-interval="0">
    <img src="img/slides/Diapositiva45.JPG" class="d-block w-100" alt="..." > 
   </div>
   <div class="carousel-item"  data-bs-interval="0">
   <img src="img/slides/Diapositiva46.JPG" class="d-block w-100" alt="..." > 
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



  <br>  
    <button type="button" class="btn btn-success" onclick="cambiar(2)" style="background-color: #13a72f">Realizar la evaluación!</button>
 
</div>



<div class="container" id="div2" style="display: none;">

    <div id="p1">
<h5>1. Qué equipo de protección personal debo utilizar al ingresar a las operaciones?</h5>
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




<h5>2. La siguiente señalética es de tipo:</h5>
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




<h5>3. Puedo hacer uso de mi equipo celular en almacén sin problema?</h5>
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



<h5>4. El riesgo es:</h5>
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



<h5>5. La condición subestándar o insegura es:</h5>
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


<h5>6. El accidente es:</h5>
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


<h5>7. Postura forzada, esfuerzo, manipulación de cargas y movimiento repetitivo, se relaciona con el riesgo:</h5>
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


<h5>8. La siguiente señalética hace referencia al Riesgo:</h5>
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

<h5>9. Seleccione un trabajo considerado como riesgo especial:</h5>
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


<h5>10. Seleccione una de las prohibiciones al ingreso a las instalaciones de Ransa:</h5>
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
    <button type="button" class="btn btn-info" id="regresar" name="enviardata" onclick="cambiar(0)" style="background-color: #F39200">Regresar a mis datos!</button>
  </div>
<br>
  <div class="col-12">
    <button type="button" class="btn btn-success" id="enviardata" name="enviardata" onclick="cambiar(3)" style="background-color: #13a72f">Enviar respuestas!</button>
  </div>

</div>
</div>
<br><br>





<!-- secciond e modals-->


<!-- Modal -->
<div class="modal fade" id="modal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Resultados de la Evaluación</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <p id="id1"></p>
       <p id="id2"></p>
       <br>
       <p id="id3"></p>
      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>-->
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" style="background-color: #009A3F;">Entendido</button>
      </div>
    </div>
  </div>
</div>




<!-- Modal -->
<div class="modal fade" id="modal2" tabindex="-1" aria-labelledby="ab1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="ab1">CONSENTIMIENTO</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <p id="id1">Por favor, lea la política de uso de datos personales y acepte los términos, condiciones y autorización para el tratamiento de datos por RANSA.</p>
      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>-->
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" style="background-color: #009A3F;">Entendido</button>
      </div>
    </div>
  </div>
</div>


</body>
</html>


<script>

    function cambiar(val){
      const checkbox = document.querySelector('input[name="checksi"]');

if (!checkbox.checked) {
  // The checkbox is not checked
$("#modal2").modal('show'); 
var consentimiento = 0;

} else {
  var consentimiento = 1;
}
var comprobar = $('#nombre').val().length * $('#cedula').val().length * $('#cd').val().length * $('#trabajo').val().length * consentimiento;
    if (comprobar > 0) {

      
      if( $("#nacionalidad").val()==1){ //ecuatoriano

        if( $("#cedula").val().length<10){
  document.getElementById('textoamostrar').innerHTML = 'Recuerde que un número de cédula válido, contiene 10 dígitos.';

  return false;
} 
} 
if( $("#nacionalidad").val()==2){ //ecuatoriano

if( $("#cedula").val().length<8){
document.getElementById('textoamostrar').innerHTML = 'Recuerde que un número de identificación válido, contiene al menos 8 dígitos.';

return false;
} 
} 
   
if(val==0){ //ES 0 = MOSTRAR PAGINA INICIAL
  llamarlog('Clic - Regresar P.Inicial');

    document.getElementById('div0').style.display='inherit';
    document.getElementById('div1').style.display='none';
    document.getElementById('div2').style.display='none';

}

if(val==1){
  llamarlog('Clic - Empezar capacitación');
    document.getElementById('div0').style.display='none';
    document.getElementById('div1').style.display='inherit';
}

if(val==2){
  llamarlog('Clic - Realizar Evaluación');

    document.getElementById('div0').style.display='none';
    document.getElementById('div1').style.display='none';
    document.getElementById('div2').style.display='inherit';
}
    } else {
      document.getElementById('textoamostrar').innerHTML = 'Recuerde ingresar todos los campos con *';
    }
  }

  
  



  


/********************************** registro cargas    ***********************/
/*$(function() {
$('#registro1').submit(function() {
  */
  $(document).on("click", "#enviardata", function () {
llamarlog('Clic -   Enviar Respuestas');
    document.getElementById("enviardata").disabled = true;


    if( $("#nacionalidad").val()==1){ //ecuatoriano

if( $("#cedula").val().length<10){
document.getElementById('textoamostrar').innerHTML = 'Recuerde que un número de cédula válido, contiene 10 dígitos.';

return false;
} 
} 
if( $("#nacionalidad").val()==2){ //ecuatoriano

if( $("#cedula").val().length<8){
document.getElementById('textoamostrar').innerHTML = 'Recuerde que un número de identificación válido, contiene al menos 8 dígitos.';

return false;
} 
} 


var cedula    =  $("#cedula").val();
var nombre    =  $("#nombre").val();
var cargo    =  $("#cargo").val();
var cd    =  $("#cd").val();
var trabajo    =  $("#trabajo").val();
var nacionalidad    =  $("#nacionalidad").val();
var personavisita    =  $("#personavisita").val();
var obs    =  $("#obs").val();
var r1    = document.querySelector('input[name=r1]:checked').value;// $("#r1").val();
var r2    =  document.querySelector('input[name=r2]:checked').value;//// $("#r2").val();
var r3    =  document.querySelector('input[name=r3]:checked').value;// $("#r3").val();
var r10    =  document.querySelector('input[name=r10]:checked').value;// $("#r10").val();
var r4    =  document.querySelector('input[name=r4]:checked').value;// $("#r4").val();
var r5    =  document.querySelector('input[name=r5]:checked').value;// $("#r5").val();
var r6    =  document.querySelector('input[name=r6]:checked').value;// $("#r6").val();
var r7    =  document.querySelector('input[name=r7]:checked').value;// $("#r7").val();
var r8    =  document.querySelector('input[name=r8]:checked').value;// $("#r8").val();
var r9    =  document.querySelector('input[name=r9]:checked').value;// $("#r9").val();

        
            var value = {
              cedula    :  cedula,
              nombre:nombre,
              cargo:cargo,
              cd:cd,
              trabajo:trabajo,
              obs:obs,
              nacionalidad:nacionalidad,
              personavisita:personavisita,
              r1:r1,
              r2:r2,
              r3:r3,
              r10:r10,
              r4:r4,
              r5:r5,
              r6:r6,
              r7:r7,
              r8:r8,
              r9:r9
    };


  $.ajax({
        url: 'envio.php',
        type: 'POST',
        data: value,
        success: function(response) {
const myArray = response.split("|");
document.getElementById('id1').innerHTML =myArray[0];
document.getElementById('id2').innerHTML = myArray[1];
if (myArray[2]<7){
document.getElementById('id3').innerHTML = '<button type="button" class="btn btn-primary"  data-bs-dismiss="modal"  style="background-color: #F39200;">Hacer evaluación nuevamente.</button>' ;
document.getElementById("r11").focus();

llamarlog('Datos enviados');


}
$("#modal1").modal('show'); 

//document.getElementById("enviardata").disabled = false;


        }
    });

         return false;
        
    });



function valideKey(evt){
    
    // code is the decimal ASCII representation of the pressed key.
    var code = (evt.which) ? evt.which : evt.keyCode;
    
    if(code==8) { // backspace.
      return true;
    } else if(code>=48 && code<=57) { // is a number.
      return true;
    } else{ // other keys.
      return false;
    }
}


$(document).ready(function() {
            $('#personavisita').select2({
                placeholder: 'Seleccione una opción...',
                allowClear: true,
                tags: false // With this, you can add data that are not in the select options
            });
        });

        function validarcheck() {
            const checkbox = document.getElementById('checksi');
            const estado = checkbox.checked ? 'Marcado' : 'No marcado';
            // Aquí puedes agregar lógica para enviar el estado a un servidor o realizar otra acción
            llamarlog('Consentimiento: ' + estado);
        }

        function llamarlog(dato){
          var value = {
            dato    :  dato
          }
          $.ajax({
        url: 'log_activity.php',
        type: 'POST',
        data: value,
        success: function(response) {

        }
    });
        }


function validarnombres(dato){
}
/*
          var value = {
            dato    :  dato
          }
          $.ajax({
        url: 'validar.php',
        type: 'GET',
        data: value,
        success: function(response) {
//print_r(responde);
$("#nombre").val(response);

        }
    });
        }*/
       
</script>            