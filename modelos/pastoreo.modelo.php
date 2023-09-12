<?php

require_once "conexion.php";

class ModeloPastoreo{

	/*=============================================
	MOSTRAR Datos
	=============================================*/

	static public function mdlMostrarRegistros($tabla,$campo, $item, $valor,$item2 = null,$valor2 = null){

		if($item != null){

			if($item2 == null){

				if($valor != null){
	
					$stmt = Conexion::conectar()->prepare("SELECT $campo FROM $tabla WHERE $item = :$item ");
					
					$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
					
					$stmt -> execute();
					
					return $stmt -> fetchAll();
	
				} else {
					
					$stmt = Conexion::conectar()->prepare("SELECT $campo FROM $tabla WHERE $item IS NULL");
	
					$stmt -> execute();
					
					return $stmt -> fetchAll();
				}

			} else {

				$stmt = Conexion::conectar()->prepare("SELECT $campo FROM $tabla WHERE $item = :$item AND $item2 = :$item2 ");
					
				$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
				$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);
				
				$stmt -> execute();
				
				return $stmt -> fetchAll();

			}


			
		}else{
			
			$stmt = Conexion::conectar()->prepare("SELECT $campo FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		
		$stmt = null;

	}
	
    static public function mdlNuevoRegistro($tabla,$data){
	
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(tropa,fechaEntrada) VALUES (:tropa,:fechaEntrada)");
            
        $stmt->bindParam(":tropa", $data['tropa'], PDO::PARAM_STR);
        $stmt->bindParam(":fechaEntrada", $data['fechaEntrada'], PDO::PARAM_STR);
		
        if($stmt->execute()){
            
            return "ok";	
            
        }else{
            
            return $stmt->errorInfo();
            
        }
    }
    
	static public function mdlEditarRegistro($tabla,$data,$item,$valor){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET fechaEntrada = :fechaEntrada, fechaSalida = :fechaSalida WHERE $item = :$item");
            
        $stmt->bindParam(":fechaEntrada", $data['fechaEntrada'], PDO::PARAM_STR);
        $stmt->bindParam(":fechaSalida", $data['fechaSalida'], PDO::PARAM_STR);
        $stmt->bindParam(":$item", $valor, PDO::PARAM_STR);
		
        if($stmt->execute()){
            
            return "ok";	
            
        }else{
            
            return $stmt->errorInfo();
            
        }
    }

	static public function mdlEliminarRegistro($tabla,$item,$valor){
	
    
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE $item = :$item");
		
		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{
			return $stmt->	errorInfo();
			return "error";	

		}

		$stmt = null;
    }
}