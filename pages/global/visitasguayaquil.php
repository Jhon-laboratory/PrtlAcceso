<?php
include('../../Conexion/conexion_mysqli.php');
include('../../Model/Model_gb_global.php');
include('../../control_session.php');

$dato1 = 6;   // Módulo
$dato2 = 49;  // Interfaz  
$dato3 = 1;   // Origen
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PORTAL DE ACCESO A TERCEROS - GUAYAQUIL</title>

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
            background: linear-gradient(rgba(255, 255, 255, 0.95), rgba(255, 255, 255, 0.95)), 
                        url('../../img/imglogin.jpg') center/cover no-repeat fixed;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* CABECERA SUPERIOR MÍNIMA */
        .top_nav {
            background: #2c3e50;
            min-height: 40px !important;
            border-bottom: 1px solid #1a252f;
            display: flex;
            align-items: center;
        }
        
        .top_nav .nav_menu {
            min-height: 40px !important;
            padding: 0 !important;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .nav_menu .navbar-left {
            display: flex;
            align-items: center;
        }
        
        .nav_menu .navbar-right {
            margin: 0 !important;
            padding: 0 !important;
        }
        
        /* TÍTULO EN LA CABECERA */
        .nav-title {
            color: #28a745;
            font-size: 14px;
            font-weight: 600;
            margin-left: 15px;
            display: flex;
            align-items: center;
        }
        
        .nav-title i {
            margin-right: 8px;
            font-size: 13px;
            color: #20c997;
        }
        
        /* ESTILOS ESPECÍFICOS PARA EL NOMBRE DE USUARIO */
        .nav_menu .navbar-right a.user-profile {
            color: #28a745 !important;
            padding: 8px 15px !important;
            font-size: 14px;
            text-decoration: none !important;
            display: inline-flex !important;
            align-items: center !important;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            margin: 5px 10px;
            transition: all 0.3s ease;
            border: 1px solid rgba(40, 167, 69, 0.3);
        }
        
        .nav_menu .navbar-right a.user-profile:hover {
            background: rgba(40, 167, 69, 0.15);
            color: #20c997 !important;
            border-color: rgba(32, 201, 151, 0.5);
        }
        
        /* Estilo para el dropdown */
        .dropdown-usermenu {
            background: #2c3e50;
            border: 1px solid #1a252f;
            border-radius: 8px;
            margin-top: 5px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }
        
        .dropdown-usermenu a.dropdown-item {
            color: #e9ecef !important;
            padding: 10px 15px;
            font-size: 13px;
            transition: all 0.2s ease;
        }
        
        .dropdown-usermenu a.dropdown-item:hover {
            background: #009A3F;
            color: white !important;
        }
        
        .dropdown-usermenu a.dropdown-item i {
            color: #28a745;
        }
        
        .dropdown-usermenu a.dropdown-item:hover i {
            color: white;
        }
        
        .nav_menu .nav.toggle {
            padding: 8px 10px;
        }

        /* Estilos para las tarjetas - IGUAL QUE LAS PÁGINAS ANTERIORES */
        .cards-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 15px;
            padding: 20px 0;
        }

        .tercero-card {
            background: linear-gradient(145deg, #ffffff, #f8f9fa);
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            border: 1px solid #e8f5e9;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
            position: relative;
            backdrop-filter: blur(10px);
        }

        .tercero-card:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 12px 25px rgba(0,154,63,0.15);
            border-color: #009A3F;
        }

        .card-header {
            background: linear-gradient(135deg, #009A3F 0%, #00c853 100%);
            color: white;
            padding: 12px 15px 8px;
            position: relative;
            overflow: hidden;
        }

        .card-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
            transform: rotate(45deg);
            animation: shimmer 3s infinite;
        }

        @keyframes shimmer {
            0% { transform: translateX(-100%) rotate(45deg); }
            100% { transform: translateX(100%) rotate(45deg); }
        }

        .card-header h5 {
            margin: 0;
            font-size: 13px;
            font-weight: 600;
            display: flex;
            align-items: center;
            color: white;
            position: relative;
            z-index: 1;
        }

        .card-header h5 i {
            margin-right: 8px;
            font-size: 14px;
            color: rgba(255,255,255,0.9);
        }

        .card-body {
            padding: 10px 15px 12px;
            background: white;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 6px 0;
            border-bottom: 1px solid #f0f0f0;
            transition: background-color 0.2s ease;
        }

        .info-item:hover {
            background-color: #f8f9fa;
            border-radius: 4px;
            padding-left: 5px;
            padding-right: 5px;
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-label {
            font-weight: 500;
            color: #555;
            font-size: 11px;
            display: flex;
            align-items: center;
            flex-shrink: 0;
        }

        .info-label i {
            margin-right: 5px;
            font-size: 11px;
            color: #009A3F;
            width: 14px;
            text-align: center;
        }

        .info-value {
            color: #333;
            font-size: 11px;
            text-align: right;
            margin-left: 8px;
            font-weight: 500;
            line-height: 1.3;
        }

        .status-badge {
            padding: 3px 8px;
            border-radius: 10px;
            font-size: 9px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-activo {
            background: linear-gradient(135deg, #e8f5e8, #c8e6c9);
            color: #2e7d32;
            border: 1px solid #a5d6a7;
        }

        .status-pendiente {
            background: linear-gradient(135deg, #fff3cd, #ffeaa7);
            color: #856404;
            border: 1px solid #ffd54f;
        }

        .status-inactivo {
            background: linear-gradient(135deg, #f8d7da, #f5c6cb);
            color: #721c24;
            border: 1px solid #f1b0b7;
        }

        .status-autorizado {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            color: #155724;
            border: 1px solid #b1dfbb;
        }

        .status-restringido {
            background: linear-gradient(135deg, #f8d7da, #f5c6cb);
            color: #721c24;
            border: 1px solid #f1b0b7;
        }

        /* Botón de antecedentes */
        .btn-antecedentes {
            background: #F39200;
            border: none;
            color: white;
            font-size: 9px;
            padding: 2px 6px;
            border-radius: 6px;
            font-weight: 600;
            transition: all 0.2s ease;
            width: auto;
            margin: 2px 0;
        }

        .btn-antecedentes:hover {
            background: #e68300;
            transform: scale(1.05);
        }

        .btn-antecedentes:disabled {
            background: #ccc;
            cursor: not-allowed;
            transform: none;
        }

        /* Indicador de estado en el borde lateral */
        .tercero-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(180deg, #009A3F 0%, #00c853 100%);
            border-radius: 4px 0 0 4px;
        }

        .tercero-card.status-autorizado-card::after {
            background: linear-gradient(180deg, #28a745 0%, #20c997 100%);
        }

        .tercero-card.status-restringido-card::after {
            background: linear-gradient(180deg, #dc3545 0%, #e83e8c 100%);
        }

        /* Barra de búsqueda */
        .search-container {
            background: linear-gradient(135deg, #ffffff, #f8f9fa);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            margin-bottom: 25px;
            border: 1px solid #e8f5e9;
            position: relative;
            overflow: hidden;
        }

        .search-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #009A3F, #00c853, #009A3F);
            background-size: 200% 100%;
            animation: gradientShift 3s ease infinite;
        }

        @keyframes gradientShift {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

        .search-box {
            position: relative;
            max-width: 400px;
        }

        .search-box .form-control {
            padding-left: 45px;
            border-radius: 25px;
            border: 2px solid #e0e0e0;
            transition: all 0.3s ease;
            background: rgba(255,255,255,0.9);
        }

        .search-box .form-control:focus {
            border-color: #009A3F;
            box-shadow: 0 0 0 3px rgba(0,154,63,0.1);
            background: white;
        }

        .search-box .fa-search {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #777;
            z-index: 2;
        }

        .results-count {
            color: #666;
            font-size: 13px;
            margin-top: 10px;
            font-weight: 500;
        }

        .load-more-container {
            text-align: center;
            margin: 30px 0;
        }

        .load-more-btn {
            background: linear-gradient(135deg, #009A3F, #00c853);
            border: none;
            border-radius: 25px;
            padding: 10px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0,154,63,0.3);
        }

        .load-more-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0,154,63,0.4);
            background: linear-gradient(135deg, #008a35, #00b848);
        }

        .no-results {
            text-align: center;
            padding: 40px;
            color: #666;
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            margin: 20px 0;
        }

        .no-results i {
            font-size: 48px;
            margin-bottom: 15px;
            color: #ccc;
        }

        .loading-spinner {
            text-align: center;
            padding: 40px;
            color: #009A3F;
        }

        .loading-spinner i {
            font-size: 48px;
            margin-bottom: 15px;
            animation: pulse 1.5s ease-in-out infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.1); opacity: 0.7; }
            100% { transform: scale(1); opacity: 1; }
        }

        /* Estilos específicos para GUAYAQUIL */
        .guayaquil-title {
            color: #009A3F;
            font-weight: 700;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .guayaquil-subtitle {
            color: #F39200;
            font-weight: 600;
            background: linear-gradient(135deg, #fff3e0, #ffecb3);
            padding: 8px 15px;
            border-radius: 10px;
            display: inline-block;
            margin-bottom: 15px;
        }

        /* Responsive */
        @media (min-width: 1800px) {
            .cards-container {
                grid-template-columns: repeat(5, 1fr);
            }
        }

        @media (min-width: 1400px) and (max-width: 1799px) {
            .cards-container {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        @media (min-width: 1200px) and (max-width: 1399px) {
            .cards-container {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (min-width: 992px) and (max-width: 1199px) {
            .cards-container {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (min-width: 768px) and (max-width: 991px) {
            .cards-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 767px) {
            .cards-container {
                grid-template-columns: 1fr;
                gap: 12px;
                padding: 15px 0;
            }
            
            .nav-title {
                display: none; /* Ocultar título en móviles */
            }
            
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

            <!-- CABECERA SUPERIOR MÍNIMA - ACTUALIZADA (IGUAL QUE CD3) -->
            <div class="top_nav">
                <div class="nav_menu">
                    <div class="navbar-left">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>
                        
                    </div>
                    
                    <nav class="nav navbar-nav">
                        <ul class="navbar-right">
                            <li class="nav-item dropdown open">
                                <a href="javascript:;" class="user-profile dropdown-toggle"
                                    id="navbarDropdown" data-toggle="dropdown">
                                    <div style="display: inline-flex; align-items: center; background: #28a745; width: 26px; height: 26px; border-radius: 50%; justify-content: center; margin-right: 8px;">
                                        <i class="fa fa-user" style="color: white; font-size: 12px;"></i>
                                    </div>
                                    <?php echo $_SESSION["gb_nombre"]; ?>
                                </a>
                                <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="../../session_destroy.php">
                                        <i class="fa fa-sign-out pull-right"></i> Salir
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>

            <!-- CONTENIDO PRINCIPAL -->
            <div class="right_col" role="main">
                <div class="detalle-container">
                    
                    <!-- Mensaje de sistema -->
                    <div id="mensaje2"></div>
                    
                

                    <!-- Panel Principal -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="x_panel portal-card">
                                
                                    
                                    <!-- Sección de Consulta -->
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="x_panel">
                                                <div class="x_title">
                                                    <h5 class="nav-title">
                                                        <i class="fa fa-search"></i> Consulta de Terceros - GUAYAQUIL
                                                    </h5>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="x_content">
                                                  
                                                  <!-- Barra de búsqueda -->
                                                  <div class="search-container">
                                                      <div class="row">
                                                          <div class="col-md-6">
                                                              <div class="search-box">
                                                                <i class="fa fa-search"></i>
                                                                <input type="text" id="searchInput" class="form-control" placeholder="Buscar por nombre, cédula, razón social...">
                                                              </div>
                                                          </div>
                                                          <div class="col-md-6">
                                                              <div class="results-count">
                                                                Mostrando <span id="resultsCount">0</span> de <span id="totalCount">0</span> registros
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>

                                                  <!-- Contenedor de tarjetas -->
                                                  <div id="cardsContainer" class="cards-container">
                                                      <!-- Las tarjetas se cargarán aquí via JavaScript -->
                                                  </div>

                                                  <!-- Botón cargar más -->
                                                  <div class="load-more-container">
                                                      <button id="loadMoreBtn" class="btn btn-primary load-more-btn" style="display: none;">
                                                          <i class="fa fa-refresh"></i> Cargar Más Registros
                                                      </button>
                                                  </div>

                                                  <!-- Mensaje sin resultados -->
                                                  <div id="noResults" class="no-results" style="display: none;">
                                                      <i class="fa fa-search"></i>
                                                      <h4>No se encontraron resultados</h4>
                                                      <p>Intenta con otros términos de búsqueda</p>
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

    <script>
    // Variables globales para GUAYAQUIL
    let allDataGuayaquil = [];
    let displayedCountGuayaquil = 0;
    const initialLoadCountGuayaquil = 15;
    const loadMoreCountGuayaquil = 15;
    let isLoadingGuayaquil = false;

    // FUNCIÓN SIMPLIFICADA - MOSTRAR VALOR DIRECTO
    function formatDate(dateString) {
        if (!dateString || 
            dateString === '' || 
            dateString === 'null' ||
            dateString === 'NULL' ||
            dateString === '0000-00-00' || 
            dateString === '0000-00-00 00:00:00') {
            return 'N/A';
        }
        
        return dateString;
    }

    // Función para limpiar texto de HTML
    function cleanButtonText(htmlString) {
        if (!htmlString) return 'N/A';
        
        if (typeof htmlString === 'number') return htmlString.toString();
        
        if (typeof htmlString === 'string' && !htmlString.includes('<')) {
            return htmlString.trim();
        }
        
        const tempDiv = document.createElement('div');
        tempDiv.innerHTML = htmlString;
        let textContent = tempDiv.textContent || tempDiv.innerText || '';
        
        textContent = textContent
            .replace(/[\r\n\t]/g, '')
            .replace(/\s+/g, ' ')
            .trim()
            .replace(/^::/, '')
            .replace(/^">\s*/, '')
            .replace(/\s*">\s*$/, '');
        
        const lastColonIndex = textContent.lastIndexOf(':');
        if (lastColonIndex !== -1) {
            textContent = textContent.substring(lastColonIndex + 1).trim();
        }
        
        return textContent || 'N/A';
    }

    // Función para determinar estado según antecedentes y examen (estado)
    function getEstadoGuayaquil(antecedentesValue, estadoValue) {
        const antecedentesLimpio = cleanButtonText(antecedentesValue).toLowerCase();
        const estadoLimpio = cleanButtonText(estadoValue).toLowerCase();
        
        const antecedentesOk = antecedentesLimpio === 'no' || antecedentesLimpio.includes('no');
        const estadoOk = estadoLimpio === 'aprobado' || estadoLimpio.includes('aprobado') || 
                        estadoLimpio === 'si' || estadoLimpio === 'sí' ||
                        estadoLimpio === 'activo' || estadoLimpio.includes('activo');
        
        if (antecedentesOk && estadoOk) {
            return 'AUTORIZADO';
        } else {
            return 'RESTRINGIDO';
        }
    }

    // Función para crear tarjeta para GUAYAQUIL - CON LOS CAMPOS CORRECTOS
    function createCardGuayaquil(tercero, index) {
        const id = tercero.id || index + 1;
        const nombre = tercero.Nombre || 'N/A';
        const cedula = cleanButtonText(tercero.Cedula || 'N/A');
        const estado = tercero.estado || 'N/A';  // Esto es el "Examen de Seguridad"
        const antecedentes = tercero.Antedentes || 'N/A';  // OJO: con 'd' de más
        const fechaIngreso = tercero.fechaIngreso || 'N/A';  // "Fecha Capacitación"
        const fechaRegistro = tercero.fecha_registro || 'N/A';  // "Fecha Antecedentes Penales"
        const comentario = tercero.Comentario || 'N/A';
        const consultas = tercero.numconsulta || 0;  // "#Visitas"
        
        const estadoLimpio = cleanButtonText(estado);
        const antecedentesLimpio = cleanButtonText(antecedentes);
        const estadoFinal = getEstadoGuayaquil(antecedentes, estado);
        const estadoClass = estadoFinal === 'AUTORIZADO' ? 'status-autorizado-card' : 'status-restringido-card';
        
        return `
            <div class="tercero-card ${estadoClass}" data-index="${index}" data-id="${id}">
                <div class="card-header">
                    <h5>
                        <i class="fa fa-user-circle"></i>
                        ${nombre}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="info-item">
                        <span class="info-label">
                            <i class="fa fa-hashtag"></i> ID:
                        </span>
                        <span class="info-value">${id}</span>
                    </div>
                    
                    <div class="info-item">
                        <span class="info-label">
                            <i class="fa fa-id-card"></i> Cédula:
                        </span>
                        <span class="info-value">${cedula}</span>
                    </div>
                    
                    <!-- BOTÓN DE CONSULTAR ANTECEDENTES -->
                    <div style="text-align: center; padding: 3px 0;">
                        <button type="button" class="btn btn-antecedentes" 
                                onclick="consultarAntecedentesGuayaquil('${cedula}', this)"
                                title="Consultar antecedentes penales">
                            <i class="fa fa-search"></i> Antecedentes
                        </button>
                    </div>
                    
                    <!-- Examen de Seguridad (campo "estado") -->
                    <div class="info-item">
                        <span class="info-label">
                            <i class="fa fa-shield"></i> Examen Seguridad:
                        </span>
                        <span class="info-value">${estadoLimpio}</span>
                    </div>
                    
                    <!-- Antecedentes -->
                    <div class="info-item">
                        <span class="info-label">
                            <i class="fa fa-history"></i> Antecedentes:
                        </span>
                        <span class="info-value">${antecedentesLimpio}</span>
                    </div>
                    
                    <!-- Fecha Capacitación (fechaIngreso) -->
                    <div class="info-item">
                        <span class="info-label">
                            <i class="fa fa-calendar"></i> Fecha Capacitación:
                        </span>
                        <span class="info-value">${formatDate(fechaIngreso)}</span>
                    </div>
                    
                    <!-- Fecha Antecedentes (fecha_registro) -->
                    <div class="info-item">
                        <span class="info-label">
                            <i class="fa fa-calendar-check"></i> Fecha Antecedentes:
                        </span>
                        <span class="info-value">${formatDate(fechaRegistro)}</span>
                    </div>
                    
                    ${comentario !== 'N/A' && comentario !== '' ? `
                    <div class="info-item">
                        <span class="info-label">
                            <i class="fa fa-comment"></i> Comentario:
                        </span>
                        <span class="info-value" style="font-size: 10px;" title="${comentario}">
                            ${comentario.length > 20 ? comentario.substring(0, 20) + '...' : comentario}
                        </span>
                    </div>
                    ` : ''}
                    
                    <!-- # Visitas (numconsulta) -->
                    <div class="info-item">
                        <span class="info-label">
                            <i class="fa fa-eye"></i> # Visitas:
                        </span>
                        <span class="info-value">${consultas}</span>
                    </div>
                    
                    <!-- ESTADO FINAL (AUTORIZADO/RESTRINGIDO) -->
                    <div class="info-item">
                        <span class="info-label">
                            <i class="fa fa-circle"></i> Estado General:
                        </span>
                        <span class="info-value">
                            ${estadoFinal === 'AUTORIZADO' ? 
                                '<span class="status-badge status-autorizado">AUTORIZADO</span>' : 
                                '<span class="status-badge status-restringido">RESTRINGIDO</span>'}
                        </span>
                    </div>
                </div>
            </div>
        `;
    }

    // Función para consultar antecedentes
    function consultarAntecedentesGuayaquil(cedula, buttonElement) {
        if (!cedula) return;
        
        const originalText = buttonElement.innerHTML;
        buttonElement.innerHTML = '<i class="fa fa-spinner fa-spin"></i>';
        buttonElement.disabled = true;
        
        $.ajax({
            url: "validar.php",
            type: "POST",
            data: { cedula: cedula },
            success: function(response) {
                if (response === '1' || response === 1) {
                    buttonElement.innerHTML = '<i class="fa fa-check" style="color: #28a745;"></i>';
                    buttonElement.style.background = '#e8f5e8';
                    buttonElement.style.color = '#28a745';
                    
                    setTimeout(() => {
                        loadDataGuayaquil($('#searchInput').val());
                    }, 1000);
                } else {
                    buttonElement.innerHTML = '<i class="fa fa-times" style="color: #dc3545;"></i>';
                    buttonElement.style.background = '#f8d7da';
                    buttonElement.style.color = '#dc3545';
                }
                
                setTimeout(() => {
                    buttonElement.innerHTML = originalText;
                    buttonElement.disabled = false;
                    buttonElement.style.background = '';
                    buttonElement.style.color = '';
                }, 2000);
            },
            error: function(xhr, status, error) {
                console.error("Error en consulta:", error);
                
                buttonElement.innerHTML = '<i class="fa fa-times" style="color: #dc3545;"></i>';
                buttonElement.style.background = '#f8d7da';
                buttonElement.style.color = '#dc3545';
                
                setTimeout(() => {
                    buttonElement.innerHTML = originalText;
                    buttonElement.disabled = false;
                    buttonElement.style.background = '';
                    buttonElement.style.color = '';
                }, 2000);
            }
        });
    }

    // Función para cargar datos de GUAYAQUIL - USANDO EL CONTROLADOR CORRECTO
    function loadDataGuayaquil(searchTerm = '', loadMore = false) {
        if (isLoadingGuayaquil) return;
        
        isLoadingGuayaquil = true;
        
        if (!loadMore) {
            $('#cardsContainer').html('<div class="loading-spinner"><i class="fa fa-spinner fa-spin"></i><p>Cargando datos GUAYAQUIL...</p></div>');
            allDataGuayaquil = [];
            displayedCountGuayaquil = 0;
        } else {
            $('#loadMoreBtn').html('<i class="fa fa-spinner fa-spin"></i> Cargando...').prop('disabled', true);
        }
        
        console.log("Cargando datos de GUAYAQUIL desde Controller_visitasgye.php...");
        
        // AJAX para GUAYAQUIL - USANDO EL CONTROLADOR CORRECTO
        $.ajax({
            url: "../../Controller/Controller_visitasgye.php",
            type: "POST",
            data: {
                "txt_option": '2'
            },
            dataType: "json",
            success: function(response) {
                isLoadingGuayaquil = false;
                
                console.log("Respuesta de GUAYAQUIL:", response);
                
                if (response && response.data) {
                    console.log("Total registros recibidos:", response.data.length);
                    console.log("Primer registro:", response.data[0]);
                    
                    if (loadMore) {
                        allDataGuayaquil = allDataGuayaquil.concat(response.data);
                    } else {
                        allDataGuayaquil = response.data;
                    }
                    
                    filterAndDisplayResultsGuayaquil(searchTerm);
                    
                } else {
                    console.error("Respuesta vacía o sin datos:", response);
                    if (!loadMore) {
                        $('#cardsContainer').html('<div class="no-results"><i class="fa fa-exclamation-triangle"></i><h4>Error: Datos vacíos</h4><p>El servidor no devolvió datos válidos</p></div>');
                    }
                }
                
                if (loadMore) {
                    $('#loadMoreBtn').html('<i class="fa fa-refresh"></i> Cargar Más Registros').prop('disabled', false);
                }
            },
            error: function(xhr, status, error) {
                isLoadingGuayaquil = false;
                console.error("Error al cargar datos GUAYAQUIL:", error);
                console.log("Estado:", status);
                console.log("Respuesta XHR:", xhr.responseText);
                
                if (!loadMore) {
                    $('#cardsContainer').html('<div class="no-results"><i class="fa fa-exclamation-triangle"></i><h4>Error de conexión</h4><p>No se pudo conectar al servidor GUAYAQUIL</p><p>Detalle: ' + error + '</p></div>');
                }
                
                if (loadMore) {
                    $('#loadMoreBtn').html('<i class="fa fa-refresh"></i> Cargar Más Registros').prop('disabled', false);
                }
            }
        });
    }

    // Función para filtrar y mostrar resultados GUAYAQUIL
    function filterAndDisplayResultsGuayaquil(searchTerm = '') {
        const container = $('#cardsContainer');
        const resultsCount = $('#resultsCount');
        const totalCount = $('#totalCount');
        const loadMoreBtn = $('#loadMoreBtn');
        const noResults = $('#noResults');

        if (searchTerm) {
            displayedCountGuayaquil = 0;
        }

        let filteredData = allDataGuayaquil;
        if (searchTerm) {
            const term = searchTerm.toLowerCase();
            filteredData = allDataGuayaquil.filter(item => {
                const nombre = item.Nombre ? item.Nombre.toLowerCase() : '';
                const cedula = item.Cedula ? cleanButtonText(item.Cedula).toLowerCase() : '';
                const comentario = item.Comentario ? item.Comentario.toLowerCase() : '';
                
                return nombre.includes(term) || 
                       cedula.includes(term) || 
                       comentario.includes(term);
            });
        }

        const currentDisplayCount = Math.min(displayedCountGuayaquil + (searchTerm ? filteredData.length : initialLoadCountGuayaquil), filteredData.length);
        resultsCount.text(currentDisplayCount);
        totalCount.text(filteredData.length);

        if (filteredData.length === 0) {
            container.hide();
            loadMoreBtn.hide();
            noResults.show();
            return;
        } else {
            noResults.hide();
            container.show();
        }

        const endIndex = Math.min(displayedCountGuayaquil + (searchTerm ? filteredData.length : initialLoadCountGuayaquil), filteredData.length);
        
        if (searchTerm || displayedCountGuayaquil === 0) {
            container.empty();
        }

        for (let i = displayedCountGuayaquil; i < endIndex; i++) {
            container.append(createCardGuayaquil(filteredData[i], i));
        }

        displayedCountGuayaquil = endIndex;

        if (displayedCountGuayaquil < filteredData.length && !searchTerm) {
            loadMoreBtn.show();
        } else {
            loadMoreBtn.hide();
        }
    }

    // Función para buscar en tiempo real
    function performSearchGuayaquil(searchTerm = '') {
        if (searchTerm) {
            displayedCountGuayaquil = 0;
            filterAndDisplayResultsGuayaquil(searchTerm);
        } else {
            displayedCountGuayaquil = 0;
            filterAndDisplayResultsGuayaquil();
        }
    }

    // Eventos cuando el documento está listo
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('menu_toggle').addEventListener('click', function() {
            const leftCol = document.querySelector('.left_col');
            leftCol.classList.toggle('menu-open');
        });

        // Cargar datos iniciales
        loadDataGuayaquil();

        let searchTimeout;
        $('#searchInput').on('input', function() {
            const searchTerm = $(this).val();
            
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                performSearchGuayaquil(searchTerm);
            }, 300);
        });

        $('#loadMoreBtn').on('click', function() {
            loadDataGuayaquil('', true);
        });

        $('#searchInput').on('keydown', function(e) {
            if (e.key === 'Escape') {
                $(this).val('');
                performSearchGuayaquil('');
            }
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

    <!-- Modal para cambiar contraseña -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog"
        aria-labelledby="changePasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="changePasswordModalLabel">
                        <i class="fa fa-lock"></i> Actualizar Contraseña
                    </h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="change-password-form">
                        <div class="form-group">
                            <label for="new-password">Nueva Contraseña:</label>
                            <input type="password" class="form-control" id="new-password"
                                placeholder="Ingrese nueva contraseña" required>
                        </div>
                        <div class="form-group">
                            <label for="repeat-password">Repita Contraseña:</label>
                            <input type="password" class="form-control" id="repeat-password"
                                placeholder="Repita la nueva contraseña" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="update-password-btn">Actualizar</button>
                </div>
            </div>
        </div>
    </div>

</body>
</html>