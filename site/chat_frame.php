<?php
session_start();
require "class.chat.php";
$chat = new Chat();
if(!isset($_SESSION['chat'])&&empty($_SESSION['chat'])){
	$chat->openChat();
}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/chat_frame.css">
	<title></title>
</head>
<body>
	<iframe src="chat_msg.php" id="chat_msg"></iframe>
	<div class="input_text">
		<form method="post">
			<input type="text" name="text" id="texto" autocomplete="off">
			<input type="submit" value="Enviar">
		</form>
	</div>
	<?php
	if(isset($_POST['text'])&&!empty($_POST['text'])){
		$chat->sendMsg($_POST['text']);
	}
	?>
	<script type="text/javascript">
		document.getElementById("texto").focus();
	</script>
</body>
</html>