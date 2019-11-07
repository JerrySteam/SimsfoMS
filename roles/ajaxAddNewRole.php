<?php

    $path = "../";
	require_once $path.'@core/core.php';
	require_once $path.'@core/helperFunction.php';

	if(isset($_POST)){
		$rolename = strtoupper(cleanInput($_POST['rolename']));

        if( strlen($rolename) < 3){
            $err = 'Please fill in all fields';
        }else{

            if(isRoleRegistered($rolename)){
                $err = 'An role exist with the same name.';
            }else{
                $response = addNewRoleRecord($rolename);

                if($response == 'success'){
                    $err = '1';
                }else{
                    $err = 'Error encountered while processing request.';
                }
            }            
        }
        echo $err;
	}else{
        echo 'Unauthorized Request. Process Terminated';
	}

?>