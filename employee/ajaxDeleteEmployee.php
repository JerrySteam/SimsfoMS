<?php

    $path = "../";
	require_once $path.'@core/core.php';
	require_once $path.'@core/helperFunction.php';

	if(isset($_POST)){
		$employeeid = cleanInput($_POST['employeeid']);

        if($employeeid < 1){
            $err = 'Unauthorized Request. Process Terminated.';
        }else{
            if(isEmployeeUser($employeeid) == true){
                $err = 'Oops! Employee cannot be deleted.';
            }else{
                $response = deleteEmployeeRecord($employeeid);

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