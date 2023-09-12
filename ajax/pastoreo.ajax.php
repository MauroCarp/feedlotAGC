<?php

require_once "../controladores/pastoreo.controlador.php";
require_once "../modelos/pastoreo.modelo.php";

class AjaxPastoreo{

	/*=============================================
	CARGAR DATA REGISTRO
	=============================================*/	

    public $item;

    public $valor;

    public $item2;

    public $valor2;


	public function ajaxMostrarData(){

        $campo = '*';
        $item = $this->item;
        $valor = $this->valor;
        $item2 = $this->item2;
        $valor2 = $this->valor2;
		$respuesta = ControladorPastoreo::ctrMostrarRegistros($campo,$item, $valor,$item2,$valor2);
        echo json_encode($respuesta);

	}

}

/*=============================================
EDITAR USUARIO
=============================================*/
if(isset($_POST["accion"])){

	$accion = $_POST['accion'];
    if($accion == 'mostrarData'){
		$mostrarData = new AjaxPastoreo();
        $mostrarData -> item = $_POST["item"];
        $mostrarData -> valor = $_POST["valor"];
        $mostrarData -> item2 = $_POST["item2"] ?? null;
        $mostrarData -> valor2 = $_POST["valor2"] ?? null;
        $mostrarData -> ajaxMostrarData();
        die();

    }

}

