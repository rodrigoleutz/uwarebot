<?php
session_start();
require "class.chat.php";
$chat = new Chat();
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/chat_msg.css">
	<title></title>
</head>
<body>
<div id="id_baixo">
<?php
$list = $chat->readMsg($_SESSION['chat']);
foreach ($list as $key) {
	if($key['ip']==$_SERVER['REMOTE_ADDR']){
		?>
		 <div class="dir"><?php echo  $key['msg']; ?><span class="data"><?php
            $data = new DateTime($key['data']);
            echo "     ".$data->format('H:i');
            ?></span>
        </div>
        <br><br>
        <?php
     }
     else{
		?>
		<div class="esq"><?php echo $key['msg']; ?><span class="data"><?php
            $data = new DateTime($key['data']);
            echo "     ".$data->format('H:i');
            ?></span>
        </div><br><br>
            <?php
	}
}
?>
<br><br>
<!--<div id="seta_baixo">
    <a href="#baixo"><img src="img/i_seta.png"></a>
</div>-->
<a name="baixo"></a>
<br><br>
</div>

<script type="text/javascript">
        document.location.href='#baixo';
</script>
</body>
</html>