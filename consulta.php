<?php

$script = file_get_contents("/usr/sbin/script.json");
$decoded = json_decode($script, true);

if($_POST['ip']) {
    $consulta = shell_exec("{$decoded['retorno']}{$decoded['consulta']}{$_POST['ip']}");

    if($consulta) {
        echo "IP encontrado:<br>{$consulta}<br>Caso o IP encontrado seja igual ao IP pesquisado, clique em Confirmar caso queira bloqueá-lo";
    } else {
        echo "Este IP não se encontra liberado em nosso sistema.<br>Clique em Confirmar caso queira liberá-lo";
    }

}

?>