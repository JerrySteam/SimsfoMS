<?php
  $path = "../../";
  $activePage = "role";
  $pageTitle = "Add New Roles";
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
          <h1><i class="fa fa-dashboard"></i> Add New Role</h1>
          <p>Start a beautiful journey here</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Add New Role</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">              
              <div class="row">   
                <div class="col-md-3">
                  <a href="../view-roles" class="btn btn-xs btn-primary" title="View Roles"><i class="fa fa-search-plus"></i> View Roles</a>
                </div>             
                <div class="col-md-6">
                  <h3 class="tile-title">Role Information</h3>
                  <div class="tile-body">
                    <form id="frmAddRole" method="post" action="javascript:void(0)">
                      <div class="form-group">
                        <label class="control-label">Role Name</label>
                        <input class="form-control" type="text" name="rolename" placeholder="Enter role name">
                      </div>                      
                    </form>
                  </div>
                  <div class="tile-footer">
                    <button class="btn btn-primary" type="button" id="btnAddNewRole"><i class="fa fa-fw fa-lg fa-check-circle"></i>Proceed</button>&nbsp;&nbsp;&nbsp;
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

    <script type="text/javascript" src="../role.js"></script>
  </body>
</html>