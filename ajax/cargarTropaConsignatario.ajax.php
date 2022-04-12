<?php

include('../modelos/conexion.php');

$valor = $_POST['consignatario'];

$tabla = $_POST['tabla'];

$conexion = mysqli_connect(MYSQL_SERVIDOR, MYSQL_USUARIO, MYSQL_CONTRASENA, MYSQL_BD);

if($valor != ''){
  $sql = "SELECT DISTINCT(proveedor) FROM $tabla WHERE consignatario = '$valor' ORDER BY proveedor ASC";

  $query = mysqli_query($conexion,$sql);

  echo "<option value='Proveedor'>Proveedor</option>";

  while($resultado = mysqli_fetch_array($query)){

        $proveedor = $resultado['proveedor'];

        echo "<option value='".utf8_encode($proveedor)."'>".utf8_encode($proveedor)."</option>";

  }
}else{

    $sql = "SELECT DISTINCT(proveedor) FROM $tabla ORDER BY tropa ASC";

    $query = mysqli_query($conexion,$sql);
  
    echo "<option value='Proveedor'>Proveedor</option>";
  
    while($resultado = mysqli_fetch_array($query)){
  
          $proveedor = $resultado['proveedor'];
  
          echo "<option value='".utf8_encode($proveedor)."'>".utf8_encode($proveedor)."</option>";
  
    }

}

?>
