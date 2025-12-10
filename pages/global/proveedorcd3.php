<?php
include('../../Conexion/conexion_mysqli.php');
include('../../Model/Model_gb_global.php');
include('../../control_session.php');

$_SESSION['tipo_usuario'] = isset($_SESSION['tipo_usuario']) ? $_SESSION['tipo_usuario'] : 'usuario';

$dato1 = 7;
$dato2 = 50;  
$dato3 = 1;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PORTAL DE ACCESO A TERCEROS - CD3</title>

    <link href="../../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="../../vendors/nprogress/nprogress.css" rel="stylesheet">
    <link href="../../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <link href="../../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../../build/css/custom.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(rgba(255, 255, 255, 0.95), rgba(255, 255, 255, 0.95)), 
                        url('../../img/imglogin.jpg') center/cover no-repeat fixed;
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
        
        .nav_menu .navbar-right a.user-profile img {
            width: 24px;
            height: 24px;
            margin-right: 8px;
            border-radius: 50%;
            background: #28a745;
            padding: 3px;
            border: 1px solid rgba(255, 255, 255, 0.2);
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
        
        /* CONTENIDO PRINCIPAL - SIN ESPACIOS INNECESARIOS */
        .right_col {
            padding: 5px !important;
            min-height: calc(100vh - 40px) !important;
        }
        
        /* ELIMINAR ESPACIOS DE X_PANEL */
        .x_panel {
            margin: 0 !important;
            border: none !important;
            box-shadow: none !important;
            background: transparent !important;
        }
        
        .x_title {
            display: none !important;
        }
        
        .x_content {
            padding: 0 !important;
        }
        
        /* DISEÑO DE TARJETAS - MANTENIENDO EL ESTILO ELEGANTE */
        .cards-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 15px;
            padding: 0 !important;
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

        /* OPCIONAL: Cambiar color del borde lateral según estado */
        .tercero-card.status-autorizado-card::after {
            background: linear-gradient(180deg, #28a745 0%, #20c997 100%);
        }

        .tercero-card.status-restringido-card::after {
            background: linear-gradient(180deg, #dc3545 0%, #e83e8c 100%);
        }

        /* Botón de antecedentes PEQUEÑO */
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

        /* Indicador de estado en el borde lateral con gradiente */
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

        /* BUSCADOR SIMPLE */
        .search-container {
            background: linear-gradient(135deg, #ffffff, #f8f9fa);
            padding: 15px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
            margin-bottom: 15px;
            border: 1px solid #e8f5e9;
        }

        .search-box {
            position: relative;
        }

        .search-box .form-control {
            padding-left: 40px;
            border-radius: 25px;
            border: 2px solid #e0e0e0;
            transition: all 0.3s ease;
            background: rgba(255,255,255,0.9);
            height: 35px;
            font-size: 13px;
        }

        .search-box .form-control:focus {
            border-color: #009A3F;
            box-shadow: 0 0 0 3px rgba(0,154,63,0.1);
            background: white;
        }

        .search-box .fa-search {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #777;
            z-index: 2;
        }

        .results-count {
            color: #666;
            font-size: 12px;
            margin-top: 8px;
            font-weight: 500;
        }

        .load-more-container {
            text-align: center;
            margin: 20px 0;
        }

        .load-more-btn {
            background: linear-gradient(135deg, #009A3F, #00c853);
            border: none;
            border-radius: 25px;
            padding: 8px 25px;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(0,154,63,0.2);
        }

        .load-more-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0,154,63,0.3);
            background: linear-gradient(135deg, #008a35, #00b848);
        }

        .no-results {
            text-align: center;
            padding: 30px;
            color: #666;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
            margin: 15px 0;
        }

        .no-results i {
            font-size: 40px;
            margin-bottom: 10px;
            color: #ccc;
        }

        .loading-spinner {
            text-align: center;
            padding: 30px;
            color: #009A3F;
        }

        .loading-spinner i {
            font-size: 40px;
            margin-bottom: 10px;
            animation: pulse 1.5s ease-in-out infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.1); opacity: 0.7; }
            100% { transform: scale(1); opacity: 1; }
        }

        /* RESPONSIVE */
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
            }
            
            .nav-title {
                display: none; /* Ocultar título en móviles */
            }
        }

        @media (max-width: 576px) {
            .cards-container {
                grid-template-columns: 1fr;
            }
            
            .card-header h5 {
                font-size: 12px;
            }
            
            .info-item {
                padding: 5px 0;
            }
            
            .info-label, .info-value {
                font-size: 10px;
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
                            <img src="../../img/logo.png" alt="RANSA" style="height: 35px;">
                        </a>
                    </div>
                    <div class="clearfix"></div>

                    <div class="profile clearfix">
                        <div class="profile_info">
                            <span>Bienvenido,</span>
                            <h2><?php echo $_SESSION["gb_nombre"]; ?></h2>
                        </div>
                    </div>

                    <br />

                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <ul class="nav side-menu">
                                <?php 
                                include('../menu.php');
                                sistema_menu($dato1, $dato2, $dato3); 
                                ?>
                                <li>
                                    <a href="../../session_destroy.php">
                                        <i class="fa fa-sign-out"></i> Cerrar Sesión
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="sidebar-footer hidden-small">
                        <a data-toggle="tooltip" data-placement="top" title="Configuración" onclick="showChangePasswordModal()">
                            <span class="glyphicon glyphicon-cog"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Pantalla Completa" onclick="toggleFullScreen()">
                            <span class="glyphicon glyphicon-fullscreen"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Recargar" onclick="reloadPage()">
                            <span class="glyphicon glyphicon-refresh"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Cerrar Sesión" href="../../session_destroy.php">
                            <span class="glyphicon glyphicon-off"></span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- CABECERA SUPERIOR MÍNIMA - CORREGIDA CON TÍTULO -->
            <div class="top_nav">
                <div class="nav_menu">
                    <div class="navbar-left">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>
                        <div class="nav-title">
                            <i class="fa fa-building"></i> PORTAL ACCESO - CD3
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
                
                <!-- CONTENIDO PRINCIPAL - SOLO LO ESENCIAL -->
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        
                        <!-- BUSCADOR SIMPLE -->
                        <div class="search-container">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="search-box">
                                        <i class="fa fa-search"></i>
                                        <input type="text" id="searchInput" class="form-control" placeholder="Buscar por nombre, cédula...">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="results-count">
                                        <span id="resultsCount">0</span> de <span id="totalCount">0</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- CONTENEDOR DE TARJETAS -->
                        <div id="cardsContainer" class="cards-container">
                            <!-- Las tarjetas se cargarán aquí via JavaScript -->
                        </div>

                        <!-- BOTÓN CARGAR MÁS -->
                        <div class="load-more-container">
                            <button id="loadMoreBtn" class="btn btn-primary load-more-btn" style="display: none;">
                                <i class="fa fa-refresh"></i> Cargar Más
                            </button>
                        </div>

                        <!-- SIN RESULTADOS -->
                        <div id="noResults" class="no-results" style="display: none;">
                            <i class="fa fa-search"></i>
                            <h5>No se encontraron resultados</h5>
                        </div>

                    </div>
                </div>

            </div>

            <footer>
                <div class="pull-right" style="font-size: 11px;">
                    PORTAL ACCESO RANSA © <?php echo date('Y') ?>
                </div>
                <div class="clearfix"></div>
            </footer>
            
        </div>
    </div>

    <script src="../../vendors/jquery/dist/jquery.min.js"></script>
    <script src="../../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../vendors/nprogress/nprogress.js"></script>
    <script src="../../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../../build/js/custom.min.js"></script>

    <script src="../../plugins/sweetalert2/sweetalert2.min.js"></script>

    <!-- MANTENGO TU JAVASCRIPT ESPECIAL PARA CD3 -->
    <script>
    // Variables globales
    let allData = [];
    let displayedCount = 0;
    const initialLoadCount = 15;
    const loadMoreCount = 15;
    let isLoading = false;

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

    // FUNCIÓN MEJORADA: Extraer solo el texto limpio (sin HTML)
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

    // FUNCIÓN ESPECIAL PARA CD3: Determinar si Antecedentes está "No"
    function isAntecedentesNo(antecedentesValue) {
        if (!antecedentesValue) return false;
        const antecedentesText = cleanButtonText(antecedentesValue).toLowerCase().trim();
        
        return antecedentesText === 'no' || 
               antecedentesText === 'no ' ||
               antecedentesText.includes('no') ||
               antecedentesText === 'negativo' ||
               antecedentesText === 'rechazado';
    }

    // FUNCIÓN ESPECIAL PARA CD3: Determinar si Estado está "Activo" o "Aprobado"
    function isEstadoActivo(estadoValue) {
        if (!estadoValue) return false;
        const estadoText = cleanButtonText(estadoValue).toLowerCase().trim();
        
        return estadoText === 'activo' || 
               estadoText === 'aprobado' ||
               estadoText === 'aprobada' ||
               estadoText === 'sí' || 
               estadoText === 'si' ||
               estadoText === 'habilitado' ||
               estadoText === 'activa' ||
               estadoText === 'aprobado ' ||
               estadoText.includes('aprobado');
    }

    // FUNCIÓN ESPECIAL PARA CD3: Determinar estado general solo con Antecedentes y Estado
    function getEstadoGeneralCD3(antecedentesValue, estadoValue) {
        const antecedentesNo = isAntecedentesNo(antecedentesValue);
        const estadoActivo = isEstadoActivo(estadoValue);
        
        if (antecedentesNo && estadoActivo) {
            return 'AUTORIZADO';
        } else {
            return 'RESTRINGIDO';
        }
    }

    // FUNCIÓN ESPECIAL PARA CD3: Obtener badge
    function getStatusBadgeCD3(antecedentesValue, estadoValue) {
        const estado = getEstadoGeneralCD3(antecedentesValue, estadoValue);
        
        if (estado === 'AUTORIZADO') {
            return '<span class="status-badge status-autorizado">AUTORIZADO</span>';
        } else {
            return '<span class="status-badge status-restringido">RESTRINGIDO</span>';
        }
    }

    // Función para consultar antecedentes - SILENCIOSA
    function consultarAntecedentes(cedula, buttonElement) {
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
                        loadRealData($('#searchInput').val());
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

    // MODIFICA la función createCard para mostrar los valores correctamente:
    function createCard(tercero, index) {
        const cedula = cleanButtonText(tercero.Cedula);
        const nombre = tercero.Nombre || 'N/A';
        const antecedentesValue = tercero.Antedentes || tercero.antecedentes || 'N/A';
        const estadoValue = tercero.estado || tercero.Estado || 'N/A';
        const fechaRegistro = tercero.fecha_registro || tercero.fechaRegistro || tercero.Fecha_registro || 'N/A';
        const numConsulta = tercero.numconsulta || 0;
        const cd = tercero.cd || 'N/A';
        
        const antecedentesLimpio = cleanButtonText(antecedentesValue);
        const estadoLimpio = cleanButtonText(estadoValue);
        
        const estado = getEstadoGeneralCD3(antecedentesValue, estadoValue);
        const estadoClass = estado === 'AUTORIZADO' ? 'status-autorizado-card' : 'status-restringido-card';
        
        return `
            <div class="tercero-card ${estadoClass}" data-index="${index}">
                <div class="card-header">
                    <h5>
                        <i class="fa fa-user-circle"></i>
                        ${nombre}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="info-item">
                        <span class="info-label">
                            <i class="fa fa-id-card"></i> Cédula:
                        </span>
                        <span class="info-value">${cedula}</span>
                    </div>
                    
                    <div style="text-align: center; padding: 3px 0;">
                        <button type="button" class="btn btn-antecedentes" 
                                onclick="consultarAntecedentes('${cedula}', this)"
                                title="Consultar antecedentes penales">
                            <i class="fa fa-search"></i> Antecedentes
                        </button>
                    </div>
                    
                    <div class="info-item">
                        <span class="info-label">
                            <i class="fa fa-history"></i> Antecedentes:
                        </span>
                        <span class="info-value">${antecedentesLimpio}</span>
                    </div>
                    
                    <div class="info-item">
                        <span class="info-label">
                            <i class="fa fa-check-circle"></i> Estado:
                        </span>
                        <span class="info-value">${estadoLimpio}</span>
                    </div>
                    
                    <div class="info-item">
                        <span class="info-label">
                            <i class="fa fa-calendar"></i> Fecha Registro:
                        </span>
                        <span class="info-value">${formatDate(fechaRegistro)}</span>
                    </div>
                    
                    ${cd !== 'N/A' ? `
                    <div class="info-item">
                        <span class="info-label">
                            <i class="fa fa-building"></i> CD:
                        </span>
                        <span class="info-value">${cd}</span>
                    </div>
                    ` : ''}
                    
                    <div class="info-item">
                        <span class="info-label">
                            <i class="fa fa-eye"></i> Consultas:
                        </span>
                        <span class="info-value">${numConsulta}</span>
                    </div>
                    
                    <div class="info-item">
                        <span class="info-label">
                            <i class="fa fa-circle"></i> Estado General:
                        </span>
                        <span class="info-value">${getStatusBadgeCD3(antecedentesValue, estadoValue)}</span>
                    </div>
                </div>
            </div>
        `;
    }

    // Función para cargar datos REALES del endpoint - CONTROLADOR CORRECTO PARA CD3
    function loadRealData(searchTerm = '', loadMore = false) {
        if (isLoading) return;
        
        isLoading = true;
        
        if (!loadMore) {
            $('#cardsContainer').html('<div class="loading-spinner"><i class="fa fa-spinner fa-spin"></i><p>Cargando datos CD3...</p></div>');
            allData = [];
            displayedCount = 0;
        } else {
            $('#loadMoreBtn').html('<i class="fa fa-spinner fa-spin"></i> Cargando...').prop('disabled', true);
        }
        
        $.ajax({
            url: "../../Controller/Controller_cd3.php",
            type: "POST",
            data: { "txt_option": '2' },
            dataType: "json",
            success: function(response) {
                isLoading = false;
                
                if (response && response.data) {
                    if (loadMore) {
                        allData = allData.concat(response.data);
                    } else {
                        allData = response.data;
                    }
                    
                    filterAndDisplayResults(searchTerm);
                    
                } else {
                    if (!loadMore) {
                        $('#cardsContainer').html('<div class="no-results"><i class="fa fa-exclamation-triangle"></i><h5>Error al cargar datos</h5></div>');
                    }
                }
                
                if (loadMore) {
                    $('#loadMoreBtn').html('<i class="fa fa-refresh"></i> Cargar Más').prop('disabled', false);
                }
            },
            error: function(xhr, status, error) {
                isLoading = false;
                console.error("Error al cargar datos CD3:", error);
                
                if (!loadMore) {
                    $('#cardsContainer').html('<div class="no-results"><i class="fa fa-exclamation-triangle"></i><h5>Error de conexión</h5></div>');
                }
                
                if (loadMore) {
                    $('#loadMoreBtn').html('<i class="fa fa-refresh"></i> Cargar Más').prop('disabled', false);
                }
            }
        });
    }

    // Función para filtrar y mostrar resultados
    function filterAndDisplayResults(searchTerm = '') {
        const container = $('#cardsContainer');
        const resultsCount = $('#resultsCount');
        const totalCount = $('#totalCount');
        const loadMoreBtn = $('#loadMoreBtn');
        const noResults = $('#noResults');

        if (searchTerm) {
            displayedCount = 0;
        }

        let filteredData = allData;
        if (searchTerm) {
            const term = searchTerm.toLowerCase();
            filteredData = allData.filter(item => {
                const nombre = item.Nombre ? item.Nombre.toLowerCase() : '';
                const cedula = item.Cedula ? cleanButtonText(item.Cedula).toLowerCase() : '';
                const cd = item.cd ? item.cd.toLowerCase() : '';
                const razonSocial = item.Razon_Social ? item.Razon_Social.toLowerCase() : '';
                
                return nombre.includes(term) || 
                       cedula.includes(term) || 
                       cd.includes(term) ||
                       razonSocial.includes(term);
            });
        }

        const currentDisplayCount = Math.min(displayedCount + (searchTerm ? filteredData.length : initialLoadCount), filteredData.length);
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

        const endIndex = Math.min(displayedCount + (searchTerm ? filteredData.length : initialLoadCount), filteredData.length);
        
        if (searchTerm || displayedCount === 0) {
            container.empty();
        }

        for (let i = displayedCount; i < endIndex; i++) {
            container.append(createCard(filteredData[i], i));
        }

        displayedCount = endIndex;

        if (displayedCount < filteredData.length && !searchTerm) {
            loadMoreBtn.show();
        } else {
            loadMoreBtn.hide();
        }
    }

    function performSearch(searchTerm = '') {
        if (searchTerm) {
            displayedCount = 0;
            filterAndDisplayResults(searchTerm);
        } else {
            displayedCount = 0;
            filterAndDisplayResults();
        }
    }

    $(document).ready(function() {
        $('#menu_toggle').on('click', function() {
            $('.left_col').toggleClass('menu-open');
        });

        loadRealData();

        let searchTimeout;
        $('#searchInput').on('input', function() {
            const searchTerm = $(this).val();
            
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                performSearch(searchTerm);
            }, 300);
        });

        $('#loadMoreBtn').on('click', function() {
            loadRealData('', true);
        });

        $('#searchInput').on('keydown', function(e) {
            if (e.key === 'Escape') {
                $(this).val('');
                performSearch('');
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

    <script src="../funciones.js"></script>

</body>
</html>