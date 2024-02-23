<?php

	$ses_user_id = @$_SESSION[SESSION_USER_ID];

	$ses_user_name = $site_db_fetch->fetch_user_colum('userId',$ses_user_id,'username');
	$ses_first_name = $site_db_fetch->fetch_user_colum('userId',$ses_user_id,'firstname');
	$ses_last_name = $site_db_fetch->fetch_user_colum('userId',$ses_user_id,'lastname');

	if(empty($ses_user_id)){
	header("location: /login?return=".$_SERVER['REQUEST_URI']);
	die();
	exit();
	}
