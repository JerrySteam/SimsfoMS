<?php
  $path = "../../";
  $activePage = "sales";
  $pageTitle = "Add New Sales";
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
          <h1><i class="fa fa-dashboard"></i> Add New Sales</h1>
          <p>Start a beautiful journey here</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Add New Sales</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="row">
                <div class="col-md-12">
                  <h3 class="tile-title">
                    <a href="../view-sales" class="btn btn-xs btn-primary col-md-2" title="View Sales"><i class="fa fa-search-plus"></i> View Sales</a> &nbsp;&nbsp;
                    <span class="col-md-4 offset-3">Sales Information</span>
                  </h3>
                  <br/>
                  <div class="tile-body">
                    <form id="frmAddSales" method="post" action="javascript:void(0)">
                      <div class="row">
                        <div class="form-group col-md-4 offset-1">
                          <label class="control-label">Sales Reference</label>
                          <input class="form-control" type="text" name="salesref" value="<?php echo generateUniqueRef('SAL_'); ?>" readonly>
                        </div>
                        <div class="form-group col-md-4">
                          <label for="exampleSelect1">Select Customer</label>
                          <select class="form-control sel2" id="customer" name="customer">
                            <?php echo loadCustomerIntoCombo(); ?>
                          </select>
                        </div>
                        <div class="form-group col-md-2">
                          <label class="control-label">Sales Date</label>
                          <input class="form-control" type="date" name="salesdate" placeholder="Enter sales date">
                        </div>
                      </div>                      
                      <br/><hr/><br/>
                      <div class="container">
                        <div id="field0">
                          <div class="row">
                            <div class="form-group col-md-6 offset-2">
                              <label for="exampleSelect1">Select Stock</label>
                              <select class="form-control stock" id="stock0" rel="0" name="stock[]">
                                <?php echo loadStockIntoCombo(); ?>
                              </select>
                            </div>
                            <div class="form-group col-md-2">
                              <label class="control-label">Quantity</label>
                              <input class="form-control quantity" type="number" id="quantity0" rel="0" min="1" name="quantity[]" placeholder="Enter quantity">
                            </div>                        
                          </div>
                        </div>
                        <br/>
                        <div class="form-group">
                          <div class="col-md-12 text-right">
                            <button id="add-more" name="add-more" class="btn btn-primary"><i class="fa fa-plus"></i> Add Another Item</button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="tile-footer">
                    <button class="btn btn-primary" type="button" id="btnAddNewSales"><i class="fa fa-fw fa-lg fa-check-circle"></i>Proceed</button>&nbsp;&nbsp;&nbsp;
                    <span class="offset-8" id="salestotal"><b>Total: (&#8358;) <span id="totalval">0.00</span></b></span>
                  </div>
                </div>
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
    <script type="text/javascript" src="../sales.js"></script>
  </body>
</html>