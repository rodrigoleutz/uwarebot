<?php
/*

	Autor: Rodrigo Leutz
	Telegram Bot: Simple Server Monitor

*/

//	Ip do servidor, se não for a msg dele ja sai
if($_SERVER['REMOTE_ADDR']!='149.154.167.217'){
	exit;
}

//	Classe de logs
require "class.logs.php";
require "class.posts.php";

//	Aqui é o token e id user do telegram
define('BOT_TOKEN', '<token>');
define('BOT_URL', '<url do bot>');
define('OWNER','<user id>');
define('BOT_NAME','<@ nome do bot>');
define('API_URL', 'https://api.telegram.org/bot'.BOT_TOKEN.'/');

//	Iniciando a class do Log
$log = new Logs();


//	Variaveis
$content = file_get_contents("php://input");
$update = json_decode($content, true);
$chatID = $update["message"]["chat"]["id"];
$text_inteiro = $update['message']['text'];
$first_name = $update['message']['from']['first_name'];
$last_name = $update['message']['from']['last_name'];
$first_name = $first_name." ".$last_name;


//	Programação do uwareBot

$text = explode(' ',$text_inteiro);

// Variavel de texto MARKDOWN
$x=0;

//	Comandos do dono
if($update['message']['from']['id'] == OWNER){
	if($text[0] == '/failssh'){
		$msg = shell_exec("/usr/bin/sudo fail2ban-client status sshd");
		$log->log($update['message']['from']['id'],$first_name,$text_inteiro);
	}
	else if($text[0] == '/free'){
		$msg = shell_exec("free -m");
		$log->log($update['message']['from']['id'],$first_name,$text_inteiro);
	}
	else if($text[0] == '/last'){
		$msg = shell_exec("last -20");
		$log->log($update['message']['from']['id'],$first_name,$text_inteiro);
	}
	else if($text[0] == '/log'){
		$list = $log->showLog();
		$msg = "id - Data - User_id - Name - Action";
		foreach ($list as $key) {
			$retorno = "\n".$key['id']." - ".$key['data']." - *".$key['user_id']."* - ".$key['name']." - ".$key['action'];
			$msg.= $retorno;
		}
		$log->log($update['message']['from']['id'],$first_name,$text_inteiro);
	}
	else if($text[0] == '/logall'){
		$log_name = $log->sendLog();
		$msg = "O log ira em arquivo .zip nome: * ".$log_name.".zip *";
		$sendto =API_URL."sendDocument?chat_id=".$chatID."&document=".BOT_URL.$log_name.".zip";
		file_get_contents($sendto);
		unlink($log_name.".txt");
		unlink($log_name.".zip");
		$x=1;
		$log->log($update['message']['from']['id'],$first_name,$text_inteiro);
	}
	else if($text[0] == '/ls'){
		$msg = "_Listando diretório:_ * $text[1] *\n";
		$msg.= shell_exec("/usr/bin/sudo ls -lh $text[1]");
		$x=1;
		$log->log($update['message']['from']['id'],$first_name,$text_inteiro);
	}
	else if($text[0] == '/ngaccess'){
		$msg = shell_exec("/usr/bin/sudo tail /var/log/nginx/access.log");
		$log->log($update['message']['from']['id'],$first_name,$text_inteiro);
	}
	else if($text[0] == '/ngerror'){
		$msg = shell_exec("/usr/bin/sudo tail /var/log/nginx/error.log");
		$msg = str_replace(BOT_TOKEN,"<TOKEN>",$msg);
		$log->log($update['message']['from']['id'],$first_name,$text_inteiro);
	}
	else if($text[0] == '/ps'){
		$msg = shell_exec("ps aux | grep $text[1]");
		$log->log($update['message']['from']['id'],$first_name,$text_inteiro);
	}
	else if($text[0] == '/sshlog'){
		$msg = shell_exec("/usr/bin/sudo journalctl -u sshd --no-pager -n 20");
		$log->log($update['message']['from']['id'],$first_name,$text_inteiro);
	}
	else if($text[0] == '/top'){
		$msg = shell_exec("/usr/bin/sudo top -b -n 1 | head -n 15");
		$log->log($update['message']['from']['id'],$first_name,$text_inteiro);
	}
	else if($text[0] == '/uptime'){
		$msg = shell_exec("uptime");
		$log->log($update['message']['from']['id'],$first_name,$text_inteiro);
	}
	else if($text[0] == '/version'){
		$msg = shell_exec("uname -a");
		$log->log($update['message']['from']['id'],$first_name,$text_inteiro);
	}
	else if($text[0] == '/versions'){
		$cen = shell_exec("cat /etc/redhat-release");
		$des = shell_exec("ls -lct --time-style=+\"%F %T\" / | tail -1 | awk '{print $6, $7}'");
		$php = phpversion();
		$mys = shell_exec("mysql -V");
		$msg = "S.O.: $cen $des";
		$msg.= "PHP: $php";
		$msg.= "\nMySQL: $mys";
		$log->log($update['message']['from']['id'],$first_name,$text_inteiro);
	}
	else if($text[0] == '/w'){
		$msg = shell_exec("w");
		$log->log($update['message']['from']['id'],$first_name,$text_inteiro);
	}
	/* 	Escopo de função de dono

	else if($text[0] == '']){
		$msg = shell_exec("");
		$log->log($update['message']['from']['id'],$first_name,$text_inteiro);
	}
	*/

}


