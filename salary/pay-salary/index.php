<?php
  $path = "../../";
  $activePage = "salary";
  $pageTitle = "Pay Salary";
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
          <h1><i class="fa fa-dashboard"></i> Pay Salary</h1>
          <p>Start a beautiful journey here</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Pay Salary</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="row">
                <div class="col-md-3">
                  <a href="../view-salary" class="btn btn-xs btn-primary" title="View Salary"><i class="fa fa-search-plus"></i> View Salary</a>
                </div>
                <div class="col-md-6">
                  <h3 class="tile-title">Pay Salary</h3>
                  <div class="tile-body">
                    <form id="frmPaySalary" method="post" action="javascript:void(0)">
                      <div class="form-group">
                        <label for="exampleSelect1">Select Employee</label>
                        <select class="form-control sel2" id="employee" name="employee">
                          <?php echo loadEmployeeIntoCombo(); ?>
                        </select>
                      </div>
                      <div class="row">
                        <div class="form-group col-md-6">
                          <label for="exampleSelect1">Select Year</label>
                          <select class="form-control sel2" id="year" name="year">
                            <?php echo loadYearIntoCombo(); ?>
                          </select>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="exampleSelect1">Select Month</label>
                          <select class="form-control sel2" id="month" name="month">
                            <?php echo loadMonthIntoCombo(); ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label">Amount (&#8358;)</label>
                        <input class="form-control" type="number" min="1" name="amount" placeholder="Enter amount">
                      </div>
                      <div class="form-group">
                        <label for="exampleSelect1">Select Salary Type</label>
                        <select class="form-control sel2" id="type" name="type">
                          <?php echo loadSalaryTypeIntoCombo(); ?>
                        </select>
                      </div>
                    </form>
                  </div>
                  <div class="tile-footer">
                    <button class="btn btn-primary" type="button" id="btnPaySalary"><i class="fa fa-fw fa-lg fa-check-circle"></i>Proceed</button>&nbsp;&nbsp;&nbsp;
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
    <script type="text/javascript" src="../salary.js"></script>
  </body>
</html>