<?php
define('MYSQL_SERVIDOR','localhost');
define('MYSQL_USUARIO','c2030098_mamauro');
define('MYSQL_CONTRASENA','Mauro425336');
define('MYSQL_BD','c2030098_hotel');
$conexion = mysqli_connect(MYSQL_SERVIDOR, MYSQL_USUARIO, MYSQL_CONTRASENA, MYSQL_BD);


class Conexion{

	static public function conectar(){

		$link = new PDO("mysql:host=localhost;dbname=c2030098_hotel",
			            "c2030098_mamauro",
			            "Mauro425336");

		$link->exec("set names utf8");

		return $link;

	}

}