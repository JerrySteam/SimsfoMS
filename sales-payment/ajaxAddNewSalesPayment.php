<?php

    $path = "../";
    require_once $path.'@core/core.php';
    require_once $path.'@core/helperFunction.php';

    if(isset($_POST)){
        $paymentref = cleanInput($_POST['paymentref']);
        $salesid = cleanInput($_POST['salesid']);
        $amountpaid = cleanInput($_POST['amountpaid']);
        $bankaccountid = cleanInput($_POST['bankaccountid']);
        $amountpaid = cleanInput($_POST['amountpaid']);        
        $paymenttype = cleanInput($_POST['paymenttype']);
        $paymentmode = cleanInput($_POST['paymentmode']);
        $outstanding = ($_POST['outstanding'] > 0) ? cleanInput($_POST['outstanding']) : 0;
        $duedate = cleanInput($_POST['duedate']);
        $comment = (strlen($_POST['comment']) > 3) ? cleanInput($_POST['comment']) : '';

        if( strlen($paymentref) < 3 || $salesid == '-1' || $amountpaid < 1 || $bankaccountid == '-1' || $paymenttype == '-1' || $paymentmode == '-1'){
            $err = 'Please fill in all fields';
        }else{
            $out = ($outstanding - $amountpaid);
            if( $out > 0 && strlen($duedate) < 10 ){
                $err = "Please specify a due date";
            }else{
                if(!isSalesIdExist($salesid)){
                    $err = 'The sales reference provided does not exist.';
                }else{
                    $salesref = getSalesRecordById($salesid);
                    if($salesref == false){
                      $err = "No Record Found for Selected Sales";
                    }else{
                        $tc = getSalesTotalCostById($salesref[0]['salesref']);
                        $op = getTotalAmountPaidBySalesId($salesid);
                        $tp = ($op + $amountpaid);
                        $outstandingbalance = intval($tc - $tp);

                        // /echo $outstandingbalance.' - '.$outstanding; exit;
                        //print_r($_POST); exit;

                        if($outstanding > 0){
                            if(isSalesPaymentReferenceExist($paymentref)){
                                $err = 'A sales payment already exist with the reference provided.';
                            }else{                        
                                $response = addNewSalesPaymentRecord($paymentref, $salesid, $bankaccountid, $amountpaid, $outstandingbalance, $duedate, $paymenttype, $paymentmode, $comment);

                                if($response == 'success'){                                    
                                    $sessionHandler = new HmsSessionHandler();
                                    $sessionHandler->createSession('sales-reference', $salesref);
                                    $err = '1';
                                }else{
                                    $err = 'Error encountered while processing request.';                 
                                }                     
                            }
                        }else{
                            $err = "Selected sales has no outstanding balance";
                        }
                    }
                }  
            }                      
        }
        echo $err;
    }else{
        echo 'Unauthorized Request. Process Terminated';
    }

?>