<?php

    $path = "../";
	require_once $path.'@core/core.php';
	require_once $path.'@core/helperFunction.php';

	if(isset($_POST)){
		$supplyorderid = cleanInput($_POST['supplyorderid']);

        if( $supplyorderid < 1){
            $err = 'Unauthorized Request. Process Terminated.';
        }else{
            if(isPaymentMadeForSupplyOrder($supplyorderid) == true){
                $err = 'Oops! Payment has been paid for this order and cannot be deleted.';
            }else{
                $response = deleteSupplyOrderRecord($supplyorderid);

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