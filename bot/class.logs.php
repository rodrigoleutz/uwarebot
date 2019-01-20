<?php
class Logs{
  private $pdo;
  public function __construct(){
    try{
       $this->pdo = new PDO("mysql:dbname=uwarebot;host=localhost","uwarebot",$_SERVER['UWARE_PASSWD']);
    }catch(PDOException $e){
        echo "Erro na db: ".$e->getMessage();
    }
  }
  public function log($user_id,$name,$action) {
    $sql = $this->pdo->prepare("insert into logs (data,user_id,name,action) values (NOW(),:user_id,:name,:action)");
    $sql->bindValue(':user_id',$user_id);
    $sql->bindValue(':name',$name);
    $sql->bindValue(':action',$action);
    $sql->execute();
    return true;
  }
  public function showLog(){
     $sql = $this->pdo->prepare("select * from logs order by id desc limit 20;");
     $sql->execute();
     if($sql->rowCount()>0){
         return $sql->fetchAll();
     }
     else{
        return array();
     }
  }
  private function showAllLog(){
     $sql = $this->pdo->prepare("select * from logs order by id desc;");
     $sql->execute();
     if($sql->rowCount()>0){
         return $sql->fetchAll();
     }
     else{
        return array();
     }
  }
  public function sendLog(){
    $d = new DateTime();
    $d = $d->format("d-m-Y-H-i-s");
    $list = $this->showAllLog();
    $log_name = "log-".$d;
    $fp = fopen($log_name.".txt","w");
    fwrite($fp, "id - Data - User_id - Name - Action");
    foreach ($list as $key) {
      $retorno = "\n".$key['id']." - ".$key['data']." - ".$key['user_id']." - ".$key['name']." - ".$key['action'];
      fwrite($fp,$retorno);
    }
    fclose($fp);
    shell_exec("zip ".$log_name.".zip ".$log_name.".txt");
    return $log_name;
  }
}
?>

