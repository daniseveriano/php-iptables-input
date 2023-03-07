<?php

// $script = parse_ini_file("/usr/sbin/script-iptables-erp.ini");

if($_POST['ip']) {
    $consulta = shell_exec("cd / && sudo usr/sbin/iptables -L -n |grep {$_POST['ip']}");

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