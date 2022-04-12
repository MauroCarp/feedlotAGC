<?php
require_once "../controladores/datos.controlador.php";
require_once "../modelos/datos.modelo.php";
function formatearFecha($fecha){
    $fecha = explode('-',$fecha);
    $nuevaFecha = $fecha[2]."-".$fecha[1]."-".$fecha[0];
    return $nuevaFecha;
}

$tropa = $_POST['tropa'];

$item = 'tropa';
$valor = $tropa;
$orden = 'fechaSalida';
$datos = ControladorDatos::ctrMostrardatosTabla($item, $valor,$orden);

for ($i=0; $i < sizeof($datos); $i++) { 

    echo "<tr>
            <td>".$datos[$i]["hotelero"]."</td>
            <td>".$datos[$i]["caravana"]."</td>
            <td>".str_replace("Ã“","Ó",$datos[$i]["tropa"])."</td>
            <td>".$datos[$i]["raza"]."</td>
            <td>".$datos[$i]["destinoVenta"]."</td>
            <td>".$datos[$i]["consignatario"]."</td>
            <td>".$datos[$i]["proveedor"]."</td>
            <td>".formatearFecha($datos[$i]["fechaIngreso"])."</td>
            <td>".formatearFecha($datos[$i]["fechaSalida"])."</td>
        </tr>";

}

?>