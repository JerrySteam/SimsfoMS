<?php
  $path = "../../";
  $activePage = "customer";
  $pageTitle = "Add New Supplier";
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
          <h1><i class="fa fa-dashboard"></i> Add New Supplier</h1>
          <p>Start a beautiful journey here</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Add New Supplier</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="row">
                <div class="col-md-3">
                  <a href="../view-supplier" class="btn btn-xs btn-primary" title="Add New Supply Expense"><i class="fa fa-search-plus"></i> View Supplier</a>
                </div>
                <div class="col-md-6">
                  <h3 class="tile-title">Supplier Information</h3>
                  <div class="tile-body">
                    <form id="frmAddSupplier" method="post" action="javascript:void(0)">
                      <div class="form-group">
                        <label class="control-label">Full Name</label>
                        <input class="form-control" type="text" name="fullname" placeholder="Enter full name">
                      </div>
                      <div class="form-group">
                        <label class="control-label">Phone Number</label>
                        <input class="form-control" type="text" name="phonenumber" placeholder="Enter phone number">
                      </div>
                       <div class="form-group">
                        <label class="control-label">Email</label>
                        <input class="form-control" type="email" name="email" placeholder="Enter email address">
                      </div>
                      <div class="form-group">
                        <label for="exampleSelect1">Select Country of Residence</label>
                        <select class="form-control" id="country" name="country">
                          <?php echo loadCountryIntoCombo(); ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label class="control-label">Contact Address</label>
                        <textarea class="form-control" rows="4" name="address" placeholder="Enter your address"></textarea>
                      </div>
                    </form>
                  </div>
                  <div class="tile-footer">
                    <button class="btn btn-primary" type="button" id="btnAddNewSupplier"><i class="fa fa-fw fa-lg fa-check-circle"></i>Proceed</button>&nbsp;&nbsp;&nbsp;
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
    <script type="text/javascript" src="../supplier.js"></script>
  </body>
</html>