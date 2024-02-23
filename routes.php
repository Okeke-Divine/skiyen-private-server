<?php

	$page = @$_GET['p'];
	?>
	<script type="text/javascript">
		console.log('<?php echo $page; ?>', './router');
	</script>
	<?php
	if(empty($page)){
		$_router_target_file = "pages/dashboard.php";
	}
	//routes
	else if($page === 'dashboard'){
		$_router_target_file = "pages/dashboard.php";
	}
	//404
	else if($page === '404'){
		$_router_target_file = "pages/404.php";
	}else{
		$_router_target_file ='pages/404.php';
	}

?>