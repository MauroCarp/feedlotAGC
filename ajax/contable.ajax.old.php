<?php

require_once "../controladores/contable.controlador.php";
require_once "../modelos/contable.modelo.php";

class AjaxContable{

	/*=============================================
	EDITAR USUARIO
	=============================================*/	
    public $periodo;

	public function ajaxMostrarData(){
        
        $ultimoPeriodo = $this->periodo;

        if($ultimoPeriodo == 'last'){
            
            $ultimoPeriodoValido = ControladorContable::ctrUltimoPeriodo();
                
        
        }

        if(isset($ultimoPeriodoValido['error'])){

            echo json_encode($ultimoPeriodoValido);

            die();

        }
        

		$respuesta = ControladorContable::ctrCalcularData($ultimoPeriodoValido);

        echo json_encode($respuesta);

	}


}

/*=============================================
EDITAR USUARIO
=============================================*/
if(isset($_POST["accion"])){
	
	$accion = $_POST['accion'];

	if($accion == 'mostrarData'){

		$mostrarData = new AjaxContable();
        $mostrarData -> periodo = $_POST["periodo"];
        $mostrarData -> ajaxMostrarData();

    }

}

