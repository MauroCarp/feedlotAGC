<?php

include('../modelos/conexion.php');

$tabla = $_POST['tabla'];

$rango = $_POST['rango'];

$rangoExplotado = explode('-',$rango);

if (sizeof($rangoExplotado) > 2) {
    
    $rangoExplotado = explode('/',$rango);

    $fechaInicial = $rangoExplotado[0];

    $fechaFinal = $rangoExplotado[1];

}else{

    $fechaInicial = explode('/',trim($rangoExplotado[0]));
    
    $fechaInicial = $fechaInicial[2].'-'.$fechaInicial[1].'-'.$fechaInicial[0];
    
    $fechaFinal = explode('/',trim($rangoExplotado[1]));
    
    $fechaFinal = $fechaFinal[2].'-'.$fechaFinal[1].'-'.$fechaFinal[0];

}

$campo = $_POST['campo'];

$item = $_POST['item'];

$conexion = mysqli_connect(MYSQL_SERVIDOR, MYSQL_USUARIO, MYSQL_CONTRASENA, MYSQL_BD);

  $sql = "SELECT DISTINCT($campo) FROM $tabla WHERE $item BETWEEN '$fechaInicial' AND '$fechaFinal' ORDER BY consignatario ASC";

  $query = mysqli_query($conexion,$sql);

  echo "<option value='".ucfirst($campo)."'>".ucfirst($campo)."</option>";

  while($resultado = mysqli_fetch_array($query)){

        $select = $resultado[$campo];

        echo "<option value='".utf8_encode($select)."'>".utf8_encode($select)."</option>";

  }

?>
