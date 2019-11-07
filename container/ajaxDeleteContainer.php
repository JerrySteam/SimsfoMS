<?php

    $path = "../";
	require_once $path.'@core/core.php';
	require_once $path.'@core/helperFunction.php';

	if(isset($_POST)){
		$containerid = cleanInput($_POST['containerid']);

        if( $containerid < 1){
            $err = 'Unauthorized Request. Process Terminated.';
        }else{
            if(isContainerWithStock($containerid) == true){
                $err = 'Oops! Container has stocks captured and cannot be deleted.';
            }else{
                $response = deleteContainerRecord($containerid);

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