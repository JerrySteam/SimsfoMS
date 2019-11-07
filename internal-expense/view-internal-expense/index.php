<?php
  $path = "../../";
  $activePage = "supply-expense";
  $pageTitle = "View Internal Expense";
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
          <h1><i class="fa fa-dashboard"></i> View Internal Expense</h1>
          <p>Start a beautiful journey here</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">View Internal Expense</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title"><a href="../add-new-internal-expense" class="btn btn-xs btn-primary" title="Add New Internal Expense"><i class="fa fa-plus"></i> Add New Internal Expense</a> Internal Expense Record </h3>
            <div class="tile-body">
              <?php echo viewInternalExpense();?>
            </div>
          </div>
        </div>
      </div>
    </main>
    <!-- End main content-->
    <?php echo getModal('editInternalExpenseModal', 'Edit Internal Expense Record'); ?>
    <!-- Essential javascripts for application to work-->
    <?php echo getCoreJSFiles($path); ?>
    <!-- End Essential javascripts for application to work-->
    <!-- Page specific javascripts-->
    <!-- Data table plugin-->
    <script type="text/javascript">$('#viewInternalExpenseTable').DataTable({
      dom: 'Bfrtip',
        buttons: [
            'print'
        ]
    });</script>
    <script type="text/javascript" src="../internalexpense.js"></script>
  </body>
</html>