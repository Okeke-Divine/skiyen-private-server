<?php require('config.php'); ?>
<?php require('constants.php'); ?>
<?php
	require('database-connection.php');
	session_start();
	require('functions.php');
	require('__authenticate.php');
	$page = @$_GET['p'];
	$page = trim($page);
	if(empty($page)){
		header("location: /?p=home");
	}
	//TODO MUST CONVERT PAGE TO STRING
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Loading... | Private Server | Skiyen</title>
	<?php require('internalAssets.php'); ?>
	<?php require('externalAssets.php'); ?>
</head>
<script type="text/javascript">
	function onPageLoad(){
		const currentPage = '<?php echo ucfirst($page); ?>';
		loadPage(currentPage);
		lastSeen();
		setInterval(function(){
			lastSeen();
		},10000);
	}
</script>

<body class="app_bg" onload="onPageLoad()">
	<!-- <div class="router_root"></div> -->

	<div class="ui_sidebar_1" id="ui_sidebar_1">
		<div>
			<div class="sidebar_icon" id="fullScreenToggle_controller"  onclick="toggleFullScreen();" data-isFullScreen="false"><i class="las la-expand"></i></div>
			<hr />
			<div class="sidebar_icon col_ColGreen4" onclick="loadPage('home');"><i class="las la-home"></i></div>
			<div class="sidebar_icon col_ColYellow1" onclick="loadPage('create');"><i class="las la-plus"></i></div>
			<div class="sidebar_icon col_ColGreen3" onclick="loadPage('messages');"><i class="las la-comment"></i></div>
			<div class="sidebar_icon col_ColPink_colSet" onclick="loadPage('notifications');"><i class="las la-bell"></i></div>
			<div class="sidebar_icon col_ColRed_colSet" onclick="loadPage('profile');"><i class="las la-user"></i></div>
			<div class="sidebar_icon col_ColPurple1" onclick="loadPage('settings');"><i class="las la-cog"></i></div>
			<hr />
			<div class="sidebar_icon col_ColGreen3" onclick="logout();"><i class="las la-sign-out-alt"></i></div>
		</div>
	</div>
	
	<div class="ui_container">
		<div class="ui_area_1"></div>
		<div class="ui_area_2" id="main_page_content"></div>
		<div class="ui_area_3" id="right_page_content" data-isViewing="">loading...</div>
	</div>

	<div class="ui_expand_sidebar" onclick="ui_sidebarExpand_toogle();"><i class="las la-bars"></i></div>

<div class="pageLoaderOverlay sk_flex_center" id="pageLoaderOverlay">
	<div class="loaderConatiner sk_flex_center">
		<i class="las la-spinner spin_item"></i>
	</div>
</div>

<div class="chat_contianer" id="chat_contianer">
	<div class="chat_overlay" id="chat_overlay">
		<div class="chat_overlay_close sk_flex_center" onclick="close_chat_overlay();">
			<i class="las la-times"></i>
		</div>
		<iframe id="chat_iframe"></iframe>
	</div>
</div>

</body>
</html>