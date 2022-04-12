<?php
require_once "../controladores/datos.controlador.php";
require_once "../modelos/datos.modelo.php";

function formatearFecha($fecha){

    $fecha = explode('-',$fecha);

    $nuevaFecha = $fecha[2]."-".$fecha[1]."-".$fecha[0];

    return $nuevaFecha;

}

 


class tablaModal{
    
    public $tropa;
    
    public function mostrarTablaModal(){
        
        $item = 'tropa';
        $valor = $this->tropa;
        $orden = 'fechaSalida';
        $datos = ControladorDatos::ctrMostrardatosTabla($item, $valor,$orden);

        if(count($datos) == 0){

            echo '{"data": []}';

            return;
        }	

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($datos); $i++){

        //  /*=============================================
        // 	TRAEMOS LAS ACCIONES
        // 	=============================================*/ 

            $tropa = str_replace("Ã“","Ó",$datos[$i]["tropa"]);

            $tropa = utf8_decode($tropa);


            $datosJson .= '[
                "'.ltrim($datos[$i]['hotelero']).'",
                "'.ltrim($datos[$i]['caravana']).'",
                "'.$tropa.'",
                "'.ltrim($datos[$i]['raza']).'",
                "'.ltrim($datos[$i]['destinoVenta']).'",
                "'.ltrim($datos[$i]['consignatario']).'",
                "'.ltrim($datos[$i]['proveedor']).'",
                "'.ltrim($datos[$i]['fechaIngreso']).'",
                "'.ltrim($datos[$i]['fechaSalida']).'"
            ],';

        }

        $datosJson = substr($datosJson, 0, -1);

        $datosJson .=   '] 

        }';
        
        echo $datosJson;


    }
}

/*=============================================
ACTIVAR TABLA DE MODAL
=============================================*/ 
$activarModal = new TablaModal();
$activarModal -> tropa = $_POST["tropa"];
$activarModal -> mostrarTablaModal();



?>