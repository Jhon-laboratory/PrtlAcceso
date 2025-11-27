<?php
include('../../Conexion/conexion_mysqli.php');
include('../../Model/Model_gb_global.php');
include('../../control_session.php');
include('../menu.php');
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PORTAL DE ACCESO A TERCEROS</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="../../plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="../../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="../../plugins/bs-stepper/css/bs-stepper.min.css">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="../../plugins/dropzone/min/dropzone.min.css">

   <!-- SweetAlert2 -->
   <link rel="stylesheet" href="../../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">


  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../../dist/css/uikit.css">

<link rel="stylesheet" href="../../dist/css/bebasneue.css">
  <link rel="stylesheet" href="../../css_session/Css.css">
</head>

<body class="hold-transition sidebar-mini sidebar-collapse">
<div id="mensaje2"></div>
  <div class="wrapper">

    <!--  SALIR DEL SISTEMA -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#" >
            <i class="fa fa-user fa-fw"></i> <?php echo  $_SESSION["gb_nombre"]; ?> <b class="caret"></b>
          </a>
          <ul class="dropdown-menu dropdown-user">

            <li><a href="../../session_destroy.php"><i class="fa fa-sign-out fa-fw"></i> Salir</a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
    <!-- FIN SALIR DEL SISTEMA -->

    <!-- INICIO MENU -->
    <aside class="main-sidebar sidebar-light-primary elevation-4">
    <a href="" class="brand-link">
          <img src="../../img/logo.png" style="width: 80%; height: 2%;margin-top: -4px" alt="RANSA">
      </a>
      <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image"  style="display: none;" >
            <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info"  style="display: none;">
            <a href="#" class="d-block"><?php echo  $_SESSION["gb_nombre"]; ?></a>
          </div>
        </div>
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <?php
            sistema_menu(7,51,1);
            ?>



            </li>
          </ul>
        </nav>
      </div>
    </aside>
    <!-- FIN MENU -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

      <!-- INFORMACION UBICACION SISTEMA-->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <!--<h1 class="m-0">Registro/consulta Productos</h1>
-->
            </div>
           <!-- <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">

                <button type="button" class="pull-right btn btn-default" id="sendEmail">Logística
                  <i class="fa fa-arrow-circle-right"></i>
                </button>
                <button type="button" class="pull-right btn btn-default" id="sendEmail">Clientes
                  <i class="fa fa-arrow-circle-right"></i>
              </ol>
            </div>-->
          </div>
        </div>
      </div>
      <!-- FIN INFORMACION UBICACION SISTEMA-->


      <!-- CONTENIDO PAGUINA PRINCIPAL -->

      <div class="content">

      
        <div class="container-fluid">


        <div class="card card-primary card-outline">
        <div class="card-header">
        <h3 class="card-title">
                    <i class="fas fa-address-card"></i>
                    Interfaz de Consulta
                  </h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          
          </div>
        </div>
        <div class="card-body">
        <div class="col-lg-2">

        <!--
          <button type="button" id="btn_actualizarproductos" onclick="registro_proceso()"  class="btn btn-outline-info btn-block btn-flat"><i class="fas fa-update"></i>Actualizar Productos</button>
-->
</div>

        <div class="row">
            <div class="col-lg-3" style="display: none;">

              <div class="card card-primary card-outline">
                <div class="card-header">
                  <h5 class="m-0">Carga de imagenes/fotos</h5>
                </div>
                <div class="card-body">
                  <div class="col-lg-12">

                  <div class="col-sm-12 col-md-12 col-lg-12">
                      <div class="form-group">
                        <strong>Código</strong><span style="color:#ff0000;">*</span></label>
                        <input  readonly="true" disabled type="text" class="form-control" id="txt_identificacion" maxlength="20" autocomplete="off" onkeypress='return validaNumericos(event)' onChange="validar_identificacion(this.value)" />
                      </div>
                    </div>
                  <div class="col-sm-12 col-md-12 col-lg-12">
                      <div class="form-group">
                        <strong>Nombre del Producto</strong><span style="color:#ff0000;">*</span></label>
                        <input type="text"  readonly="true" disabled  class="form-control" id="txt_nombre" autocomplete="off" oninput="this.value = this.value.toUpperCase()" />
                      </div>
                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-12">
                      <div class="form-group">
                        <strong>Imagenes</strong>
                        <input name="image" multiple id="image" type="file" accept="image/*" class="form-control" />  
                      </div>
                    </div>
					
					
			<!--		<div class="col-sm-12 col-md-12 col-lg-12">
                      <div class="form-group">
                        <strong>Ciudad</strong>
                        <input type="text" class="form-control" id="txt_ciudad" autocomplete="off"  oninput="this.value = this.value.toUpperCase()"/>
                      </div>
                    </div>
