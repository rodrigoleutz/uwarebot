<center><img src="img/uwarebot.png"></center>
<br><br><br>
Simple Server Monitor Bot - Telegram

Site: https://www.uware.com.br

Bot para telegram com funções básicas.

- Você não sabe seu id entre no grupo e digite /meuid

https://t.me/joinchat/LLhzhBfQ6xP3jq-9RfBB-w

ou

https://t.me/bot_php_brasil


- INSTALAÇÂO

* Dica:
* https://www.vivaolinux.com.br/dica/Simple-Server-Monitor-Bot-Telegram-PHP/

Utilize o bot/@BotFather de exemplo para criação do Bot.

Database use o arquivo sql/database.sql como exemplo.

Adicione a seguinte linha no /etc/sudoers

nginx   ALL=NOPASSWD: /bin/fail2ban-client status sshd , /bin/journalctl -u sshd --no-pager -n 20 , /bin/tail /var/log/nginx/error.log , /bin/tail /var/log/nginx/access.log  , /bin/top , /bin/ls , /bin/ping , /bin/whois

Adicione o arquivo bot/uwarebot.php e arquivos bot/class.* no seu servidor nginx com https(a pasta precisa estar com permissão de escrita para o nginx).

Entre nesta página com as devidas alterações.

https://api.telegram.org/bot--token--/setwebhook?url=https://--URL--/uwarebot.php

O resultado será.

{“ok”:true,”result”:true,”description”:”Webhook was set”}



