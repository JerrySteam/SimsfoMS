<?php

    $path = "../";
	require_once $path.'@core/core.php';
	require_once $path.'@core/helperFunction.php';

	if(isset($_POST)){
		$salesid = cleanInput($_POST['salesid']);

        if( $salesid < 1){
            $err = 'Unauthorized Request. Process Terminated.';
        }else{
            if(isPaymentMadeForSales($salesid) == true){
                $err = 'Oops! Sales has been paid for and cannot be deleted.';
            }else{
                $response = deleteSalesRecord($salesid);

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