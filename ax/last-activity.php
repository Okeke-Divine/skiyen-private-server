<?php require 'inherit.php'; ?>
<?php

$query = mysqli_query($dbConn,"UPDATE $userTable SET `lastActivity` = UNIX_TIMESTAMP() WHERE `userId` = '$ses_user_id'");

?>