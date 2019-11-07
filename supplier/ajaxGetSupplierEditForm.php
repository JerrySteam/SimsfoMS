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
                        <div class="row">
                            <div class="col-md-12">
                          <div class="tile-body">
                            <form id="frmAddSupplier" method="post" action="javascript:void(0)">
                              <div class="form-group">
                                <label class="control-label">Full Name</label>
                                <input class="form-control" type="text" name="fullname" placeholder="Enter full name" value="'.$supplier['fullname'].'">
                              </div>
                              <div class="form-group">
                                <label class="control-label">Phone Number</label>
                                <input class="form-control" type="text" name="phonenumber" placeholder="Enter phone number" value="'.$supplier['phonenumber'].'">
                              </div>
                               <div class="form-group">
                                <label class="control-label">Email</label>
                                <input class="form-control" type="email" name="email" placeholder="Enter email address" value="'.$supplier['email'].'">
                              </div>
                              <div class="form-group">
                                <label for="exampleSelect1">Select Country of Residence</label>
                                <select class="form-control" id="country" name="country">
                                  '.loadCountryIntoCombo($supplier['countryid']).'
                                </select>
                              </div>
                              <div class="form-group">
                                <label class="control-label">Contact Address</label>
                                <textarea class="form-control" rows="4" name="address" placeholder="Enter your address">'.$supplier['contactaddress'].'</textarea>
                                <input class="form-control" type="hidden" name="supplierid" value="'.$supplier['supplierid'].'">
                              </div>
                            </form>
                          </div>
                          <div class="tile-footer">
                            <button class="btn btn-primary pull-right" type="button" id="btnEditSupplier"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Changes</button>
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