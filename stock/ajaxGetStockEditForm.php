<?php

    $path = "../";
	require_once $path.'@core/core.php';
	require_once $path.'@core/helperFunction.php';

	if(isset($_POST)){
		$stockid = cleanInput($_POST['stockid']);
        
        if( $stockid < 1){
            $err = 'Unauthorized Request. Process Terminated.';
        }else{
            $stockdata = getStockRecordById($stockid);
            if($stockdata == false){
                $err = 'Error Encountered. Container record not found.';
            }else{
                $stock = $stockdata[0];
                $err = '
                        <div class="row">
                          <div class="col-md-12">
                            <div class="tile-body">
                              <form id="frmAddStock" method="post" action="javascript:void(0)">
                                <div class="row">
                                  <div class="form-group col-md-6">
                                    <label for="exampleSelect1">Select Container</label>
                                    <select class="form-control" id="container2" name="container" readonly="readonly">
                                      '.loadContainerIntoCombo($stock['containerid']).'
                                    </select>
                                    Cost Price Ratio: <span style="color:red" id="ratio"></span>
                                    <input type="hidden" id="cpratio" name="cpratio"/>
                                    <input type="hidden" name="stockid" value ="'.$stockid.'"/>
                                  </div>
                                  <div class="form-group col-md-6">
                                    <label class="control-label">Stock Reference</label>
                                    <select class="form-control stockref" id="stockref0" rel="0" name="stockref" readonly="readonly">
                                      '.loadSupplierStockListIntoCombo($stock['supplierid'], $stock['sr']).'
                                    </select>
                                  </div>
                                  <div class="form-group col-md-6">
                                    <label class="control-label">Stock Name</label>
                                    <input class="form-control stockname" type="text" id="stockname0" rel="0" name="stockname" placeholder="Stock name" value ="'.$stock['stockname'].'" readonly="readonly">
                                  </div>
                                  <div class="form-group col-md-6">
                                    <label class="control-label">Stock kg</label>
                                    <input class="form-control weight" type="number" id="weight0" rel = "0" name="weight" placeholder="Stock kg" value ="'.$stock['weight'].'" readonly="readonly">
                                  </div>
                                  <div class="form-group col-md-6">
                                    <label class="control-label">Quantity</label>
                                    <input class="form-control quantity" type="number" name="quantity" id="quantity0" rel ="0" placeholder="Enter quantity" value ="'.$stock['quantity'].'">
                                  </div>
                                  <div class="form-group col-md-6">
                                    <label class="control-label">Buying Price (<span class="double-strikethrough">N</span>)</label>
                                    <input class="form-control buyingprice" type="number" name="buyingprice" id="buyingprice0" rel="0" placeholder="Enter buying price" rel="0" value ="'.$stock['bp'].'">
                                  </div>
                                  <div class="form-group col-md-6">
                                    <label class="control-label">Cost Price (<span class="double-strikethrough">N</span>)</label>
                                    <input class="form-control costprice" type="number" name="costprice" id="costprice0" rel="0" placeholder="Cost price" value ="'.$stock['cp'].'" readonly="readonly">
                                  </div>
                                  <div class="form-group col-md-6">
                                    <label class="control-label">Unit Selling Price (<span class="double-strikethrough">N</span>): <span style="color:red" id="unitsellingprice0" class="usprice"></span></label>
                                    <input class="form-control unitsellingprice" type="number" name="unitsellingprice" id="unitsellingprice" rel="0" placeholder="Enter unit selling price" value ="'.$stock['sp'].'">
                                  </div>
                                </div>                    
                              </form>
                            </div>
                            <div class="tile-footer">
                              <button class="btn btn-primary" type="button" id="btnEditStock"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Changes</button>&nbsp;&nbsp;&nbsp;
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