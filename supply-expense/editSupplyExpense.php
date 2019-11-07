<?php

    $path = "../";
	require_once $path.'@core/core.php';
	require_once $path.'@core/helperFunction.php';

	if(isset($_POST)){
		$orderid = cleanInput($_POST['orderid']);
        $description = cleanInput($_POST['description']);
        $amount = cleanInput($_POST['amount']);
        $expenseid = cleanInput($_POST['expenseid']);

        if( $orderid == '-1' || strlen($description) < 3 || $amount < 1 || $expenseid < 1){
            $err = 'Please fill in all fields';
        }else{

            $response = addNewSupplyExpenseRecord($orderid, $description, $amount, true, $expenseid);

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