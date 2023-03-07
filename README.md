1- Este script tem o objetivo de liberar/bloquear IPs através do Iptables no servidor Linux/Debian 11;

2- O usuário padrão do servidor Apache costumar ser o "www-data". Garanta que o mesmo recebeu liberação como super usuário (sudo) acessando o arquivo sudoers pelo comando "visudo" (acesse esse comando no Linux pelo root);

3- Sugestão de configuração do usuário, dentro do arquivo sudoers:

#User privilege specification <br>
root ALL=(ALL:ALL) ALL <br>
www-data ALL=NOPASSWD:ALL

4- Guarde o arquivo "script-iptables-erp.ini" em um diretório protegido. Neste exemplo, ele encontra-se no mesmo diretório local dos demais arquivos;

5- Este arquivo foi construído como objeto de estudos. Caso resolva utilizá-lo, modifique-o conforme sua necessidade e nível de segurança.