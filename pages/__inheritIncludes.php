<?php 
if(empty(@$rootDir)){$rootDir = "";}
session_start();
require ($rootDir.'constants.php');
require ($rootDir.'config.php');
require ($rootDir.'database-connection.php');
require ($rootDir.'functions.php');
require ($rootDir.'__authenticate.php');
?>