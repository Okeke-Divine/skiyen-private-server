<?php
$rootDir = "../";
require '__inheritIncludes.php';
?>
<div class="page_header">
	<div>
		<span class="app_badge_1">welcome</span> - <?php echo $ses_first_name . " " . $ses_last_name; ?> | <?php echo $ses_user_name; ?>
		<div class="mainTitle">
			Home
			|
			<?php echo htmlspecialchars('<?php echo $home_content; ?>'); ?>
		</div>
	</div>
</div>