<?php
session_start();
require "class.hits.php";
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
			
				<span class="hits">Hits: <?php echo $hit->showHits(); ?></span><br><br>
			
			<u>Bem vindo ao site de divulgação do uwarebot.</u><br><br>
			Este é um bot que envia os logs de um servidor linux pelo telegram para um usuário pré estabelecido.<br><br>
			Dependências:<br>
			- Nginx com https<br>
			- PHP<br>
			- MySQL<br>
			- fail2ban<br>
			<br><br>
			<div class="git">
				<a href="https://github.com/rodrigoleutz/uwarebot">Git do uwarebot</a>
				<a href="https://www.vivaolinux.com.br/dica/Simple-Server-Monitor-Bot-Telegram-PHP/">Dica no vivaolinux</a>
			</div>
			<br><br>
			<div class="menu">
			</div>
			<br>
			<div class="footer">
				Contato: <a href="mailto:uwarebot@uware.com.br">uwarebot@uware.com.br</a><br>
				Desenvolvido por: <a href="https://www.uware.com.br" target="_blank">&#174; uware.com.br</a>
			</div>
		</center>
	</body>
</html>