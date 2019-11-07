<?php

    $path = "../";
	require_once $path.'@core/core.php';
	require_once $path.'@core/helperFunction.php';

	if(isset($_POST)){
		$bank = cleanInput($_POST['bank']);
        $accountname = cleanInput($_POST['accountname']);
        $accountnumber = cleanInput($_POST['accountnumber']);
        $sortcode = cleanInput($_POST['sortcode']);
        $bankaccountid = cleanInput($_POST['bankaccountid']);

        if( $bank == '-1' || strlen($accountname) < 3 || strlen($accountnumber) < 3 || strlen($sortcode) < 3 || $bankaccountid < 1 ){
            $err = 'Please fill in all fields';
        }else{
            $response = addNewBankAccountRecord($bank, $accountname, $accountnumber, $sortcode, true, $bankaccountid);

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