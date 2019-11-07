<?php

  $path = "../";
	require_once $path.'@core/core.php';
	require_once $path.'@core/helperFunction.php';

	if(isset($_POST)){
		$supplyorderpaymentid = cleanInput($_POST['supplyorderpayment']);

        if( $supplyorderpaymentid < 1){
            $err = 'Unauthorized Request. Process Terminated.';
        }else{
            $supplyorderpaymentdata = getSupplyOrderPaymentRecordById($supplyorderpaymentid);
            if($supplyorderpaymentdata == false){
                $err = 'Error Encountered. Container record not found.';
            }else{
                $supplyorderpayment = $supplyorderpaymentdata[0];
                $d = new DateTime($supplyorderpayment['datepaid']);
                $datepaid = $d->format('Y-m-d');
                $err = '
                        <div class="row">
                          <div class="col-md-12">
                            <div class="tile-body">
                              <form id="frmAddSupplyOrderPayment" method="post" action="javascript:void(0)">
                                <div class="form-group">
                                  <label class="control-label">Payment Reference</label>
                                  <input class="form-control" type="text" name="paymentref" value="'.$supplyorderpayment['paymentref'].'" disabled/>
                                </div>
                                <div class="form-group">
                                  <label for="exampleSelect1">Order Reference</label>
                                  <select class="form-control" id="orderid" name="orderid" disabled>
                                    '.loadSupplyOrderIntoCombo($supplyorderpayment['orderid']).'
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label class="control-label">Amount Paid</label>
                                  <input class="form-control" type="text" min="1" name="amountpaid" placeholder="Enter amount paid" value="'.formatAmount($supplyorderpayment['amountpaid']).'" disabled>
                                </div>
                                
                                <div class="form-group">
                                  <label class="control-label">Outstanding Amount</label>
                                  <input class="form-control" type="text" min="1" name="totalcost" placeholder="Enter total cost" value="'.formatAmount($supplyorderpayment['outstanding']).'" disabled>
                                </div>
                                <div class="form-group">
                                  <label for="exampleSelect1">Payment Currency</label>
                                  <select class="form-control" id="currency" name="currency" disabled="disabled">
                                    '.loadCurrencyIntoCombo($supplyorderpayment['currencyid']).'
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label class="control-label">Date Paid</label>
                                  <input class="form-control" type="date" name="datepaid" placeholder="Enter date paid" value="'.$datepaid.'" disabled>
                                </div>
                                <div class="form-group">
                                  <label class="control-label">Due Date</label>
                                  <input class="form-control" type="date" name="duedate" placeholder="Enter due date" value="'.$supplyorderpayment['duedate'].'" disabled>
                                </div>
                                <div class="form-group">
                                  <label for="exampleSelect1">Select Type of Payment</label>
                                  <select class="form-control" id="paymenttype" name="paymenttype" disabled>
                                    '.loadPaymentTypeIntoCombo($supplyorderpayment['paymenttype']).'
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label for="exampleSelect1">Select Mode of Payment</label>
                                  <select class="form-control" id="paymentmode" name="paymentmode" disabled>
                                    '.loadPaymentModeIntoCombo($supplyorderpayment['paymentmode']).'
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label class="control-label">Comment(s)</label>
                                  <textarea class="form-control" rows="4" id="comment" name="comment" placeholder="Enter comment" disabled="disabled">'.$supplyorderpayment['comment'].'</textarea>
                                </div>
                              </form>
                            </div>
                            <div class="tile-footer">
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