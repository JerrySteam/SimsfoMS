<?php

    $path = "../";
	require_once $path.'@core/core.php';
	require_once $path.'@core/helperFunction.php';

	if(isset($_POST)){
		$supplyorderid = cleanInput($_POST['supplyorder']);

        if( $supplyorderid < 1){
            $err = 'Unauthorized Request. Process Terminated.';
        }else{
            $supplyorderdata = getSupplyOrderRecordById($supplyorderid);
            if($supplyorderdata == false){
                $err = 'Error Encountered. Container record not found.';
            }else{
                $supplyorder = $supplyorderdata[0];
                $err = '
                        <div class="row">
                          <div class="col-md-12">
                            <div class="tile-body">
                              <form id="frmAddSupplyOrder" method="post" action="javascript:void(0)">
                                <div class="form-group">
                                  <label class="control-label">Order Reference</label>
                                  <input class="form-control" type="text" name="orderref" placeholder="Enter order reference" value="'.$supplyorder['orderno'].'">
                                </div>
                                <div class="form-group">
                                  <label for="exampleSelect1">Select Supplier</label>
                                  <select class="form-control" id="supplier" name="supplier">
                                    '.loadSupplierIntoCombo($supplyorder['supplierid']).'
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label class="control-label">Date Ordered</label>
                                  <input class="form-control" type="date" name="dateordered" placeholder="Enter ordered date" value="'.$supplyorder['dateordered'].'">
                                </div>
                                <div class="form-group">
                                  <label class="control-label">Total Cost</label>
                                  <input class="form-control" type="number" min="1" name="totalcost" placeholder="Enter total cost" value="'.$supplyorder['totalcost'].'">
                                  <input class="form-control" type="hidden" name="supplyorderid" value="'.$supplyorder['orderid'].'">
                                </div>
                              </form>
                            </div>
                            <div class="tile-footer">
                              <button class="btn btn-primary" type="button" id="btnEditSupplyOrder"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Changes</button>&nbsp;&nbsp;&nbsp;
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