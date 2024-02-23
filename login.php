<?php require('config.php'); ?>
<?php require('constants.php'); ?>
<?php
require('database-connection.php');
require('functions.php');
session_start();
$reDir = (isset($_GET['return'])) ? $_GET['return'] : '/?p=home';
if (isset($_SESSION[SESSION_USER_ID])) {
	header("location: " . $reDir);
	die();
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login | Private Server | Skiyen</title>
	<?php require('internalAssets.php'); ?>
	<?php require('externalAssets.php'); ?>
</head>

<body class="app_bg">
<div class="__page_login sk_flex_center">

	<div class="login_form">

		<div class="sk_flex_center wd100">
			<div class="login_title">
				<i class="las la-shield-alt"></i>
				SECURITY LOCK | <?php echo $site_name; ?>
			</div>
		</div>
		<br />

		<?php

		$idNumber = "";
		if (isset($_POST['idNumber'], $_POST['password'])) {
			$idNumber = (int) trim(htmlspecialchars($_POST['idNumber']));
			$password = $_POST['password'];
			$idNumber = $security_class->escape_mysql_string($idNumber);
			$password = $security_class->escape_mysql_string($password);
			$hashed_password = $security_class->encrpt_alogrithm_1(PASSWORD_ENCRYPTION_REPS, $password);

			$authenticateUser = mysqli_query($dbConn, "SELECT * FROM $userTable WHERE identificationNumber='$idNumber' AND password = '$hashed_password' AND isStaff = '1'");

			if (mysqli_num_rows($authenticateUser) > 0) {
				while ($row = mysqli_fetch_array($authenticateUser)) {
					$userId = $row['userId'];
					$_SESSION[SESSION_USER_ID] = $userId;
					header("location: " . $reDir);
				}
		?>
				<div class="alert alert-success">Access Granted</div><br />
			<?php
			} else {
			?>
				<div class="alert alert-danger">Access Denied! Go home <b>you don't belong here.</b>🙄</div><br />
		<?php
			}
		}


		?>

		<div class="login_form_flex">
			<div>
				<!-- <i class="las la-id-card" style="font-size:100px;"></i> -->
			</div>
			<div>
				<form method="POST" action="">
					<label for="idNumber"><i class="las la-user"></i> Identification Number</label>
					<div class="wd100 bg-info">
						<input type="number" class="login_input" placeholder="Identification Number" name="idNumber" required value="<?php echo $idNumber; ?>" />
					</div>

					<label for="password"><i class="las la-lock"></i> Password</label>

					<div class="flex login_input_group_flex">
						<div><input type="password" id="password" class="login_input" placeholder="Password" name="password" required /></div>
						<div>
							<div class="login_passwordViewToggle sk_flex_center" onclick="toggleLogin_passwordView()">
								<span><i class="las la-eye"></i></span>
							</div>
						</div>
					</div>


					<button class="button_inherit login_button">Login</button>
				</form>
			</div>
		</div>
	</div>

</div>
<br />
</body>

</html>