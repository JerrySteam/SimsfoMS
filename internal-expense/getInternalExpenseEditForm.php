<?php

    $path = "../";
	require_once $path.'@core/core.php';
	require_once $path.'@core/helperFunction.php';

	if(isset($_POST)){
		$expenseid = cleanInput($_POST['expenseid']);

        if( $expenseid < 1){
            $err = 'Unauthorized Request. Process Terminated.';
        }else{
            $internalexpensedata = getInternalExpenseRecordById($expenseid);
            if($internalexpensedata == false){
                $err = 'Error Encountered. Container record not found.';
            }else{
                $expensedata = $internalexpensedata[0];
                $d = new DateTime($expensedata['datecreated']);
                $datepaid = $d->format('Y-m-d');
                $err = '
                        <div class="row">
                          <div class="col-md-12">
                            <div class="tile-body">
                              <form id="frmAddInternalExpense" method="post" action="javascript:void(0)">
                                <div class="form-group col-md-12">
                                  <label class="control-label">Description</label>
                                  <input class="form-control description" type="text" name="description" id="description0" rel="0" placeholder="Enter expense description" value="'.$expensedata['description'].'">
                                  <input type="hidden" name="expenseid" value="'.$expensedata['expenseid'].'"/>
                                </div>
                                <div class="form-group col-md-12">
                                  <label class="control-label">Amount</label>
                                  <input class="form-control amount" type="number" min="1" name="amount" id="amount0" rel="0" placeholder="Enter expense amount" value="'.$expensedata['amount'].'">
                                </div>
                                <div class="form-group col-md-12">
                                  <label for="exampleSelect1">Approved by</label>
                                  <select class="form-control approvedby" name="approvedby" id="approvedby0" rel="0">
                                    '.loadEmployeeIntoCombo($expensedata['approvedby']).'
                                  </select>
                                </div>
                              </form>
                            </div>
                            <div class="tile-footer">
                              
                              <button class="btn btn-primary" type="button" id="btnEditInternalExpense"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Changes</button>&nbsp;&nbsp;&nbsp;
                             
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