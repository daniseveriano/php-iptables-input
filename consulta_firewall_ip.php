<?php

include("Iptables.php");
include("config.php");

$iptables = new Iptables();

$sql = "SELECT * FROM servidor_iptables WHERE ativo = 1";
$results = $mysqli->query($sql);
$rows = $results->fetch_all(MYSQLI_ASSOC);
$results->free_result();
$mysqli->close();

if($rows[0]) {

    $raiz = $iptables->getRaizIptables('iptables');
    $comandoListagem = $iptables->getComandoListagemIptables($rows);
    $shellListagem = 'sudo '.$raiz.' '.$comandoListagem;
    $execucaoListagem = exec($shellListagem, $outputListagem, $resultListagem);

    if(strripos($outputListagem[0], 'chain') !== false){

        if($_GET['ip']) {

            $comandoConsulta = $iptables->getComandoConsultaIptables($rows);
            $shellConsulta = 'sudo '.$raiz.' '.$comandoConsulta.' '.$_GET['ip'];
            $execucaoConsulta = exec($shellConsulta, $outputConsulta, $resultConsulta);
            
            if($outputConsulta[0] != false) {
                echo "<strong>IP encontrado!<br>Clique em Confirmar para bloqueá-lo</strong>";
                exit;

            } else {
                echo "<strong>Este IP não se encontra liberado em nosso servidor.<br>Clique em Confirmar para salvá-lo</strong><br>{$outputConsulta[0]}";
                exit;
            }
        }

    } else {
        echo "<strong>Verifique se o seu usuário possui liberação para usar esta ferramenta</strong><br>{$outputListagem[0]}";
        exit;
    }

} else {
    echo "<strong>O seu servidor não está habilitado para liberar este IP.</strong>";
    exit;
}


?>