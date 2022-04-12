<?php

include('../modelos/conexion.php');

$valor = $_POST['proveedor'];

$tabla = $_POST['tabla'];

$conexion = mysqli_connect(MYSQL_SERVIDOR, MYSQL_USUARIO, MYSQL_CONTRASENA, MYSQL_BD);

if($valor != ''){
  $sql = "SELECT DISTINCT(tropa) FROM $tabla WHERE proveedor = '$valor' ORDER BY tropa ASC";

  $query = mysqli_query($conexion,$sql);

  echo "<option value='Tropa'>Tropa</option>";

  while($resultado = mysqli_fetch_array($query)){

        $tropa = $resultado['tropa'];

        echo "<option value='".utf8_encode($tropa)."'>".utf8_encode($tropa)."</option>";

  }
}else{

    $sql = "SELECT DISTINCT(tropa) FROM $tabla ORDER BY tropa ASC";

    $query = mysqli_query($conexion,$sql);
  
    echo "<option value='Tropa'>Tropa</option>";
  
    while($resultado = mysqli_fetch_array($query)){
  
          $tropa = $resultado['tropa'];
  
          echo "<option value='".utf8_encode($tropa)."'>".utf8_encode($tropa)."</option>";
  
    }

}
?>
