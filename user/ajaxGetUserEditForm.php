<?php

    $path = "../";
	require_once $path.'@core/core.php';
	require_once $path.'@core/helperFunction.php';

	if(isset($_POST)){
		  $userid = cleanInput($_POST['userid']);

      if($userid < 1){
          $err = 'Unauthorized Request. Process Terminated.';
      }else{
          $userdata = getUserRecordById($userid);
          if($userdata == false){
              $err = 'Error Encountered. Employee record not found.';
          }else{
              $err = '
                      <div class="col-md-12">
                        <h3 class="tile-title">Edit User Information</h3>
                        <div class="tile-body">
                          <form id="frmAddUser" method="post" action="javascript:void(0)">
                            <div class="form-group">
                              <label for="exampleSelect1">Select Employee</label>
                              <select class="form-control sel2" id="employee" name="employee">
                                '.loadEmployeeIntoCombo($userdata['employeeid']).'
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="exampleSelect1">Select Role</label>
                              <select class="form-control sel2" id="role" name="role">
                                '.loadRoleIntoCombo($userdata['roleid']).'
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="exampleSelect1">Select Status</label>
                              <select class="form-control sel2" id="status" name="status">
                                '.loadStatusIntoCombo($userdata['status']).'
                              </select>
                            </div>
                            <input type="hidden" name="userid" value="'.$userdata['userid'].'" />
                          </form>
                        </div>
                        <div class="tile-footer">
                          <button class="btn btn-primary" type="button" id="btnEditUser"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Changes</button>&nbsp;&nbsp;&nbsp;
                        </div>
                      </div>
                  ';
          }            
      }
      echo $err;
	}else{
        echo 'Unauthorized Request. Process Terminated';
	}

?>