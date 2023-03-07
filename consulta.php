<?php

define("IP", $_POST['ip']);
$script = parse_ini_file("script-iptables-erp.ini");

if($_POST['ip']) {
    $consulta = exec($script['consulta']);

    if($consulta) {
        echo "IP encontrado:<br>{$consulta}<br>Caso o IP encontrado seja igual ao IP pesquisado, clique em Confirmar caso queira bloqueá-lo";
    } else {
        echo "Este IP não se encontra liberado em nosso sistema.<br>Clique em Confirmar caso queira liberá-lo";
    }

}

?>