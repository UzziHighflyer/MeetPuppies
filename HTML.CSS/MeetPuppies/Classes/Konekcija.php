<?php  
	class Konekcija{
		private static $konekcija;
		public static function get(){
			if (!self::$konekcija) {
				try{	
					self::$konekcija = new PDO("mysql:host=" . DB_HOST .";dbname=" . DB_DATABASE,DB_USERNAME,DB_PASSWORD);
					self::$konekcija->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					self::$konekcija->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
					self::$konekcija->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
				}catch(PDOException $e){
					echo "Error" . $e->getMessage();
				}
			}
			return self::$konekcija;
		}
	}

