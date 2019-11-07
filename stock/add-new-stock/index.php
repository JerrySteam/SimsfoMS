<?php
  $path = "../../";
  $activePage = "stock";
  $pageTitle = "Add New Stock";
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
          <h1><i class="fa fa-dashboard"></i> Add New Stock</h1>
          <p>Start a beautiful journey here</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-stock"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-stock"><a href="#">Add New Stock</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="row">
                <div class="col-md-12">
                  <h3 class="tile-title"><a href="../view-stock" class="btn btn-xs btn-primary" title="View Stocks"><i class="fa fa-search-plus"></i> View Stocks</a> &nbsp &nbsp &nbsp &nbsp Stock Information</h3>
                  <div class="tile-body">
                    <form id="frmAddStock" method="post" action="javascript:void(0)">
                      <div class="row">
                        <div class="form-group col-md-6">
                          <label for="exampleSelect1">Select Container</label>
                          <select class="form-control" id="container" name="container">
                            <?php echo loadContainerIntoCombo(); ?>
                          </select>
                          Cost Price Ratio: <span style="color:red" id="ratio"></span>
                          <input type="hidden" id="cpratio" name="cpratio"/>
                        </div>
                        <div class="form-group col-md-3">
                          <label for="exampleSelect1">Select Currency</label>
                          <select class="form-control" id="currency" name="currency">
                            <?php echo loadCurrencyIntoCombo(); ?>
                          </select>
                        </div>
                        <div class="form-group col-md-3">
                          <label for="exampleSelect1">Convertion Rate</label>
                          <input class="form-control" type="text" id="convertionrate" name="convertionrate" placeholder="Convertion rate to Naira">
                        </div>
                      </div>
                      <hr>
                      <div id="field0">
                        <div class="row">
                          <div class="form-group col-md-3">
                            <label class="control-label">Stock Reference</label>
                            <select class="form-control stockref" id="stockref0" rel="0" name="stockref[]"></select>
                          </div>
                          <div class="form-group col-md-5">
                            <label class="control-label">Stock Name</label>
                            <input class="form-control stockname" type="text" id="stockname0" rel="0" name="stockname[]" placeholder="Stock name" readonly="readonly">
                          </div>
                          <div class="form-group col-md-2">
                            <label class="control-label">Stock kg</label>
                            <input class="form-control weight" type="number" id="weight0" rel = "0" name="weight[]" placeholder="Stock kg" readonly="readonly">
                          </div>
                          <div class="form-group col-md-2">
                            <label class="control-label">Quantity</label>
                            <input class="form-control quantity" type="number" name="quantity[]" id="quantity0" rel ="0" placeholder="Enter quantity">
                          </div>
                          <div class="form-group col-md-4">
                            <label class="control-label">Buying Price (<span class="double-strikethrough">N</span>)</label>
                            <input class="form-control buyingprice" type="number" name="buyingprice[]" id="buyingprice0" rel="0" placeholder="Enter buying price" rel="0">
                          </div>
                          <div class="form-group col-md-4">
                            <label class="control-label">Cost Price (<span class="double-strikethrough">N</span>)</label>
                            <input class="form-control costprice" type="number" name="costprice[]" id="costprice0" rel="0" placeholder="Cost price" readonly="readonly">
                          </div>
                          <div class="form-group col-md-4">
                            <label class="control-label">Unit Selling Price (<span class="double-strikethrough">N</span>): <span style="color:red" id="unitsellingprice0" class="usprice"></span></label>
                            <input class="form-control unitsellingprice" type="number" name="unitsellingprice[]" id="unitsellingprice" rel="0" placeholder="Enter unit selling price">
                          </div>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <div class="col-md-12 text-right">
                          <button id="add-more" name="add-more" class="btn btn-primary"><i class="fa fa-plus"></i> Add Another Stock</button>
                        </div>
                      </div>                     
                    </form>
                  </div>
                  <div class="tile-footer">
                    <button class="btn btn-primary" type="button" id="btnAddNewStock"><i class="fa fa-fw fa-lg fa-check-circle"></i>Proceed</button>&nbsp;&nbsp;&nbsp;
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
    <script type="text/javascript" src="../stock.js"></script>
  </body>
</html>