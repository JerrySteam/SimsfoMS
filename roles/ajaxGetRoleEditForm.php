<?php

    $path = "../";
	require_once $path.'@core/core.php';
	require_once $path.'@core/helperFunction.php';

	if(isset($_POST)){
		$roleid = cleanInput($_POST['roleid']);

        if( $roleid < 1){
            $err = 'Unauthorized Request. Process Terminated.';
        }else{
            $roledata = getRoleDataById($roleid);
            if($roledata == false){
                $err = 'Error Encountered. Role record not found.';
            }else{
                $err = '
                        <div class="row">
                          <div class="col-md-6 offset-3">
                          <h3 class="tile-title">Role Information</h3>
                          <div class="tile-body">
                            <form id="frmAddRole" method="post" action="javascript:void(0)">
                              <div class="form-group">
                                <label class="control-label">Role Name</label>
                                <input class="form-control" type="text" name="rolename" value="'.$roledata['role'].'" placeholder="Enter role name">
                                <input type="hidden" name="roleid" value="'.$roledata['roleid'].'">
                              </div>                      
                            </form>
                          </div>
                          <div class="tile-footer">
                            <button class="btn btn-primary" type="button" id="btnEditRole"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Changes</button>&nbsp;&nbsp;&nbsp;
                          </div>
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