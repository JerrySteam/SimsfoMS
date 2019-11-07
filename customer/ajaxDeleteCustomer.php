<?php

    $path = "../";
	require_once $path.'@core/core.php';
	require_once $path.'@core/helperFunction.php';

	if(isset($_POST)){
		$customerid = cleanInput($_POST['customerid']);

        if( $customerid < 1){
            $err = 'Unauthorized Request. Process Terminated.';
        }else{
            if(hasCustomerMadeTrasaction($customerid) == true){
                $err = 'Oops! Customer has made a transaction and cannot be deleted.';
            }else{
                $response = deleteCustomerRecord($customerid);

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