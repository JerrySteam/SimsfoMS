<?php

	$path = "../";
	require_once($path.'@core/core.php');

	$sessionHandler = new HmsSessionHandler();
	$sessionHandler->destroyAllSession();

	redirectTo(site_url());

?>