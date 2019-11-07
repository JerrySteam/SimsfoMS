<?php
  $path = "../../";
  $activePage = "role-privilege";
  $pageTitle = "View Role Privilege";
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
          <h1><i class="fa fa-dashboard"></i> View Role Privilege</h1>
          <p>Start a beautiful journey here</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">View Role Privilege</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="row">
              <div class="col-md-4">
                <h3 class="tile-title">
                  <a href="../add-new-role-privilege" class="btn btn-xs btn-primary" title="Add New Role Privilege"><i class="fa fa-plus"></i> Add New Role Privilege</a>
                </h3>
              </div>
              <div class="col-md-8">
                <h3 class="tile-title">Role Privilege Records</h3>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="tile-body">
                  <?php echo ViewRolePrivileges(); ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <!-- End main content-->

    <?php echo getModal('editRolePrivilegeModal', 'Edit Role Privilege Record'); ?>
    <!-- End main content-->

    <!-- Essential javascripts for application to work-->
    <?php echo getCoreJSFiles($path); ?>
    <!-- End Essential javascripts for application to work-->

    <!-- Page specific javascripts-->
    <!-- Data table plugin-->
    <script type="text/javascript">
      $('#viewRolePrivilegeTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'print'
        ]
      });
    </script>
    <script type="text/javascript" src="../roleprivilege.js"></script>
  </body>
</html>