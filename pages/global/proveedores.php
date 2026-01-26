<?php
include('../../Conexion/conexion_mysqli.php');
include('../../Model/Model_gb_global.php');
include('../../control_session.php');

$_SESSION['tipo_usuario'] = isset($_SESSION['tipo_usuario']) ? $_SESSION['tipo_usuario'] : 'usuario';

$dato1 = 5;  // Ajusta estos valores según tu menú
$dato2 = 40; // Nuevo ID para el módulo proveedores  
$dato3 = 1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PORTAL DE ACCESO - PROVEEDORES IESS</title>
  
  <link href="../../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="../../vendors/nprogress/nprogress.css" rel="stylesheet">
  <link href="../../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
  <link href="../../vendors/select2/dist/css/select2.min.css" rel="stylesheet">
  <link href="../../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
  <link href="../../build/css/custom.min.css" rel="stylesheet">

  <style>
    /* MANTENER LOS MISMOS ESTILOS QUE proveedorguayaquiil.php */
    body {
        background: linear-gradient(rgba(255, 255, 255, 0.95), rgba(255, 255, 255, 0.95)), 
                    url('../../img/imglogin.jpg') center/cover no-repeat fixed;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .top_nav {
        background: #2c3e50;
        min-height: 40px !important;
        border-bottom: 1px solid #1a252f;
        display: flex;
        align-items: center;
    }
    
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
    
    .right_col {
        padding: 5px !important;
        min-height: calc(100vh - 40px) !important;
    }
    
    /* TARJETAS PROVEEDORES - DISEÑO SIMILAR */
    .cards-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 15px;
        padding: 0 !important;
    }

    .proveedor-card {
        background: linear-gradient(145deg, #ffffff, #f8f9fa);
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        border: 1px solid #e8f5e9;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
        position: relative;
        backdrop-filter: blur(10px);
    }

    .proveedor-card:hover {
        transform: translateY(-5px) scale(1.02);
        box-shadow: 0 12px 25px rgba(0,154,63,0.15);
        border-color: #009A3F;
    }

    .card-header {
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%); /* Azul para diferenciar */
        color: white;
        padding: 12px 15px 8px;
        position: relative;
        overflow: hidden;
        min-height: 50px;
        display: flex;
        align-items: center;
    }

    .card-header.proveedor-activo {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    }
    
    .card-header.proveedor-inactivo {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    }
    
    .card-header.proveedor-pendiente {
        background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);
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
        line-height: 1.3;
    }

    .card-header h5 i {
        margin-right: 8px;
        font-size: 14px;
        color: rgba(255,255,255,0.9);
        flex-shrink: 0;
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
        color: #007bff; /* Azul para diferenciar */
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
        flex: 1;
        min-width: 0; /* Permite que el texto se trunque */
    }

    .info-value .text-truncate {
        display: inline-block;
        max-width: 100%;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .status-badge {
        padding: 3px 8px;
        border-radius: 10px;
        font-size: 9px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-block;
    }

    .status-activo {
        background: linear-gradient(135deg, #d4edda, #c3e6cb);
        color: #155724;
        border: 1px solid #b1dfbb;
    }

    .status-inactivo {
        background: linear-gradient(135deg, #f8d7da, #f5c6cb);
        color: #721c24;
        border: 1px solid #f1b0b7;
    }
    
    .status-pendiente {
        background: linear-gradient(135deg, #fff3cd, #ffeaa7);
        color: #856404;
        border: 1px solid #ffeaa7;
    }

    .status-vigente {
        background: linear-gradient(135deg, #d4edda, #c3e6cb);
        color: #155724;
        border: 1px solid #b1dfbb;
    }

    .status-por-vencer {
        background: linear-gradient(135deg, #fff3cd, #ffeaa7);
        color: #856404;
        border: 1px solid #ffeaa7;
    }

    .status-vencido {
        background: linear-gradient(135deg, #f8d7da, #f5c6cb);
        color: #721c24;
        border: 1px solid #f1b0b7;
    }

    /* Indicador de estado en el borde lateral */
    .proveedor-card::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        border-radius: 4px 0 0 4px;
    }
    
    .proveedor-card.activo::after {
        background: linear-gradient(180deg, #28a745 0%, #20c997 100%);
    }
    
    .proveedor-card.inactivo::after {
        background: linear-gradient(180deg, #dc3545 0%, #c82333 100%);
    }
    
    .proveedor-card.pendiente::after {
        background: linear-gradient(180deg, #ffc107 0%, #e0a800 100%);
    }

    /* BUSCADOR */
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
        border-color: #007bff; /* Azul para diferenciar */
        box-shadow: 0 0 0 3px rgba(0,123,255,0.1);
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
        background: linear-gradient(135deg, #007bff, #0056b3);
        border: none;
        border-radius: 25px;
        padding: 8px 25px;
        font-size: 13px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 10px rgba(0,123,255,0.2);
    }

    .load-more-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(0,123,255,0.3);
        background: linear-gradient(135deg, #0069d9, #004085);
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

    .loading-spinner {
        text-align: center;
        padding: 30px;
        color: #007bff;
    }

    /* RESPONSIVE */
    @media (min-width: 1800px) {
        .cards-container {
            grid-template-columns: repeat(5, 1fr);
        }
    }

    @media (max-width: 767px) {
        .cards-container {
            grid-template-columns: 1fr;
            gap: 12px;
        }
        
        .card-header {
            min-height: 45px;
        }
        
        .card-header h5 {
            font-size: 12px;
        }
    }
    
    /* Tooltip personalizado */
    .card-header h5[title]:hover::after {
        content: attr(title);
        position: absolute;
        bottom: 100%;
        left: 50%;
        transform: translateX(-50%);
        background: rgba(0,0,0,0.8);
        color: white;
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 11px;
        white-space: nowrap;
        z-index: 1000;
        margin-bottom: 5px;
    }
  </style>
</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      
      <!-- Sidebar -->
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

          <!-- REEMPLAZA ESTA SECCIÓN DEL MENÚ CON EL NUEVO DISEÑO -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <ul class="nav side-menu">
                
                <!-- BOTÓN FIJO "PROVEEDORES" AL INICIO CON DOS OPCIONES -->
                <li class="active">
                  <a>
                    <i class="fa fa-truck"></i>
                    Proveedores
                    <span class="fa fa-chevron-up"></span>
                  </a>
                  <ul class="nav child_menu" style="display: block;">
                    <!-- OPCIÓN 1: PAGOS IESS (ACTIVA EN ESTA PÁGINA) -->
                    <li class="current-page">
                      <a href="proveedores.php">
                        <i class="fa fa-money"></i>
                        Pagos IESS
                      </a>
                    </li>
                    
                    <!-- OPCIÓN 2: DASHBOARD -->
                    <li>
                      <a href="proveedorguayaquiil.php">
                        <i class="fa fa-dashboard"></i>
                        Dashboard Proveedores
                      </a>
                    </li>
                  </ul>
                </li>
                
                <!-- MENÚ DINÁMICO DEL SISTEMA (Módulos de BD) -->
                <?php 
                include('../menu.php');
                sistema_menu($dato1, $dato2, $dato3); 
                ?>
                
                <!-- CERRAR SESIÓN -->
                <li>
                  <a href="../../session_destroy.php">
                    <i class="fa fa-sign-out"></i> Cerrar Sesión
                  </a>
                </li>
                
              </ul>
            </div>
          </div>
          <!-- FIN DEL MENÚ MODIFICADO -->

        </div>
      </div>

      <!-- CABECERA -->
      <div class="top_nav">
        <div class="nav_menu">
          <div class="navbar-left">
            <div class="nav toggle">
              <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>
            <div class="nav-title">
              <i class="fa fa-money"></i> PORTAL - PAGOS IESS
            </div>
          </div>
          
          <nav class="nav navbar-nav">
            <ul class="navbar-right">
              <li class="nav-item dropdown open">
                <a href="javascript:;" class="user-profile dropdown-toggle"
                  id="navbarDropdown" data-toggle="dropdown">
                  <div style="display: inline-flex; align-items: center; background: #007bff; width: 26px; height: 26px; border-radius: 50%; justify-content: center; margin-right: 8px;">
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
        <div class="row">
          <div class="col-md-12 col-sm-12">
            
            <!-- BUSCADOR -->
            <div class="search-container">
              <div class="row">
                <div class="col-md-8">
                  <div class="search-box">
                    <i class="fa fa-search"></i>
                    <input type="text" id="searchInput" class="form-control" placeholder="Buscar por RUC, razón social...">
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
              <!-- Las tarjetas se cargarán aquí -->
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
              <h5>No se encontraron proveedores</h5>
            </div>

          </div>
        </div>
      </div>

      <footer>
        <div class="pull-right" style="font-size: 11px;">
          PORTAL PROVEEDORES RANSA © <?php echo date('Y') ?>
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

  <!-- JAVASCRIPT PARA PROVEEDORES -->
  <script>
    // Variables globales
    let allData = [];
    let displayedCount = 0;
    const initialLoadCount = 15;
    const loadMoreCount = 15;
    let isLoading = false;

    // Formatear fecha
    function formatDate(dateString) {
        if (!dateString || 
            dateString === '' || 
            dateString === 'null' ||
            dateString === 'NULL' ||
            dateString === '0000-00-00' ||
            dateString === '0000-00-00 00:00:00') {
            return 'N/A';
        }
        
        // Extraer solo la parte de la fecha (YYYY-MM-DD)
        const datePart = dateString.split(' ')[0];
        const parts = datePart.split('-');
        
        if (parts.length === 3) {
            return `${parts[2]}/${parts[1]}/${parts[0]}`;
        }
        
        return dateString;
    }

    // Calcular estado de vigencia (45 días: 30 antes, 15 después)
    function calcularEstadoVigencia(fechaVigencia) {
        if (!fechaVigencia || 
            fechaVigencia === 'N/A' || 
            fechaVigencia === '0000-00-00' ||
            fechaVigencia === '0000-00-00 00:00:00') {
            return { texto: 'SIN FECHA', clase: 'vencido' };
        }
        
        try {
            const fechaVig = new Date(fechaVigencia);
            const hoy = new Date();
            
            // Resetear horas para comparar solo fechas
            fechaVig.setHours(0, 0, 0, 0);
            hoy.setHours(0, 0, 0, 0);
            
            // Diferencia en días
            const diffTiempo = fechaVig.getTime() - hoy.getTime();
            const diffDias = Math.ceil(diffTiempo / (1000 * 60 * 60 * 24));
            
            if (diffDias < -15) {
                return { texto: 'VENCIDO', clase: 'vencido' };
            } else if (diffDias > 30) {
                return { texto: 'VIGENTE', clase: 'vigente' };
            } else if (diffDias >= 0) {
                return { texto: 'POR VENCER', clase: 'por-vencer' };
            } else {
                // Entre -1 y -15 días
                return { texto: 'VENCIDO', clase: 'vencido' };
            }
        } catch (error) {
            console.error('Error calculando vigencia:', error);
            return { texto: 'ERROR', clase: 'vencido' };
        }
    }

    // Formatear período de pago
    function formatPeriodoPago(periodoPago) {
        if (!periodoPago || periodoPago === 'N/A' || periodoPago === '') {
            return { año: 'N/A', mes: 'N/A', mesTexto: 'N/A' };
        }
        
        // Si el formato es "1 2025 - 02" o similar
        const parts = periodoPago.toString().split(/[\s-]+/);
        
        // Buscar el año (parte que tiene 4 dígitos)
        let año = 'N/A';
        let mesNumero = 'N/A';
        
        for (let part of parts) {
            part = part.trim();
            
            // Buscar año (4 dígitos)
            if (/^\d{4}$/.test(part)) {
                año = part;
            }
            // Buscar mes (1 o 2 dígitos) que no sea el año
            else if (/^\d{1,2}$/.test(part) && part !== año) {
                mesNumero = parseInt(part).toString();
            }
        }
        
        // Si no encontramos mes en el formato esperado, buscar cualquier número de 1-12
        if (mesNumero === 'N/A') {
            for (let part of parts) {
                const num = parseInt(part);
                if (num >= 1 && num <= 12) {
                    mesNumero = num.toString();
                    break;
                }
            }
        }
        
        // Convertir número de mes a texto
        const meses = [
            'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
            'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
        ];
        
        let mesTexto = 'N/A';
        if (mesNumero !== 'N/A') {
            const mesIndex = parseInt(mesNumero) - 1;
            if (mesIndex >= 0 && mesIndex < 12) {
                mesTexto = meses[mesIndex];
            }
        }
        
        return { año, mes: mesNumero, mesTexto };
    }

    // Determinar clase CSS según estado del proveedor
    function getEstadoClass(estadoGeneral) {
        switch(estadoGeneral) {
            case 'ACTIVO': return 'activo';
            case 'INACTIVO': return 'inactivo';
            case 'PENDIENTE': return 'pendiente';
            default: return 'pendiente';
        }
    }

    // Determinar clase header según estado del proveedor
    function getHeaderClass(estadoGeneral) {
        switch(estadoGeneral) {
            case 'ACTIVO': return 'proveedor-activo';
            case 'INACTIVO': return 'proveedor-inactivo';
            case 'PENDIENTE': return 'proveedor-pendiente';
            default: return '';
        }
    }

    // Badge de estado del proveedor
    function getStatusBadge(estadoGeneral) {
        switch(estadoGeneral) {
            case 'ACTIVO': 
                return '<span class="status-badge status-activo">ACTIVO</span>';
            case 'INACTIVO': 
                return '<span class="status-badge status-inactivo">INACTIVO</span>';
            case 'PENDIENTE': 
                return '<span class="status-badge status-pendiente">PENDIENTE</span>';
            default: 
                return '<span class="status-badge status-pendiente">PENDIENTE</span>';
        }
    }

    // Crear tarjeta HTML
    function createCard(proveedor, index) {
        const estadoClass = getEstadoClass(proveedor.estado_general);
        const headerClass = getHeaderClass(proveedor.estado_general);
        
        // Usar tooltip para mostrar nombre completo
        const razonSocialTruncada = proveedor.razon_social ? 
            (proveedor.razon_social.length > 35 ? proveedor.razon_social.substring(0, 35) + '...' : proveedor.razon_social) : 
            'SIN RAZÓN SOCIAL';
        
        const estadoVigencia = calcularEstadoVigencia(proveedor.vigencia);
        const periodoPago = formatPeriodoPago(proveedor.periodo_pago);
        const conceptoTruncado = proveedor.concepto ? 
            (proveedor.concepto.length > 25 ? proveedor.concepto.substring(0, 25) + '...' : proveedor.concepto) : 
            'N/A';
        
        return `
            <div class="proveedor-card ${estadoClass}" data-index="${index}">
                <div class="card-header ${headerClass}">
                    <h5 title="${proveedor.razon_social || ''}">
                        <i class="fa fa-building"></i>
                        ${razonSocialTruncada}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="info-item">
                        <span class="info-label">
                            <i class="fa fa-id-card"></i> RUC:
                        </span>
                        <span class="info-value">${proveedor.ruc || 'N/A'}</span>
                    </div>
                    
                    <div class="info-item">
                        <span class="info-label">
                            <i class="fa fa-file-text"></i> Concepto:
                        </span>
                        <span class="info-value" title="${proveedor.concepto || ''}">${conceptoTruncado}</span>
                    </div>
                    
                    <div class="info-item">
                        <span class="info-label">
                            <i class="fa fa-calendar-check"></i> Vigencia:
                        </span>
                        <span class="info-value">
                            ${formatDate(proveedor.vigencia)}
                            <br>
                            <small>
                                <span class="status-badge status-${estadoVigencia.clase}">
                                    ${estadoVigencia.texto}
                                </span>
                            </small>
                        </span>
                    </div>
                    
                    <div class="info-item">
                        <span class="info-label">
                            <i class="fa fa-calendar-alt"></i> Periodo Pago:
                        </span>
                        <span class="info-value">
                            Año: ${periodoPago.año}
                            <br><small>Mes: ${periodoPago.mes}</small>
                        </span>
                    </div>
                    
                    <div class="info-item">
                        <span class="info-label">
                            <i class="fa fa-calendar"></i> Mes Pago:
                        </span>
                        <span class="info-value">${periodoPago.mesTexto}</span>
                    </div>
                    
                    <div class="info-item">
                        <span class="info-label">
                            <i class="fa fa-clock-o"></i> Fecha Registro:
                        </span>
                        <span class="info-value">${proveedor.fecha_registro || 'N/A'}</span>
                    </div>
                    
                    <div class="info-item">
                        <span class="info-label">
                            <i class="fa fa-hashtag"></i> Año:
                        </span>
                        <span class="info-value">${proveedor.año_registro || 'N/A'}</span>
                    </div>
                    
                    <div class="info-item">
                        <span class="info-label">
                            <i class="fa fa-list"></i> Total Registros:
                        </span>
                        <span class="info-value">${proveedor.total_registros || 1}</span>
                    </div>
                    
                    <div class="info-item">
                        <span class="info-label">
                            <i class="fa fa-flag"></i> Estado:
                        </span>
                        <span class="info-value">${getStatusBadge(proveedor.estado_general)}</span>
                    </div>
                </div>
            </div>
        `;
    }

    // Cargar datos reales
    function loadRealData(searchTerm = '', loadMore = false) {
        if (isLoading) return;
        
        isLoading = true;
        
        if (!loadMore) {
            $('#cardsContainer').html('<div class="loading-spinner"><i class="fa fa-spinner fa-spin"></i><p>Cargando proveedores...</p></div>');
            allData = [];
            displayedCount = 0;
        } else {
            $('#loadMoreBtn').html('<i class="fa fa-spinner fa-spin"></i> Cargando...').prop('disabled', true);
        }
        
        $.ajax({
            url: "../../Controller/Controller_proveedores.php",
            type: "POST",
            data: { "txt_option": '1' },
            dataType: "json",
            success: function(response) {
                isLoading = false;
                
                console.log("Datos recibidos:", response);
                
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
                console.error("Error al cargar datos:", error);
                
                if (!loadMore) {
                    $('#cardsContainer').html('<div class="no-results"><i class="fa fa-exclamation-triangle"></i><h5>Error de conexión</h5></div>');
                }
                
                if (loadMore) {
                    $('#loadMoreBtn').html('<i class="fa fa-refresh"></i> Cargar Más').prop('disabled', false);
                }
            }
        });
    }

    // Filtrar y mostrar resultados
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
                const ruc = item.ruc ? item.ruc.toLowerCase() : '';
                const razonSocial = item.razon_social ? item.razon_social.toLowerCase() : '';
                const concepto = item.concepto ? item.concepto.toLowerCase() : '';
                
                return ruc.includes(term) || 
                       razonSocial.includes(term) || 
                       concepto.includes(term);
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

    // Realizar búsqueda
    function performSearch(searchTerm = '') {
        if (searchTerm) {
            displayedCount = 0;
            filterAndDisplayResults(searchTerm);
        } else {
            displayedCount = 0;
            filterAndDisplayResults();
        }
    }

    // Document ready
    $(document).ready(function() {
        $('#menu_toggle').on('click', function() {
            $('.left_col').toggleClass('menu-open');
        });

        // Cargar datos iniciales
        loadRealData();

        // Búsqueda en tiempo real
        let searchTimeout;
        $('#searchInput').on('input', function() {
            const searchTerm = $(this).val();
            
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                performSearch(searchTerm);
            }, 300);
        });

        // Botón cargar más
        $('#loadMoreBtn').on('click', function() {
            loadRealData('', true);
        });

        // Limpiar búsqueda con ESC
        $('#searchInput').on('keydown', function(e) {
            if (e.key === 'Escape') {
                $(this).val('');
                performSearch('');
            }
        });

        // Tooltip para conceptos largos
        $(document).on('mouseenter', '.info-value[title]', function() {
            const title = $(this).attr('title');
            if (title && title !== '') {
                $(this).tooltip({
                    title: title,
                    placement: 'top',
                    trigger: 'manual'
                }).tooltip('show');
            }
        }).on('mouseleave', '.info-value[title]', function() {
            $(this).tooltip('dispose');
        });
    });
  </script>
</body>
</html>