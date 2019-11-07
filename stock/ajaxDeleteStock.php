<?php

    $path = "../";
	require_once $path.'@core/core.php';
	require_once $path.'@core/helperFunction.php';

	if(isset($_POST)){
		$stockid = cleanInput($_POST['stockid']);

        if( $stockid < 1){
            $err = 'Unauthorized Request. Process Terminated.';
        }else{
            if(isStockWithSales($stockid) == true){
                $err = 'Oops! Stock has sales captured and cannot be deleted.';
            }else{
                $response = deleteStockRecord($stockid);

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