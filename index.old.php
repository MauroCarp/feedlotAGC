<?php

require_once "controladores/plantilla.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/datos.controlador.php";
require_once "controladores/compras.controlador.php";
require_once "controladores/comparador.controlador.php";
require_once "controladores/muertes.controlador.php";
require_once "controladores/piri.controlador.php";
require_once "controladores/archivos.controlador.php";
require_once "controladores/panelControl.controlador.php";


require_once "modelos/usuarios.modelo.php";
require_once "modelos/datos.modelo.php";
require_once "modelos/compras.modelo.php";
require_once "modelos/comparador.modelo.php";
require_once "modelos/muertes.modelo.php";
require_once "modelos/piri.modelo.php";
require_once "modelos/archivos.modelo.php";
require_once "modelos/panelControl.modelo.php";
require_once "extensiones/vendor/autoload.php";


$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();