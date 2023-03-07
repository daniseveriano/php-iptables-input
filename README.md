1- Este script tem o objetivo de liberar/bloquear IPs através do Iptables no servidor Linux/Debian 11;

2- Você precisa ter um servidor rodando em Linux, com o Apache2, PHP e Iptables ativos (PHP instalado como módulo do Apache);

3- O usuário padrão do servidor Apache costumar ser o "www-data". Garanta que o mesmo recebeu liberação como super usuário (sudo), sem senha, acessando o arquivo sudoers pelo comando "visudo" (acesse esse comando no Linux pelo root);

4- Sugestão de configuração do usuário, dentro do arquivo sudoers:

#User privilege specification <br>
root ALL=(ALL:ALL) ALL <br>
www-data ALL=NOPASSWD:/usr/sbin/iptables,/usr/sbin/script-iptables-erp.ini

5- Guarde o arquivo "script-iptables-erp.ini" em um diretório protegido. Neste repositório, ele encontra-se no mesmo diretório local dos demais arquivos. Sugiro inseri-lo no mesmo diretório de inicialização do Iptables ("/usr/sbin/script-iptables-erp.ini"). Ao mover o arquivo para "/usr/sbin", lembre-se de alterar o caminho relativo nos diretórios, para leitura;

6- O repositório já possui os arquivos de inicialização para o jQuery, bem como uma rota para o PhpMyAdmin, para caso queira gravar logs no banco de dados.

7- Este arquivo foi construído como objeto de estudos. Caso resolva utilizá-lo, modifique-o conforme sua necessidade e nível de segurança.
