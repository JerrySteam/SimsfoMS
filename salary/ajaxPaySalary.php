<?php

    $path = "../";
	require_once $path.'@core/core.php';
	require_once $path.'@core/helperFunction.php';

	if(isset($_POST)){
		$employeeid = cleanInput($_POST['employee']);
        $yearid = cleanInput($_POST['year']);
        $monthid = cleanInput($_POST['month']);
        $amount = cleanInput($_POST['amount']);
        $salarytype = cleanInput($_POST['type']);

        if( $employeeid == '-1' || $yearid == '-1' || $monthid == '-1' || $amount < 1 || $salarytype == '-1' ){
            $err = 'Please fill in all fields';
        }else{

            $response = payEmployeeSalary($employeeid, $yearid, $monthid, $amount, $salarytype);

            if($response == 'success'){
                $err = '1';
            }else{
                $err = 'Error encountered while processing request.'.$response;
            }           
                     
        }
        echo $err;
	}else{
        echo 'Unauthorized Request. Process Terminated';
	}

?>