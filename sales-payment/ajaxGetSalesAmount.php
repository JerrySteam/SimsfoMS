<?php

  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: GET");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  $path = "../";
  require_once($path.'@core/core.php');
  
  isUserLoggedIn($path);

  require_once($path.'@core/helperFunction.php');

  $sessionHandler = new HmsSessionHandler();
  $login_user = $sessionHandler->getSessionData('login_user');

  $total = 0;
  $salesid = 0;
  $outstanding = 0;

  if(isset($_POST['salesid']) && $_POST['salesid'] > 0){
    $salesid = cleanInput($_POST['salesid']);
    $salesref = getSalesRecordById($salesid);

    if($salesref == false){
      http_response_code(200);
      echo json_encode(
            array("message" => "No Record Found for Selected Sales")
          );
      die();
    }else{
      $record = getSalesRecordByReference($salesref[0]['salesref']);
      if($record == false){
        http_response_code(200);
        echo json_encode(
              array("message" => "No Record Found for Selected Sales")
            );
        die();
      }else{
        $total = getSalesTotalCostById($salesref[0]['salesref']);
        $tp = getTotalAmountPaidBySalesId($salesid);
        $outstanding = ($total - $tp);

        http_response_code(200);
        echo json_encode(
              array("message"=>"Success", "totalcost"=>formatAmount($total), "outstanding"=>formatAmount($outstanding))
            );
        die();
      }
    }

  }elseif(isset($_POST['amountpaid']) && $_POST['amountpaid'] > 0 && isset($_POST['sid']) && $_POST['sid'] > 0){
    $salesid = cleanInput($_POST['sid']);
    $amountpaid = cleanInput($_POST['amountpaid']);

    $salesref = getSalesRecordById($salesid);

    if($salesref == false){
      http_response_code(200);
      echo json_encode(
            array("message" => "No Record Found for Selected Sales")
          );
      die();
    }else{
        $tc = getSalesTotalCostById($salesref[0]['salesref']);
        $tp = getTotalAmountPaidBySalesId($salesid);
        $paid = ($tp + $amountpaid);
        $outstanding = ($tc - $paid);

        http_response_code(200);
        echo json_encode(
              array("message"=>"Success", "totalcost"=>formatAmount($total), "outstanding"=>formatAmount($outstanding))
            );
        die();
    }
  }else{
    http_response_code(200);
    echo json_encode(
          array("message" => "Invalid Sales Reference.")
        );
    die();
  }

?>