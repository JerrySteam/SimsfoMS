<?php

    $path = "../";
	require_once $path.'@core/core.php';
	require_once $path.'@core/helperFunction.php';

	if(isset($_POST)){
		$staffid = cleanInput($_POST['staffid']);
        $fullname = cleanInput($_POST['fullname']);
        $phone = cleanInput($_POST['phonenumber']);
        $email = cleanInput($_POST['email']);
        $address = cleanInput($_POST['address']);
        $employmentdate = cleanInput($_POST['employmentdate']);

        if( strlen($staffid) < 3 || strlen($fullname) < 3 || strlen($phone) < 3 || strlen($address) < 3 ){
            $err = 'Please fill in all fields';
        }else{

            if(strlen($email) > 3){
                 if(isEmployeeEmailRegistered($email)){
                    $err = 'An employee exist with the email address provided.';
                }
            }

            if(isEmployeePhonenumberRegistered($phone)){
                $err = 'An employee exist with the phone number provided.';
            }else{
                $response = addNewEmployeeRecord($staffid, $fullname, $phone, $email, $address, $employmentdate);

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