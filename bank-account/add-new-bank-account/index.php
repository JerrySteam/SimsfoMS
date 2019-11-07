<?php
  $path = "../../";
  $activePage = "employee";
  $pageTitle = "Add New Bank Account";
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
          <h1><i class="fa fa-dashboard"></i> Add New Bank Account</h1>
          <p>Start a beautiful journey here</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Add New Bank Account</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">              
              <div class="row">   
                <div class="col-md-3">
                  <a href="../view-bank-account" class="btn btn-xs btn-primary" title="View Bank Accounts"><i class="fa fa-search-plus"></i> View Bank Accounts</a>
                </div>             
                <div class="col-md-6">
                  <h3 class="tile-title">Bank Account Information</h3>
                  <div class="tile-body">
                    <form id="frmAddBankAccount" method="post" action="javascript:void(0)">
                      <div class="form-group">
                        <label for="exampleSelect1">Select Bank</label>
                        <select class="form-control sel2" id="bank" name="bank">
                          <?php echo loadBankIntoCombo(); ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label class="control-label">Account Name</label>
                        <input class="form-control" type="text" name="accountname" placeholder="Enter account name">
                      </div>
                      <div class="form-group">
                        <label class="control-label">Account Number</label>
                        <input class="form-control" type="text" name="accountnumber" placeholder="Enter account number">
                      </div>
                       <div class="form-group">
                        <label class="control-label">Sort Code</label>
                        <input class="form-control" type="text" name="sortcode" placeholder="Enter bank sort code">
                      </div>                      
                    </form>
                  </div>
                  <div class="tile-footer">
                    <button class="btn btn-primary" type="button" id="btnAddNewBankAccount"><i class="fa fa-fw fa-lg fa-check-circle"></i>Proceed</button>&nbsp;&nbsp;&nbsp;
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
    <script type="text/javascript" src="../bankaccount.js"></script>

  </body>
</html>