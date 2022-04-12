<?php

require_once "conexion.php";

class ModeloDatos{

	/*=============================================
	MOSTRAR USUARIOS
	=============================================*/

	static public function mdlMostrarUsuarios($tabla, $item, $valor){

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
	REGISTRO DE USUARIO
	=============================================*/

	static public function mdlCargarDatos($tabla, $datos){
		
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(hotelero,caravana,categoria,raza,tropa,motivo,destinoVenta,actividad,cab,kgIngreso,kgSalida,kgProd,dias,adpv,convMS,kgI,kgE,dias2,kgP,adpv3,CMS,kgI4,kgE5,dias6,kgP7,adpv8,CMS9,kgI10,kgE11,dias12,kgP13,adpv14,CMS15,convTC,totalKgTC,totalKgMS,costoKG,costoCompra,otrosCompra,total,consignatario,proveedor,localidad,provincia,totalConsumo,totalEstructura,estadoProduccion,anio,fechaIngreso,fechaSalida,ingresoVenta,gastoVenta,margen,margenKilo,transaccion,tipoOperacion,estadoEgreso,estadoIngreso,clasificacion,sexo,fechaRomaneo,kilosCarcasaIngreso,kilos3raBalanza,kilosCarne4ta,dressing,ADPC,convMSCarcasa,establecimiento,trazadoSino,zona,columna16)
		 VALUES (:hotelero,:caravana,:categoria,:raza,:tropa,:motivo,:destinoVenta,:actividad,:cab,:kgIngreso,:kgSalida,:kgProd,:dias,
		 :adpv,:convMS,:kgI,:kgE,:dias2,:kgP,:adpv3,:CMS,:kgI4,:kgE5,:dias6,:kgP7,:adpv8,:CMS9,:kgI10,:kgE11,:dias12,:kgP13,:adpv14,
		 :CMS15,:convTC,:totalKgTC,:totalKgMS,:costoKG,:costoCompra,:otrosCompra,:total,:consignatario,:proveedor,:localidad,:provincia,
		 :totalConsumo,:totalEstructura,:estadoProduccion,:anio,:fechaIngreso,:fechaSalida,:ingresoVenta,:gastoVenta,:margen,:margenKilo,
		 :transaccion,:tipoOperacion,:estadoEgreso,:estadoIngreso,:clasificacion,:sexo,:fechaRomaneo,:kilosCarcasaIngreso,:kilos3raBalanza,
		 :kilosCarne4ta,:dressing,:ADPC,:convMSCarcasa,:establecimiento,:trazadoSino,:zona,:columna16)");


		$stmt->bindParam(":hotelero", $datos["hotelero"], PDO::PARAM_STR);
		$stmt->bindParam(":caravana", $datos["caravana"], PDO::PARAM_STR);
		$stmt->bindParam(":categoria", $datos["categoria"], PDO::PARAM_STR);
		$stmt->bindParam(":raza", $datos["raza"], PDO::PARAM_STR);
		$stmt->bindParam(":tropa", $datos["tropa"], PDO::PARAM_STR);
		$stmt->bindParam(":motivo", $datos["motivo"], PDO::PARAM_STR);
		$stmt->bindParam(":destinoVenta", $datos["destinoVenta"], PDO::PARAM_STR);
		$stmt->bindParam(":actividad", $datos["actividad"], PDO::PARAM_STR);
		$stmt->bindParam(":cab", $datos["cab"], PDO::PARAM_STR);
		$stmt->bindParam(":kgIngreso", $datos["kgIngreso"], PDO::PARAM_STR);
		$stmt->bindParam(":kgSalida", $datos["kgSalida"], PDO::PARAM_STR);
		$stmt->bindParam(":kgProd", $datos["kgProd"], PDO::PARAM_STR);
		$stmt->bindParam(":dias", $datos["dias"], PDO::PARAM_STR);
		$stmt->bindParam(":adpv", $datos["adpv"], PDO::PARAM_STR);
		$stmt->bindParam(":convMS", $datos["convMS"], PDO::PARAM_STR);
		$stmt->bindParam(":kgI", $datos["kgI"], PDO::PARAM_STR);
		$stmt->bindParam(":kgE", $datos["kgE"], PDO::PARAM_STR);
		$stmt->bindParam(":dias2", $datos["dias2"], PDO::PARAM_STR);
		$stmt->bindParam(":kgP", $datos["kgP"], PDO::PARAM_STR);
		$stmt->bindParam(":adpv3", $datos["adpv3"], PDO::PARAM_STR);
		$stmt->bindParam(":CMS", $datos["CMS"], PDO::PARAM_STR);
		$stmt->bindParam(":kgI4", $datos["kgI4"], PDO::PARAM_STR);
		$stmt->bindParam(":kgE5", $datos["kgE5"], PDO::PARAM_STR);
		$stmt->bindParam(":dias6", $datos["dias6"], PDO::PARAM_STR);
		$stmt->bindParam(":kgP7", $datos["kgP7"], PDO::PARAM_STR);
		$stmt->bindParam(":adpv8", $datos["adpv8"], PDO::PARAM_STR);
		$stmt->bindParam(":CMS9", $datos["CMS9"], PDO::PARAM_STR);
		$stmt->bindParam(":kgI10", $datos["kgI10"], PDO::PARAM_STR);
		$stmt->bindParam(":kgE11", $datos["kgE11"], PDO::PARAM_STR);
		$stmt->bindParam(":dias12", $datos["dias12"], PDO::PARAM_STR);
		$stmt->bindParam(":kgP13", $datos["kgP13"], PDO::PARAM_STR);
		$stmt->bindParam(":adpv14", $datos["adpv14"], PDO::PARAM_STR);		
		$stmt->bindParam(":CMS15", $datos["CMS15"], PDO::PARAM_STR);
		$stmt->bindParam(":convTC", $datos["convTC"], PDO::PARAM_STR);
		$stmt->bindParam(":totalKgTC", $datos["totalKgTC"], PDO::PARAM_STR);
		$stmt->bindParam(":totalKgMS", $datos["totalKgMS"], PDO::PARAM_STR);
		$stmt->bindParam(":costoKG", $datos["costoKG"], PDO::PARAM_STR);
		$stmt->bindParam(":costoCompra", $datos["costoCompra"], PDO::PARAM_STR);
		$stmt->bindParam(":otrosCompra", $datos["otrosCompra"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":consignatario", $datos["consignatario"], PDO::PARAM_STR);
		$stmt->bindParam(":proveedor", $datos["proveedor"], PDO::PARAM_STR);
		$stmt->bindParam(":localidad", $datos["localidad"], PDO::PARAM_STR);
		$stmt->bindParam(":provincia", $datos["provincia"], PDO::PARAM_STR);
		$stmt->bindParam(":transaccion", $datos["transaccion"], PDO::PARAM_STR);
		$stmt->bindParam(":tipoOperacion", $datos["tipoOperacion"], PDO::PARAM_STR);
		$stmt->bindParam(":estadoEgreso", $datos["estadoEgreso"], PDO::PARAM_STR);
		$stmt->bindParam(":estadoIngreso", $datos["estadoIngreso"], PDO::PARAM_STR);
		$stmt->bindParam(":clasificacion", $datos["clasificacion"], PDO::PARAM_STR);
		$stmt->bindParam(":sexo", $datos["sexo"], PDO::PARAM_STR);
		$stmt->bindParam(":fechaRomaneo", $datos["fechaRomaneo"], PDO::PARAM_STR);
		$stmt->bindParam(":kilosCarcasaIngreso", $datos["kilosCarcasaIngreso"], PDO::PARAM_STR);
		$stmt->bindParam(":kilos3raBalanza", $datos["kilos3raBalanza"], PDO::PARAM_STR);
		$stmt->bindParam(":kilosCarne4ta", $datos["kilosCarne4ta"], PDO::PARAM_STR);
		$stmt->bindParam(":ADPC", $datos["ADPC"], PDO::PARAM_STR);
		$stmt->bindParam(":convMSCarcasa", $datos["convMSCarcasa"], PDO::PARAM_STR);
		$stmt->bindParam(":establecimiento", $datos["establecimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":trazadoSino", $datos["trazadoSino"], PDO::PARAM_STR);
		$stmt->bindParam(":zona", $datos["zona"], PDO::PARAM_STR);
		$stmt->bindParam(":columna16", $datos["columna16"], PDO::PARAM_STR);



		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	}

	/*=============================================
	EDITAR USUARIO
	=============================================*/

	static public function mdlEditarUsuario($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, password = :password, perfil = :perfil, foto = :foto WHERE usuario = :usuario");

		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt -> bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
		$stmt -> bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		$stmt -> bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR USUARIO
	=============================================*/

	static public function mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	BORRAR USUARIO
	=============================================*/

	static public function mdlBorrarUsuario($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;


	}

}