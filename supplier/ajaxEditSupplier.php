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
        $supplierid = cleanInput($_POST['supplierid']);

        if( strlen($fullname) < 3 || strlen($phone) < 3 || strlen($email) < 3 || $country == '-1' || strlen($address) < 3 || $supplierid < 1 ){
            $err = 'Please fill in all fields';
        }else{
            $response = addNewSupplierRecord($fullname, $phone, $email, $country, $address, true, $supplierid);
            //echo $response; exit;
            if($response == 'success'){
                $err = '1';
            }else{
                $err = 'Error encountered while processing request';
            }         
        }
        echo $err;
	}else{
        echo 'Unauthorized Request. Process Terminated';
	}

?>