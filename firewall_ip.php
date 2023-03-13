<?php

include("Iptables.php");
include("config.php");

$iptables = new Iptables();

$sql = "SELECT * FROM servidor_iptables WHERE ativo = 1";
$results = $mysqli->query($sql);
$rows = $results->fetch_all(MYSQLI_ASSOC);
$results->free_result();

$raiz = $iptables->getRaizIptables('iptables');
$comandoConsulta = $iptables->getComandoConsultaIptables($rows);
$shellConsulta = 'sudo '.$raiz.' '.$comandoConsulta.' '.$_POST['ip'];
$execucaoConsulta = exec($shellConsulta, $outputConsulta, $resultConsulta);

if($outputConsulta[0] == false) {

    $adicionar = $iptables->getComandoAdicionarIptables($rows);
    $scriptAdicionar = 'sudo '.$raiz.' '.$adicionar[0]->comando_inicio.' '.$_POST['ip'].'/32'.' '.$adicionar[0]->comando_fim;
    $execucao = exec($scriptAdicionar, $outputAdicionar, $resultadicionar);

    if($outputAdicionar[0] != false) {

        $codigo_usuario = 1;
        $usuario = "User";
        $acao = 'Erro ao tentar adicionar IP nº '.$_POST['ip'].'/32'.' no servidor';
        $parametros = $outputAdicionar[0];
        $data = date('Y-m-d H:i:s');
        
        $iptables->gravarLogIptables($codigo_usuario, $usuario, $acao, $parametros, $data, $mysqli);

        echo "<strong>Erro ao tentar adicionar IP. Verifique logs de erros</strong><br>{$outputAdicionar[0]}";
        exit;

    } else {

        $codigo_usuario = 1;
        $usuario = "User";
        $acao = 'Liberou o IP nº '.$_POST['ip'].'/32'.' no servidor';
        $parametros = "Ação realizada com sucesso {$outputAdicionar[0]}";
        $data = date('Y-m-d H:i:s');

        $iptables->gravarLogIptables($codigo_usuario, $usuario, $acao, $parametros, $data, $mysqli);

        echo "<strong>IP registrado com sucesso no servidor</strong>";
        exit;
    }

  } else {

    $deletar = $iptables->getComandoDeletarIptables($rows);
    $scriptDeletar = 'sudo '.$raiz.' '.$deletar[0]->comando_inicio.' '.$_POST['ip'].'/32'.' '.$deletar[0]->comando_fim;
    $execucao = exec($scriptDeletar, $outputDeletar, $resultDeletar);

    if($outputDeletar[0] != false) {

        $codigo_usuario = 1;
        $usuario = "User";
        $acao = 'Erro ao tentar deletar IP nº '.$_POST['ip'].'/32'.' no servidor.';
        $parametros = $outputDeletar[0];
        $data = date('Y-m-d H:i:s');

        $iptables->gravarLogIptables($codigo_usuario, $usuario, $acao, $parametros, $data, $mysqli);

        echo "<strong>Erro ao tentar deletar IP. Verifique logs de erros</strong><br>{$outputDeletar[0]}";
        exit;

    } else {

        $codigo_usuario = 1;
        $usuario = "User";
        $acao = 'Deletou o IP nº '.$_POST['ip'].'/32'.' no servidor.';
        $parametros = "Ação realizada com sucesso {$outputDeletar[0]}";
        $data = date('Y-m-d H:i:s');

        $iptables->gravarLogIptables($codigo_usuario, $usuario, $acao, $parametros, $data, $mysqli);

        echo "<strong>IP deletado com sucesso do servidor</strong>";
        exit;

    }
  }


?>