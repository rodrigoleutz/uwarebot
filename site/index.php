<?php
session_start();
require "class.hits.php";
require "class.chat.php";
$hit = new Hits();
if(!isset($_SESSION['ip'])&&empty($_SESSION['ip'])){
	$hit->hit();
	$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
}
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/reset.css">
		<link rel="stylesheet" type="text/css" href="css/index.css">
		<link rel="stylesheet" type="text/css" href="css/chat.css">
		<link rel="shortcut icon" type="image/png" href="img/icon.png"/>
		<title>uware</title>
	</head>
	<body>
		<center>
			<br>
			<img src="img/uwarebot.png">
		</center>
		<br>
		<center>
			<div class="menu">
				<!--<ul>
					<li><a href="index.php">Principal</a></li>
				</ul> -->
			</div>
			<br>
			
			<span class="hits">Hits: <?php echo $hit->showHits(); ?></span><br><br><br>
			
			<u>Bem vindo ao site de divulgação do uwarebot.</u><br><br>
			Este é um bot que envia os logs de um servidor linux pelo telegram para um usuário pré estabelecido.<br>
			Em breve um chatbot vai estar no site para tirar dúvidas...Esperem...Está em construção...<br><br>
			Dependências:<br>
			- Nginx com https<br>
			- PHP<br>
			- MySQL<br>
			- fail2ban<br>
			<br><br>
			<div class="git">
				<a href="https://github.com/rodrigoleutz/uwarebot"target="_blank">Git do uwarebot</a>
				<a href="https://www.vivaolinux.com.br/dica/Simple-Server-Monitor-Bot-Telegram-PHP/" target="_blank">Dica no vivaolinux</a><br><br>
				<a href="https://t.me/bot_php_brasil">BOT PHP Telegram</a>
				<a href="https://t.me/curitiba_pr" target="_blank">Curitiba-PR Telegram</a><br><br>
			</div>
					<div class="down"><a href="https://github.com/rodrigoleutz/uwarebot/blob/master/uwarebot-v0.1.tar.gz?raw=true">Download</a></div><br>
			<div class="menu">
			</div>
			<br>
			<div class="footer">
				Contato: <a href="mailto:uwarebot@uware.com.br">uwarebot@uware.com.br</a><br>
				Desenvolvido por: <a href="https://www.uware.com.br" target="_blank">&#174; uware.com.br</a>
			</div>
		</center>
		<div id="chat">
			<?php
				include "chat.php";
			?>
		</div>
	</body>
</html>