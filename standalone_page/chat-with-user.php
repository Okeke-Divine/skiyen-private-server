<?php

if (isset($_GET['publicKey'])) {
	$publicKey = $_GET['publicKey'];
	if (empty($publicKey)) {
		die();
	}
} else {
	die();
}

?>
<?php require('../config.php'); ?>
<?php require('../constants.php'); ?>
<?php
session_start();
require('../database-connection.php');
require('../functions.php');
require('../__authenticate.php');
$publicKey = $security_class->escape_mysql_string($publicKey);
$reciever_userId = $site_db_fetch->fetch_user_colum('publicKey', $publicKey, 'userId');
$reciever_username = $site_db_fetch->fetch_user_colum('publicKey', $publicKey, 'username');
if ($reciever_userId === null) {
	die();
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<!-- <meta http-equiv="refresh" content="3" /> -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Chat | Private Server | Skiyen</title>
	<?php require('../internalAssets.php'); ?>
	<?php require('../externalAssets.php'); ?>
</head>

<body class="app_bg" onload="initialize_msgLoader();">
	<div class="chat_zone">
		<div class="chat_zone_header sk_flex_center">
			<?php echo $reciever_username; ?>
		</div>
		<div class="chat_zone_body" id="chat_zone_body">
			loading...
		</div>
		<div class="chat_zone_footer">
			<div class="input_area">
				<input class="form-control" onkeyup="checkIfEnterKeyIsPressed(event)" placeholder="Type your message here..." id="message_input" />
			</div>
			<div class="button_area"><button><i class="las la-paper-plane" onclick="send_message();"></i></button></div>
		</div>
	</div>
</body>

</html>
<script>
	function initialize_msgLoader() {
		load_message();
		setInterval(function() {
			load_message();
		}, 5000);
		lastSeen();
		setInterval(function() {
			lastSeen();
		}, 10000);
	}

	const user_publicKey = '<?php echo $publicKey; ?>';

	function checkIfEnterKeyIsPressed(e) {
		if (e.keyCode === 13) {
			send_message();
		}
	}

	function send_message() {
		lastActivity();
		var message = _el('id', 'message_input').value;
		if (message != '') {
			console.log(message);
			_el('id', 'message_input').value = '';

			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState === 4 & this.status === 200) {
					load_message();
				}
			}
			xhttp.open("POST", "/ax/send_message");
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send(
				"message=" + message + "&user_publicKey=" + user_publicKey, );
		}
	}

	function parse_message(json_message) {
		json_message = JSON.parse(json_message);
		console.log(json_message);

		var fkf0f = document.createElement("div");
		fkf0f.setAttribute('class', 'msg_cont_flex_main');

		json_message.forEach((msg) => {
			var shouldFloatRight = '';
			var message_div = document.createElement("div");
			if (msg.sentByMe === true) {
				shouldFloatRight = 'float_msg_cont_right';
			}
			message_div.setAttribute('class', 'msg_cont');
			message_div.innerHTML = msg.message;

			console.log(msg.message,msg.sentByMe,msg.viewed)
			if(msg.sentByMe === true & msg.viewed == 1){
				message_div.innerHTML += `<div class="messageIsViewed"><i class="las la-eye"></i></div>`;
			}

			var msg_cont_layerUp_1 = document.createElement("div");
			msg_cont_layerUp_1.setAttribute("class", "msg_cont_layerUp_1 " + shouldFloatRight);

			msg_cont_layerUp_1.appendChild(message_div);
			fkf0f.appendChild(msg_cont_layerUp_1);
		});

		_el('id', 'chat_zone_body').innerHTML = "";
		_el('id', 'chat_zone_body').appendChild(fkf0f);
	}

	function load_message() {
		lastActivity();
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.status === 200 & this.readyState === 4) {
				parse_message(this.responseText);
			}
		}
		xhttp.open("POST", "/ax/fetch_messages");
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("user_publicKey=" + user_publicKey);
	}
</script>