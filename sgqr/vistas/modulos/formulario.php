<div class="container-fluid">
  <div class="border-bottom shadow-sm pb-4 pt-2 row text-white" style="background:#009A3F">
    <div class=" col-md-3 pt-2 logo">
      <img width="300" src="<?php echo $url;?>vistas/img/plantilla/logos/logotipo2.png">
    </div>
    <div class="col-md-6 text-center titulo">
      <h1>Registro de quejas y reclamos</h1>
      <h3>Ransa Ecuador</h3>
    </div>
    <div class="col-md-12 text-center lead msjbienvenida">
      <p>Bienvenido a nuestro sistema de registro de quejas y reclamos. Éste es el primer paso para procesar su
        solicitud.<br>
        Por favor ingrese los datos requeridos y nuestro equipo trabajará para solucionar su novedad y brindarle una
        pronta respuesta.<br> El registro tardará aproximadamente 4 minutos en completarse agradecemos gentilmente de su
        tiempo.</p>
    </div>
  </div>
  <form method="POST" id="formQR" action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF"]); ?>">
    <div class="row">
      <div class=" container pt-5 d-flex justify-content-center container-form mb-5">
        
        <div class="border rounded shadow p-3 col-md-6">
          <div class="col-md-12 pb-4 float-end">
            <a href="https://www.ransa.biz/politica-de-proteccion-de-datos-ecuador/" target="_blank"
              class="float-end btn btn-warning">Politicas de Protección de datos</a>
          </div>
          <div class="col-md-12 border-bottom text-center">
            <h3>Registro de Información</h3>
          </div>
          <div class=" col-md-12 mt-5 cont-fech pb-4">
            <div class="form-floating mb-3">
              <input type="text" readonly class="datemes form-control" name="fechaNovedad" font-awesome="true"
                id="fechaNovedad" placeholder="____-__-__">
              <label class="text-muted" for="fechaNovedad">*Por favor ingrese la fecha en que se presento la novedad que
                desea reportar:</label>
            </div>
          </div>
          <div class="col-md-12 pb-4">
            <label class="text-muted form-label" for="">*Por favor indique ¿En qué servicio brindado por RANSA presento
              la novedad?</label>
            <select class="form-select form-control chosenmultiple" data-placeholder="Escoge una o varias opciones"
              multiple="multiple" name="selservicio" id="selservicio">
              <?php 
              $servicosRansa = ControladorServiciosRansa::ctrConsultarServiciosRansa("","");
              for ($i=0; $i < count($servicosRansa) ; $i++) { 
                echo '<option value="'.$servicosRansa[$i]["idservicioransa"].'">'.$servicosRansa[$i]["nombre"].'</option>';
              }

              ?>
            </select>
            <div class="col-md-12 detalleotras">
              <label class="text-muted form-label" for="">*Detalla otras.</label>
              <textarea id="detalleOtras" class=" mt-2 form-control"
                placeholder="Facturacion, Seguridad Fisica, temas administrativos en general, etc.."></textarea>
            </div>

          </div>
          <div class="col-md-12 pb-4">
            <label class="text-muted form-label" for="">*Por favor indique ¿En qué ciudad presentó la novedad?</label>
            <select class="form-select form-control chosenmultiple" data-placeholder="Escoge una o varias opciones"
              id="selciudad" name="selciudad" multiple="multiple">
              <?php
                $ciudad = ControladorCiudad::ctrConsultarCiudad("","");
                for ($i=0; $i < count($ciudad) ; $i++) { 
                  echo '<option value="'.$ciudad[$i]["idciudad"].'">'.$ciudad[$i]["desc_ciudad"].'</option>';
                }
              ?>
            </select>
          </div>
          <div class="col-md-12 pb-4">
            <label class="text-muted form-label col-md-12" for="">*Por favor clasifique la novedad presentada:</label>
            <span class="badge bg-light text-wrap text-secondary">Guía de Clasificación:<br><br>
              <div class="text-start"><strong>-Queja:</strong> Es una expresión de insatisfacción hecha a una organización con respecto a sus
                productos/servicios brindados.<br> <strong>-Reclamo:</strong> Es una expresión de insatisfacción hecha a
                una organización con respecto a sus productos / servicios brindados pero que pide o pretende algún tipo de
                compensación</div>
              </span>
            <select class="col-md-12 form-select mt-2 form-control" id="seltnovedad" name="seltnovedad">
              <option selected>Escoge una opción</option>
              <option value="Queja">Queja</option>
              <option value="Reclamo">Reclamo</option>
            </select>
          </div>
          <div class="col-md-12 pb-4">
            <label class="text-muted form-label col-md-12" for="">* Por favor registre aquí su nombre.</label>
            <input type="text" name="nombreapellido" class="form-control" id="nombreapellido"
              placeholder="Nombres y Apellidos completos">
          </div>
          <div class="col-md-12 pb-4">
            <label class="text-muted form-label col-md-12" for="">* ¿A qué cliente u organización usted
              pertenece?.</label>
            <input type="text" class="form-control" name="organizacion" id="organizacion"
              placeholder="Cliente u organización">
          </div>
          <div class="col-md-12 pb-4">
            <label class="text-muted form-label col-md-12" for="">*En este espacio, por favor detalle la novedad
              presentada.</label>
            <textarea id="detallenovedad" name="detallenovedad" class="form-control"></textarea>
          </div>
          <div class="col-md-12 pb-4">
            <label class="text-muted form-label col-md-12" for="">* Por favor registre el/los correo(s) electrónico(s)
              al que desee que se envíe la respuesta a su queja o reclamo. ((DIGITE EL CORREO PARA RECIBIR RESPUESTA Y
              PULSE ENTER))</label>
            <input type="text" class="multipleinput" data-role="tagsinput" name="inputcorreos" id="inputcorreos">
          </div>
          <div class="col-md-12 pb-4">
            <label class="text-muted form-label col-md-12" for="">* Por favor registre aquí el número de teléfono al que
              podamos contactarlo:</label>
            <input type="text" name="celular" class="form-control celular" id="celular">
          </div>
          <div class="col-md-12 pb-4">
            <label class="text-muted form-label col-md-12" for="">Por favor adjuntar si existe algún soporte de Novedad
              reportada.</label>
            <div class="col-md-12 pt-3">
              <input class="form-control" name="soporte" type="file" id="soporte">
            </div>

          </div>
        </div>
      </div>
      <!--       <div class="container d-flex justify-content-center ">
        <div class="w-50 bg-light">
          Este contenido lo creó el propietario del formulario. Los datos que envíes se enviarán al propietario del formulario. Microsoft no es responsable de las prácticas de privacidad o seguridad de sus clientes, incluidas las que adopte el propietario de este formulario. Nunca des tu contraseña.  
        </div>
        
      </div> -->
      <div class="col-md-12 pt-5" align="center">
        <div class="politicas">

        </div>
        <button type="button" class="btn btn-primary btnRegistroqr">Registrar</button>
      </div>
    </div>
  </form>
</div>

<div id="conte_loading" class="conte_loading">
  <div id="cont_gif">
    <img src="<?php echo $url.'vistas/img/plantilla/logos/Ripple-1s-200px.gif'?>">
  </div>
</div>