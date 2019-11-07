<?php

    $path = "../";
	require_once $path.'@core/core.php';
	require_once $path.'@core/helperFunction.php';

	if(isset($_POST)){
		$expenseid = cleanInput($_POST['expenseid']);

        if( $expenseid < 1){
            $err = 'Unauthorized Request. Process Terminated.';
        }else{
            if(isSupplyExpenseIdExist($expenseid) == true){
                $response = deleteSupplyExpenseRecord($expenseid);

                if($response == 'success'){
                    $err = '1';
                }else{
                    $err = 'Error encountered while processing request.';
                }
            }else{
                $err = 'Oops! Payment record does not exist';
            }                   
        }
        echo $err;
	}else{
        echo 'Unauthorized Request. Process Terminated';
	}

?>