//	Funções de todos os usuários
if($text[0] == '/help' || $text[0] == '/help'.BOT_NAME){
	$msg = "* Comandos do uwareBot:*\n\n";
	if($update['message']['from']['id'] == OWNER){
		$msg.= "/failssh - falhas no sshd do fail2ban\n";
		$msg.= "/free - Verifica memória\n";
		$msg.= "/last - Ultimos 20 logins\n";
		$msg.= "/log - Ultimos 20 logs do bot\n";
		$msg.= "/logall - Todos os logs do bot\n";
		$msg.= "/ls (pasta) - Lista o diretório\n";
		$msg.= "/ngaccess - Acessos do nginx\n";
		$msg.= "/ngerror - Erros do nginx\n";
		$msg.= "/ps (processo) - Lista processo\n";
		$msg.= "/sshlog - 20 ultimos logs do sshd\n";
		$msg.= "/top - Comando top\n";
		$msg.= "/uptime - Uptime do server\n";
		$msg.= "/version - Verssão do kernel\n";
		$msg.= "/versions - Outras versõe\n";
		$msg.= "/w - Quem esrá logado\n";
	}
	$msg.= "/meuid - Mostra seu id\n";
	$msg.= "/oi - Saudações\n";
	$msg.= "/ping (url) - Ping no destino\n";
	$msg.= "/post - Posts feitos por usuários\n";
	$msg.= "/start - Bem vindo\n";
	$msg.= "/whois (url) - Whois do destino\n\n\n";
	$msg.= "*GitHub: * https://github.com/rodrigoleutz/uwarebot  \n";
	$x=1;
	$log->log($update['message']['from']['id'],$first_name,$text_inteiro);
}
else if($text[0] == '/meuid'){
	$user_id = $update['message']['from']['id'];
	$msg = "Seu id:* $user_id *";
	$x=1;
	$log->log($update['message']['from']['id'],$first_name,$text_inteiro);
}
else if($text[0] == '/oi'){
	$msg = "oi $first_name, como vai?";
	$log->log($update['message']['from']['id'],$first_name,$text_inteiro);
}
else if($text[0] == '/post'){
	$post = new Posts();
	if($text[1] == 'add'){
		$user_id = $update['message']['from']['id'];
		$post->postAdd($text,$first_name,$user_id);
		$msg = '_Post adicionado._';
		$x=1;
	}
	else if($text[1] == 'list'){
		$list = $post->postList();
		$msg = "*Posts:*";
		foreach ($list as $key) {
			$msg.= "\n".$key['url']." - ".$key['post']." -_ ".$key['owner']." _";
		}
		$x=1;
	}
	else{
		$msg = "*Post Command:*";
		$msg.= "\n /post add (url) descrição - Adiciona Post";
		$msg.= "\n /post list - Lista os Posts";
		$x=1;
	}
	$log->log($update['message']['from']['id'],$first_name,$text_inteiro);
}
else if($text[0] == '/ping'){
	$msg = shell_exec("/usr/bin/sudo ping $text[1] -c 4");
	$log->log($update['message']['from']['id'],$first_name,$text_inteiro);
}
else if($text[0] == '/start'){
	$msg = "Bem vindo ao uwareBot Server Monitor";
	$log->log($update['message']['from']['id'],$first_name,$text_inteiro);
}
else if($text[0] == '/whois'){
	$msg = shell_exec("/usr/bin/sudo whois $text[1]");
	$log->log($update['message']['from']['id'],$first_name,$text_inteiro);
}

/*	Escopo de função de qualquer um
if($text[0] == ''){
	$msg = shell_exec("");
	$log->log($update['message']['from']['id'],$first_name,$text_inteiro);
}
*/

// Envio para o servidor telegram
if($x==1){
	$sendto =API_URL."sendmessage?chat_id=".$chatID."&parse_mode=MARKDOWN&text=".urlencode($msg);
}
else{
	$sendto =API_URL."sendmessage?chat_id=".$chatID."&text=".urlencode($msg);
}
// parse_mode=MARKDOWN
file_get_contents($sendto);
?>