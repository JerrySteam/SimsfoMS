<?php
  $path = "../../";
  $activePage = "supply-order";
  $pageTitle = "Add New Supply Order";
  require_once($path.'@core/core.php');
  
  isUserLoggedIn($path);

  require_once($path.'@core/helperFunction.php');

  $sessionHandler = new HmsSessionHandler();
  $login_user = $sessionHandler->getSessionData('login_user');
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
          <h1><i class="fa fa-dashboard"></i> Add New Supply Order</h1>
          <p>Start a beautiful journey here</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Add New Supply Order</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="row">
                <div class="col-md-3">
                  <a href="../view-supply-order" class="btn btn-xs btn-primary" title="Add New Supply Order"><i class="fa fa-search-plus"></i> View Supply Order</a>
                </div>
                <div class="col-md-6">
                  <h3 class="tile-title">Supply Order Information</h3>
                  <div class="tile-body">
                    <form id="frmAddSupplyOrder" method="post" action="javascript:void(0)">
                      <div class="form-group">
                        <label class="control-label">Order Reference</label>
                        <input class="form-control" type="text" name="orderref" value="<?php echo generateUniqueRef('SOR_'); ?>" readonly />
                      </div>
                      <div class="form-group">
                        <label for="exampleSelect1">Select Supplier</label>
                        <select class="form-control" id="supplier" name="supplier">
                          <?php echo loadSupplierIntoCombo(); ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label class="control-label">Date Ordered</label>
                        <input class="form-control" type="date" name="dateordered" placeholder="Enter ordered date">
                      </div>
                      <!--
                      <div class="form-group">
                        <label for="exampleSelect1">Select Type of Payment</label>
                        <select class="form-control" id="paymenttype" name="paymenttype">
                          <?php echo loadPaymentTypeIntoCombo(); ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleSelect1">Select Mode of Payment</label>
                        <select class="form-control" id="paymentmode" name="paymentmode">
                          <?php echo loadPaymentModeIntoCombo(); ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleSelect1">Select Freight Forwarder</label>
                        <select class="form-control" id="freightforwarder" name="freightforwarder">
                          <?php echo loadEmployeeIntoCombo(); ?>
                        </select>
                      </div>
                      -->
                      <div class="form-group">
                        <label class="control-label">Total Cost</label>
                        <input class="form-control" type="number" min="1" name="totalcost" placeholder="Enter total cost">
                      </div>
                    </form>
                  </div>
                  <div class="tile-footer">
                    <button class="btn btn-primary" type="button" id="btnAddNewSupplyOrder"><i class="fa fa-fw fa-lg fa-check-circle"></i>Proceed</button>&nbsp;&nbsp;&nbsp;
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
    <script type="text/javascript" src="../supplyorder.js"></script>
  </body>
</html>