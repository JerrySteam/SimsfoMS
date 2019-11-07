<?php

    $path = "../";
	require_once $path.'@core/core.php';
	require_once $path.'@core/helperFunction.php';

	if(isset($_POST)){
        $paymentref = cleanInput($_POST['paymentref']);
        $orderid = cleanInput($_POST['orderid']);
        $amountpaid = cleanInput($_POST['amountpaid']);
        $currency = cleanInput($_POST['currency']);
        $duedate = cleanInput($_POST['duedate']);
        $paymenttype = cleanInput($_POST['paymenttype']);
        $paymentmode = cleanInput($_POST['paymentmode']);
        $comment = cleanInput($_POST['comment']);
        /**
        $paymenttype = cleanInput($_POST['paymenttype']);
        $paymentmode = cleanInput($_POST['paymentmode']);
        $freightforwarder = cleanInput($_POST['freightforwarder']);
        **/

        if( strlen($paymentref) < 3 || $orderid == '-1' || $amountpaid < 1 || $currency == '-1' || strlen($duedate) < 10 || $paymenttype == '-1' || $paymentmode == '-1' || strlen($comment) < 3){
            $err = 'Please fill in all fields';
        }else{

            if(!isSupplyOrderIdExist($orderid)){
                $err = 'The supply order reference provided does not exist.';
            }else{
                if(isSupplyOrderPaymentReferenceExist($paymentref)){
                    $err = 'A supply order payment already exist with the reference provided.';
                }else{
                    $response = addNewSupplyOrderPaymentRecord($paymentref, $orderid, $amountpaid, $currency, $duedate, $paymenttype, $paymentmode, $comment);

                    if($response == 'success'){
                        $err = '1';
                    }else{
                        $err = 'Error encountered while processing request.';
                    }
                }
            }            
        }
        echo $err;
	}else{
        echo 'Unauthorized Request. Process Terminated';
	}

?>