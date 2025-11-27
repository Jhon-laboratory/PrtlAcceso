<?php
include('../../Conexion/conexion_mysqli.php');
include('../../Model/Model_gb_global.php');
include('../../control_session.php');

// FUNCIÓN SISTEMA_MENU ADAPTADA PARA GENTELLA
function sistema_menu_gentella($modulo, $interfaz, $origen) 
{    
    $conn = conexionSQL();
    $Global = new ModelGlobal();
    $sql = "SELECT * FROM gb_modulo WHERE gb_estatus='1' ORDER BY gb_id_modulo ASC";
    $resultado = sqlsrv_query($conn, $sql);
    
    while ($fila = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC)) {
        /** PERFIL ADMINISTRADOR **/
        if ($_SESSION["gb_perfil"] == 1) {
            generar_menu_gentella($fila, $modulo, $interfaz, $origen, $conn, true);
        } 
        /** NO ES PERFIL ADMINISTRADOR **/
        else {
            if($_SESSION["gb_id_user"] == 24) {
                if($fila['gb_id_modulo'] == 3) {
                    $validacion = false;
                } else {
                    $validacion = true;
                }
            } else {
                $validacion = $Global->modulo_permitido($fila['gb_id_modulo'], $_SESSION["gb_perfil"]) == 1;
            }

            if($validacion) {
                generar_menu_gentella($fila, $modulo, $interfaz, $origen, $conn, false);
            }
        }
    }
}

// FUNCIÓN AUXILIAR PARA GENERAR EL MENÚ GENTELLA
function generar_menu_gentella($fila, $modulo, $interfaz, $origen, $conn, $esAdmin) 
{
    $moduloActivo = ($modulo == $fila['gb_id_modulo']) ? 'active' : '';
    
    echo '<li class="' . $moduloActivo . '">';
    echo '<a>';
    echo '<i class="' . $fila['gb_icono_modulo'] . '"></i>';
    echo '<span>' . $fila['gb_nombre_modulo'] . '</span>';
    echo '<span class="fa fa-chevron-down"></span>';
    echo '</a>';
    
    echo '<ul class="nav child_menu">';
    
    $sql_menu = "SELECT * FROM gb_menu WHERE gb_id_modulo = '" . $fila['gb_id_modulo'] . "' AND gb_estatus='1'";
    $resultado_menu = sqlsrv_query($conn, $sql_menu);
    
    while ($fila_menu = sqlsrv_fetch_array($resultado_menu, SQLSRV_FETCH_ASSOC)) {
        if($origen == 0) {
            $ext = $fila_menu['gb_raiz'] . '/';
        } else {
            $ext = '';
        }
        
        $menuActivo = ($interfaz == $fila_menu['gb_id_menu']) ? 'current-page' : '';
        
        // Validaciones de permisos para perfiles específicos
        $mostrarItem = true;
        if (!$esAdmin) {
            switch ($_SESSION["gb_perfil"]) {
                case 5: // Perfil 5
                    $mostrarItem = in_array($fila_menu['gb_id_menu'], [15, 39]);
                    break;
                case 4: // Perfil 4
                    $mostrarItem = in_array($fila_menu['gb_id_menu'], [39, 42, 43]);
                    break;
                case 7: // Perfil 7
                    $mostrarItem = in_array($fila_menu['gb_id_menu'], [15]);
                    break;
                case 2: // Perfil 2 (Supervisor)
                    $mostrarItem = in_array($fila_menu['gb_id_menu'], [15, 44]);
                    break;
            }
        }
        
        if ($mostrarItem) {
            echo '<li class="' . $menuActivo . '">';
            echo '<a href="' . $ext . 'index.php?opc=' . $fila_menu['gb_archivo'] . '">';
            echo '<i class="fa fa-circle-o"></i>';
            echo $fila_menu['gb_nombre_menu'];
            echo '</a>';
            echo '</li>';
        }
    }
    
    echo '</ul>';
    echo '</li>';
}

// Agregar esta línea para evitar el error
$_SESSION['tipo_usuario'] = isset($_SESSION['tipo_usuario']) ? $_SESSION['tipo_usuario'] : 'usuario';

