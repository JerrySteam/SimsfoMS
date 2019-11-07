<?php

    $path = "../";
  	require_once $path.'@core/core.php';
  	require_once $path.'@core/helperFunction.php';

  	if(isset($_POST)){
  		$roleid = cleanInput($_POST['roleid']);

        if( $roleid < 1){
            $err = 'Unauthorized Request. Process Terminated.';
        }else{
            $roledata = getRolePrivilegeDataByRoleId($roleid);
            if($roledata == false){
                $err = 'Error Encountered. Role record not found.';
            }else{
                $err = '
                        <div class="col-md-12">
                          <h3 class="tile-title">Edit Role Privilege</h3>
                          <div class="tile-body">
                            <form id="frmAddRolePrivilege" method="post" action="javascript:void(0)">
                              <div class="form-group">
                                <label class="control-label">Select Role</label>
                                <select class="form-control sel2" id="roleid" name="roleid">
                                  '.loadRoleIntoCombo($roleid).'
                                </select>
                              </div>
                              <div class="form-group">
                                <label class="control-label">Select Privilege</label> <br/><br/>
                                <div class="row">'.getAllPrivilegeChecklist($roledata).'</div>
                              </div>                      
                            </form>
                          </div>
                          <div class="tile-footer">
                            <button class="btn btn-primary" type="button" id="btnEditRolePrivilege"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Changes</button>&nbsp;&nbsp;&nbsp;
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