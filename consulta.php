<?php

$script = parse_ini_file("/usr/sbin/script-iptables-erp.ini");

if($_POST['ip']) {
    $consulta = shell_exec("{$script['retorno']}{$script['consulta']}{$_POST['ip']}");

    if($consulta) {
        echo "IP encontrado e já liberado:<br>{$consulta}";
    } else {
        echo "Este IP não se encontra liberado em nosso sistema.<br>Clique abaixo caso queira liberá-lo";
    }

}

?>