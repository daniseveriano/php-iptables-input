<?php

$script = parse_ini_file("/usr/sbin/script-iptables-erp.ini");

echo shell_exec("{$script['id']}");

?>