<?php

    $path = "../";
	require_once $path.'@core/core.php';
	require_once $path.'@core/helperFunction.php';

	if(isset($_POST)){
		$bankaccountid = cleanInput($_POST['bankaccountid']);

        if( $bankaccountid < 1){
            $err = 'Unauthorized Request. Process Terminated.';
        }else{
            $bankaccount = getBankAccountRecordById($bankaccountid);
            if($bankaccount == false){
                $err = 'Error Encountered. Bank Account record not found.';
            }else{
                $bankaccount = $bankaccount;
                $err = '
                        <div class="row">
                          <div class="col-md-12">
                            <div class="tile-body">
                              <form id="frmAddBankAccount" method="post" action="javascript:void(0)">
                                <input class="form-control" type="hidden" name="bankaccountid" value="'.$bankaccount['bankaccountid'].'">
                                <div class="form-group">
                                  <label for="exampleSelect1">Select Bank</label>
                                  <select class="form-control sel2" id="bank" name="bank">
                                    '.loadBankIntoCombo($bankaccount['bankid']).'
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label class="control-label">Account Name</label>
                                  <input class="form-control" type="text" name="accountname" placeholder="Enter account name" value="'.$bankaccount['accountname'].'">
                                </div>
                                <div class="form-group">
                                  <label class="control-label">Account Number</label>
                                  <input class="form-control" type="text" name="accountnumber" placeholder="Enter account number" value="'.$bankaccount['accountno'].'">
                                </div>
                                 <div class="form-group">
                                  <label class="control-label">Sort Code</label>
                                  <input class="form-control" type="text" name="sortcode" placeholder="Enter bank sort code" value="'.$bankaccount['sortcode'].'">                                  
                                </div>                      
                              </form>
                            </div>
                            <div class="tile-footer">
                              <button class="btn btn-primary" type="button" id="btnEditBankAccount"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Changes</button>&nbsp;&nbsp;&nbsp;
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