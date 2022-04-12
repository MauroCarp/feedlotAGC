<?php

include "../vistas/bower_components/simple_html_dom/simple_html_dom.php";
include "../modelos/conexion.php";

$sql = "SELECT fecha from piri WHERE fecha  = (SELECT MAX(fecha) FROM piri)";
//SELECT * FROM piri ORDER BY id DESC LIMIT 1

$query = mysqli_query($conexion,$sql);
// echo mysqli_error($conexion);
$resultado = mysqli_fetch_array($query);

// echo $resultado['fecha'];

$html = file_get_html('https://www.rosgan.com.ar/precios-rosgan/');
$arrayMeses[] = array();
$arrayMeses[] = 'enero';
$arrayMeses[] = 'febrero';
$arrayMeses[] = 'marzo';
$arrayMeses[] = 'abril';
$arrayMeses[] = 'mayo';
$arrayMeses[] = 'junio';
$arrayMeses[] = 'julio';
$arrayMeses[] = 'agosto';
$arrayMeses[] = 'septiembre';
$arrayMeses[] = 'octubre';
$arrayMeses[] = 'noviembre';
$arrayMeses[] = 'diciembre';

$contador = 1;

$huboActualizacion = array();

foreach( $html->find('dl[class="remate"]') as $element){
	
	$fecha = $element->find('dt',0);
	$fecha = $fecha->plaintext;
	$fecha = explode('-',$fecha);
	$detalle = $fecha[0];
	$piri = $element->find('span',0);
	$piri = $piri->plaintext;
	$estado = substr($piri,12);
	$piri = substr($piri,6,-6);
	$fecha = explode(' ',$fecha[1]);
	$diaFecha = $fecha[1];
	if($diaFecha < 10){
		$diaFecha = '0'.$fecha[1];
	}
	$mesFecha = $fecha[3];
	$anioFecha = $fecha[5];
	if(sizeof($fecha) > 6){
		$mesFecha = $fecha[5];
		$anioFecha = $fecha[7];
	}


	foreach ($arrayMeses as $key => $value) {
		if ($mesFecha == $value) {
			$mesFecha = $key;
			if($key < 10){
				$mesFecha = '0'.$key;
			}
		}
	}

	$date = $anioFecha."-".$mesFecha."-".$diaFecha;
	// CARGAR DATOS DE PIRI EN LA BASE DE DATOS
		

		$fechaBDformato = strtotime($resultado['fecha']);
		$fechaDOMformato = strtotime($date);
		
		
		$fechaBDformato = date('Y-m-d',$fechaBDformato);
		$fechaDOMformato = date('Y-m-d',$fechaDOMformato);
		// echo $fechaDOMformato." / ".$fechaBDformato;

		if ($fechaDOMformato > $fechaBDformato) {

			$sql = "INSERT INTO piri(precio,fecha,detalle,estado) VALUES('$piri','$date','$detalle','$estado')";
	
			mysqli_query($conexion,$sql);
	
			echo mysqli_error($conexion);
	
			$huboActualizacion[] = TRUE;

		}else{
			$huboActualizacion[] = FALSE;
		}

		
		$contador++;
		
	}
	
	$huboActualizacion = (in_array(TRUE, $huboActualizacion));

	print_r($huboActualizacion);

?>