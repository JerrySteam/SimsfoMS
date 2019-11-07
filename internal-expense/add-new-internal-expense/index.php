<?php
  $path = "../../";
  $activePage = "supply-expense";
  $pageTitle = "Add New Internal Expense";
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
          <h1><i class="fa fa-dashboard"></i> Add New Internal Expense</h1>
          <p>Start a beautiful journey here</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Add New Internal Expense</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="row">
                <div class="col-md-3">
                  <a href="../view-internal-expense" class="btn btn-xs btn-primary" title="View Internal Expense"><i class="fa fa-search-plus"></i> View Internal Expense</a>
                </div>
                <div class="col-md-6"><h3 class="tile-title text-center">Internal Expense Information</h3></div>
                <div class="col-md-3"></div>
              </div>
              <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                  <div class="tile-body">
                    <form id="frmAddInternalExpense" method="post" action="javascript:void(0)">
                      <hr>
                      <div id="field0">
                        <div class="row">
                          <div class="form-group col-md-6">
                            <label class="control-label">Description</label>
                            <input class="form-control description" type="text" name="description[]" id="description0" rel="0" placeholder="Enter expense description">
                          </div>
                          <div class="form-group col-md-3">
                            <label class="control-label">Amount</label>
                            <input class="form-control amount" type="number" min="1" name="amount[]" id="amount0" rel="0" placeholder="Enter expense amount">
                          </div>
                          <div class="form-group col-md-3">
                            <label for="exampleSelect1">Approved by</label>
                            <select class="form-control approvedby" name="approvedby[]" id="approvedby0" rel="0">
                              <?php echo loadEmployeeIntoCombo(); ?>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-12 text-right">
                          <button id="add-more" name="add-more" class="btn btn-primary"><i class="fa fa-plus"></i> Add Another Expense</button>
                        </div>
                      </div>  
                    </form>
                  </div>
                  <div class="tile-footer">
                    <button class="btn btn-primary" type="button" id="btnAddNewInternalExpense"><i class="fa fa-fw fa-lg fa-check-circle"></i>Proceed</button>&nbsp;&nbsp;&nbsp;
                  </div>
                </div>
                <div class="col-md-1"></div>
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
    <script type="text/javascript" src="../internalexpense.js"></script>
  </body>
</html>