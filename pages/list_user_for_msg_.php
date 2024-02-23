<?php
$rootDir = "../";
require '__inheritIncludes.php';
?>
<div class="page_header">
	<div>
		<span class="app_badge_1">message zone</span>
		<div class="mainTitle">Messages | SELECT * FROM users WHERE user != me</div>
	</div>
</div>
<div class="page_body">

<div class="message_list">
	<?php
	$getAllUsers = mysqli_query($dbConn, "SELECT * FROM $userTable WHERE userId != '$ses_user_id'");
	if (mysqli_num_rows($getAllUsers) > 0) {
		while ($row = mysqli_fetch_array($getAllUsers)) {
			$username = $row['username'];
			$firstname = $row['firstname'];
			$lastname = $row['lastname'];
			$publicKey = $row['publicKey'];
	?>
		<div class="user_message_list_item" onclick="load_chat_with('<?php echo $publicKey; ?>');">
			<div>
				<img src="/assets/img/pexels-kevin-ku-577585.jpg" alt="<?php echo $username; ?>'s profile picture" />
			</div>
			<div class="sk_flex_center">
				<?php echo $firstname. " ". $lastname; ?>
			</div>
		</div>
	<?php
		}
	} else {
		?>
		<div>No user found!.</div>
	<?php
	}
	?>
</div>

</div>