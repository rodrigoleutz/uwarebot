<?php
class Chat{
	private $pdo;
	public function __construct(){
    	try{
	    	$this->pdo = new PDO("mysql:dbname=uwarebot;host=localhost","uwarebot",$_SERVER['UWARE_PASSWD']);
    	}catch(PDOException $e){
	    	echo "Erro na db: ".$e->getMessage();
    	}
	}
	public function openChat(){
  		$_SESSION['chat'] = $_SERVER['REMOTE_ADDR'].' - '.time();
  		$sql = "insert into chatmsg (data,talk,ip,msg) values (now(),:talk,:ip,:msg);";
  		$ip = "uwarebot";
  		$msg = "Bem vindo ao uwarebot<br>
  				Posso lhe ajudar em algo?<br>
  				Para ver os comandos disponiveis digite: ajuda<br><br>
  				Em Construção.
  				";
  		$sql = $this->pdo->prepare($sql);
  		$sql->bindValue(':talk',$_SESSION['chat']);
  		$sql->bindValue(':ip',$ip);
  		$sql->bindValue(':msg',$msg);
  		$sql->execute();
  		return;
	}
	public function readMsg($talk){
		$sql = "select * from chatmsg where talk=:talk;";		
  		$sql = $this->pdo->prepare($sql);
  		$sql->bindValue(':talk',$talk);
  		$sql->execute();
  		return $sql->fetchAll();
	}
	public function sendMsg($msg){
		$sql = "insert into chatmsg (data,talk,ip,msg) values (now(),:talk,:ip,:msg);";
		$sql = $this->pdo->prepare($sql);
  		$sql->bindValue(':talk',$_SESSION['chat']);
  		$sql->bindValue(':ip',$_SERVER['REMOTE_ADDR']);
  		$sql->bindValue(':msg',$msg);
  		$sql->execute();
      	$msg = "%".$msg."%";
      	$sql = "select resp from chatbot where query like :msg";
      	$sql = $this->pdo->prepare($sql);
      	$sql->bindValue(':msg',$msg);
      	$sql->execute();
      	if($sql->rowCount()>0){
      		$resp = $sql->fetch();
      		$resp = $resp['resp'];
      		$sql = "insert into chatmsg (data,talk,ip,msg) values (now(),:talk,:ip,:msg);";
      		$sql = $this->pdo->prepare($sql);
      		$sql->bindValue(':talk',$_SESSION['chat']);
      		$sql->bindValue(':ip','uwarebot');
      		$sql->bindValue(':msg',$resp);
      		$sql->execute();
      	}
      	else{
      		$resp = "Não entendi... tente: ajuda";
      		$sql = "insert into chatmsg (data,talk,ip,msg) values (now(),:talk,:ip,:msg);";
      		$sql = $this->pdo->prepare($sql);
      		$sql->bindValue(':talk',$_SESSION['chat']);
      		$sql->bindValue(':ip','uwarebot');
      		$sql->bindValue(':msg',$resp);
      		$sql->execute();	
      	}
	}
}