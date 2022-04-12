<?php

require_once "conexion.php";

class ModeloDatos{

	/*=============================================
	MOSTRAR Datos
	=============================================*/

	static public function mdlMostrarDatos($tabla, $item, $valor,$orden){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY $orden DESC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();
			
			return $stmt -> fetch();
			
		}else{
			
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY $orden DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}

	
	/*=============================================
	MOSTRAR Datos RANGO
	=============================================*/

	static public function mdlMostrarDatosRango($tabla,$campo, $item, $valor,$item2,$fecha1,$fecha2){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT $campo FROM $tabla WHERE $item = :$item AND $item2 BETWEEN '$fecha1' AND '$fecha2'");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			
			return $stmt -> fetch();
			
		}else{
			
			$stmt = Conexion::conectar()->prepare("SELECT $campo FROM $tabla WHERE $item2 BETWEEN '$fecha1' AND '$fecha2'");
			
			$stmt -> execute();
			// var_dump($stmt ->errorInfo());
			// var_dump($stmt);

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	MOSTRAR Datos RANGO DOBLE
	=============================================*/

	static public function mdlMostrarDatosRangoDoble($tabla,$campo, $item, $valor,$item2,$fecha1,$fecha2){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT $campo FROM $tabla WHERE ($item = :$item) AND ($item2 BETWEEN '$kg1' AND '$kg2') AND ($item3 BETWEEN '$fecha1' AND '$fecha2')");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			
			return $stmt -> fetch();
			
		}else{
			
			$stmt = Conexion::conectar()->prepare("SELECT $campo FROM $tabla WHERE ($item2 BETWEEN '$kg1' AND '$kg2') AND ($item3 BETWEEN '$fecha1' AND '$fecha2')");
			
			$stmt -> execute();
			var_dump($stmt ->errorInfo());
			var_dump($stmt);

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}


		/*=============================================
	MOSTRAR DATOS PARA TABLA
	=============================================*/

	static public function mdlMostrarDatosTabla($tabla, $item, $valor,$orden){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY $orden DESC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			
			return $stmt -> fetchAll();
			
		}else{
			
			$stmt = Conexion::conectar()->prepare("SELECT DISTINCT(tropa) FROM $tabla ORDER BY $orden DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}


	
	
	/*=============================================
	CONTAR DATOS
	=============================================*/


	static public function mdlContarDatos($tabla, $item, $valor,$item2,$valor2,$operador){

		if ($item2 != null) {

			
			$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) as total FROM $tabla WHERE $item $operador :$item AND $item2 = :$item2");
			
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

			$stmt -> execute();


			return $stmt -> fetch();

		}else{
			
			if($item != null){
				$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) as total FROM $tabla WHERE $item $operador :$item");
	
				$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
	
				$stmt -> execute();
				return $stmt -> fetch();
	
			}else{
	
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
	
				$stmt -> execute();
	
				return $stmt -> fetchAll();
	
			}

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	CONTAR DATOS ENTRE FECHAS
	=============================================*/


	static public function mdlContarDatosRango($tabla, $item, $valor,$item2,$valor2,$operador,$item3,$fecha1,$fecha2){

		if ($item2 != null) {

			
			$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) as total FROM $tabla WHERE $item $operador :$item AND $item2 = :$item2 AND $item3 BETWEEN '$fecha1' AND '$fecha2'");
			
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			
			$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);


			$stmt -> execute();

			//var_dump($stmt ->errorInfo());

			return $stmt -> fetch();

		}else{
			
			if($item != null){
				$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) as total FROM $tabla WHERE $item $operador :$item AND $item3 BETWEEN '$fecha1' AND '$fecha2'");
	
				$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
				
				$stmt -> execute();
				return $stmt -> fetch();
	
			}else{
	
				$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM $tabla WHERE $item3 BETWEEN '$fecha1' AND '$fecha2'");

				$stmt -> execute();

				return $stmt -> fetchAll();
	
			}

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	MOSTRAR TROPAS O CONSIGNATARIO
	=============================================*/

	static public function mdlMostrarTropas($tabla, $variable, $item, $valor){

		if($item != null){
			$stmt = Conexion::conectar()->prepare("SELECT DISTINCT($variable) FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT DISTINCT($variable) FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}

	
	/*=============================================
	CONTAR DIAS POR TROPAS
	=============================================*/

	static public function mdlContarDiasTropa($tabla, $item, $valor){

		if($item != null){

			
			$stmt = Conexion::conectar()->prepare("SELECT SUM(diasCC) as totalDias, COUNT(tropa) as totalAnimales FROM $tabla WHERE $item = '$valor'");
			
			$stmt -> execute();

			// var_dump($stmt ->errorInfo());

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT DISTINCT(tropa) FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}


	/*=============================================eee
	CONTAR ANIMALES 
	=============================================*/

	static public function mdlContarAnimales($tabla, $item, $valor){

		if($item != null){

			
			$stmt = Conexion::conectar()->prepare("SELECT COUNT(tropa) as totalAnimales FROM $tabla WHERE $item = '$valor'");
			
			$stmt -> execute();

			// var_dump($stmt ->errorInfo());

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT COUNT(tropa) FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}
	
	/*=============================================eee
	CONTAR ANIMALES RANGO
	=============================================*/

	static public function mdlContarAnimalesRango($tabla, $item, $valor,$item2,$fecha1,$fecha2){

		if($item != null){

			
			$stmt = Conexion::conectar()->prepare("SELECT COUNT(tropa) as totalAnimales FROM $tabla WHERE $item = '$valor' AND $item2 BETWEEN '$fecha1' AND '$fecha2'");
			
			$stmt -> execute();

			
			return $stmt -> fetch();
			
		}else{
			
			$stmt = Conexion::conectar()->prepare("SELECT COUNT(tropa) FROM $tabla WHERE $item2 BETWEEN '$fecha1' AND '$fecha2'");
			
			// var_dump($stmt);
			// var_dump($stmt ->errorInfo());
			
			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}

	
	/*=============================================eee
	CONTAR ANIMALES RANGO DOBLE
	=============================================*/

	static public function mdlContarAnimalesRangoDoble($tabla, $item, $valor,$item2,$kg1,$kg2,$item3,$fecha1,$fecha2){

		if($item != null){

			
			$stmt = Conexion::conectar()->prepare("SELECT COUNT(tropa) as totalAnimales FROM $tabla WHERE ($item = :$item) AND ($item2 BETWEEN '$kg1' AND '$kg2') AND ($item3 BETWEEN '$fecha1' AND '$fecha2')");
			
			$stmt -> execute();

			
			return $stmt -> fetch();
			
		}else{
			
			$stmt = Conexion::conectar()->prepare("SELECT COUNT(tropa) FROM $tabla WHERE ($item2 BETWEEN '$kg1' AND '$kg2') AND ($item3 BETWEEN '$fecha1' AND '$fecha2')");
			
			// var_dump($stmt);
			// var_dump($stmt ->errorInfo());

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}


	/*=============================================
	SUMAR CAMPO 
	=============================================*/

	static public function mdlSumarCampo($tabla, $item, $valor,$campo){
		
		if($item != null){

			
			$stmt = Conexion::conectar()->prepare("SELECT SUM($campo) as totalAnimales FROM $tabla WHERE $item = '$valor'");
			
			$stmt -> execute();

			// var_dump($stmt ->errorInfo());

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT SUM($campo) FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	SUMAR CAMPO  RANGO
	=============================================*/

	static public function mdlSumarCampoRango($tabla, $item, $valor,$campo,$item2,$fecha1,$fecha2){
		
		if($item != null){

			
			$stmt = Conexion::conectar()->prepare("SELECT SUM($campo) as totalAnimales FROM $tabla WHERE $item = '$valor' AND $item2 BETWEEN '$fecha1' AND '$fecha2'");
			
			// var_dump($stmt);
			$stmt -> execute();

			
			return $stmt -> fetch();
			
		}else{
			
			$stmt = Conexion::conectar()->prepare("SELECT SUM($campo) FROM $tabla WHERE $item2 BETWEEN '$fecha1' AND '$fecha2'");
			
			$stmt -> execute();
			
			// var_dump($stmt ->errorInfo());
			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}


	/*=============================================
	SUMAR CAMPO  RANGO DOBLE
	=============================================*/

	static public function mdlSumarCampoRangoDoble($tabla,$item,$valor,$campo,$item2,$kg1,$kg2,$item3,$fecha1,$fecha2){
		
		if($item != null){

			
			$stmt = Conexion::conectar()->prepare("SELECT SUM($campo) as totalAnimales FROM $tabla WHERE ($item = :$item) AND ($item2 BETWEEN '$kg1' AND '$kg2') AND ($item3 BETWEEN '$fecha1' AND '$fecha2')");
			
			// var_dump($stmt);
			$stmt -> execute();

			
			return $stmt -> fetch();
			
		}else{
			
			$stmt = Conexion::conectar()->prepare("SELECT SUM($campo) FROM $tabla WHERE ($item2 BETWEEN '$kg1' AND '$kg2') AND ($item3 BETWEEN '$fecha1' AND '$fecha2')");
			
			$stmt -> execute();
			
			// var_dump($stmt);
			// var_dump($stmt ->errorInfo());

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	SUMAR CAMPO  OPERADOR Y RANGO 
	=============================================*/

	static public function mdlSumarCampoOperadorRango($tabla, $item, $valor,$campo,$operador,$item2,$fecha1,$fecha2){
		
		if($item != null){

			
			$stmt = Conexion::conectar()->prepare("SELECT SUM($campo) as totalAnimales FROM $tabla WHERE $item $operador '$valor' AND $item2 BETWEEN '$fecha1' AND '$fecha2'");
			
			$stmt -> execute();

			
			return $stmt -> fetch();
			
		}else{
			
			$stmt = Conexion::conectar()->prepare("SELECT SUM($campo) FROM $tabla WHERE $item2 BETWEEN '$fecha1' AND '$fecha2'");
			
			// var_dump($stmt);
			$stmt -> execute();
			
			// var_dump($stmt ->errorInfo());
			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	SUMAR CAMPO  OPERADOR SEGUN TROPA/Consig/Proveedor 
	=============================================*/

	static public function mdlSumarAlimento($tabla, $item,$valor,$item2,$valor2,$campo,$operador){
		
		if($item != null){

			
			$stmt = Conexion::conectar()->prepare("SELECT SUM($campo) FROM $tabla WHERE $item $operador :$item AND $item2 = :$item2");
			
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

			$stmt -> execute();

			// var_dump($stmt ->errorInfo());

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT SUM($campo) FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}


}