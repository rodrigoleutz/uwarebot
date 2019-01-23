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
  public function addText($text){
  	$text1 = explode('-', $text);
    $query = '';
  	if(isset($text1[1])&&!empty($text1[1])){
      $resp = $text1[1];
  	}
    $text2 = explode(' ',$text1[0]);
    if(isset($text2[2])&&!empty($text2[2])){
  	 for($x=2;$x<=count($text2);$x++){
  		  $query = $query.' '.$text2[$x];
  	 }
    }
    $sql = "select * from chatbot where query=:query;";
    $sql = $this->pdo->prepare($sql);
    $sql->bindValue(':query',$query);
    $sql->execute();
    if($sql->rowCount()>0){
      return "Já existe este query ".$query;
    }
    else{
      if(!isset($text1[1])&&empty($text1[1])){
        return "Tem que ser digitado /chat add (Palavra chave) - (Resposta que o bot irá dar)";
      }
      else{
  	    $sql = "insert into chatbot (query,resp) values (:query,:resp);";
  	    $sql = $this->pdo->prepare($sql);
  	    $sql->bindValue(':query',$query);
  	    $sql->bindValue(':resp',$resp);
  	    $sql->execute();
        return "Add:".$query." resp:".$resp;
      }
  	}
  }
  public function delText($text){
    if($this->existText()){

    }
    else{
      
    }
  }
  public function existText($text){
    if(isset($text)&&!empty($text)){
      $text = "%".$text."%";
    }
    $sql = "select * from chatbot where query like :query;";
    $sql = $this->pdo->prepare($sql);
    $sql->bindValue(':query',$text);
    $sql->execute();
    if($sql->rowCount()>0){
      return true;
    }
    else{
      return false;
    }
  }
  public function respText($text){
    $text = "%".$text."%";
    $sql = "select * from chatbot where query like :query;";
    $sql = $this->pdo->prepare($sql);
    $sql->bindValue(':query',$text);
    $sql->execute();
    $resp = $sql->fetch();
    return $resp['resp'];
  }
}