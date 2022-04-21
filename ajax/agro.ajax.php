<?php

require_once "../controladores/agro.controlador.php";
require_once "../modelos/agro.modelo.php";

class AjaxAgro{

	/*=============================================
	EDITAR USUARIO
	=============================================*/	

	public $campania;

    public $campo;

    public $seccion;

	public function ajaxMostrarData(){

		$item = "campania";
		$valor = $this->campania;
		
        $item2 = "campo";
		$valor2= $this->campo;

		$tabla = $this->seccion;

		$respuesta = ControladorAgro::ctrMostrarData($tabla, $item, $valor, $item2, $valor2);
		
		echo json_encode($respuesta);

	}

	public function ajaxMostrarCostos(){

		$item = "campania";
		
		$valor = $this->campania;

		$tabla = $this->seccion;

		$respuesta = ControladorAgro::ctrMostrarCostos($tabla, $item, $valor);
		
		echo json_encode($respuesta);

	}

}

/*=============================================
EDITAR USUARIO
=============================================*/
if(isset($_POST["accion"])){
	
	$accion = $_POST['accion'];

	if($accion == 'mostrarDataPlanificacion'){

		$mostrarData = new AjaxAgro();
        $mostrarData -> campania = $_POST["campania"];
        $mostrarData -> campo = $_POST["campo"];
        $mostrarData -> seccion = $_POST["seccion"];
        $mostrarData -> ajaxMostrarData();

    }

	if($accion == 'mostrarCostos'){

		$mostrarData = new AjaxAgro();
        $mostrarData -> campania = $_POST["campania"];
        $mostrarData -> seccion = $_POST["seccion"];
        $mostrarData -> ajaxMostrarCostos();

    }

}

