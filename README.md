<center><img src="img/uwarebot.png"></center>
<br><br><br>
Simple Server Monitor Bot - Telegram

Bot para telegram com funções básicas.

- Você não sabe seu id entre no grupo e digite /meuid

https://t.me/joinchat/LLhzhBfQ6xP3jq-9RfBB-w

- INSTALAÇÂO

Utiliza o @BotFather de exemplo para criação do Bot.

Database use o arquivo database.sql como exemplo.

Adicione a seguinte linha no /etc/sudoers

nginx   ALL=NOPASSWD: /bin/fail2ban-client status sshd , /bin/journalctl -u sshd --no-pager -n 20 , /bin/tail /var/log/nginx/error.log , /bin/tail /var/log/nginx/access.log  , /bin/top , /bin/ls , /bin/ping , /bin/whois

Adicione o arquivo uwarebot.php e arquivos class no seu servidor nginx com https(a pasta precisa estar com permissão de escrita para o nginx).

Entre nesta página com as devidas alterações.

<<<<<<< HEAD


https://api.telegram.org/bot--token--/setwebhook?url=https://--URL--/uwarebot.php

=======
https://api.telegram.org/bot^token^/setwebhook?url=https://^URL^/uwarebot.php
>>>>>>> quote

O resultado será.

{“ok”:true,”result”:true,”description”:”Webhook was set”}
