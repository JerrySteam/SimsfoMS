<?php

    $path = "../";
	require_once $path.'@core/core.php';
	require_once $path.'@core/helperFunction.php';

	if(isset($_POST)){
		$containerid = cleanInput($_POST['containerid']);

        if( $containerid < 1){
            $err = 'Unauthorized Request. Process Terminated.';
        }else{
            $containerdata = getContainerRecordById($containerid);
            if($containerdata == false){
                $err = 'Error Encountered. Container record not found.';
            }else{
                $container = $containerdata[0];
                $err = '
                        <div class="row">
                          <div class="col-md-12">
                            <div class="tile-body">
                              <form id="frmAddContainer" method="post" action="javascript:void(0)">
                                <div class="form-group">
                                  <label for="exampleSelect1">Select Order</label>
                                  <select class="form-control" id="order" name="order">
                                    '.loadSupplyOrderIntoCombo($container['supplyorderid']).'
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label class="control-label">Container Reference</label>
                                  <input class="form-control" type="text" name="containerref" placeholder="Enter conatiner reference" value="'.$container['containerref'].'">
                                </div>
                                <div class="form-group">
                                  <label class="control-label">Container Description</label>
                                  <textarea class="form-control" rows="4" name="description" placeholder="Enter container description">'.$container['description'].'</textarea>
                                </div>
                                <div class="form-group">
                                  <label class="control-label">Buying Price</label>
                                  <input class="form-control" type="text" name="buyingprice" placeholder="Enter buying price" value="'.$container['buyingprice'].'">
                                </div>
                                <div class="form-group">
                                  <label class="control-label">Expenses</label>
                                  <input class="form-control" type="text" name="expenses" placeholder="Enter expenses" value="'.$container['expenses'].'">
                                </div>
                                <div class="form-group">
                                  <label for="exampleSelect1">Does Container has Deficit</label>
                                  <select class="form-control" id="hasdeficit" name="hasdeficit">
                                    '.loadYesNoIntoCombo($container['hasdeficit']).'
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label class="control-label">Deficit Description</label>
                                  <textarea class="form-control" rows="4" name="deficitdesc" placeholder="Enter deficit description">'.$container['deficitdesc'].'</textarea>
                                </div>
                                <div class="form-group">
                                  <label for="exampleSelect1">Does Container has Outstanding</label>
                                  <select class="form-control" id="hasoutstanding" name="hasoutstanding">
                                    '.loadYesNoIntoCombo($container['hasoutstanding']).'
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label class="control-label">Outstanding Description</label>
                                  <textarea class="form-control" rows="4" name="outstandingdesc" placeholder="Enter outstanding description">'.$container['outstandingdesc'].'</textarea>
                                </div>
                                <div class="form-group">
                                  <label class="control-label">Shipping Date</label>
                                  <input class="form-control" type="date" name="shippingdate" placeholder="Enter shipping date" value="'.$container['shippingdate'].'">
                                </div>
                                <div class="form-group">
                                  <label class="control-label">Seaport Arrival Date</label>
                                  <input class="form-control" type="date" name="seaportdate" placeholder="Enter seaport arrival date" value="'.$container['seaportarrivaldate'].'">
                                </div>
                                <div class="form-group">
                                  <label class="control-label">Clearance Date</label>
                                  <input class="form-control" type="date" name="clearancedate" placeholder="Enter clearance date" value="'.$container['clearancedate'].'">
                                </div>
                                <div class="form-group">
                                  <label class="control-label">Date moved to Ware House</label>
                                  <input class="form-control" type="date" name="warehousedate" placeholder="Enter date moved to ware house" value="'.$container['datemovedtowarehouse'].'">
                                  <input class="form-control" type="hidden" name="containerid" value="'.$container['containerid'].'">
                                </div>
                              </form>
                            </div>
                            <div class="tile-footer">
                              <button class="btn btn-primary" type="button" id="btnEditContainer"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Changes</button>&nbsp;&nbsp;&nbsp;
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