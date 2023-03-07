<?php

$script = file_get_contents("/usr/sbin/script.json");
$decoded = json_decode($script, true);

echo shell_exec("{$decoded['id']}");

?>