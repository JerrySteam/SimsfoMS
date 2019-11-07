<?php
  $path = "../../";
  $activePage = "role-privilege";
  $pageTitle = "Add New Role Privilege";
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
          <h1><i class="fa fa-dashboard"></i> Add New Role Privilege</h1>
          <p>Start a beautiful journey here</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Add New Role Privilege</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">              
              <div class="row">   
                <div class="col-md-4">
                  <a href="../view-role-privilege" class="btn btn-xs btn-primary" title="View Role Privilege"><i class="fa fa-search-plus"></i> View Role Privilege</a>
                </div>
                <div class="col-md-8">
                  <h3 class="tile-title">Add New Role Privilege</h3>
                </div>
              </div>    
              <div class="row">           
                <div class="col-md-1"></div>
                <div class="col-md-10">
                  <div class="tile-body">
                    <form id="frmAddRolePrivilege" method="post" action="javascript:void(0)">
                      <div class="form-group">
                        <label class="control-label">Select Role</label>
                        <select class="form-control sel2" id="roleid" name="roleid">
                          <?php echo loadRoleIntoCombo(); ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label class="control-label">Select Privilege</label> <br/>
                        <div class="row"><?php echo getAllPrivilegeChecklist(); ?></div>
                      </div>                      
                    </form>
                  </div>
                  <div class="tile-footer">
                    <button class="btn btn-primary" type="button" id="btnAddNewRolePrivilege"><i class="fa fa-fw fa-lg fa-check-circle"></i>Proceed</button>&nbsp;&nbsp;&nbsp;
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

    <script type="text/javascript" src="../roleprivilege.js"></script>
  </body>
</html>