$dato1 = 6;   // Módulo
$dato2 = 48;  // Interfaz  
$dato3 = 1;   // Origen
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PORTAL DE ACCESO A TERCEROS</title>
  
  <!-- CSS de Gentelella (COPIADO DEL MODELO) -->
  <link href="../../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="../../vendors/nprogress/nprogress.css" rel="stylesheet">
  <link href="../../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
  <link href="../../vendors/select2/dist/css/select2.min.css" rel="stylesheet">
  <link href="../../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
  <link href="../../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
  <link href="../../build/css/custom.min.css" rel="stylesheet">

  <style>
    /* Estilos para las tarjetas - NUEVO DISEÑO ELEGANTE CON COLOR ENTERO */
    .cards-container {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 15px;
        padding: 20px 0;
    }

    .tercero-card {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        border: none;
        transition: all 0.3s ease;
        overflow: hidden;
        position: relative;
        padding: 0;
    }

    .tercero-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        width: 4px;
        background: linear-gradient(180deg, #009A3F 0%, #006b2d 100%);
        z-index: 2;
    }

    .tercero-card::after {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        width: 2px;
        background: linear-gradient(180deg, #6c757d 0%, #495057 100%);
        opacity: 0.6;
    }

    .tercero-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        background: linear-gradient(135deg, #ffffff 0%, #f1f3f4 100%);
    }

    .tercero-card:hover::before {
        background: linear-gradient(180deg, #00c853 0%, #009A3F 100%);
        width: 5px;
    }

    .card-content {
        padding: 15px;
        position: relative;
        z-index: 1;
    }

    .card-header {
        background: transparent;
        padding: 0 0 12px 0;
        margin-bottom: 10px;
        border-bottom: 1px solid rgba(0, 154, 63, 0.2);
        position: relative;
    }

    .card-header::after {
        content: '';
        position: absolute;
        bottom: -1px;
        left: 0;
        width: 40px;
        height: 2px;
        background: #009A3F;
    }

    .card-header h5 {
        margin: 0;
        font-size: 14px;
        font-weight: 700;
        color: #2c3e50;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        padding-left: 5px;
    }

    .info-grid {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .info-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 6px 0;
        position: relative;
    }

    .info-item:not(:last-child)::after {
        content: '';
        position: absolute;
        bottom: -4px;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent 0%, rgba(108, 117, 125, 0.2) 50%, transparent 100%);
    }

    .info-label {
        font-weight: 600;
        color: #495057;
        font-size: 11px;
        flex: 0 0 45%;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .info-value {
        color: #2c3e50;
        font-size: 11px;
        text-align: right;
        flex: 1;
        margin-left: 5px;
        line-height: 1.3;
        font-weight: 500;
    }

    .status-container {
        margin-top: 8px;
        padding-top: 8px;
        border-top: 1px solid rgba(0, 154, 63, 0.3);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .status-label {
        font-size: 10px;
        font-weight: 600;
        color: #495057;
        text-transform: uppercase;
    }

    .status-badge {
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 9px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-activo {
        background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
        color: #155724;
        border: 1px solid #b1dfbb;
    }

    .status-pendiente {
        background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);
        color: #856404;
        border: 1px solid #ffdf7e;
    }

    .status-inactivo {
        background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
        color: #721c24;
        border: 1px solid #f1b0b7;
    }

    .card-footer {
        margin-top: 10px;
        padding-top: 8px;
        border-top: 1px solid rgba(108, 117, 125, 0.2);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .consultas-count {
        font-size: 10px;
        color: #6c757d;
        font-weight: 600;
    }

    .consultas-number {
        background: #009A3F;
        color: white;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 9px;
        font-weight: 700;
    }

    .search-container {
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        margin-bottom: 20px;
        border: 1px solid #e9ecef;
    }

    .search-box {
        position: relative;
        max-width: 400px;
    }

    .search-box .form-control {
        padding-left: 40px;
        border-radius: 25px;
        border: 2px solid #e0e0e0;
        background: #f8f9fa;
        transition: all 0.3s ease;
    }

    .search-box .form-control:focus {
        border-color: #009A3F;
        background: white;
        box-shadow: 0 0 0 0.2rem rgba(0, 154, 63, 0.25);
    }

    .search-box .fa-search {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
    }

    .results-count {
        color: #495057;
        font-size: 14px;
        margin-top: 10px;
        font-weight: 600;
    }

    .load-more-container {
        text-align: center;
        margin: 30px 0;
    }

    .no-results {
        text-align: center;
        padding: 50px 40px;
        color: #6c757d;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 10px;
        border: 2px dashed #dee2e6;
    }

    .no-results i {
        font-size: 48px;
        margin-bottom: 15px;
        color: #adb5bd;
    }

    /* Responsive */
    @media (max-width: 1400px) {
        .cards-container {
            grid-template-columns: repeat(4, 1fr);
        }
    }

    @media (max-width: 1200px) {
        .cards-container {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 992px) {
        .cards-container {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .cards-container {
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 15px;
            padding: 15px 0;
        }
    }

    @media (max-width: 576px) {
        .cards-container {
            grid-template-columns: 1fr;
        }
        
        .card-header h5 {
            font-size: 14px;
        }
    }

    /* Efectos adicionales para profesionalismo */
    .tercero-card {
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
    }

    .card-content {
        background: rgba(255, 255, 255, 0.9);
    }

    .tercero-card:hover .card-content {
        background: rgba(255, 255, 255, 0.95);
    }
  </style>
</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      
      <!-- Sidebar de Gentelella (COPIADO DEL MODELO) -->
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

          <!-- MENÚ PRINCIPAL (COPIADO DEL MODELO) -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <h3>Navegación Principal</h3>
              <ul class="nav side-menu">
                <!-- Aquí mantenemos el menú con la nueva función -->
                <?php 
                // Usar la nueva función adaptada
                sistema_menu_gentella($dato1, $dato2, $dato3);
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

      <!-- top navigation (COPIADO DEL MODELO) -->
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
                  <h2><i class="fa fa-address-card"></i> PORTAL DE ACCESO A TERCEROS - GUAYAQUIL</h2>
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
                            <button id="loadMoreBtn" class="btn btn-primary" style="display: none;">
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

      <!-- footer content (COPIADO DEL MODELO) -->
      <footer>
        <div class="pull-right">
          Copyright © <?php echo date('Y') ?> RANSA Help-Desk. All rights reserved.
        </div>
        <div class="clearfix"></div>
      </footer>
      
    </div>
  </div>

  <!-- SCRIPTS de Gentelella (COPIADO DEL MODELO) -->
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
    const initialLoadCount = 15; // 5 columnas x 3 filas = 15 tarjetas
    const loadMoreCount = 15;
    let isLoading = false;
    let hasMoreData = true;

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
        // Extraer solo el texto del botón
        const match = htmlString.match(/>([^<]+)</);
        return match ? match[1].trim() : htmlString;
    }

    // Función para convertir estado de botón a booleano
    function buttonToBoolean(buttonHtml) {
        const text = cleanButtonText(buttonHtml).toLowerCase();
        return text === 'sí' || text === 'aprobado';
    }

    // Función para crear una tarjeta - DISEÑO MEJORADO
    function createCard(tercero, index) {
        return `
            <div class="tercero-card" data-index="${index}">
                <div class="card-content">
                    <div class="card-header">
                        <h5 title="${tercero.Nombre || 'N/A'}">
                            <i class="fa fa-user" style="color: #009A3F;"></i>
                            ${tercero.Nombre || 'N/A'}
                        </h5>
                    </div>
                    
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">Cédula:</span>
                            <span class="info-value">${cleanButtonText(tercero.Cedula) || 'N/A'}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Documento IESS:</span>
                            <span class="info-value">${tercero.DocIess || 'N/A'}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Seguridad:</span>
                            <span class="info-value">${cleanButtonText(tercero.Examen_seguridad)}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Antecedentes:</span>
                            <span class="info-value">${cleanButtonText(tercero.Antedentes)}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Razón Social:</span>
                            <span class="info-value" title="${tercero.Razon_Social || 'N/A'}">${tercero.Razon_Social || 'N/A'}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Fecha Doc:</span>
                            <span class="info-value">${formatDate(tercero.Fecha_de_documentacion)}</span>
                        </div>
                    </div>
                    

                    
                    <div class="card-footer">
                        <span class="consultas-count">Consultas:</span>
                        <span class="consultas-number">${tercero.numconsulta || 0}</span>
                    </div>
                </div>
            </div>
        `;
    }

    // El resto del JavaScript se mantiene igual...
    // Función para cargar datos REALES del endpoint
    function loadRealData(searchTerm = '', loadMore = false) {
        if (isLoading) return;
        
        isLoading = true;
        
        if (!loadMore) {
            // Mostrar loading solo para carga inicial
            $('#cardsContainer').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x"></i><p>Cargando datos...</p></div>');
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
                    
                    // Ocultar botón si no hay más datos (en este caso siempre hay datos completos)
                    $('#loadMoreBtn').hide();
                    
                } else {
                    if (!loadMore) {
                        $('#cardsContainer').html('<div class="no-results"><i class="fa fa-exclamation-triangle"></i><h4>Error al cargar datos</h4><p>No se pudieron obtener los registros</p></div>');
                    }
                    $('#loadMoreBtn').hide();
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
                } else {
                    $('#loadMoreBtn').hide();
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
        const currentDisplayCount = Math.min(displayedCount + initialLoadCount, filteredData.length);
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