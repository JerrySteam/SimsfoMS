<?php

    $path = "../";
	require_once $path.'@core/core.php';
	require_once $path.'@core/helperFunction.php';

	if(isset($_POST)){
		$supplyorderid = cleanInput($_POST['order']);
        $containerref = cleanInput($_POST['containerref']);
        $description = cleanInput($_POST['description']);
        $buyingprice = cleanInput($_POST['buyingprice']);
        $expenses = cleanInput($_POST['expenses']);
        $hasdeficit = cleanInput($_POST['hasdeficit']);
        $deficitdesc = cleanInput($_POST['deficitdesc']);
        $hasoutstanding = cleanInput($_POST['hasoutstanding']);
        $outstandingdesc = cleanInput($_POST['outstandingdesc']);
        $shippingdate = cleanInput($_POST['shippingdate']);
        $seaportarrivaldate = cleanInput($_POST['seaportdate']);
        $clearancedate = cleanInput($_POST['clearancedate']);
        $datemovedtowarehouse = cleanInput($_POST['warehousedate']);

        if( $supplyorderid == '-1' || strlen($containerref) < 3 || strlen($description) < 3 || $buyingprice < 0 || $expenses < 0 || $hasdeficit == '-1' || strlen($deficitdesc) < 3 || $hasoutstanding == '-1' || strlen($outstandingdesc) < 3 || strlen($shippingdate) < 10 || strlen($seaportarrivaldate) < 10 || strlen($clearancedate) < 10 || strlen($datemovedtowarehouse) < 10 ){
            $err = 'Please fill in all fields';
        }else{

            if(isContainerRefRegistered($containerref)){
                $err = 'A container exist with the reference provided.';
            }else{
                $response = addNewContainerRecord($supplyorderid, $description, $hasdeficit, $deficitdesc, $hasoutstanding, $outstandingdesc, $containerref, $shippingdate, $seaportarrivaldate, $clearancedate, $datemovedtowarehouse, $buyingprice, $expenses);

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