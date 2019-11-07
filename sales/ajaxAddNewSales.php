<?php

    $path = "../";
	require_once $path.'@core/core.php';
	require_once $path.'@core/helperFunction.php';

	if(isset($_POST)){
        $salesref = cleanInput($_POST['salesref']);
        $customer = cleanInput($_POST['customer']);        
        $salesdate = cleanInput($_POST['salesdate']);
        $stock = $_POST['stock'];
        $quantity = $_POST['quantity'];

        if( strlen($salesref) < 3 || $customer == '-1' || strlen($salesdate) < 10 || $stock[0] == '-1' ||  $quantity[0] < 1 ){
            $err = 'Please fill in all fields';
        }else{

            if(isSalesReferenceExist($salesref)){
                $err = 'A sales exist with the reference provided.';
            }else{
                $stk = array();
                $qty = array();

                for ($i=0; $i < count($stock); $i++) { 
                    if($stock[$i] != '-1' && $quantity[$i] > 0){
                        $stk[] = $stock[$i];
                        $qty[] = $quantity[$i];
                    }
                }

                $response = addNewSalesRecord($salesref, $customer, $stk, $qty, $salesdate);

                if($response == 'success'){
                    $sessionHandler = new HmsSessionHandler();
                    $sessionHandler->createSession('sales-reference', $salesref);
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