<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">


	<title>e-Ransa Help Desk</title>
	<link rel="icon" href="../../img/solor.png" type="image/x-icon">
	<link rel="shortcut icon" href="../../img/solor.png" type="image/x-icon">

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

	<style>
        
		.view-all-button {
			background-color: #009A3F;
			color: white;
			padding: 10px 20px;
			border: none;
			border-radius: 5px;
			font-size: 16px;
			cursor: pointer;
			display: flex;
			align-items: center;
		}

		.view-all-button i {
			margin-right: 8px;
			/* Espacio entre el icono y el texto */
		}
	</style>
</head>



<body class="nav-md">
	<div class="container body">
		<div class="main_container">
			<div class="col-md-3 left_col">
				<div class="left_col scroll-view">
					<div class="navbar nav_title" style="border: 0;">
						<a href="index.php?opc=principal" class="site_title">
							<img src="images/ransa.png" alt="RANSA Logo" style="height: 40px;">
						</a>
					</div>

					<div class="clearfix"></div>

					<!-- menu profile quick info -->
					<div class="profile clearfix">
						<!--<div class="profile_pic">
							<img src="images/img.jpg" alt="..." class="img-circle profile_img">
						</div>-->
						<div class="profile_info">
							<span>Bienvenido,</span>
							<h2><?php echo isset($_SESSION['nombre']) ? $_SESSION['nombre'] : 'Invitado'; ?></h2>
						</div>
					</div>
					<!-- /menu profile quick info -->

					<br />

					<!-- sidebar menu -->



					<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
						<?php
						sistema_menu($dato1, $dato2, $dato3);
						?>

					</div>
					<!-- /sidebar menu -->

					<!-- /menu footer buttons -->
					<div class="sidebar-footer hidden-small">
						<!-- Botón para mostrar el modal de cambiar contraseña -->
						<a data-toggle="tooltip" data-placement="top" title="Configuraci&oacute;n" onclick="showChangePasswordModal()">
							<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
						</a>
						<!-- Botón para activar pantalla completa -->
						<a data-toggle="tooltip" data-placement="top" title="Pantalla Completa" onclick="toggleFullScreen()">
							<span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
						</a>
						<!-- Botón para recargar la página -->
						<a data-toggle="tooltip" data-placement="top" title="Recargar Página" onclick="reloadPage()">
							<span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
						</a>
						<!-- Botón para cerrar sesión -->
						<a data-toggle="tooltip" data-placement="top" title="Cerrar Sesi&oacute;n" href="login.html">
							<span class="glyphicon glyphicon-off" aria-hidden="true"></span>
						</a>
					</div>
					<!-- /menu footer buttons -->
				</div>
			</div>

			<!-- top navigation -->
			<div class="top_nav">
				<div class="nav_menu">
					<div class="nav toggle">
						<a id="menu_toggle"><i class="fa fa-bars"></i></a>
					</div>
					<nav class="nav navbar-nav">
						<ul class=" navbar-right">
							<li class="nav-item dropdown open" style="padding-left: 15px;">
								<a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true"
									id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
									<img src="images/user.png" alt=""><?php echo isset($_SESSION['nombre']) ? $_SESSION['nombre'] : 'Invitado'; ?>
								</a>
								<div class="dropdown-menu dropdown-usermenu pull-right"
									aria-labelledby="navbarDropdown">
									<a class="dropdown-item" href="javascript:;" data-toggle="modal"
										data-target="#changePasswordModal"> Cambiar Contraseña</a> <a
										class="dropdown-item" href="../../session_destroy.php"><i
											class="fa fa-sign-out pull-right"></i>
										Salir</a>
								</div>
							</li>

							<?php if (isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] === 'encargado'): ?>
    <li class="nav-item dropdown open" id="notificaciones-tickets">
        <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-envelope-o"></i>
            <span class="badge bg-green" id="notif-count">0</span>
        </a>
        <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1" id="notif-list">
            <li class="nav-item text-center text-muted">Cargando...</li>
        </ul>
    </li>
<?php endif; ?>
						</ul>
					</nav>
				</div>
			</div>
			<!-- /top navigation -->