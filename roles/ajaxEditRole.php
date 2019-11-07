<?php

    $path = "../";
	require_once $path.'@core/core.php';
	require_once $path.'@core/helperFunction.php';

	if(isset($_POST)){
		$rolename = cleanInput($_POST['rolename']);
        $roleid = cleanInput($_POST['roleid']);

        if( strlen($rolename) < 3 || $roleid < 1 ){
            $err = 'Please fill in all fields';
        }else{
            $response = addNewRoleRecord($rolename, true, $roleid);

            if($response == 'success'){
                $err = '1';
            }else{
                $err = 'Error encountered while processing request.';
            }         
        }
        echo $err;
	}else{
        echo 'Unauthorized Request. Process Terminated';
	}

?>