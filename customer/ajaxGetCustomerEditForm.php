<?php

    $path = "../";
	require_once $path.'@core/core.php';
	require_once $path.'@core/helperFunction.php';

	if(isset($_POST)){
		$customerid = cleanInput($_POST['customerid']);

        if( $customerid < 1){
            $err = 'Unauthorized Request. Process Terminated.';
        }else{
            $customerdata = getCustomerRecordById($customerid);
            if($customerdata == false){
                $err = 'Error Encountered. Customer record not found.';
            }else{
                $customer = $customerdata[0];
                $err = '
                        <div class="row">
                            <div class="col-md-12">
                          <div class="tile-body">
                            <form id="frmAddCustomer" method="post" action="javascript:void(0)">
                              <div class="form-group">
                                <label class="control-label">Full Name</label>
                                <input class="form-control" type="text" name="fullname" placeholder="Enter full name" value="'.$customer['fullname'].'">
                              </div>
                              <div class="form-group">
                                <label class="control-label">Phone Number</label>
                                <input class="form-control" type="text" name="phonenumber" placeholder="Enter phone number" value="'.$customer['phonenumber'].'">
                              </div>
                               <div class="form-group">
                                <label class="control-label">Email</label>
                                <input class="form-control" type="email" name="email" placeholder="Enter email address" value="'.$customer['email'].'">
                              </div>
                              <div class="form-group">
                                <label for="exampleSelect1">Select Country of Residence</label>
                                <select class="form-control sel2" id="country" name="country">
                                  '.loadCountryIntoCombo($customer['countryid']).'
                                </select>
                              </div>
                              <div class="form-group">
                                <label class="control-label">Contact Address</label>
                                <textarea class="form-control" rows="4" name="address" placeholder="Enter your address">'.$customer['contactaddress'].'</textarea>
                                <input class="form-control" type="hidden" name="customerid" value="'.$customer['customerid'].'">
                              </div>
                            </form>
                          </div>
                          <div class="tile-footer">
                            <button class="btn btn-primary pull-right" type="button" id="btnEditCustomer"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Changes</button>
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