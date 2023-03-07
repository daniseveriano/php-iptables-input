<?php

define("IP", $_POST['ip']);
$script = parse_ini_file("script-iptables-erp.ini");

if($_POST['ip']) {
   
   $consulta = exec($script['consulta']);

    if(!$consulta) {
      exec($script['add']);
      echo "IP registrado com sucesso no servidor.";
    }

    if($consulta) {
      exec($script['delete']);
      echo "IP deletado com sucesso do servidor.";
    }    
}

?>