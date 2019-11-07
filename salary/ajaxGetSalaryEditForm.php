<?php

    $path = "../";
  	require_once $path.'@core/core.php';
  	require_once $path.'@core/helperFunction.php';

  	if(isset($_POST)){
  		  $salaryid = cleanInput($_POST['salaryid']);

        if($salaryid < 1){
            $err = 'Unauthorized Request. Process Terminated.';
        }else{
            $salarydata = getSalaryRecordById($salaryid);
            if($salarydata == false){
                $err = 'Error Encountered. Salary record not found.';
            }else{
                $err = '
                        <div class="col-md-12">
                          <h3 class="tile-title">Edit Salary Information</h3>
                          <div class="tile-body">
                            <form id="frmPaySalary" method="post" action="javascript:void(0)">
                              <div class="form-group">
                                <label for="exampleSelect1">Select Employee</label>
                                <select class="form-control sel2" id="employee" name="employee">
                                  '.loadEmployeeIntoCombo($salarydata['employeeid']).'
                                </select>
                              </div>
                              <div class="row">
                                <div class="form-group col-md-6">
                                  <label for="exampleSelect1">Select Year</label>
                                  <select class="form-control sel2" id="year" name="year">
                                    '.loadYearIntoCombo($salarydata['yearid']).'
                                  </select>
                                </div>
                                <div class="form-group col-md-6">
                                  <label for="exampleSelect1">Select Month</label>
                                  <select class="form-control sel2" id="month" name="month">
                                    '.loadMonthIntoCombo($salarydata['monthid']).'
                                  </select>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label">Amount (&#8358;)</label>
                                <input class="form-control" type="number" min="1" name="amount" value="'.$salarydata['amount'].'" placeholder="Enter amount">
                              </div>
                              <div class="form-group">
                                <label for="exampleSelect1">Select Salary Type</label>
                                <select class="form-control sel2" id="type" name="type">
                                  '.loadSalaryTypeIntoCombo($salarydata['salarytype']).'
                                </select>
                              </div>
                              <input class="form-control" type="hidden" name="salaryid" value="'.$salarydata['salaryid'].'">
                            </form>
                          </div>
                          <div class="tile-footer">
                            <button class="btn btn-primary" type="button" id="btnEditSalary"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Changes</button>&nbsp;&nbsp;&nbsp;
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