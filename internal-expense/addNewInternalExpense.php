<?php

    $path = "../";
	require_once $path.'@core/core.php';
	require_once $path.'@core/helperFunction.php';

	if(isset($_POST)){
        $description = (isset($_POST['description'])) ? $_POST['description'] : array();
        $amount = (isset($_POST['amount'])) ? $_POST['amount'] : array();
        $approvedby = (isset($_POST['approvedby'])) ? $_POST['approvedby'] : array();

        if( count($description) < 1 || count($amount) < 1 || count($approvedby) < 1){
            $err = 'Please fill in all fields';
        }else{
            $desc = array();
            $amt = array();
            $aby = array();

            for ($i=0; $i < count($description); $i++) { 
                $expdesc = cleanInput($description[$i]);
                $expamnt = cleanInput($amount[$i]);
                $expapby = cleanInput($approvedby[$i]);

               if(strlen($expdesc) > 3 && $expamnt > 0 && $expapby > 0){
                    $desc[] = $expdesc;
                    $amt[] = $expamnt;
                    $aby[] = $expapby;
               }
            }
            if (count($desc) > 0 && count($amt) > 0 && count($aby) > 0) {
                $response = addNewInternalExpenseRecord($desc, $amt, $aby);
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