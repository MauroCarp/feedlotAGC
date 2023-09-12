<?php

require_once "../controladores/agro.controlador.php";
require_once "../modelos/agro.modelo.php";

class AjaxAgro{

	/*=============================================
	EDITAR USUARIO
	=============================================*/	

	public $campania1;

	public $campania2;

    public $campo;

    public $seccion;

	public function ajaxMostrarData(){

		$item = "campania1";

		$valor = $this->campania1;
		
		$item2 = "campania2";

		$valor2 = $this->campania2;
		
        $item3 = "campo";

		$valor3= $this->campo;

		$tabla = $this->seccion;

		$respuesta = ControladorAgro::ctrMostrarData($tabla, $item, $valor, $item2, $valor2, $item3, $valor3);
		
		echo json_encode($respuesta);

	}

	public function ajaxMostrarInfo(){

		$item = "campania";

		$valor = $this->campania;

		$tabla = $this->seccion;

		$respuesta = ControladorAgro::ctrMostrarData($tabla, $item, $valor, $item2, $valor2, $item3, $valor3);
		
		echo json_encode($respuesta);

	}

	public function ajaxCerrarCampania(){

		$item = "campania";

		$valor = $this->campania;

		$respuesta = ControladorAgro::ctrCerrarCampania($item, $valor);

		echo json_encode($respuesta);

	}

	public function ajaxMostrarCostos(){

		$item = 'cultivo';

		$valor = '';

		$item2 = "campania1";
		
		$valor2 = $this->campania1;

		$item3 = "campania2";
		
		$valor3 = $this->campania2;

		$tabla = $this->seccion;

		$respuesta = ControladorAgro::ctrMostrarCostos($tabla,$item,$cultivo,$item2,$campania1,$item3,$campania2);

		echo json_encode($respuesta);

	}

}

/*=============================================
EDITAR USUARIO
=============================================*/
if(isset($_POST["accion"])){

	$accion = $_POST['accion'];

	if($accion == 'mostrarData'){

		$mostrarData = new AjaxAgro();
        $mostrarData -> campania = $_POST["campania"];
        $mostrarData -> campo = $_POST["campo"];
        $mostrarData -> seccion = $_POST["seccion"];
        $mostrarData -> ajaxMostrarData();

    }

	if($accion == 'mostrarInfo'){

		$mostrarInfo = new AjaxAgro();
        $mostrarInfo -> campania = $_POST["campania"];
        $mostrarInfo -> seccion = $_POST["seccion"];
        $mostrarInfo -> ajaxMostrarInfo();

    }

	if($accion == 'mostrarCostos'){

		$mostrarData = new AjaxAgro();
        $mostrarData -> campania1 = $_POST["campania1"];
        $mostrarData -> campania2 = $_POST["campania2"];
        $mostrarData -> seccion = $_POST["seccion"];
        $mostrarData -> ajaxMostrarCostos();

    }

	if($accion == 'cerrarPlanifiacion'){

		$mostrarData = new AjaxAgro();
        $mostrarData -> campania = $_POST["campania"];
        $mostrarData -> ajaxCerrarCampania();

    }

}

