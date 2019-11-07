<?php

    $path = "../";
	require_once $path.'@core/core.php';
	require_once $path.'@core/helperFunction.php';

	if(isset($_POST)){
		$fullname = cleanInput($_POST['fullname']);
        $phone = cleanInput($_POST['phonenumber']);
        $email = cleanInput($_POST['email']);
        $country = cleanInput($_POST['country']);
        $address = cleanInput($_POST['address']);

        if( strlen($fullname) < 3 || strlen($phone) < 3 || strlen($email) < 3 || $country == '-1' || strlen($address) < 3 ){
            $err = 'Please fill in all fields';
        }else{

            if(isCustomerEmailRegistered($email)){
                $err = 'A customer exist with the email address provided.';
            }else{
                $response = addNewCustomerRecord($fullname, $phone, $email, $country, $address);

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