<?php

    $path = "../";
	require_once $path.'@core/core.php';
	require_once $path.'@core/helperFunction.php';

	if(isset($_POST)){
		$supplierid = cleanInput($_POST['supplierid']);

        if( $supplierid < 1){
            $err = 'Unauthorized Request. Process Terminated.';
        }else{
            if(hasSupplierMadeTrasaction($supplierid) == true){
                $err = 'Oops! Supplier has made a transaction and cannot be deleted.';
            }else{
                $response = deleteSupplierRecord($supplierid);

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