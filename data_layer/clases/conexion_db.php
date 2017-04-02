<?php 	
	class Db{
        
		private static $conexion=null;
		private function __construct(){}

		public static function conectar(){
			try {
	            require_once('./config/database.php');
				$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
				self::$conexion = new PDO('mysql:host='.$DB_HOST.';dbname='.$DB_DATABASE,
					$DB_USER, $DB_PASSWORD, $pdo_options);
		    }
		    catch(PDOException $e)
            {
             $conexion=null;
             //echo "Connection failed: " . $e->getMessage();
            }

			return self::$conexion;

		}
	}
?>