<?php

    $path = "../";
	require_once $path.'@core/core.php';
	require_once $path.'@core/helperFunction.php';

	if(isset($_POST)){
		$employeeid = cleanInput($_POST['employee']);
        $roleid = cleanInput($_POST['role']);
        $status = cleanInput($_POST['status']);

        if( $employeeid == '-1' || $roleid == '-1' || $status == '-1' ){
            $err = 'Please fill in all fields';
        }else{

            if(isEmployeeAssignedRole($employeeid, $roleid)){
                $err = 'User has already been assigned to selected role';
            }else{
                $response = addNewUserRecord($employeeid, $roleid, $status);

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