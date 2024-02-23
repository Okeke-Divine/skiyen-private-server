<?php require 'inherit.php'; ?>
<?php
if (isset($_POST['user_publicKey'], $_POST['message'])) {
	$user_publicKey = $_POST['user_publicKey'];
	$message = $_POST['message'];
	$user_publicKey = $security_class->escape_mysql_string($user_publicKey);
	$message = trim(htmlspecialchars($message));
	$message = $security_class->escape_mysql_string($message);

	$reciever_userId = $site_db_fetch->fetch_user_colum('publicKey', $user_publicKey, 'userId');
	if ($reciever_userId === null) {
		die();
	}
	$query = mysqli_query($dbConn, "INSERT INTO $privateMessages (`senderId`,`recieverId`,`message`,`messageType`,`timeSent`) VALUES ('$ses_user_id','$reciever_userId','$message','textOnly',UNIX_TIMESTAMP())");
	if ($query) {
		echo "success";
	} else {
		echo "error";
	}
}
?>