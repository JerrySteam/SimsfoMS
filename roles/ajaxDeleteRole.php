<?php

    $path = "../";
	require_once $path.'@core/core.php';
	require_once $path.'@core/helperFunction.php';

	if(isset($_POST)){
		$roleid = cleanInput($_POST['roleid']);

        if( $roleid < 1){
            $err = 'Unauthorized Request. Process Terminated.';
        }else{
            if(isRoleWithPrivilege($roleid) == true){
                $err = 'Oops! Role has privileges assigned and cannot be deleted.';
            }else{
                $response = deleteRoleRecord($roleid);

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