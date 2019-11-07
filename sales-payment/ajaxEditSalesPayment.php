<?php

    $path = "../";
	require_once $path.'@core/core.php';
	require_once $path.'@core/helperFunction.php';

	if(isset($_POST)){
		$salesref = cleanInput($_POST['salesref']);
        $customer = cleanInput($_POST['customer']);
        $stock = cleanInput($_POST['stock']);
        $quantity = cleanInput($_POST['quantity']);
        $salesdate = cleanInput($_POST['salesdate']);
        $paymenttype = cleanInput($_POST['paymenttype']);
        $paymentmode = cleanInput($_POST['paymentmode']);
        $salesid = cleanInput($_POST['salesid']);

        if( strlen($salesref) < 3 || $customer == '-1' || $stock == '-1' ||  $quantity < 1 || strlen($salesdate) < 10 || $paymenttype < 0 || $paymentmode < 0 || $salesid < 0 ){
            $err = 'Please fill in all fields';
        }else{

            $response = addNewSalesRecord($salesref, $customer, $stock, $quantity, $salesdate, $paymenttype, $paymentmode, true, $salesid);

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