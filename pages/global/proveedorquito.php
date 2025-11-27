<?php
include('../../Conexion/conexion_mysqli.php');
include('../../Model/Model_gb_global.php');
include('../../control_session.php');

// Agregar esta línea para evitar el error
$_SESSION['tipo_usuario'] = isset($_SESSION['tipo_usuario']) ? $_SESSION['tipo_usuario'] : 'usuario';

$dato1 = 5;   // Módulo
$dato2 = 39;  // Interfaz  
$dato3 = 1;   // Origen
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PORTAL DE ACCESO A TERCEROS - QUITO</title>
  
  <!-- CSS de Gentelella (COPIADO DE GUAYAQUIL) -->
  <link href="../../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="../../vendors/nprogress/nprogress.css" rel="stylesheet">
  <link href="../../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
  <link href="../../vendors/select2/dist/css/select2.min.css" rel="stylesheet">
  <link href="../../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
  <link href="../../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
  <link href="../../build/css/custom.min.css" rel="stylesheet">

  <style>
    /* Estilos mejorados para las tarjetas - DISEÑO ELEGANTE Y COMPACTO */
    .cards-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 16px;
        padding: 20px 0;
    }

    .tercero-card {
        background: linear-gradient(145deg, #ffffff, #fafafa);
        border-radius: 16px;
        box-shadow: 
            0 4px 20px rgba(0, 0, 0, 0.08),
            0 1px 3px rgba(0, 0, 0, 0.05);
        border: 1px solid rgba(0, 154, 63, 0.1);
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        overflow: hidden;
        position: relative;
        backdrop-filter: blur(10px);
    }

    .tercero-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, #009A3F, #00c853, #4CAF50);
        background-size: 200% 100%;
        animation: gradientFlow 3s ease infinite;
    }

    @keyframes gradientFlow {
        0% { background-position: 200% 0; }
        100% { background-position: -200% 0; }
    }

    .tercero-card:hover {
        transform: translateY(-6px) scale(1.02);
        box-shadow: 
            0 12px 35px rgba(0, 154, 63, 0.15),
            0 4px 15px rgba(0, 0, 0, 0.08);
        border-color: rgba(0, 154, 63, 0.3);
    }

    .card-header {
        background: transparent;
        padding: 16px 16px 12px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.06);
        position: relative;
    }

    .card-header h5 {
        margin: 0;
        font-size: 13px;
        font-weight: 700;
        color: #2A3F54;
        display: flex;
        align-items: center;
        line-height: 1.3;
    }

    .card-header h5 i {
        margin-right: 8px;
        color: #009A3F;
        font-size: 14px;
        background: rgba(0, 154, 63, 0.1);
        padding: 6px;
        border-radius: 8px;
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .card-body {
        padding: 12px 16px 16px;
        background: transparent;
    }

    .info-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 6px 0;
        border-bottom: 1px solid rgba(0, 0, 0, 0.04);
        transition: all 0.2s ease;
        border-radius: 4px;
    }

    .info-item:hover {
        background: rgba(0, 154, 63, 0.03);
        padding-left: 6px;
        padding-right: 6px;
    }

    .info-item:last-child {
        border-bottom: none;
    }

    .info-label {
        font-weight: 600;
        color: #555;
        font-size: 10px;
        display: flex;
        align-items: center;
        flex-shrink: 0;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .info-label i {
        margin-right: 6px;
        font-size: 10px;
        color: #009A3F;
        width: 12px;
        text-align: center;
        opacity: 0.8;
    }

    .info-value {
        color: #333;
        font-size: 10px;
        text-align: right;
        margin-left: 8px;
        font-weight: 500;
        line-height: 1.3;
    }

    .status-badge {
        padding: 3px 8px;
        border-radius: 10px;
        font-size: 8px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border: 1px solid transparent;
    }

    .status-activo {
        background: linear-gradient(135deg, #e8f5e8, #c8e6c9);
        color: #2e7d32;
        border-color: #a5d6a7;
    }

    .status-pendiente {
        background: linear-gradient(135deg, #fff3cd, #ffeaa7);
        color: #856404;
        border-color: #ffd54f;
    }

    .status-inactivo {
        background: linear-gradient(135deg, #f8d7da, #f5c6cb);
        color: #721c24;
        border-color: #f1b0b7;
    }

    .search-container {
        background: linear-gradient(135deg, #ffffff, #f8f9fa);
        padding: 20px;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        margin-bottom: 25px;
        border: 1px solid rgba(0, 154, 63, 0.1);
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
        background: linear-gradient(90deg, #009A3F, #00c853, #4CAF50);
        background-size: 200% 100%;
        animation: gradientFlow 3s ease infinite;
    }

    .search-box {
        position: relative;
        max-width: 400px;
    }

    .search-box .form-control {
        padding-left: 45px;
        border-radius: 25px;
        border: 2px solid rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.9);
        font-size: 14px;
    }

    .search-box .form-control:focus {
        border-color: #009A3F;
        box-shadow: 0 0 0 3px rgba(0, 154, 63, 0.1);
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
        box-shadow: 0 4px 15px rgba(0, 154, 63, 0.3);
        color: white;
    }

    .load-more-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 154, 63, 0.4);
        background: linear-gradient(135deg, #008a35, #00b848);
        color: white;
    }

    .no-results {
        text-align: center;
        padding: 40px;
        color: #666;
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        margin: 20px 0;
        border: 1px solid rgba(0, 0, 0, 0.1);
    }

    .no-results i {
        font-size: 48px;
        margin-bottom: 15px;
        color: #ccc;
    }

    /* Efectos de carga mejorados */
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

    /* Grid responsivo para 5 columnas */
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
        
        .tercero-card {
            margin-bottom: 0;
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
            font-size: 9px;
        }
    }

    /* Estilos adicionales para mejorar la estética general */
    .x_panel {
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(0, 0, 0, 0.1);
    }

    .x_title {
        border-bottom: 1px solid rgba(0, 0, 0, 0.08);
    }

    .x_title h2 {
        color: #2A3F54;
        font-weight: 700;
    }

    .x_title h5 {
        color: #F39200;
        font-weight: 600;
    }
  </style>
</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      
      <!-- Sidebar de Gentelella (COPIADO DE GUAYAQUIL) -->
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

          <!-- MENÚ PRINCIPAL (COPIADO DE GUAYAQUIL) -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <h3>Navegación Principal</h3>
              <ul class="nav side-menu">
                <!-- Aquí mantenemos el menú original del sistema -->
                <?php 
                // INCLUIR MENÚ DIRECTAMENTE (igual que Guayaquil)
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

          <!-- /menu footer buttons -->
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

      <!-- top navigation (COPIADO DE GUAYAQUIL) -->
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

      <!-- page content -->
      <div class="right_col" role="main">
        <div class="">
          <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 col-sm-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2><i class="fa fa-address-card"></i> PORTAL DE ACCESO A TERCEROS - QUITO</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  
                  <!-- Contenido existente adaptado -->
                  <div id="mensaje2"></div>
                  
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="x_panel">
                        <div class="x_title">
                          <h5 style="color: #F39200">
                            <i class="fa fa-search"></i> Consulta de Terceros
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
      <!-- /page content -->

      <!-- footer content (COPIADO DE GUAYAQUIL) -->
      <footer>
        <div class="pull-right">
          Copyright © <?php echo date('Y') ?> RANSA Help-Desk. All rights reserved.
        </div>
        <div class="clearfix"></div>
      </footer>
      
    </div>
  </div>

  <!-- SCRIPTS de Gentelella (COPIADO DE GUAYAQUIL) -->
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
    // Variables globales
    let allData = [];
    let displayedCount = 0;
    const initialLoadCount = 15;
    const loadMoreCount = 15;
    let isLoading = false;

    // Función para formatear fecha
    function formatDate(dateString) {
        if (!dateString) return 'N/A';
        const date = new Date(dateString);
        return date.toLocaleDateString('es-ES');
    }

    // Función para determinar el estado
    function getStatusBadge(seguridad, antecedentes) {
        if (seguridad && antecedentes) {
            return '<span class="status-badge status-activo">ACTIVO</span>';
        } else if (!seguridad && !antecedentes) {
            return '<span class="status-badge status-inactivo">INACTIVO</span>';
        } else {
            return '<span class="status-badge status-pendiente">PENDIENTE</span>';
        }
    }

    // Función para limpiar HTML de botones y extraer solo el texto
    function cleanButtonText(htmlString) {
        if (!htmlString) return 'N/A';
        // Extraer solo el texto del botón (eliminar el SVG y botón completo)
        const tempDiv = document.createElement('div');
        tempDiv.innerHTML = htmlString;
        const textContent = tempDiv.textContent || tempDiv.innerText || '';
        // Extraer solo la cédula si está presente
        const cedulaMatch = textContent.match(/(\d+)/);
        return cedulaMatch ? cedulaMatch[1] : textContent.trim();
    }

    // Función para convertir estado de botón a booleano
    function buttonToBoolean(buttonHtml) {
        if (!buttonHtml) return false;
        const tempDiv = document.createElement('div');
        tempDiv.innerHTML = buttonHtml;
        const text = (tempDiv.textContent || tempDiv.innerText || '').toLowerCase().trim();
        return text === 'sí' || text === 'aprobado';
    }

    // Función para crear una tarjeta mejorada y compacta
    function createCard(tercero, index) {
        const examenSeguridad = buttonToBoolean(tercero.Examen_seguridad);
        const antecedentes = buttonToBoolean(tercero.Antedentes);
        
        return `
            <div class="tercero-card" data-index="${index}">
                <div class="card-header">
                    <h5>
                        <i class="fa fa-user-circle"></i>
                        ${tercero.Nombre || 'N/A'}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="info-item">
                        <span class="info-label">
                            <i class="fa fa-id-card"></i> Cédula:
                        </span>
                        <span class="info-value">${cleanButtonText(tercero.Cedula) || 'N/A'}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">
                            <i class="fa fa-shield"></i> Seguridad:
                        </span>
                        <span class="info-value">${cleanButtonText(tercero.Examen_seguridad)}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">
                            <i class="fa fa-history"></i> Antecedentes:
                        </span>
                        <span class="info-value">${cleanButtonText(tercero.Antedentes)}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">
                            <i class="fa fa-building"></i> Razón Social:
                        </span>
                        <span class="info-value">${tercero.Razon_Social ? (tercero.Razon_Social.length > 18 ? tercero.Razon_Social.substring(0, 18) + '...' : tercero.Razon_Social) : 'N/A'}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">
                            <i class="fa fa-circle"></i> Estado:
                        </span>
                        <span class="info-value">${getStatusBadge(examenSeguridad, antecedentes)}</span>
                    </div>
                </div>
            </div>
        `;
    }

    // Función para cargar datos REALES del endpoint
    function loadRealData(searchTerm = '', loadMore = false) {
        if (isLoading) return;
        
        isLoading = true;
        
        if (!loadMore) {
            // Mostrar loading solo para carga inicial
            $('#cardsContainer').html('<div class="loading-spinner"><i class="fa fa-spinner fa-spin"></i><p>Cargando datos...</p></div>');
            allData = [];
            displayedCount = 0;
        } else {
            // Mostrar loading en el botón para cargar más
            $('#loadMoreBtn').html('<i class="fa fa-spinner fa-spin"></i> Cargando...').prop('disabled', true);
        }
        
        $.ajax({
            url: "../../Controller/Controller_proveedorgye.php",
            type: "POST",
            data: {
                "txt_option": '2'
            },
            dataType: "json",
            success: function(response) {
                isLoading = false;
                
                if (response && response.data) {
                    if (loadMore) {
                        // Para cargar más, agregamos a los datos existentes
                        allData = allData.concat(response.data);
                    } else {
                        // Para carga inicial, reemplazamos todos los datos
                        allData = response.data;
                    }
                    
                    // Filtrar y mostrar resultados
                    filterAndDisplayResults(searchTerm);
                    
                } else {
                    if (!loadMore) {
                        $('#cardsContainer').html('<div class="no-results"><i class="fa fa-exclamation-triangle"></i><h4>Error al cargar datos</h4><p>No se pudieron obtener los registros</p></div>');
                    }
                }
                
                if (loadMore) {
                    $('#loadMoreBtn').html('<i class="fa fa-refresh"></i> Cargar Más Registros').prop('disabled', false);
                }
            },
            error: function(xhr, status, error) {
                isLoading = false;
                console.error("Error al cargar datos:", error);
                
                if (!loadMore) {
                    $('#cardsContainer').html('<div class="no-results"><i class="fa fa-exclamation-triangle"></i><h4>Error de conexión</h4><p>No se pudo conectar al servidor</p></div>');
                }
                
                if (loadMore) {
                    $('#loadMoreBtn').html('<i class="fa fa-refresh"></i> Cargar Más Registros').prop('disabled', false);
                }
            }
        });
    }

    // Función para filtrar y mostrar resultados (búsqueda en TODOS los datos)
    function filterAndDisplayResults(searchTerm = '') {
        const container = $('#cardsContainer');
        const resultsCount = $('#resultsCount');
        const totalCount = $('#totalCount');
        const loadMoreBtn = $('#loadMoreBtn');
        const noResults = $('#noResults');

        // Resetear contador si es nueva búsqueda
        if (searchTerm) {
            displayedCount = 0;
        }

        // Filtrar datos si hay término de búsqueda - busca en TODOS los datos
        let filteredData = allData;
        if (searchTerm) {
            const term = searchTerm.toLowerCase();
            filteredData = allData.filter(item => {
                const nombre = item.Nombre ? item.Nombre.toLowerCase() : '';
                const cedula = item.Cedula ? cleanButtonText(item.Cedula).toLowerCase() : '';
                const razonSocial = item.Razon_Social ? item.Razon_Social.toLowerCase() : '';
                
                return nombre.includes(term) || 
                       cedula.includes(term) || 
                       razonSocial.includes(term);
            });
        }

        // Actualizar contadores
        const currentDisplayCount = Math.min(displayedCount + (searchTerm ? filteredData.length : initialLoadCount), filteredData.length);
        resultsCount.text(currentDisplayCount);
        totalCount.text(filteredData.length);

        // Mostrar/u ocultar mensaje sin resultados
        if (filteredData.length === 0) {
            container.hide();
            loadMoreBtn.hide();
            noResults.show();
            return;
        } else {
            noResults.hide();
            container.show();
        }

        // Calcular cuántos elementos mostrar
        const endIndex = Math.min(displayedCount + (searchTerm ? filteredData.length : initialLoadCount), filteredData.length);
        
        // Limpiar contenedor si es nueva búsqueda o carga inicial
        if (searchTerm || displayedCount === 0) {
            container.empty();
        }

        // Agregar tarjetas
        for (let i = displayedCount; i < endIndex; i++) {
            container.append(createCard(filteredData[i], i));
        }

        displayedCount = endIndex;

        // Mostrar/u ocultar botón "Cargar más" - solo si hay más datos Y no hay búsqueda activa
        if (displayedCount < filteredData.length && !searchTerm) {
            loadMoreBtn.show();
        } else {
            loadMoreBtn.hide();
        }
    }

    // Función para buscar en tiempo real
    function performSearch(searchTerm = '') {
        if (searchTerm) {
            // Con búsqueda activa, mostramos todos los resultados coincidentes
            displayedCount = 0;
            filterAndDisplayResults(searchTerm);
        } else {
            // Sin búsqueda, volvemos a la paginación normal
            displayedCount = 0;
            filterAndDisplayResults();
        }
    }

    // Eventos cuando el documento está listo
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle del menú en móviles
        document.getElementById('menu_toggle').addEventListener('click', function() {
            const leftCol = document.querySelector('.left_col');
            leftCol.classList.toggle('menu-open');
        });

        // Cargar datos REALES iniciales
        loadRealData();

        // Evento de búsqueda en tiempo real
        let searchTimeout;
        $('#searchInput').on('input', function() {
            const searchTerm = $(this).val();
            
            // Debounce para evitar muchas búsquedas rápidas
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                performSearch(searchTerm);
            }, 300);
        });

        // Evento cargar más
        $('#loadMoreBtn').on('click', function() {
            // Al cargar más, recargamos todos los datos para asegurar consistencia
            loadRealData('', true);
        });

        // Evento para limpiar búsqueda con ESC
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

  <!-- Scripts específicos de la página -->
  <script src="../funciones.js"></script>
  <script src="./js/portalacceso.js"></script>

</body>
</html>