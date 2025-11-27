<?php
include('../../Conexion/conexion_mysqli.php');
include('../../Model/Model_gb_global.php');
include('../../control_session.php');
// ELIMINAR: include('../menu.php');

$dato1 = 5;   // Módulo
$dato2 = 40;  // Interfaz  
$dato3 = 1;   // Origen
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PORTAL DE ACCESO A TERCEROS</title>

    <!-- CSS de Gentelella -->
    <link href="../../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="../../vendors/nprogress/nprogress.css" rel="stylesheet">
    <link href="../../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <link href="../../vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <link href="../../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <link href="../../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../../build/css/custom.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.9)), 
                        url('../../img/imglogin.jpg') center/cover no-repeat fixed;
            min-height: 100vh;
        }

        .detalle-container {
            padding: 20px;
        }

        .welcome-section {
            text-align: center;
            margin-bottom: 30px;
            padding: 20px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }

        .welcome-title {
            color: #2A3F54;
            font-weight: 700;
            margin-bottom: 10px;
            font-size: 1.8rem;
        }

        .user-info {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            display: inline-block;
            font-weight: 600;
        }

        .tienda-info {
            background: #2A3F54;
            color: white;
            padding: 6px 12px;
            border-radius: 15px;
            font-size: 0.8rem;
            margin-left: 10px;
        }

        .table-responsive {
            margin-top: 20px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .portal-table thead {
            background: linear-gradient(135deg, #009A3F 0%, #00c853 100%) !important;
        }

        .portal-table th {
            color: white;
            border: none;
            padding: 12px 10px;
            font-weight: 600;
            font-size: 11px;
            text-align: center;
        }

        .portal-table td {
            padding: 10px;
            vertical-align: middle;
            text-align: center;
        }

        .portal-table tbody tr:hover {
            background-color: #f8fff9;
        }

        .portal-card .x_title {
            border-bottom: 2px solid #009A3F;
        }

        .portal-title {
            color: #009A3F;
            font-weight: 700;
        }

        .subtitle-orange {
            color: #F39200;
            font-weight: 600;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .left_col {
                position: fixed;
                z-index: 1000;
                height: 100vh;
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            
            .left_col.menu-open {
                transform: translateX(0);
            }
            
            .detalle-container {
                padding: 15px;
            }
            
            .welcome-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            
            <!-- SIDEBAR -->
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="" class="site_title">
                            <img src="../../img/logo.png" alt="RANSA Logo" style="height: 40px;">
                        </a>
                    </div>
                    <div class="clearfix"></div>

                    <!-- Información del usuario -->
                    <div class="profile clearfix">
                        <div class="profile_info">
                            <span>Bienvenido,</span>
                            <h2><?php echo $_SESSION["gb_nombre"]; ?></h2>
                        </div>
                    </div>

                    <br />

                    <!-- MENÚ PRINCIPAL -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <h3>Navegación Principal</h3>
                            <ul class="nav side-menu">
                                <!-- Menú del sistema -->
                                <?php 
                                include('../menu.php');
                                sistema_menu($dato1, $dato2, $dato3); 
                                ?>
                                
                                <!-- Opción de cerrar sesión -->
                                <li>
                                    <a href="../../session_destroy.php">
                                        <i class="fa fa-sign-out"></i> Cerrar Sesión
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Botones footer -->
                    <div class="sidebar-footer hidden-small">
                        <a data-toggle="tooltip" data-placement="top" title="Configuración" onclick="showChangePasswordModal()">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Pantalla Completa" onclick="toggleFullScreen()">
                            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Recargar Página" onclick="reloadPage()">
                            <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Cerrar Sesión" href="../../session_destroy.php">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- NAVBAR SUPERIOR -->
            <div class="top_nav">
                <div class="nav_menu">
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>
                    <div class="nav navbar-nav navbar-right">
                        <span style="color: white; padding: 15px; font-weight: 600;">
                            <i class="fa fa-user-circle"></i> 
                            <span><?php echo $_SESSION["gb_nombre"]; ?></span>
                        </span>
                        <a href="../../session_destroy.php" style="color: white; padding: 15px; font-weight: 600;">
                            <i class="fa fa-sign-out"></i> Salir
                        </a>
                    </div>
                </div>
            </div>

            <!-- CONTENIDO PRINCIPAL -->
            <div class="right_col" role="main">
                <div class="detalle-container">
                    
                    <!-- Mensaje de sistema -->
                    <div id="mensaje2"></div>
                    
                    <!-- Sección de Bienvenida -->
                    <div class="welcome-section">
                        <h1 class="welcome-title">
                            <i class="fa fa-address-card"></i>
                            PORTAL DE ACCESO A TERCEROS - QUITO
                        </h1>
                        <div class="user-info">
                            <i class="fa fa-user"></i> 
                            <span><?php echo $_SESSION["gb_nombre"]; ?></span>
                            <span class="tienda-info">
                                Sistema de Gestión
                            </span>
                        </div>
                    </div>

                    <!-- Panel Principal -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="x_panel portal-card">
                                <div class="x_title">
                                    <h2 class="portal-title">
                                        <i class="fa fa-address-card"></i> PORTAL DE ACCESO A TERCEROS - QUITO
                                    </h2>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    
                                    <!-- Sección de Consulta -->
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="x_panel">
                                                <div class="x_title">
                                                    <h5 class="subtitle-orange">
                                                        <i class="fa fa-search"></i> Consulta
                                                    </h5>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="x_content">
                                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                                        <div class="table-responsive">
                                                            <table id="table_clientes" class="table table-striped table-bordered portal-table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Nombre</th>
                                                                        <th>Cédula</th>
                                                                        <th>Examen de Seguridad</th>
                                                                        <th>Antecedente</th>
                                                                        <th>Fecha Capacitación</th>
                                                                        <th>Fecha Antecedentes Penales</th>
                                                                        <th>Comentario</th>
                                                                        <th>#Visitas</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <!-- Los datos se cargarán via JavaScript -->
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

                </div>
            </div>

            <!-- FOOTER -->
            <footer>
                <div class="pull-right">
                    PORTAL ACCESO RANSA 1.0 - Copyright © <?php echo date('Y'); ?> RANSA. All rights reserved.
                </div>
                <div class="clearfix"></div>
            </footer>
            
        </div>
    </div>

    <!-- SCRIPTS de Gentelella -->
    <script src="../../vendors/jquery/dist/jquery.min.js"></script>
    <script src="../../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../vendors/fastclick/lib/fastclick.js"></script>
    <script src="../../vendors/nprogress/nprogress.js"></script>
    <script src="../../vendors/select2/dist/js/select2.full.min.js"></script>
    <script src="../../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../../build/js/custom.min.js"></script>

    <!-- Scripts adicionales necesarios -->
    <script src="../../plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="../../plugins/toastr/toastr.min.js"></script>

    <!-- Scripts específicos del portal -->
    <script src="../funciones.js"></script>
    <script src="./js/portalaccesovisitauio.js"></script>

    <script>
        // INICIALIZACIÓN
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle del menú en móviles
            document.getElementById('menu_toggle').addEventListener('click', function() {
                const leftCol = document.querySelector('.left_col');
                leftCol.classList.toggle('menu-open');
            });
        });

        function showChangePasswordModal() {
            $('#changePasswordModal').modal('show');
        }

        function toggleFullScreen() {
            if (!document.fullscreenElement) {
                document.documentElement.requestFullscreen();
            } else {
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                }
            }
        }

        function reloadPage() {
            location.reload();
        }
    </script>

</body>
</html>