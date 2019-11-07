<?php

    $path = "../";
	require_once $path.'@core/core.php';
	require_once $path.'@core/helperFunction.php';

	if(isset($_POST)){
		$bank = cleanInput($_POST['bank']);
        $accountname = cleanInput($_POST['accountname']);
        $accountnumber = cleanInput($_POST['accountnumber']);
        $sortcode = cleanInput($_POST['sortcode']);

        if( $bank == '-1' || strlen($accountname) < 3 || strlen($accountnumber) < 3 || strlen($sortcode) < 3){
            $err = 'Please fill in all fields';
        }else{

            if(isBankAccountRegistered($accountnumber)){
                $err = 'An account exist with the account number provided.';
            }else{
                $response = addNewBankAccountRecord($bank, $accountname, $accountnumber, $sortcode);

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