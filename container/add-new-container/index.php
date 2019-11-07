<?php
  $path = "../../";
  $activePage = "container";
  $pageTitle = "Add New Container";
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
          <h1><i class="fa fa-dashboard"></i> Add New Container</h1>
          <p>Start a beautiful journey here</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Add New Container</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="row">
                <div class="col-md-3">
                  <a href="../view-container" class="btn btn-xs btn-primary" title="View Containers"><i class="fa fa-search-plus"></i> View Containers</a>
                </div>
                <div class="col-md-6">
                  <h3 class="tile-title">Container Information</h3>
                  <div class="tile-body">
                    <form id="frmAddContainer" method="post" action="javascript:void(0)">
                      <div class="form-group">
                        <label for="exampleSelect1">Select Order</label>
                        <select class="form-control" id="order" name="order">
                          <?php echo loadSupplyOrderIntoCombo(); ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label class="control-label">Container Reference</label>
                        <input class="form-control" type="text" name="containerref" placeholder="Enter container reference">
                      </div>
                      <div class="form-group">
                        <label class="control-label">Container Description</label>
                        <textarea class="form-control" rows="4" name="description" placeholder="Enter container description"></textarea>
                      </div>
                      <div class="form-group">
                        <label class="control-label">Buying Price</label>
                        <input class="form-control" type="text" name="buyingprice" placeholder="Enter buying price">
                      </div>
                      <div class="form-group">
                        <label class="control-label">Expenses</label>
                        <input class="form-control" type="text" name="expenses" placeholder="Enter expenses">
                      </div>
                      <div class="form-group">
                        <label for="exampleSelect1">Does Container has Deficit</label>
                        <select class="form-control" id="hasdeficit" name="hasdeficit">
                          <?php echo loadYesNoIntoCombo(); ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label class="control-label">Deficit Description</label>
                        <textarea class="form-control" rows="4" name="deficitdesc" placeholder="Enter deficit description"></textarea>
                      </div>
                      <div class="form-group">
                        <label for="exampleSelect1">Does Container has Outstanding</label>
                        <select class="form-control" id="hasoutstanding" name="hasoutstanding">
                          <?php echo loadYesNoIntoCombo(); ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label class="control-label">Outstanding Description</label>
                        <textarea class="form-control" rows="4" name="outstandingdesc" placeholder="Enter outstanding description"></textarea>
                      </div>
                      <div class="form-group">
                        <label class="control-label">Shipping Date</label>
                        <input class="form-control" type="date" name="shippingdate" placeholder="Enter shipping date">
                      </div>
                      <div class="form-group">
                        <label class="control-label">Seaport Arrival Date</label>
                        <input class="form-control" type="date" name="seaportdate" placeholder="Enter seaport arrival date">
                      </div>
                      <div class="form-group">
                        <label class="control-label">Clearance Date</label>
                        <input class="form-control" type="date" name="clearancedate" placeholder="Enter clearance date">
                      </div>
                      <div class="form-group">
                        <label class="control-label">Date moved to Ware House</label>
                        <input class="form-control" type="date" name="warehousedate" placeholder="Enter date moved to ware house">
                      </div>
                    </form>
                  </div>
                  <div class="tile-footer">
                    <button class="btn btn-primary" type="button" id="btnAddNewContainer"><i class="fa fa-fw fa-lg fa-check-circle"></i>Proceed</button>&nbsp;&nbsp;&nbsp;
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
    <script type="text/javascript" src="../container.js"></script>
  </body>
</html>