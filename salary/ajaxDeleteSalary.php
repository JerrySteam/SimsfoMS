<?php

    $path = "../";
	require_once $path.'@core/core.php';
	require_once $path.'@core/helperFunction.php';

	if(isset($_POST)){
		$salaryid = cleanInput($_POST['salaryid']);

        if($salaryid < 1){
            $err = 'Unauthorized Request. Process Terminated.';
        }else{
            $response = deleteSalaryRecord($salaryid);

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