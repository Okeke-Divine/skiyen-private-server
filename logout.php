<?php

session_start();
session_unset();
session_destroy();
$_SESSION['userLoggedOut'] = 'true';
echo $_SESSION['userLoggedOut'];
header("location: login");

?>