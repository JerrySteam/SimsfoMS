<?php

    $path = "../";
  require_once $path.'@core/core.php';
  require_once $path.'@core/helperFunction.php';

  if(isset($_POST)){
    $supplierid = cleanInput($_POST['supplierid']);

        if($supplierid < 1){
            $err = 'Unauthorized Request. Process Terminated.';
        }else{
            $supplierdata = getSupplierRecordById($supplierid);
            if($supplierdata == false){
                $err = 'Error Encountered. Customer record not found.';
            }else{
                $supplier = $supplierdata[0];
                $err = '
                      <div class="col-md-12">
                        <h3 class="tile-title">Supplier Account Information</h3>
                        <div class="tile-body">
                          <form id="frmAddTransaction" method="post" action="javascript:void(0)">
                            <div class="form-group">
                              <label for="exampleSelect1">Supplier</label>
                              <h6 class="form-control">'.$supplier['fullname'].'</h6>
                              <input type="hidden" class="form-control supplierid" id="supplierid" name="supplierid" value="'.$supplier['supplierid'].'">
                            </div>
                            <div class="form-group">
                              <label class="control-label">Description</label>
                              <input class="form-control" type="text" name="invoiceref" placeholder="Enter transaction description">
                            </div>
                            <div class="form-group">
                              <label for="exampleSelect1">Currency</label>
                              <select class="form-control currency" id="currency" name="currency">
                                '.loadCurrencyIntoCombo().'
                              </select>
                            </div>
                            <div class="form-group">
                              <label class="control-label">Amount</label>
                              <input class="form-control" type="number" name="amount" placeholder="Enter amount">
                            </div>
                            <div class="form-group">
                              <label for="exampleSelect1">Transaction Type</label>
                              <select class="form-control transactiontype" id="transactiontype" name="transactiontype">
                                '.loadTransactionTypeIntoCombo().'
                              </select>
                            </div>
                            <div class="form-group">
                              <label class="control-label">Comment (<i>optional</i>)</label>
                              <textarea class="form-control" rows="4" id="comment" name="comment" placeholder="Enter comment"></textarea>
                            </div>
                          </form>
                        </div>
                        <div class="tile-footer">
                          <button class="btn btn-primary" type="button" id="btnAddTransaction"><i class="fa fa-fw fa-lg fa-check-circle"></i>Proceed</button>&nbsp;&nbsp;&nbsp;
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