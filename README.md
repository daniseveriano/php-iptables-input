1- Este script tem o objetivo de liberar/bloquear IPs através do Iptables no servidor Linux;

2- Você precisa ter um servidor rodando em Linux, com o Apache2, PHP e Iptables ativos;

3- O usuário padrão do servidor Apache é o "www-data". Garanta que o mesmo recebeu liberação como super usuário (sudo), sem senha, acessando o arquivo sudoers pelo comando "visudo" (acesse esse comando no Linux pelo root);

4- Sugestão de configuração do usuário, dentro do arquivo sudoers:

#User privilege specification
root ALL=(ALL:ALL) ALL
www-data ALL=NOPASSWD:/usr/sbin/iptables,/usr/sbin/script-iptables-erp.ini

Obs: verifique o caminho onde se encontra o iptables, dentro da distribuição que você usa. Isso pode ser feito através do comando "which iptables".

5- O repositório já possui os arquivos de inicialização para o jQuery, bem como uma rota para o PhpMyAdmin, e um script SQL para criação do banco de dados e das tabelas. A tabela guardará os comandos iptables, e também servirá para gravar possíveis logs de erros.

6- Este arquivo foi construído como objeto de estudos. Caso resolva utilizá-lo, modifique-o conforme sua necessidade e nível de segurança.