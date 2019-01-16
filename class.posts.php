<?php
class Posts{
  private $pdo;
  public function __construct(){
    try{
	     $this->pdo = new PDO("mysql:dbname=uwarebot;host=localhost","uwarebot",$_SERVER['UWARE_PASSWD']);
    }catch(PDOException $e){
	      echo "Erro na db: ".$e->getMessage();
    }
  }
  public function postAdd($text,$owner,$owner_id){
  	$post = "";
  	for($x=3;$x<=count($text);$x++){
  		$post = $post." ".$text[$x];
  	}
  	$sql = "insert into posts (data,url,post,owner,owner_id) values (now(),:url,:post,:owner,:owner_id);";
  	$sql = $this->pdo->prepare($sql);
    $sql->bindValue(':url',$text[2]);
    $sql->bindValue(':post',$post);
    $sql->bindValue(':owner',$owner);
    $sql->bindValue(':owner_id',$owner_id);
    $sql->execute();
  	return;
  }
  public function postList(){
  	$sql = "select * from posts order by data desc limit 20;";
  	$sql = $this->pdo->prepare($sql);
  	$sql->execute();
  	return $sql->fetchAll();
  }
 }