<?php

$dbServer = "localhost";
$dbUname ="root";
$dbPsw = "";
$db = "__skiyen_private_server_db__";

$dbConn = mysqli_connect($dbServer,$dbUname,$dbPsw,$db) or die("Error connecting to the database!");

require 'db-tables.php';

?>