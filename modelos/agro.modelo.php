<?php

require_once "conexion.php";

class ModeloAgro{
	
	/*=============================================
	CARGAR ARCHIVO AGRO
	=============================================*/
	static public function mdlCargarArchivo($tabla,$data){
		
		$data = implode(',',$data);
		
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(campania,campo,tipoCultivo,lote,has,actual,planificado,dateTime) VALUES $data");
		
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
	static public function mdlMostrarCostos($tabla,$item,$value,$item2,$value2){
	
		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
					
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();
			
			return $stmt -> fetch();
			
		}else{
			
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
			
			$stmt -> execute();
			
			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	CARGAR COSTO
	=============================================*/
	static public function mdlCargarCostos($tabla,$item,$value,$item2,$value2,$costo){
	
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla($item,$item2,costo) VALUES (:$item,:$item2,:costo)");
	
		$stmt->bindParam(":".$item, $value, PDO::PARAM_STR);
		$stmt->bindParam(":".$item2, $value2, PDO::PARAM_STR);
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

}
