<?php
  $path = "../../";
  $activePage = "sales";
  $pageTitle = "Sales Invoice";
  require_once($path.'@core/core.php');
  
  isUserLoggedIn($path);

  require_once($path.'@core/helperFunction.php');

  $sessionHandler = new HmsSessionHandler();
  $login_user = $sessionHandler->getSessionData('login_user');

  $salesref = '';
  $total = 0;
  $paymentref = '';

  if(isset($_GET['token']) && strlen($_GET['token']) > 5){
    $payref = cleanInput($_GET['token']);
    $res = getSalesPaymentRecordByReference($payref);
    if($res == false){
      redirectTo('../view-sales-payment'); die();
    }else{
      $salesref = $res['salesref'];
      $sessionHandler->createSession('sales-reference', $salesref);
      $sessionHandler->createSession('payment-reference', $payref);
      redirectTo('./'); die();
    }
    
  }


  if($sessionHandler->sessionExist('sales-reference') && $sessionHandler->sessionExist('payment-reference')){
    $salesref = $sessionHandler->getSessionData('sales-reference');
    $paymentref = $sessionHandler->getSessionData('payment-reference');
  }else{
    redirectTo('../view-sales-payment'); die();
  }  

  $invoicedata = getSalesRecordByReference($salesref);
  $paymentrecord = getSalesPaymentRecordByReference($paymentref);

  if($invoicedata == false || $paymentrecord == false){
      redirectTo('../view-sales-payment'); die();
  }

  $customer = getCustomerInfoById($invoicedata[0]['customerid']);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <?php echo getHTMLHeader($path, $pageTitle); ?>
  </head>
  <body class="app sidebar-mini rtl">
    <!-- Navbar-->
    <?php echo getNavbar($path, $pageTitle); ?>
    <!-- End Navbar -->

    <!-- Sidebar menu-->
    <?php echo getSidebar($path, $login_user, $activePage); ?>
    <!--End Sidebar-->

    <!-- main content-->
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-file-text-o"></i> Sales Invoice</h1>
          <p>Printable Sales Invoice</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Sales Invoice</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <section class="invoice">
              <div class="row mb-4">
                <div class="col-6">
                  <h2 class="page-header"><i class="fa fa-globe"></i> SIMSFO</h2>
                </div>
                <div class="col-3 offset-3">                  
                  <address class="text-left">518 Akshar Avenue, Abuja - Nigeria<br>Email: sales@simsfo.com</address>
                </div>
              </div>
              <div class="row invoice-info">
                <div class="col-6">
                  <address>
                  <strong><?php echo strtoupper($customer['fullname']); ?></strong><br>
                  <?php echo ucfirst($customer['contactaddress']); ?><br>
                  <?php echo $customer['phonenumber']; ?><br>
                  <?php echo $customer['email']; ?>
                </address>
                </div>
                <div class="col-3 offset-3">
                  <b>Invoice Ref:  <?php echo $invoicedata[0]['salesref']; ?></b><br>
                  <b>Sales Date: </b> <?php echo format_display_date($invoicedata[0]['salesdate']); ?> <br/>
                  <b>Date Paid: </b> <?php echo format_display_date($paymentrecord['datepaid']); ?> <br/>
                  <b>Payment: </b> <?php echo getPaymentTypeById($paymentrecord['typeofpayment']) .' ('.getPaymentModeById($paymentrecord['modeofpayment']).')'; ?><br/>                 
                </div>
              </div>
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Sn.</th>                        
                        <th>Stock Name</th>
                        <th>Price (&#8358;)</th>
                        <th>Quantity</th>
                        <th>Subtotal (&#8358;)</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $res = '';
                        $sn = 1;
                        for ($i=0; $i < count($invoicedata); $i++) { 
                          $stotal = ($invoicedata[$i]['unitsellingprice'] * $invoicedata[$i]['qty']);
                          $total += $stotal;
                          $res .= '
                                    <tr>
                                      <td>'.$sn.'</td>
                                      <td>'.$invoicedata[$i]['stockname'].'</td>
                                      <td>'.$invoicedata[$i]['unitsellingprice'].'</td>
                                      <td>'.$invoicedata[$i]['qty'].'</td>
                                      <td>'.formatAmount($stotal).'</td>
                                    </tr>
                                  ';
                          $sn++;
                        }
                        echo $res;
                      ?>
                      <tr><td colspan="5">&nbsp;&nbsp;</td></tr>
                      <tr>                    
                        <th colspan="5" class="text-right" style="padding-right:15%">
                          Total: &#8358; <?php echo formatAmount($total); ?>
                        </th>
                      </tr>                      
                    </tbody>
                    <tfoot>
                      <tr>                    
                        <th colspan="5" class="text-left" style="padding-right:15%">
                          Amount Paid: &#8358; <?php echo formatAmount($paymentrecord['amountpaid'])."&nbsp;&nbsp; (".convertNumberToWordsForCurrency($paymentrecord['amountpaid']).")"; ?>
                        </th>
                      </tr>
                      <tr>
                        <th colspan="5" class="text-left" style="padding-right:15%">
                          Outstanding Balance: &#8358; 
                          <?php
                            $owords = "&nbsp;&nbsp; (".convertNumberToWordsForCurrency($paymentrecord['outstanding']).")"; 
                            echo ($paymentrecord['outstanding'] > 0) ? formatAmount($paymentrecord['outstanding'])." ".$owords : formatAmount($paymentrecord['outstanding']) ; ?>
                        </th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
              <div class="row d-print-none mt-2">
                <div class="col-12 text-right"><a class="btn btn-primary" href="javascript:window.print();" target="_blank"><i class="fa fa-print"></i> Print</a></div>
              </div>
            </section>
          </div>
        </div>
      </div>
    </main>
    <!-- End main content-->

    <!-- Essential javascripts for application to work-->
    <?php echo getCoreJSFiles($path); ?>
    <!-- End Essential javascripts for application to work-->
    <!-- Page specific javascripts-->    
    <script type="text/javascript" src="../sales.js"></script>

    <?php 
      $sessionHandler->destroySession('sales-reference');
      $sessionHandler->destroySession('payment-reference'); 
    ?>
  </body>
</html>