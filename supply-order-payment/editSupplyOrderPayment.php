<?php

    $path = "../";
	require_once $path.'@core/core.php';
	require_once $path.'@core/helperFunction.php';

	if(isset($_POST)){
		$orderref = cleanInput($_POST['orderref']);
        $supplier = cleanInput($_POST['supplier']);
        $dateordered = cleanInput($_POST['dateordered']);
        $totalcost = cleanInput($_POST['totalcost']);
        $supplyorderid = cleanInput($_POST['supplyorderid']);        

        if( strlen($orderref) < 3 || $supplier == '-1' ||  $totalcost < 1 || strlen($dateordered) < 10 || $supplyorderid < 1){
            $err = 'Please fill in all fields';
        }else{

            $response = addNewSupplyOrderRecord($orderref, $supplier, $dateordered, $totalcost, true, $supplyorderid);

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