-->
					
                    <div class="col-sm-12 col-md-12 col-lg-12">
                      <div class="form-group">

                        <br>
                        <div class="text-rihgt" id="create_cliente">
                          
                          <button type="button" id="btn_save_cliente"  class="btn btn-outline-info btn-block btn-flat"><i class="fas fa-save"></i> Cargar imagenes</button>
                        </div>

                        <div class="text-rihgt" id="editar_cliente" style="display: none;">


                          <button type="button" id="btn_editar_cliente"  class="btn btn-outline-info btn-block btn-flat"><i class="fas fa-edit"></i> Cargar imagenes</button>
                        </div>


                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            <div class="col-lg-12">
              <div class="card card-primary card-outline">
                <div class="card-header">
                  <h5 class="m-0">Consulta</h5>
                </div>
                <div class="card-body">


                
                <div class="col-sm-12 col-md-12 col-lg-12">
                      <div class="table-responsive demo-x content">

                        <div class="box-body">

                          <table id="table_clientes" class="table table-bordered text-center tabla_detalle_fp">
                            <thead>
                              <tr>
                              <th style="width:10px">#</th>
                                <th style="width:10px">Nombre</th>
                                <th style="width:10px">Cédula</th>
                                <th style="width:5px">Examen de Seguridad</th>
                                <th style="width:5px">Antecedente</th>
                                <th style="width:10px">Fecha Capacitación</th> <!--ANUAL X ACTIVO O CADUCADO-->
                                <th style="width:10px">Fecha Antecedentes Penales</th> <!--ANUAL X ACTIVO O CADUCADO-->
                                <th style="width:10px">Comentario</th>
                              </tr>
                            </thead>
                            <tbody>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
            </div>
          </div>



          <div class="row" style="display: none;">
            <div class="col-lg-4">

              <div class="card card-primary card-outline">
                <div class="card-header">
                  <h5 class="m-0">Servicio Mensual</h5>
                </div>
                <div class="card-body">
                  <div class="col-lg-12">



                  <div class="col-sm-12 col-md-12 col-lg-12">
                      <div class="form-group">
                        <strong>RUC</strong>
                        <input type="text" class="form-control" id="txt_identificacion_s" autocomplete="off" maxlength="20" readonly="true"/>
                      </div>
                    </div>


                    <div class="col-sm-12 col-md-12 col-lg-12">
                      <div class="form-group">
                        <strong>Nombre</strong>
                        <input type="text" class="form-control" id="txt_cliente" autocomplete="off" readonly="true" oninput="this.value = this.value.toUpperCase()" />
                      </div>
                    </div>

                  <!--<div class="col-sm-12 col-md-12 col-lg-12">
                      <div class="form-group">
                        <strong>Servicio</strong><span style="color:#ff0000;">*</span>
                        <select  id="txt_servicio" class="form-control"   style="width: 100%;" readonly="true" disabled>
                        </select>
                      </div>
                  </div>
                  
                  <div class="col-sm-12 col-md-12 col-lg-12">
                      <div class="form-group">
                        <strong>Ciudad inicio</strong><span style="color:#ff0000;">*</span>
                        <select  id="txt_ciudad_ini"  name="txt_ciudad_ini" class="form-control"   style="width: 100%;" >
                        </select>
                      </div>
                  </div>
				  
				  <div class="col-sm-12 col-md-12 col-lg-12">
                      <div class="form-group">
                        <strong>Zona</strong><span style="color:#ff0000;">*</span>
                        <select  id="txt_zona"  name="txt_zona" class="form-control"   style="width: 100%;" >
                        </select>
                      </div>
                  </div>
				  
				  <div class="col-sm-12 col-md-12 col-lg-12">
                      <div class="form-group">
                        <strong>Ciudad Fin</strong><span style="color:#ff0000;">*</span>
                        <select  id="txt_ciudad_fin"  name="txt_ciudad_fin" class="form-control"   style="width: 100%;" >
                        </select>
                      </div>
                  </div>

                
                    <div class="col-sm-12 col-md-12 col-lg-12">
                      <div class="form-group">
                        <strong>Unidad</strong><span style="color:#ff0000;">*</span>
                        <select  id="txt_unidad" class="form-control select2bs4" style="width: 100%;" >
                        </select>
                        
                      </div>
                    </div>
