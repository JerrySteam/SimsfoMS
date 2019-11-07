<?php

    $path = "../";
    require_once $path.'@core/core.php';
    require_once $path.'@core/helperFunction.php';

    if(isset($_POST)){
        $employeeid = cleanInput($_POST['employee']);
        $roleid = cleanInput($_POST['role']);
        $status = cleanInput($_POST['status']);
        $userid = cleanInput($_POST['userid']);

        if( $employeeid == '-1' || $roleid == '-1' || $status == '-1' || $userid < 1 ){
            $err = 'Please fill in all fields';
        }else{

            $response = addNewUserRecord($employeeid, $roleid, $status, true, $userid);

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