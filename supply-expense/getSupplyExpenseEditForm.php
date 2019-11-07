<?php

    $path = "../";
	require_once $path.'@core/core.php';
	require_once $path.'@core/helperFunction.php';

	if(isset($_POST)){
		$expenseid = cleanInput($_POST['expenseid']);

        if( $expenseid < 1){
            $err = 'Unauthorized Request. Process Terminated.';
        }else{
            $supplyexpensedata = getSupplyExpenseRecordById($expenseid);
            if($supplyexpensedata == false){
                $err = 'Error Encountered. Container record not found.';
            }else{
                $expensedata = $supplyexpensedata[0];
                $d = new DateTime($expensedata['datecreated']);
                $datepaid = $d->format('Y-m-d');
                $err = '
                        <div class="row">
                          <div class="col-md-12">
                            <div class="tile-body">
                              <form id="frmAddSupplyExpense" method="post" action="javascript:void(0)">
                                <div class="form-group">
                                    <label class="control-label">Order Reference</label>
                                    <select class="form-control" id="orderid" name="orderid">
                                      '.loadSupplyOrderIntoCombo($expensedata['orderid']).'
                                    </select>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label">Description</label>
                                    <input class="form-control" type="text" name="description" placeholder="Enter expense description" value="'.$expensedata['description'].'">
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label">Amount</label>
                                    <input class="form-control" type="number" min="1" name="amount" placeholder="Enter expense amount" value="'.$expensedata['amount'].'">
                                    <input class="form-control" type="hidden" name="expenseid" value="'.$expensedata['expenseid'].'">
                                  </div>
                              </form>
                            </div>
                            <div class="tile-footer">
                              
                              <button class="btn btn-primary" type="button" id="btnEditSupplyExpense"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Changes</button>&nbsp;&nbsp;&nbsp;
                             
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