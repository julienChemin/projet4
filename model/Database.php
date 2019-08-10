<?php

abstract class Database{
	protected $db;

	const DB_HOST = "mysql:host=;dbname=blog;charset=utf8";
	const DB_LOGIN = "root";
	const DB_PASSWORD = "";
	const DB_ERRMODE = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

	protected function getConnection(){
		try{
			$this -> db = new PDO(self::DB_HOST, self::DB_LOGIN, self::DB_PASSWORD, self::DB_ERRMODE);
			return $this -> db;
		}
		catch(Exception $e){
		        die('Erreur : '. $e->getMessage());
		}
	}
	protected function checkConnect(){
		if(empty($this -> db)){
			$this -> getConnection();
			return $this -> db;
		}else{
			return $this -> db;
		}
	}
	public function sql($req, array $parameters = null){
		$q = $this -> checkConnect() -> prepare($req);

		if($parameters){
			foreach($parameters as $para_key => $para_value){
				if(is_int($para_value)){
					$q -> bindValue($para_key, $para_value, PDO::PARAM_INT);
				}else{//is string
					$q -> bindValue($para_key, $para_value);
				}
			}
		}
		$q -> execute();
		return $q;
	}
}