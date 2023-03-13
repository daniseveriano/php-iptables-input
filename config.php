<?php

$servername = "localhost"; //set the servername
$username = "root"; //set the server username
$password = ""; // set the server password (you must put password here if your using live server)
$dbname = "iptables-db"; // set the table name


$mysqli = new mysqli($servername, $username, $password, $dbname);

if ($mysqli->connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli->connect_error;
  exit();
}

?>
