<?php
	class Hits{
  		private $pdo;
  		public function __construct(){
    		try{
	     		$this->pdo = new PDO("mysql:dbname=uwarebot;host=localhost","uwarebot",$_SERVER['UWARE_PASSWD']);
    	}catch(PDOException $e){
	     	 echo "Erro na db: ".$e->getMessage();
    	}
  	}
  	public function hit(){
  		$sql = "insert into hits (data,ip) values (now(),:ip);";
  		$sql = $this->pdo->prepare($sql);
  		$sql->bindValue(':ip',$_SERVER['REMOTE_ADDR']);
  		$sql->execute();
  	}
  	public function showHits(){
  		$sql = "select max(id) as id from hits;";
  		$sql = $this->pdo->prepare($sql);
  		$sql->bindValue(':ip',$_SERVER['REMOTE_ADDR']);
  		$sql->execute();
  		$num = $sql->fetch();
  		return $num['id'];
  	}

}
