<?php

    $path = "../";
	require_once $path.'@core/core.php';
	require_once $path.'@core/helperFunction.php';

	if(isset($_POST)){
		$containerref = cleanInput($_POST['container']);
        $stockref = cleanInput($_POST['stockref']);
        $stockname = cleanInput($_POST['stockname']);
        $weight = cleanInput($_POST['weight']);
        $quantity = cleanInput($_POST['quantity']);
        $buyingprice = cleanInput($_POST['buyingprice']);
        $costprice = cleanInput($_POST['costprice']);
        $unitsellingprice = cleanInput($_POST['unitsellingprice']);
        $stockid = cleanInput($_POST['stockid']);

        if( $containerref == '-1' || strlen($stockref) < 3 || strlen($stockname) < 3 || $weight < 0 || $quantity < 0 || $buyingprice < 0 || $costprice < 0 || $unitsellingprice < 0 || $stockid == '-1' ){
            $err = 'Please fill in all fields';
        }else{

            $response = addNewStockRecord($containerref, $stockref, $stockname, $weight, $quantity, $buyingprice, $costprice, $unitsellingprice, true, $stockid);

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