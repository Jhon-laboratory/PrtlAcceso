<?php
include('../../Conexion/conexion_mysqli.php');
include('../../Model/Model_gb_global.php');
include('../../control_session.php');
include('../menu.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PORTAL DE ACCESO A TERCEROS</title>

    <!-- Bootstrap -->
    <link href="../../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-wysiwyg -->
    <link href="../../vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="../../vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="../../vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- starrr -->
    <link href="../../vendors/starrr/dist/starrr.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="../../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet" />
    <!-- bootstrap-daterangepicker -->
    <link href="../../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="../../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../../build/css/custom.min.css" rel="stylesheet">
    
    <!-- Estilos adicionales para compactar -->
    <style>
        /* CABECERA SUPERIOR MÁS COMPACTA */
        .top_nav .navbar-right {
            margin: 0;
            padding: 0;
        }
        
        .top_nav .nav_menu {
            min-height: 50px;
        }
        
        .navbar-right li {
            padding: 0 5px;
        }
        
        .user-profile img {
            width: 25px;
            height: 25px;
            margin-right: 5px;
        }
        
        .dropdown-toggle {
            padding: 8px 10px !important;
        }
        
        .dropdown-usermenu {
            min-width: 180px;
        }
        
        /* Ajustar el contenido principal */
        .right_col {
            padding: 10px !important;
        }
        
        /* Reducir espacios en cards */
        .card {
            margin-bottom: 10px;
        }
        
        .card-header {
            padding: 8px 15px !important;
        }
        
        .card-title {
            font-size: 16px !important;
            margin: 0 !important;
        }
        
        /* Tabla más compacta */
        .tabla_detalle_fp th, 
        .tabla_detalle_fp td {
            padding: 4px 6px !important;
            font-size: 12px;
        }
        
        /* Inputs más compactos */
        .form-control {
            padding: 4px 8px !important;
            font-size: 13px;
        }
        
        /* Botones más pequeños */
        .btn {
            padding: 4px 12px !important;
            font-size: 13px;
        }
    </style>
</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            
            <!-- MENÚ LATERAL IZQUIERDO -->
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="index.html" class="site_title">
                            <img src="../../img/logo.png" alt="RANSA Logo" style="height: 40px;">
                        </a>
                    </div>
                    <div class="clearfix"></div>

                    <!-- PERFIL DEL USUARIO -->
                    <div class="profile clearfix">
                        <div class="profile_info">
                            <span>Bienvenido,</span>
                            <h2><?php echo $_SESSION["gb_nombre"]; ?></h2>
                        </div>
                    </div>
                    <!-- /PERFIL DEL USUARIO -->

                    <br />

                    <!-- MENÚ GENERADO POR menu.php -->
                    <?php sistema_menu(6,48,1); ?>
                    <!-- /MENÚ -->

                    <!-- BOTONES DEL FOOTER DEL MENÚ -->
                    <div class="sidebar-footer hidden-small">
                        <a data-toggle="tooltip" data-placement="top" title="Configuración">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Pantalla Completa" onclick="toggleFullScreen()">
                            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Recargar" onclick="location.reload()">
                            <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Cerrar Sesión" href="../../session_destroy.php">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div>
                    <!-- /BOTONES DEL FOOTER -->
                </div>
            </div>
            <!-- /MENÚ LATERAL IZQUIERDO -->

            <!-- CABECERA SUPERIOR -->
            <div class="top_nav">
                <div class="nav_menu">
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>
                    <nav class="nav navbar-nav">
                        <ul class="navbar-right">
                            <li class="nav-item dropdown open" style="padding-left: 15px;">
                                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true"
                                    id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                                    <img src="../../images/user.png" alt=""><?php echo $_SESSION["gb_nombre"]; ?>
                                </a>
                                <div class="dropdown-menu dropdown-usermenu pull-right"
                                    aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="../../session_destroy.php">
                                        <i class="fa fa-sign-out pull-right"></i> Salir
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /CABECERA SUPERIOR -->

            <!-- CONTENIDO PRINCIPAL -->
            <div class="right_col" role="main" style="min-height: calc(100vh - 50px); padding: 10px;">
                
                <!-- ENCABEZADO DEL CONTENIDO -->
                <div class="page-title">
                    <div class="title_left">
                        <h3>
                            <i class="fa fa-portal"></i> PORTAL DE ACCESO A TERCEROS
                        </h3>
                    </div>
                    <div class="title_right">
                        <div class="col-md-5 col-sm-5 form-group pull-right top_search">
                            <div class="input-group">
                                <input type="text" class="form-control" id="buscador_global" 
                                       placeholder="Buscar por nombre, cédula o razón social...">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" id="btn_buscar" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /ENCABEZADO DEL CONTENIDO -->

                <!-- CONTENIDO PRINCIPAL -->
                <div class="clearfix"></div>
                
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2><i class="fa fa-address-card"></i> Interfaz de Consulta</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                
                                <!-- SECCIÓN DE CARGA DE IMÁGENES (OCULTA) -->
                                <div class="row" style="display: none;">
                                    <div class="col-md-3">
                                        <div class="x_panel">
                                            <div class="x_title">
                                                <h5>Carga de imagenes/fotos</h5>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="x_content">
                                                <!-- Formulario de imágenes -->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- TABLA DE PROVEEDORES -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="x_panel">
                                            <div class="x_title">
                                                <h5>Consulta de Proveedores</h5>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="x_content">
                                                <div class="table-responsive">
                                                    <table id="table_clientes" class="table table-bordered table-striped tabla_detalle_fp">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Nombre</th>
                                                                <th>Cédula</th>
                                                                <th>Documento<br>IESS</th>
                                                                <th>Examen de Seguridad</th>
                                                                <th>Antecedentes</th>
                                                                <th>Razón Social</th>
                                                                <th>Fecha Documento</th>
                                                                <th>Fecha Capacitación</th>
                                                                <th>Fecha Antecedentes Penales</th>
                                                                <th>Comentario</th>
                                                                <th>#Consulta</th>
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
                </div>

            </div>
            <!-- /CONTENIDO PRINCIPAL -->

            <!-- FOOTER -->
            <footer>
                <div class="pull-right">
                    Copyright © <?php echo date('Y'); ?> PORTAL DE ACCESO A TERCEROS RANSA. All rights reserved.
                </div>
                <div class="clearfix"></div>
            </footer>
            <!-- /FOOTER -->

        </div>
    </div>

    <!-- jQuery -->
    <script src="../../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="../../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../../vendors/nprogress/nprogress.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../../build/js/custom.min.js"></script>
    <!-- Datatables -->
    <script src="../../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    
    <script>
        // Función para pantalla completa
        function toggleFullScreen() {
            if (!document.fullscreenElement) {
                document.documentElement.requestFullscreen();
            } else if (document.exitFullscreen) {
                document.exitFullscreen();
            }
        }
        
        // Buscador
        $(document).ready(function() {
            $('#buscador_global').keypress(function(e) {
                if(e.which == 13) {
                    buscarProveedores();
                }
            });
            
            $('#btn_buscar').click(function() {
                buscarProveedores();
            });
            
            function buscarProveedores() {
                var termino = $('#buscador_global').val();
                if (termino.length > 0) {
                    // Implementar búsqueda aquí
                    console.log('Buscando:', termino);
                }
            }
        });
    </script>
</body>
</html>