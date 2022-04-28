<?php

require_once "conexion.php";

class ModeloAgro{
	
	/*=============================================
	CARGAR ARCHIVO AGRO
	=============================================*/
	static public function mdlCargarArchivo($tabla,$data){
		
		$data = implode(',',$data);
		
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(campania1,campania2,campo,tipoCultivo,lote,has,actual,planificado,dateTime) VALUES $data");
		
		if($stmt->execute()){
			
			return "ok";	
			
		}else{
			return 'error';

			return $stmt->errorInfo();
			
		}
		
		$stmt->close();
		
		$stmt = null;
	
	}

	/*=============================================
	MOSTRAR COSTO
	=============================================*/
	static public function mdlMostrarCostos($tabla,$item,$value,$item2,$value2,$item3,$value3){

		$tabla = 'costo'.$tabla;

		if($value2 != ''){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND $item2 = :$item2 AND $item3 = :$item3");
			$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);
			$stmt -> bindParam(":".$item2, $value2, PDO::PARAM_STR);
			$stmt -> bindParam(":".$item3, $value3, PDO::PARAM_STR);
			
		}else{
			
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item3 = (SELECT MAX($item3) FROM $tabla)");

		}

		$stmt -> execute();
		
		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	CARGAR COSTO
	=============================================*/

	static public function mdlCargarCostos($tabla,$item,$value,$item2,$value2,$item3,$value3,$costo){
				
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla($item,$item2,$item3,costo) VALUES (:$item,:$item2,:$item3,:costo)");
	
		$stmt->bindParam(":".$item, $value, PDO::PARAM_STR);
		$stmt->bindParam(":".$item2, $value2, PDO::PARAM_STR);
		$stmt->bindParam(":".$item3, $value3, PDO::PARAM_STR);
		$stmt->bindParam(":costo", $costo, PDO::PARAM_STR);

		if($stmt->execute()){
			
			return "ok";	
			
		}else{
			return 'error';
			return $stmt->errorInfo();
			
		}
		
		$stmt->close();
		
		$stmt = null;
	

	}


	/*=============================================
	CARGAR COSTO
	=============================================*/

	static public function mdlEditarCostos($tabla,$item,$value,$item2,$value2,$item3,$value3,$costo){
				
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET 
		$costo = :$costo		
		WHERE $item = :$item AND $item2 = :$item2 AND $item3 = :$item3");
	
		$stmt->bindParam(":".$item, $value, PDO::PARAM_STR);
		$stmt->bindParam(":".$item2, $value2, PDO::PARAM_STR);
		$stmt->bindParam(":".$item3, $value3, PDO::PARAM_STR);
		$stmt->bindParam(":costo", $costo, PDO::PARAM_STR);

		if($stmt->execute()){
			
			return "ok";	
			
		}else{
			return 'error';
			return $stmt->errorInfo();
			
		}
		
		$stmt->close();
		
		$stmt = null;
	

	}

	/*=============================================
	MOSTRAR DATA
	=============================================*/
	static public function mdlMostrarData($tabla, $item, $value, $item2, $value2, $item3, $value3){

		if($value != ''){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND $item2 = :$item2 AND $item3 = :$item3 ");
					
			$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);
			$stmt -> bindParam(":".$item2, $value2, PDO::PARAM_STR);
			$stmt -> bindParam(":".$item3, $value3, PDO::PARAM_STR);

			$stmt -> execute();
			
			return $stmt -> fetchAll();
			
		}else{
			
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item2 = (SELECT MAX($item2) FROM $tabla) AND $item3 = :$item3");
			
			$stmt -> bindParam(":".$item3, $value3, PDO::PARAM_STR);

			$stmt -> execute();
			
			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

}
