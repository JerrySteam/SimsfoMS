<?php

    $path = "../";
	require_once $path.'@core/core.php';
	require_once $path.'@core/helperFunction.php';

	if(isset($_POST)){
		$userid = cleanInput($_POST['userid']);

        if($userid < 1){
            $err = 'Unauthorized Request. Process Terminated.';
        }else{
            if(hasUserTakenAction($userid) == true){
                $err = 'User cannot be deleted.';
            }else{
                $response = deleteUserRecord($userid);

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