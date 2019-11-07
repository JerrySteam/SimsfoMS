<?php

    $path = "../";
	require_once $path.'@core/core.php';
	require_once $path.'@core/helperFunction.php';

    if (isset($_POST) && isset($_POST['stockcontainerid'])) {

        $contid = cleanInput($_POST['stockcontainerid']);
        $containerdata = getContainerRecordById($contid)[0];

        if ($containerdata == false) {
            $err['error'] = '-1';
        } else {
            $ratio = $containerdata['expenses'] / $containerdata['buyingprice'];
            $err['error'] = 'success';
            $err['ratio'] = $ratio;
            $err['stocks'] = loadSupplierStockListIntoCombo($containerdata['supplierid']);
        }   
        echo json_encode($err);

    }elseif (isset($_POST) && isset($_POST['itmid'])) {

        $stockid = cleanInput($_POST['itmid']);
        $stockdata = getSupplierStockListById($stockid)[0];

        if ($stockdata == false) {
            $err['result'] = '-1';
        } else {
            $err['result'] = 'success';
            $err['name'] = $stockdata['stockname'];
            $err['weight'] = $stockdata['stockweight'];
        }   
        echo json_encode($err);

    }elseif(isset($_POST) && isset($_POST['container'])){

        $containerref = cleanInput($_POST['container']);
        $stockref = (isset($_POST['stockref'])) ? $_POST['stockref'] : array();
        $stockname = (isset($_POST['stockname'])) ? $_POST['stockname'] : array();
        $weight = (isset($_POST['weight'])) ? $_POST['weight'] : array();
        $quantity = (isset($_POST['quantity'])) ? $_POST['quantity'] : array();
        $buyingprice = (isset($_POST['buyingprice'])) ? $_POST['buyingprice'] : array();
        $costprice = (isset($_POST['costprice'])) ? $_POST['costprice'] : array();
        $unitsellingprice = (isset($_POST['unitsellingprice'])) ? $_POST['unitsellingprice'] : array();

        if( $containerref == '-1' || count($stockref) < 1 || count($stockname) < 1 ||  count($weight) < 1 || count($quantity) < 1 || count($buyingprice) < 1 || count($costprice) < 1 || count($unitsellingprice) < 1){
            $err = 'Please fill in all fields';
        }else{

            $ref = array();
            $nme = array();
            $wgt = array();
            $qty = array();
            $bpr = array();
            $cpr = array();
            $usp = array();

            for ($i=0; $i < count($stockref); $i++) { 
                $iref = cleanInput($stockref[$i]);
                $inme = cleanInput($stockname[$i]);
                $iwgt = cleanInput($weight[$i]);
                $iqty = cleanInput($quantity[$i]);
                $ibpr = cleanInput($buyingprice[$i]);
                $icpr = cleanInput($costprice[$i]);
                $iusp = cleanInput($unitsellingprice[$i]);
                //echo "--".$stockref[$i]; exit;

               if($iref > 0 && strlen($inme) > 0 && $iwgt > 0 && $iqty > 0 && $ibpr > 0 && $icpr > 0 && $iusp > 0){
                    $ref[] = $iref;
                    $nme[] = $inme;
                    $wgt[] = $iwgt;
                    $qty[] = $iqty;
                    $bpr[] = $ibpr;
                    $cpr[] = $icpr;
                    $usp[] = $iusp;
               }
            }

            if (count($ref) > 0 && count($usp) > 0 && count($qty) > 0) {
                $response = addNewStockRecord($containerref, $ref, $nme, $wgt, $qty, $bpr, $cpr, $usp);
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