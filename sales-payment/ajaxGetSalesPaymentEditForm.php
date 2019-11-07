<?php

    $path = "../";
	require_once $path.'@core/core.php';
	require_once $path.'@core/helperFunction.php';

	if(isset($_POST)){
		$salesid = cleanInput($_POST['salesid']);

        if( $salesid < 1){
            $err = 'Unauthorized Request. Process Terminated.';
        }else{
            $salesdata = getSalesRecordById($salesid);
            if($salesdata == false){
                $err = 'Error Encountered. Container record not found.';
            }else{
                $sales = $salesdata[0];
                $err = '
                        <div class="row">
                          <div class="col-md-12">
                            <div class="tile-body">
                              <form id="frmAddSales" method="post" action="javascript:void(0)">
                                <div class="form-group">
                                  <label class="control-label">Sales Reference</label>
                                  <input class="form-control" type="text" name="salesref" readonly="" placeholder="Enter sales reference" value="'.$sales['salesref'].'">
                                </div>
                                <div class="form-group">
                                  <label for="exampleSelect1">Select Customer</label>
                                  <select class="form-control sel2" id="customer" name="customer">
                                    '.loadCustomerIntoCombo($sales['customerid']).'
                                  </select>
                                </div>
                                 <div class="form-group">
                                  <label class="control-label">Sales Date</label>
                                  <input class="form-control" type="date" name="salesdate" placeholder="Enter sales date" value="'.$sales['salesdate'].'">
                                </div>
                                <div class="form-group">
                                  <label for="exampleSelect1">Select Type of Payment</label>
                                  <select class="form-control sel2" id="paymenttype" name="paymenttype">
                                    '.loadPaymentTypeIntoCombo($sales['typeofpayment']).'
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label for="exampleSelect1">Select Mode of Payment</label>
                                  <select class="form-control sel2" id="paymentmode" name="paymentmode">
                                    '.loadPaymentModeIntoCombo($sales['modeofpayment']).'
                                  </select>
                                  <input class="form-control" type="hidden" name="salesid" value="'.$sales['salesid'].'">
                                </div>
                                <div class="form-group">
                                  <label class="control-label">Comment</label>
                                  <textarea class="form-control" name="comment" placeholder="Comment" rows="3">'.$sales['comment'].'</textarea>
                                </div>
                              </form>
                            </div>
                            <div class="tile-footer">
                              <button class="btn btn-primary" type="button" id="btnEditSales"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Changes</button>&nbsp;&nbsp;&nbsp;
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