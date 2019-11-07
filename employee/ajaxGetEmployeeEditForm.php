<?php

    $path = "../";
	require_once $path.'@core/core.php';
	require_once $path.'@core/helperFunction.php';

	if(isset($_POST)){
		$employeeid = cleanInput($_POST['employeeid']);

        if($employeeid < 1){
            $err = 'Unauthorized Request. Process Terminated.';
        }else{
            $employeedata = getEmployeeRecordById($employeeid);
            if($employeedata == false){
                $err = 'Error Encountered. Employee record not found.';
            }else{
                $employee = $employeedata[0];
                $err = '
                        <div class="row">
                          <div class="col-md-12">
                            <div class="tile-body">
                              <form id="frmAddEmployee" method="post" action="javascript:void(0)">
                                <input class="form-control" type="hidden" name="employeeid" value="'.$employee['employeeid'].'">
                                <div class="form-group">
                                  <label class="control-label">Staff ID</label>
                                  <input class="form-control" type="text" name="staffid" placeholder="Enter Staff ID" value="'.$employee['staffid'].'">
                                </div>
                                <div class="form-group">
                                  <label class="control-label">Full Name</label>
                                  <input class="form-control" type="text" name="fullname" placeholder="Enter full name" value="'.$employee['fullname'].'">
                                </div>
                                <div class="form-group">
                                  <label class="control-label">Phone Number</label>
                                  <input class="form-control" type="text" name="phonenumber" placeholder="Enter phone number" value="'.$employee['phonenumber'].'">
                                </div>
                                 <div class="form-group">
                                  <label class="control-label">Email (<i>optional</i>)</label>
                                  <input class="form-control" type="email" name="email" placeholder="Enter email address" value="'.$employee['emailaddress'].'">
                                </div>
                                <div class="form-group">
                                  <label class="control-label">Contact Address</label>
                                  <textarea class="form-control" rows="4" name="address" placeholder="Enter your address">'.$employee['contactaddress'].'</textarea>
                                </div>
                                <div class="form-group">
                                  <label class="control-label">Date of Employment (<i>optional</i>)</label>
                                  <input class="form-control" type="date" name="employmentdate" placeholder="Enter employment date" value="'.$employee['dateemployed'].'">
                                </div>
                                <input type="hidden" name="employeeid" value="'.$employee['employeeid'].'">
                              </form>
                            </div>
                            <div class="tile-footer">
                              <button class="btn btn-primary" type="button" id="btnEditEmployee"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Changes</button>&nbsp;&nbsp;&nbsp;
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