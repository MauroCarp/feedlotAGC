<?php

require_once "conexion.php";

class ModeloAgro{
	
	/*=============================================
	CARGAR ARCHIVO AGRO
	=============================================*/
	static public function mdlCargarArchivo($tabla,$data){

		if($tabla == 'planificacion'){

			$data = implode(',',$data);
			
			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(campania1,campania2,campo,tipoCultivo,lote,has,actual,cobertura,planificado,periodoTime) VALUES $data");	
			
		}else{
			
			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(campania1,campania2,campo,lote,has,fina,costoFina,gruesa,costoGruesa) VALUES (:campania1,:campania2,:campo,:lote,:has,:fina,:costoFina,:gruesa,:costoGruesa)");

			$stmt -> bindParam(":campania1", $data['campania1'], PDO::PARAM_STR);
			$stmt -> bindParam(":campania2", $data['campania2'], PDO::PARAM_STR);
			$stmt -> bindParam(":campo", $data['campo'], PDO::PARAM_STR);
			$stmt -> bindParam(":lote", $data['lote'], PDO::PARAM_STR);
			$stmt -> bindParam(":has", $data['has'], PDO::PARAM_STR);
			$stmt -> bindParam(":fina", $data['fina'], PDO::PARAM_STR);
			$stmt -> bindParam(":costoFina", $data['precioFina'], PDO::PARAM_STR);
			$stmt -> bindParam(":gruesa", $data['gruesa'], PDO::PARAM_STR);
			$stmt -> bindParam(":costoGruesa", $data['precioGruesa'], PDO::PARAM_STR);

		}
		
		if($stmt->execute()){
			
			return "ok";	
			
		}else{
			
			return $stmt->errorInfo();
			return 'error';
			
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

		$tabla = 'costo'.$tabla;

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla($item,$item2,$item3,costo) VALUES (:$item,:$item2,:$item3,:costo)");
	
		$stmt->bindParam(":".$item, $value, PDO::PARAM_STR);
		$stmt->bindParam(":".$item2, $value2, PDO::PARAM_STR);
		$stmt->bindParam(":".$item3, $value3, PDO::PARAM_STR);
		$stmt->bindParam(":costo", $costo, PDO::PARAM_STR);

		if($stmt->execute()){
			
			return "ok";	
			
		}else{
			return $stmt->errorInfo();
			return 'error';
			
		}
		
		$stmt->close();
		
		$stmt = null;
	

	}

	/*=============================================
	EDITAR COSTO
	=============================================*/

	static public function mdlEditarCosto($tabla,$item,$value,$item2,$value2,$item3,$value3,$costo){

		$tabla = 'costo'.$tabla;

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET 
		costo = :costo		
		WHERE $item = :$item AND $item2 = :$item2 AND $item3 = :$item3");
	
		$stmt->bindParam(":".$item, $value, PDO::PARAM_STR);
		$stmt->bindParam(":".$item2, $value2, PDO::PARAM_STR);
		$stmt->bindParam(":".$item3, $value3, PDO::PARAM_STR);
		$stmt->bindParam(":costo", $costo, PDO::PARAM_STR);

		if($stmt->execute()){
			
			return "ok";	
			
		}else{

			return $stmt->errorInfo();
			return 'error';
			
		}
		
		$stmt->close();
		
		$stmt = null;
	

	}


	/*=============================================
	MOSTRAR DATA
	=============================================*/
	static public function mdlMostrarData($tabla, $item, $value, $item2, $value2, $item3, $value3){

		if($value != ''){

			if($tabla == 'info_planificacion'){
				
				if($item2 != null){
					
					$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item OR $item2 = :$item2");
					$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);
					$stmt -> bindParam(":".$item2, $value2, PDO::PARAM_STR);
					
				}else{

					$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ");
					$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);
					
				}
						

			}else{

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND $item2 = :$item2 AND $item3 = :$item3 ");
				
				$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);
				$stmt -> bindParam(":".$item2, $value2, PDO::PARAM_STR);
				$stmt -> bindParam(":".$item3, $value3, PDO::PARAM_STR);

			}

			
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

	/*=============================================
	CERRAR CAMPAÑA
	=============================================*/

	static public function mdlCerrarCampania($tabla,$item,$valor){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET cerrada = 1 WHERE $item = :$item");
	
		$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

		if($stmt->execute()){
			
			return "ok";	
			
		}else{

			return $stmt->errorInfo();
			return 'error';
			
		}
		
		$stmt->close();
		
		$stmt = null;
	

	}

	/*=============================================
	ELIMINAR ARCHIVO
	=============================================*/
	static public function mdlEliminarArchivo($tabla,$item,$value, $item2, $value2, $item3, $value3){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE $item = :$item AND $item2 = :$item2 AND $item3 = :$item3");
			
			$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);
			
		}else{
			
			$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE $item2 = :$item2 AND $item3 = :$item3");

		}
		
		$stmt -> bindParam(":".$item2, $value2, PDO::PARAM_INT);
		$stmt -> bindParam(":".$item3, $value3, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{
			return $stmt->	errorInfo();
			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

}
