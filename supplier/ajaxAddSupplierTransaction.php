<?php

    $path = "../";
	require_once $path.'@core/core.php';
	require_once $path.'@core/helperFunction.php';

	if(isset($_POST)){
		$supplierid = cleanInput($_POST['supplierid']);
        $currency = cleanInput($_POST['currency']);
        $amount = cleanInput($_POST['amount']);
        $transactiontype = cleanInput($_POST['transactiontype']);
        $invoiceref = cleanInput($_POST['invoiceref']);
        $comment = cleanInput($_POST['comment']);

        if( $supplierid < 1 || $currency < 1 || $amount < 1 || $transactiontype < 1){
            $err = 'Please fill in all fields';
        }else{
            $response = addNewSupplierTransactionRecord($supplierid, $currency, $amount, $transactiontype, $invoiceref, $comment);
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