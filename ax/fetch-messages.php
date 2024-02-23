<?php require 'inherit.php'; ?>
<?php

if(isset($_POST['user_publicKey'])){
	$user_publicKey = $_POST['user_publicKey'];
	$reciever_userId = $site_db_fetch->fetch_user_colum('publicKey', $user_publicKey, 'userId');
	if ($reciever_userId === null) {
		die();
	}
	$fetchMessages = mysqli_query($dbConn,"SELECT * FROM $privateMessages WHERE senderId = '$ses_user_id' AND recieverId = '$reciever_userId' || senderId = '$reciever_userId' AND recieverId = '$ses_user_id' ORDER BY messageId DESC LIMIT 20");
	$response = array();
	while($row = mysqli_fetch_array($fetchMessages)){

		$msgId = $row['messageId'];
		$msg_senderId = $row['senderId'];
		if($msg_senderId != $ses_user_id){
			$updateMsgView = mysqli_query($dbConn,"UPDATE $privateMessages SET viewed = '1' WHERE messageId = '$msgId'");
		}

		$message = array();

		$message['message'] = $row['message'];
		$message['messageType'] = $row['messageType'];
		$message['viewed'] = $row['viewed'];
		$message['timeSent'] = $row['timeSent'];
		$message['sentByMe'] = ($row['senderId'] === $ses_user_id) ? true : false;

		$response[] = $message;
	}
	echo json_encode($response);
}

?>