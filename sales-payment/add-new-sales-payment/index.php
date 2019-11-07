<?php
  $path = "../../";
  $activePage = "sales-payment";
  $pageTitle = "Add New Sales Payment";
  require_once($path.'@core/core.php');
  
  isUserLoggedIn($path);

  require_once($path.'@core/helperFunction.php');

  $sessionHandler = new HmsSessionHandler();
  $login_user = $sessionHandler->getSessionData('login_user');

  $salesref = '';
  $total = 0;
  $salesdata = '';
  $salesid = '';
  $outstanding = '';

  if(isset($_GET['token']) && strlen($_GET['token']) > 5){
    $salesref = cleanInput($_GET['token']);
    $sessionHandler->createSession('sales-reference', $salesref);
    redirectTo('./'); die();
  }

  if($sessionHandler->sessionExist('sales-reference')){
    $salesref = $sessionHandler->getSessionData('sales-reference');

    $salesdata = getSalesRecordByReference($salesref);
    $salesid = $salesdata[0]['salesid'];

    $total = getSalesTotalCostById($salesref);
    $tp = getTotalAmountPaidBySalesId($salesid);
    $outstanding = ($total - $tp);
    
    if($salesdata == false){
        //redirectTo('../view-sales-payment'); die();
      print_r($salesdata); die();
    }
  }

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
          <h1><i class="fa fa-dashboard"></i> Add New Sales Payment</h1>
          <p>Start a beautiful journey here</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Add New Sales Payment</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="row">
                <div class="col-md-3">
                  <a href="../view-sales-payment" class="btn btn-xs btn-primary" title="Add New Sales Order"><i class="fa fa-search-plus"></i> View Sales Payment</a>
                </div>
                <div class="col-md-6">
                  <h3 class="tile-title">Sales Payment Information</h3>
                  <div class="tile-body">
                    <form id="frmAddSalesPayment" method="post" action="javascript:void(0)">
                      <div class="form-group">
                        <label class="control-label">Sales Payment Reference</label>
                        <input class="form-control" type="text" name="paymentref" value="<?php echo generateUniqueRef('SPR_'); ?>" readonly/>
                      </div>
                      <div class="form-group">
                        <label for="exampleSelect1">Sales Reference</label>
                        <select class="form-control sel2" id="salesid" name="salesid">
                          <?php echo loadSalesIntoCombo($salesid); ?>
                        </select>
                      </div>
                      <div class="row">
                        <div class="form-group col-md-6">
                          <label class="control-label">Total Cost (&#8358;)</label>
                          <input class="form-control" type="text" name="totalcost" id="totalcost" value="<?php echo $total ;?>" placeholder="Enter total cost" readonly="">
                        </div>
                        <div class="form-group col-md-6">
                          <label class="control-label">Outstanding Amount <span id="bal"></span></label>
                          <input class="form-control" type="text" id="outstanding" name="outstanding" value="<?php echo $outstanding ;?>" placeholder="Enter outstanding amount" readonly="">
                        </div>                        
                      </div>
                      <div class="form-group">
                          <label class="control-label">Amount Paid (&#8358;)</label>
                          <input class="form-control" type="number" min="1" name="amountpaid" id="amountpaid" placeholder="Enter amount paid">
                        </div>
                      <div class="form-group">
                        <label for="exampleSelect1">Select Bank Account</label>
                        <select class="form-control sel2" id="bankaccountid" name="bankaccountid">
                          <?php echo loadBankAccountIntoCombo(); ?>
                        </select>
                      </div>                      
                      <div class="row">                        
                        <div class="form-group col-md-6">
                          <label for="exampleSelect1">Select Type of Payment</label>
                          <select class="form-control sel2" id="paymenttype" name="paymenttype">
                            <?php echo loadPaymentTypeIntoCombo(); ?>
                          </select>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="exampleSelect1">Select Mode of Payment</label>
                          <select class="form-control sel2" id="paymentmode" name="paymentmode">
                            <?php echo loadPaymentModeIntoCombo(); ?>
                          </select>
                        </div>
                      </div>                    
                      <div class="form-group">
                        <label class="control-label">Due Date</label>
                        <input class="form-control" type="date" name="duedate" placeholder="Enter due date">
                      </div> 
                      <div class="form-group">
                        <label class="control-label">Comment</label>
                        <textarea class="form-control" name="comment" placeholder="Comment" rows="3"></textarea>
                      </div>                      
                    </form>
                  </div>
                  <div class="tile-footer">
                    <button class="btn btn-primary" type="button" id="btnAddNewSalesPayment"><i class="fa fa-fw fa-lg fa-check-circle"></i>Proceed</button>&nbsp;&nbsp;&nbsp;
                  </div>
                </div>
                <div class="col-md-3"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <!-- End main content-->

    <!-- Essential javascripts for application to work-->
    <?php echo getCoreJSFiles($path); ?>
    <!-- End Essential javascripts for application to work-->
    <!-- Page specific javascripts-->  
    <script type="text/javascript" src="../salespayment.js"></script>

    <?php 
      $sessionHandler->destroySession('sales-reference');
    ?>
  </body>
</html>