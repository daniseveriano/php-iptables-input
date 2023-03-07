<?php

$script = file_get_contents("/usr/sbin/script.json");
$decoded = json_decode($script, true);

if($_POST['ip']) {
    $consulta = shell_exec("{$decoded['retorno']}{$decoded['consulta']}{$_POST['ip']}");

    if(!$consulta) {
       shell_exec("cd / && sudo usr/sbin/iptables -A INPUT -s {$_POST['ip']} -p tcp -j ACCEPT");
       echo "IP registrado com sucesso no servidor.";
    }

    if($consulta) {
       shell_exec("cd / && sudo usr/sbin/iptables -D INPUT -s {$_POST['ip']} -p tcp -j ACCEPT");
       echo "IP deletado com sucesso do servidor.";
    }    
}

?>