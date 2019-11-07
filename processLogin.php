<?php

	require_once '@core/core.php';
	require_once '@core/helperFunction.php';

	if(isset($_POST)){
		$user = cleanInput($_POST['username']);
        $pass = cleanInput($_POST['password']);

        if( empty($user) || empty($pass) ){
            echo 'Please fill in all fields';
        }else{
        	if(validateLogin($user, $pass)){
        		echo '1';
        	}else{
        		echo 'Invalid login credentials';
        	}
        }
	}else{

	}

?>