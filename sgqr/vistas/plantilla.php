<?php
$url = Ruta::ctrRuta();
echo '<link rel="icon" href="'.$url.'vistas/img/icono.png">';
?>
<!-- BOOTSTRAP -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="<?php echo $url; ?>vistas/vendors/bootstrap/dist/css/bootstrap.min.css">
<!-- DATETIMEPICKER -->

<link rel="stylesheet" type="text/css" href="<?php echo $url; ?>vistas/vendors/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css">
<!-- FONTAWAESOME -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- SELECT MULTIPLE CHOSEN -->

<link rel="stylesheet" href="<?php echo $url; ?>extensiones/chosen/chosen.css">
<!-- TAGS INPUT -->
<link rel="stylesheet" href="<?php echo $url; ?>extensiones/TagInputs/bootstrap-tagsinput.css">
<!-- ALERTIFY -->
<link rel="stylesheet" href="<?php echo $url; ?>extensiones/alertifyjs/css/alertify.min.css">
<!-- <link rel="stylesheet" type="text/css" href="<?php //echo $url; ?>extensiones/lou-multi-select/css/multi-select.css"> -->

<!-- CSS PERSONALIZADO -->

<link rel="stylesheet" href="<?php echo $url; ?>vistas/css/formulario.css">
<link rel="stylesheet" href="<?php echo $url; ?>vistas/css/plantilla.css">

<?php

include "modulos/formulario.php";
?>

<input type="hidden" value="<?php echo $url; ?>" id="rutaOculta">

<!-- FONTAWAESOME -->
<script src="https://kit.fontawesome.com/098c4b6e65.js" crossorigin="anonymous"></script>
<!-- JQUERY -->

<script type="text/javascript" src="<?php echo $url; ?>vistas/vendors/jquery/dist/jquery.min.js"></script>
<!-- BOOTSTRAP -->

<script type="text/javascript" src="<?php echo $url; ?>vistas/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DATETIMEPICKER -->

<script src="<?php echo $url; ?>vistas/vendors/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" charset="UTF-8" ></script>
<script src="<?php echo $url; ?>vistas/vendors/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.es.js"></script>
<!-- SELECT MULTIPLE -->
<script type="text/javascript" src="<?php echo $url; ?>extensiones/chosen/chosen.jquery.js"></script>
<!-- TAGS INPUT -->
<script type="text/javascript" src="<?php echo $url; ?>extensiones/TagInputs/bootstrap-tagsinput.min.js"></script>
<!-- ALERTIFY -->
<script type="text/javascript" src="<?php echo $url; ?>extensiones/alertifyjs/alertify.min.js"></script>
<!-- MASK -->
<script type="text/javascript" src="<?php echo $url; ?>extensiones/Mask/jquery.mask.min.js"></script>

<!-- <script type="text/javascript" src="<?php //echo $url; ?>extensiones/lou-multi-select/js/jquery.multi-select.js"></script> -->

<!--======================================================
=            SECCION DE JQUERY PERSONALIZADOS            =
=======================================================-->
<script type="text/javascript" src="<?php echo $url; ?>vistas/js/plantilla.js"></script>
<script type="text/javascript" src="<?php echo $url; ?>vistas/js/formulario.js"></script>
