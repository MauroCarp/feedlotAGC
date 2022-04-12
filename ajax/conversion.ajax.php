<?php
require_once "../controladores/conversion.controlador.php";
require_once "../modelos/conversion.modelo.php";

class dataGraficos{
    
    public $periodos;
    
    public function mostrarDataGraficos(){
        
        $item = 'periodo';

        $periodos = $this->periodos;
        
        $datos = ControladorConversion::ctrMostrarDatos($item, $periodos);

        echo json_encode($datos);

    }

    public function mostrarDataGraficosAnual(){
        
        $item = 'periodoTime';

        $periodos = $this->periodos;
        
        $datos = ControladorConversion::ctrMostrarDatosAnual($item, $periodos);

        echo json_encode($datos);

    }

}

/*=============================================
DATA GRAFICOS ANUAL
=============================================*/ 
$dataGraficos = new dataGraficos();
$dataGraficos -> periodos = $_POST["periodos"];

if($_POST['accion'] == 'filtros')
    $dataGraficos -> mostrarDataGraficos();
else    
    $dataGraficos -> mostrarDataGraficosAnual();

?>