<?php
session_start();
require_once "controladores/plantilla.controlador.php";
require_once "controladores/formulario.controlador.php";
require_once "controladores/servicioransa.controlador.php";
require_once "controladores/ciudad.controlador.php";

require_once "modelos/plantilla.modelo.php";
require_once "modelos/formulario.modelo.php";
require_once "modelos/servicioransa.modelo.php";
require_once "modelos/ciudad.modelo.php";

require_once "modelos/rutas.php";


$plantilla = new ControladorPlantilla();



$plantilla -> plantilla();