-->

                    <div class="col-sm-12 col-md-12 col-lg-12">
                      <div class="form-group">
                        <strong>Tipo de Honorario</strong><span style="color:#ff0000;">*</span>
                        <input type="text" class="form-control" id="txt_descripcion" autocomplete="off" oninput="this.value = this.value.toUpperCase()"  />
                      </div>
                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-12">
                      <div class="form-group">
                        <strong>Precio</strong><span style="color:#ff0000;">*</span>
                        <input type="text" class="form-control" id="txt_precio" autocomplete="off" onkeypress="return filterFloat(event,this);"  maxlength="10"/>
                      </div>
                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-12">
                      <div class="form-group">
                        <br>
                        <div class="text-rihgt" id="create_servicio">
                          
                          <button type="button" id="btn_save_servico"  class="btn btn-outline-info btn-block btn-flat"><i class="fas fa-save"></i> Crear Honorario</button>
                        </div>

                        <div class="text-rihgt" id="editar_servico" style="display: none;">


                          <button type="button" id="btn_editar_servicio"  class="btn btn-outline-info btn-block btn-flat"><i class="fas fa-edit"></i> Editar Honorario</button>
                        </div>


                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            <div class="col-lg-8">
              <div class="card card-primary card-outline">
                <div class="card-header">
                  <h5 class="m-0">Consulta de Honorarios</h5>
                </div>
                <div class="card-body">


                
                <div class="col-sm-12 col-md-12 col-lg-12">
                      <div class="table-responsive demo-x content">

                        <div class="box-body">

                          <table id="table_servicios" class="table table-striped table-bordered text-center tabla_detalle_fp">
                            <thead>
                              <tr>
                                <td style="width:10px">#</td>
                                <td style="width:10px">Honorario</td>
                                <!--<td style="width:10px">Detalle</td>
                                <td style="width:10px">Unidad</td>
                                <td style="width:10px">Descripción</td>-->
                                <td style="width:10px">Precio</td>   
                                <td style="width:80px"></td>
                              </tr>
                            </thead>
                            <tbody>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          
        </div>
        <!-- /.card-footer-->
      </div>

         
        </div>
      </div>
    </div>
    <!-- FIN  CONTENIDO PAGUINA PRINCIPAL -->



    <aside class="control-sidebar control-sidebar-dark">
      <div class="p-3">
        <h5>PORTAL ACCESO RANSA</h5>
        <p>PORTAL ACCESO RANSA</p>
      </div>
    </aside>

    <footer class="main-footer">
      <div class="float-right d-none d-sm-inline">
      PORTAL ACCESO RANSA 1.0
      </div>
      <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="#">PORTAL ACCESO RANSA</a>.</strong> All rights reserved.
    </footer>
  </div>
  <!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

 <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="../../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- SweetAlert2 -->
  <script src="../../plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- Toastr -->
  <script src="../../plugins/toastr/toastr.min.js"></script>

  <!-- DataTables  & Plugins -->
  <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="../../plugins/jszip/jszip.min.js"></script>
  <script src="../../plugins/pdfmake/pdfmake.min.js"></script>
  <script src="../../plugins/pdfmake/vfs_fonts.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>


<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="../../plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="../../plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="../../plugins/moment/moment.min.js"></script>
<script src="../../plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- date-range-picker -->
<script src="../../plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="../../plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="../../plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- BS-Stepper -->
<script src="../../plugins/bs-stepper/js/bs-stepper.min.js"></script>
<!-- dropzonejs -->
<script src="../../plugins/dropzone/min/dropzone.min.js"></script>


  <!-- AdminLTE App -->
  <script src="../../dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../../dist/js/demo.js"></script>

  <!-- AdminLTE PREDICTIVO -->
  <script src="../../plugins/jquery-ui/jquery-ui.js" type="text/javascript"></script>

  <script src="../funciones.js"></script>
  <script src="./js/portalaccesovisitauio.js"></script>
</body>

</html>