<?php

    $path = "../";
	require_once $path.'@core/core.php';
	require_once $path.'@core/helperFunction.php';

	if(isset($_POST)){
		$bankaccountid = cleanInput($_POST['bankaccountid']);

        if( $bankaccountid < 1){
            $err = 'Unauthorized Request. Process Terminated.';
        }else{
            if(isBankAccountWithPayment($bankaccountid) == true){
                $err = 'Oops! BankAccount has received a payment and cannot be deleted.';
            }else{
                $response = deleteBankAccountRecord($bankaccountid);

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