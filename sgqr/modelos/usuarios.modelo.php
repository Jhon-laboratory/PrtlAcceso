<?php
require_once "conexion.php";

class ModeloUsuarios{



	static public function mdlMostrarUsuarios($tabla,$item,$valor){

		if ($item != null) {
			
			if ($tabla != "usuariosclientes") {

				if ($item == "perfil") {
					$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :valor1 OR $item = :valor2");

					$stmt -> bindparam(":valor1", $valor["valor1"], PDO::PARAM_STR);
					$stmt -> bindparam(":valor2", $valor["valor2"], PDO::PARAM_STR);
					$stmt -> execute();


					return $stmt -> fetchAll();						
					
				}else if (isset($item["idciudad"])) {
					$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE {$item["idciudad"]} = :idciudad AND {$item["perfil"]} = :perfil");

					$stmt -> bindparam(":idciudad", $valor["idciudad"], PDO::PARAM_STR);
					$stmt -> bindparam(":perfil", $valor["perfil"], PDO::PARAM_STR);
					$stmt -> execute();


					return $stmt -> fetchAll();											
					
				}else if ($item == "cuentas") {
					/*=============================================================================================
					=            BUSCAR TODOS LOS USUARIOS QUE CONTENGAN EL CLIENTE SEGUN RAZON SOCIAL            =
					=============================================================================================*/
					$stmt = Conexion::conectar()->prepare("SELECT * FROM usuariosransa WHERE MATCH ($item) AGAINST (:valor IN BOOLEAN MODE) AND perfil = :perfil");

					$stmt -> bindparam(":valor", $valor["cuentas"], PDO::PARAM_STR);
					$stmt -> bindparam(":perfil", $valor["perfil"], PDO::PARAM_STR);
					// $stmt -> bindparam(":perfil", $valor["perfil"], PDO::PARAM_STR);
					$stmt -> execute();


					return $stmt -> fetchAll();
				}
				else{
					$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
					$stmt -> bindparam(":".$item, $valor, PDO::PARAM_STR);	
					$stmt -> execute();					
					return $stmt -> fetch();



				}


			
			}else{
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla 
													INNER JOIN clientes
													ON $tabla.`idcliente` = `clientes`.`idcliente` 
													WHERE $item = :$item");

				$stmt -> bindparam(":".$item, $valor, PDO::PARAM_STR);

				$stmt -> execute();

				return $stmt -> fetch();

			}
		}else{
			if ($tabla == "usuariosclientes") {
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla 
													   INNER JOIN clientes
													   ON $tabla.`idcliente` = `clientes`.`idcliente`");

				$stmt -> execute();

				return $stmt -> fetchAll();				
			}else{
				
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

				$stmt -> execute();

				return $stmt -> fetchAll();

			}
		}

		$stmt -> close();

		$stmt = null;

	}


}