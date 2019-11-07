<?php

    $path = "../";
	require_once $path.'@core/core.php';
	require_once $path.'@core/helperFunction.php';

	if(isset($_POST)){
		$roleid = cleanInput($_POST['roleid']);
        $privilege = (isset($_POST['privilege'])) ? $_POST['privilege'] : array();

        if( $roleid < 1 || count($privilege) < 1){
            $err = 'Please fill in all fields';
        }else{

            $response = addNewRolePrivilegeRecord($roleid, $privilege);

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