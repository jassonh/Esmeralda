<?php

	session_start();

	class conn{

	protected $dbh;

		protected function conexion(){

			try {
				$conn = $this->dbh = new PDO("mysql:local=localhost;
				dbname=dbesmeralda", "root", "");

				return $conn;
				echo "Conexion Exitosa";
			} catch (Exception $e) {
				print " ERROR!:  ". $e->getMessage()."<br/>";
				die();
			}

		} // cierre de la llave de la funcion conexion()

		public function set_names(){

			return $this->dbh->query("SET NAMES 'utf8' ");
		}

		public function ruta(){

			return "http://localhost/esmeralda/";
		}

		public static function convertir($string){
			$string = str_replace(
				array('01', '01', '01', '01', '01', '01', '01', '01', '01', '10', '11', '12'),
				array('ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'),
				$string
			);
			return $string;

		}
	} //Cierre de llave de la clase conn
?>
