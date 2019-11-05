<?php
class config{

	private $dbname;
	private $user;
	private $password;

	public function __construct($dbname,$user,$password){
		$this->dbname=$dbname;
		$this->user=$user;
		$this->password=$password;
	}

	public function getconnection(){
		return new PDO('mysql:host=localhost;dbname='.$this->dbname,$this->user,$this->password);
	}
}
?>
