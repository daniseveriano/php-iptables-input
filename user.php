<?php

$script = parse_ini_file("script-iptables-erp.ini");

echo exec($script['id']);

?>