<?php

    $path = "../";
	require_once $path.'@core/core.php';
	require_once $path.'@core/helperFunction.php';

	if(isset($_POST)){
        $orderid = cleanInput($_POST['orderid']);
        $description = $_POST['description'];
        $amount = $_POST['amount'];

        if( $orderid == '-1' || !is_array($description) || empty($description) || !is_array($amount) || empty($amount) ){
            $err = 'Please fill in all fields';
        }else{
            $desc = array();
            $amt = array();

            for ($i=0; $i < count($description); $i++) { 
                $itemdesc = cleanInput($description[$i]);
                $itemamt = cleanInput($amount[$i]);

               if(strlen($itemdesc) > 3 && strlen($itemamt) > 1){
                    $desc[] = $itemdesc;
                    $amt[] = $itemamt;
               }
            }
            if (count($desc) > 0 && count($amt) > 0) {
                $response = addNewSupplyExpenseRecord($orderid, $desc, $amt);
                if($response == 'success'){
                    $err = '1';
                }else{
                    $err = 'Error encountered while processing request.';
                }
            } else {
                $err = 'Please fill in all fields';
            }        
        }
        echo $err;
	}else{
        echo 'Unauthorized Request. Process Terminated';
	}

?>