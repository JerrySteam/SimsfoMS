<?php

    $path = "../";
	require_once $path.'@core/core.php';
	require_once $path.'@core/helperFunction.php';

        $roleid = cleanInput($_POST['roleid']);

        if( $roleid < 1 ){
            $err = 'Unauthorized Request. Process Terminated.';
        }else{

            $response = deleteRolePrivilegeRecord($roleid);

            if($response == 'success'){
                $err = '1';
            }else{
                $err = 'Error encountered while processing request.';
            }
        }

?>