<?php

require_once "conexion.php";

class ModeloContable{
	
	/*=============================================
	CARGAR ARCHIVO
	=============================================*/
	static public function mdlCargarArchivo($tabla,$data){
				
		if($data['planilla'] == 'paihuen'){

			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(archivo,periodo,ganancias,perdidas,ventasAgricultura,activos,inmobiliario,comuna,sld) VALUES(:archivo,:periodo,:ganancias,:perdidas,:ventasAgricultura,:activos,:inmobiliario,:comuna,:sld)");
			
			$stmt -> bindParam(":archivo", $data['archivo'], PDO::PARAM_STR);
			$stmt -> bindParam(":periodo", $data['periodo'], PDO::PARAM_STR);
			$stmt -> bindParam(":ganancias", $data['ganancias'], PDO::PARAM_STR);
			$stmt -> bindParam(":perdidas", $data['perdidas'], PDO::PARAM_STR);
			$stmt -> bindParam(":ventasAgricultura", $data['ventaAgricultura'], PDO::PARAM_STR);
			$stmt -> bindParam(":activos", $data['activos'], PDO::PARAM_STR);
			$stmt -> bindParam(":inmobiliario", $data['inmobiliario'], PDO::PARAM_STR);
			$stmt -> bindParam(":comuna", $data['comuna'], PDO::PARAM_STR);
			$stmt -> bindParam(":sld", $data['sld'], PDO::PARAM_STR);
			
		}else{
			
			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(archivo,libro,periodo,activos,activoCorriente,ganancias,perdidas,agricultura,ganaderia,resto,prestamos,tarjetas,mutuales,proveedores,seguros,deudaBancaria,deudaTotal,bienesDeCambio,cajaBancos,pasivoCorriente,pasivoTotal,sld,saldoTecnico,patrimonioNeto,ingresoBrutoMensual,cargasSocialesReales,inmobiliario,sueldos,honorarios) VALUES(:archivo,:libro,:periodo,:activos,:activoCorriente,:ganancias,:perdidas,:agricultura,:ganaderia,:resto,:prestamos,:tarjetas,:mutuales,:proveedores,:seguros,:deudaBancaria,:deudaTotal,:bienesDeCambio,:cajaBancos,:pasivoCorriente,:pasivoTotal,:sld,:saldoTecnico,:patrimonioNeto,:ingresoBrutoMensual,:cargasSocialesReales,:inmobiliario,:sueldos,:honorarios)");
			
			$stmt -> bindParam(":archivo", $data['archivo'], PDO::PARAM_STR);
			$stmt -> bindParam(":libro", $data['libro'], PDO::PARAM_STR);
			$stmt -> bindParam(":ganancias", $data['ganancias'], PDO::PARAM_STR);
			$stmt -> bindParam(":perdidas", $data['perdidas'], PDO::PARAM_STR);
			$stmt -> bindParam(":periodo", $data['periodo'], PDO::PARAM_STR);
			$stmt -> bindParam(":activos", $data['activos'], PDO::PARAM_STR);
			$stmt -> bindParam(":activoCorriente", $data['activoCorriente'], PDO::PARAM_STR);
			$stmt -> bindParam(":agricultura", $data['agricultura'], PDO::PARAM_STR);
			$stmt -> bindParam(":ganaderia", $data['ganaderia'], PDO::PARAM_STR);
			$stmt -> bindParam(":resto", $data['resto'], PDO::PARAM_STR);
			$stmt -> bindParam(":prestamos", $data['prestamos'], PDO::PARAM_STR);
			$stmt -> bindParam(":tarjetas", $data['tarjetas'], PDO::PARAM_STR);
			$stmt -> bindParam(":mutuales", $data['mutuales'], PDO::PARAM_STR);
			$stmt -> bindParam(":proveedores", $data['proveedores'], PDO::PARAM_STR);
			$stmt -> bindParam(":seguros", $data['seguros'], PDO::PARAM_STR);
			$stmt -> bindParam(":deudaBancaria", $data['deudaBancaria'], PDO::PARAM_STR);
			$stmt -> bindParam(":deudaTotal", $data['deudaTotal'], PDO::PARAM_STR);
			$stmt -> bindParam(":bienesDeCambio", $data['bienesDeCambio'], PDO::PARAM_STR);
			$stmt -> bindParam(":cajaBancos", $data['cajaBancos'], PDO::PARAM_STR);
			$stmt -> bindParam(":pasivoCorriente", $data['pasivoCorriente'], PDO::PARAM_STR);
			$stmt -> bindParam(":pasivoTotal", $data['pasivoTotal'], PDO::PARAM_STR);
			$stmt -> bindParam(":sld", $data['sld'], PDO::PARAM_STR);
			$stmt -> bindParam(":saldoTecnico", $data['saldoTecnico'], PDO::PARAM_STR);
			$stmt -> bindParam(":patrimonioNeto", $data['patrimonioNeto'], PDO::PARAM_STR);
			$stmt -> bindParam(":ingresoBrutoMensual", $data['ingresoBrutoMensual'], PDO::PARAM_STR);
			$stmt -> bindParam(":cargasSocialesReales", $data['cargasSocialesReales'], PDO::PARAM_STR);
			$stmt -> bindParam(":inmobiliario", $data['inmobiliario'], PDO::PARAM_STR);
			$stmt -> bindParam(":sueldos", $data['sueldos'], PDO::PARAM_STR);
			$stmt -> bindParam(":honorarios", $data['honorarios'], PDO::PARAM_STR);
			

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
	MOSTRAR DATOS
	=============================================*/
	
	static public function mdlMostrarDatos($tabla,$item,$valor,$item2,$valor2){
			
		if(is_array($valor2)){

			if($tabla != 'contablePaihuen'){

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND MONTH($item2) = :mes AND YEAR($item2) = :anio");
				
				$stmt -> bindParam(":".$item,$valor, PDO::PARAM_STR);
				
			}else{
				
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE MONTH($item2) = :mes AND YEAR($item2) = :anio");
				
			}
			
			$mes = $valor2[0];
			$anio = $valor2[1];

			$stmt -> bindParam(":mes", $mes, PDO::PARAM_STR);
			$stmt -> bindParam(":anio", $anio, PDO::PARAM_STR);

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item2 = :$item2");
			
			if($tabla != 'contablePaihuen'){
	
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND $item2 = :$item2");
				$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			
			}
	
			$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		}	
		
		$stmt -> execute();

		return $stmt -> fetch();
		
	}


	    
    /*=============================================
    ULTIMO PERIODO
    =============================================*/
    
    static public function mdlUltimoPeriodo($libro,$tabla){
        
		$stmt = Conexion::conectar()->prepare("SELECT MAX(periodo) FROM $tabla");
		
		if($tabla != 'contablePaihuen'){
			
			$stmt = Conexion::conectar()->prepare("SELECT MAX(periodo) FROM $tabla WHERE libro = :$libro");

			$stmt -> bindParam(":".$libro, $libro, PDO::PARAM_STR);

		}
			
		$stmt -> execute();
		
		return $stmt -> fetch();
        
    }
}

