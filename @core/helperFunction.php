<?php

	require_once("core.php");


	/*Helper Methods*/

	function getStatusLabel($status = '')
	{
		switch ($status) {
			case 'Active':
				return '<span class="text-success"><i class="fa fa-check-circle-o"></i> Active</span>';
				break;

			case 'Paid':
				return '<span class="text-success"><i class="fa fa-check-circle-o"></i> Paid</span>';
				break;

			case 'Suspended':
				return '<span class="text-warning"><i class="fa fa-exclamation-triangle"></i> Suspended</span>';
				break;

			case 'Deactivated':
				return '<span class="text-danger"><i class="fa fa-times-circle-o"></i> Deactivated</span>';
				break;

			case 'Deleted':
				return '<span class="text-danger"><i class="fa fa-times-circle-o"></i> Deleted</span>';
				break;

			case 'Transferred':
				return '<span class="text-info"><i class="fa fa-share-square-o"></i> Transferred</span>';
				break;

			case 'Published':
				return '<span class="text-success"><i class="fa fa-check-circle-o"></i> Published</span>';
				break;

			case 'Not Published':
				return '<span class="text-info"><i class="fa fa-exclamation-triangle"></i> Not Published</span>';
				break;

			case 'Pending':
				return '<span class="text-warning"><i class="fa fa-exclamation-triangle"></i> Pending</span>';
				break;
			
			default:
				return '';
				break;
		}
	}

	function numberTowords($num)
	{ 
		$ones = array( 
					1 => "one", 
					2 => "two", 
					3 => "three", 
					4 => "four", 
					5 => "five", 
					6 => "six", 
					7 => "seven", 
					8 => "eight", 
					9 => "nine", 
					10 => "ten", 
					11 => "eleven", 
					12 => "twelve", 
					13 => "thirteen", 
					14 => "fourteen", 
					15 => "fifteen", 
					16 => "sixteen", 
					17 => "seventeen", 
					18 => "eighteen", 
					19 => "nineteen" 
				); 
		$tens = array( 
				1 => "ten",
				2 => "twenty", 
				3 => "thirty", 
				4 => "forty", 
				5 => "fifty", 
				6 => "sixty", 
				7 => "seventy", 
				8 => "eighty", 
				9 => "ninety" 
			); 
		$hundreds = array( 
				"hundred", 
				"thousand", 
				"million", 
				"billion", 
				"trillion", 
				"quadrillion" 
			); //limit t quadrillion 

		$num = number_format($num,2,".",","); 
		$num_arr = explode(".",$num); 
		$wholenum = $num_arr[0]; 
		$decnum = $num_arr[1]; 
		$whole_arr = array_reverse(explode(",",$wholenum)); 
		krsort($whole_arr,1); 
		$rettxt = ""; 
		foreach($whole_arr as $key => $i){			
			while(substr($i,0,1)=="0")
					$i=substr($i,1,5);

			if($i < 20){ 
				/* echo "getting:".$i; */
				$rettxt .= $ones[$i]; 
			}elseif($i < 100){ 
				if(substr($i,0,1)!="0")  $rettxt .= $tens[substr($i,0,1)]; 
				if(substr($i,1,1)!="0") $rettxt .= " ".$ones[substr($i,1,1)]; 
			}else{ 
				if(substr($i,0,1)!="0") $rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0]; 
				if(substr($i,1,1)!="0")$rettxt .= " ".$tens[substr($i,1,1)]; 
				if(substr($i,2,1)!="0")$rettxt .= " ".$ones[substr($i,2,1)]; 
			} 
			if($key > 0){ 
				$rettxt .= " ".$hundreds[$key]." "; 
			}
		} 

		if($decnum > 0){
			$rettxt .= " and ";
			if($decnum < 20){
				$rettxt .= $ones[$decnum];
			}elseif($decnum < 100){
				$rettxt .= $tens[substr($decnum,0,1)];
				$rettxt .= " ".$ones[substr($decnum,1,1)];
			}
		} 
		return $rettxt; 
	} 

	function convertNumberToWordsForCurrency($number)
	{
	    //A function to convert numbers into Indian readable words with Cores, Lakhs and Thousands.
	    $words = array(
	    '0'=> '' ,'1'=> 'one' ,'2'=> 'two' ,'3' => 'three','4' => 'four','5' => 'five',
	    '6' => 'six','7' => 'seven','8' => 'eight','9' => 'nine','10' => 'ten',
	    '11' => 'eleven','12' => 'twelve','13' => 'thirteen','14' => 'fouteen','15' => 'fifteen',
	    '16' => 'sixteen','17' => 'seventeen','18' => 'eighteen','19' => 'nineteen','20' => 'twenty',
	    '30' => 'thirty','40' => 'fourty','50' => 'fifty','60' => 'sixty','70' => 'seventy',
	    '80' => 'eighty','90' => 'ninty');
	    
	    //First find the length of the number
	    $number_length = strlen($number);
	    //Initialize an empty array
	    $number_array = array(0,0,0,0,0,0,0,0,0);        
	    $received_number_array = array();
	    
	    //Store all received numbers into an array
	    for($i=0;$i<$number_length;$i++){    
	  		$received_number_array[$i] = substr($number,$i,1);    
	  	}
	    //Populate the empty array with the numbers received - most critical operation
	    for($i=9-$number_length,$j=0;$i<9;$i++,$j++){ 
	        $number_array[$i] = $received_number_array[$j]; 
	    }
	    $number_to_words_string = "";
	    //Finding out whether it is teen ? and then multiply by 10, example 17 is seventeen, so if 1 is preceeded with 7 multiply 1 by 10 and add 7 to it.
	    for($i=0,$j=1;$i<9;$i++,$j++){
	        //"01,23,45,6,78"
	        //"00,10,06,7,42"
	        //"00,01,90,0,00"
	        if($i==0 || $i==2 || $i==4 || $i==7){
	            if($number_array[$j]==0 || $number_array[$i] == "1"){
	                $number_array[$j] = intval($number_array[$i])*10+$number_array[$j];
	                $number_array[$i] = 0;
	            }
	               
	        }
	    }
	    $value = "";
	    for($i=0;$i<9;$i++){
	        if($i==0 || $i==2 || $i==4 || $i==7){    
	            $value = $number_array[$i]*10; 
	        }
	        else{ 
	            $value = $number_array[$i];    
	        }            
	        if($value!=0)         {    $number_to_words_string.= $words["$value"]." "; }
	        if($i==1 && $value!=0){    $number_to_words_string.= "Billion "; }
	        if($i==3 && $value!=0){    $number_to_words_string.= "Million ";    }
	        if($i==5 && $value!=0){    $number_to_words_string.= "Thousand "; }
	        if($i==6 && $value!=0){    $number_to_words_string.= "Hundred &amp; "; }            
	    }
	    if($number_length>9){ $number_to_words_string = "Sorry This does not support more than 99 Crores"; }
	    return ucwords(strtolower($number_to_words_string)." Naira Only.");
	}

	function generateUniqueRef($prefix="")
	{
		$random = time() . rand(10*45, 100*98);
		$ref = $prefix."".$random;
		return $ref;
		//Subsquently session will be used for 
		//passing the ref for security reason
	}

	
	//Sanitizes Inputs
	function cleanInput($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		$data = addslashes($data);

		return $data;
	}

	function formatAmount($number)
	{
		return number_format($number, 2, '.', ',');
	}

	function formatdate($dbdate)
	{
		$time = strtotime($dbdate);

	    $r = date("M d, Y", $time);

	    if (strlen($dbdate) > 10) {
	        $r = date("M d, Y", $time);
	    }

	    return $r;
	}

	function getPaymentTypeById($paymenttypeid)
	{
		try {			
			global $dbh;

			$query = "SELECT * FROM tblpaymenttype WHERE id='".$paymenttypeid."'";
			$rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);
			//return $query;
			if($count > 0){
				return $rs[0]['paymenttype'];
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}

	function getPaymentModeById($paymentmodeid)
	{
		try {			
			global $dbh;

			$query = "SELECT * FROM tblpaymentmode WHERE id='".$paymentmodeid."'";
			$rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);
			//return $query;
			if($count > 0){
				return $rs[0]['paymentmode'];
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}

	function getCustomerInfoById($customerid)
	{
		try {			
			global $dbh;

			$query = "SELECT * FROM tblcustomer WHERE customerid='".$customerid."'";
			$rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);
			//return $query;
			if($count > 0){
				return $rs[0];
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}

	function getBankRecordById($bankid)
	{
		try {			
			global $dbh;

			$query = "SELECT * FROM tblbank WHERE bankid='".$bankid."'";
			$rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);
			//return $query;
			if($count > 0){
				return $rs[0];
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}



	//Login Method
	function validateLogin($username, $password)
	{
		$sessionHandler = new HmsSessionHandler();

		try {
			$query = "SELECT staffid, fullname, emailaddress, e.employeeid 
						FROM tblemployee AS e 
						INNER JOIN tbluser AS u 
						ON e.employeeid = u.employeeid 
						WHERE (e.emailaddress='".$username."' OR e.staffid='".$username."') AND e.password='".$password."' AND u.status = 'Active'";
			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);

			if($count > 0){
				//return setUserSessions($stmt->staffid);
				$sessionHandler->createSession('login_user', $rs[0]['employeeid']);
				$sessionHandler->createSession('staff_id', $rs[0]['staffid']);
				$sessionHandler->createSession('full_name', strtoupper($rs[0]['fullname']));
				$sessionHandler->createSession('email_address', strtolower($rs[0]['emailaddress']));
				return true;
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}

	/*Load into Combo Methods*/
	function loadCountryIntoCombo($param_cat = '')
	{
		$r = '';

		try {
			$query = "SELECT * FROM tblcountries ORDER BY name ASC";

			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);
			
			if($count > 0){

				$r .= "<option value = '-1'>Select Country</option>";

				foreach ($rs as $countries => $country) {

					if($country['id'] == $param_cat){
						$r .= "<option value='" . $country['id'] . "' selected='selected'>" . $country['name'] . "</option>";
						$cat_found = true;
					}else{
						$r .= "<option value='" . $country['id'] . "'>" . $country['name'] . "</option>";
					}
				}
				
			}else{
				$r .= "<option value = '-1'>No Record Found</option>";
			}
		} catch (Exception $e) {
			return '-1';
			//return $e->getMessage();
		}

		return $r;
	}

	function loadBankIntoCombo($param_cat = '')
	{
		$r = '';

		try {
			$query = "SELECT * FROM tblbank ORDER BY bankname ASC";

			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);
			
			if($count > 0){

				$r .= "<option value = '-1'>Select Bank</option>";

				foreach ($rs as $banks => $bank) {

					if($bank['bankid'] == $param_cat){
						$r .= "<option value='" . $bank['bankid'] . "' selected='selected'>" . $bank['bankname'] . "</option>";
						$cat_found = true;
					}else{
						$r .= "<option value='" . $bank['bankid'] . "'>" . $bank['bankname'] . "</option>";
					}
				}
				
			}else{
				$r .= "<option value = '-1'>No Record Found</option>";
			}
		} catch (Exception $e) {
			return '-1';
			//return $e->getMessage();
		}

		return $r;
	}

	function loadSupplyOrderIntoCombo($param_cat = '')
	{
		$r = '';

		try {
			$query = "SELECT * 
						FROM tblsupplyorder AS so
						INNER JOIN tblsupplier AS s
						ON so.supplierid = s.supplierid 
						ORDER BY dateordered ASC";

			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);
			
			if($count > 0){

				$r .= "<option value = '-1'>Select Supply Order</option>";

				foreach ($rs as $orders => $order) {

					if($order['orderid'] == $param_cat){
						$r .= "<option value='" . $order['orderid'] . "' selected='selected'> ".$order['orderno']." (".$order['fullname'].")</option>";
						$cat_found = true;
					}else{
						$r .= "<option value='" . $order['orderid'] . "'> ".$order['orderno']." (".$order['fullname'].")</option>";
					}
				}
				
			}else{
				$r .= "<option value = '-1'>No Record Found</option>";
			}
		} catch (Exception $e) {
			return '-1';
			//return $e->getMessage();
		}

		return $r;
	}

	function loadContainerIntoCombo($param_cat = '')
	{
		$r = '';

		try {
			$query = "SELECT *, s.fullname AS supplier 
						FROM tblcontainer AS c
						INNER JOIN tblsupplyorder AS so
						INNER JOIN tblsupplier AS s
						ON c.supplyorderid = so.orderid 
						AND so.supplierid = s.supplierid
						WHERE c.status = '1'
						ORDER BY c.datecreated ASC";

			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);
			
			if($count > 0){

				$r .= "<option value = '-1'>Select Order</option>";

				foreach ($rs as $orders => $order) {

					if($order['containerid'] == $param_cat){
						$r .= "<option value='" . $order['containerid'] . "' selected='selected'> ".$order['containerref']." (".$order['supplier'].")</option>";
						$cat_found = true;
					}else{
						$r .= "<option value='" . $order['containerid'] . "'> ".$order['containerref']." (".$order['supplier'].")</option>";
					}
				}
				
			}else{
				$r .= "<option value = '-1'>No Record Found</option>";
			}
		} catch (Exception $e) {
			return '-1';
			//return $e->getMessage();
		}

		return $r;
	}

	function loadCustomerIntoCombo($param_cat = '')
	{
		$r = '';

		try {
			$query = "SELECT * 
						FROM tblcustomer 
						ORDER BY datecreated ASC";

			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);
			
			if($count > 0){

				$r .= "<option value = '-1'>Select Customer</option>";

				foreach ($rs as $customers => $customer) {

					if($customer['customerid'] == $param_cat){
						$r .= "<option value='" . $customer['customerid'] . "' selected='selected'> ".$customer['fullname']."</option>";
						$cat_found = true;
					}else{
						$r .= "<option value='" . $customer['customerid'] . "'> ".$customer['fullname']." </option>";
					}
				}
				
			}else{
				$r .= "<option value = '-1'>No Record Found</option>";
			}
		} catch (Exception $e) {
			return '-1';
			//return $e->getMessage();
		}

		return $r;
	}

	function loadStockIntoCombo($param_cat = '')
	{
		$r = '';

		try {
			$query = "SELECT * 
						FROM tblstock 
						WHERE lastmodified IS NULL
						ORDER BY dateadded ASC";

			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);
			
			if($count > 0){

				$r .= "<option value = '-1'>Select Stock</option>";

				foreach ($rs as $stocks => $stock) {

					if($stock['stockid'] == $param_cat){
						$r .= "<option value='" . $stock['stockid'] . "' rel='".$stock['unitsellingprice']."' selected='selected'> ".$stock['stockname']." (".$stock['stockref'].")</option>";
						$cat_found = true;
					}else{
						$r .= "<option value='" . $stock['stockid'] . "' rel='".$stock['unitsellingprice']."'> ".$stock['stockname']." (".$stock['stockref'].") </option>";
					}
				}
				
			}else{
				$r .= "<option value = '-1'>No Record Found</option>";
			}
		} catch (Exception $e) {
			return '-1';
			//return $e->getMessage();
		}

		return $r;
	}

	function loadSupplierIntoCombo($param_cat = '')
	{
		$r = '';

		try {
			$query = "SELECT * 
						FROM tblsupplier 
						ORDER BY datecreated ASC";

			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);
			
			if($count > 0){

				$r .= "<option value = '-1'>Select Supplier</option>";

				foreach ($rs as $suppliers => $supplier) {

					if($supplier['supplierid'] == $param_cat){
						$r .= "<option value='" . $supplier['supplierid'] . "' selected='selected'> ".ucwords($supplier['fullname'])."</option>";
						$cat_found = true;
					}else{
						$r .= "<option value='" . $supplier['supplierid'] . "'> ".ucwords($supplier['fullname'])." </option>";
					}
				}
				
			}else{
				$r .= "<option value = '-1'>No Record Found</option>";
			}
		} catch (Exception $e) {
			return '-1';
			//return $e->getMessage();
		}

		return $r;
	}

	function loadSupplierStockListIntoCombo($supplierid='', $param_cat = '')
	{
		$r = '';

		try {
			$query = "SELECT * FROM tblsupplierstocklist
						WHERE supplierid = '$supplierid' 
						ORDER BY stockid ASC";

			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);
			
			if($count > 0){

				$r .= "<option value = '-1'>Select Stock</option>";

				foreach ($rs as $stocks => $stock) {

					if($stock['stockid'] == $param_cat){
						$r .= "<option value='" . $stock['stockid'] . "' selected='selected'> ".ucwords($stock['stockref'])."</option>";
						$cat_found = true;
					}else{
						$r .= "<option value='" . $stock['stockid'] . "'> ".ucwords($stock['stockref'])." </option>";
					}
				}
				
			}else{
				$r .= "<option value = '-1'>No Record Found</option>";
			}
		} catch (Exception $e) {
			return '-1';
			//return $e->getMessage();
		}

		return $r;
	}

	function loadEmployeeIntoCombo($param_cat = '')
	{
		$r = '';

		try {
			$query = "SELECT * 
						FROM tblemployee 
						ORDER BY datecreated ASC";

			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);
			
			if($count > 0){

				$r .= "<option value = '-1'>Select Employee</option>";

				foreach ($rs as $employees => $employee) {

					if($employee['employeeid'] == $param_cat){
						$r .= "<option value='" . $employee['employeeid'] . "' selected='selected'> ".ucwords($employee['fullname'])."</option>";
						$cat_found = true;
					}else{
						$r .= "<option value='" . $employee['employeeid'] . "'> ".ucwords($employee['fullname'])." </option>";
					}
				}
				
			}else{
				$r .= "<option value = '-1'>No Record Found</option>";
			}
		} catch (Exception $e) {
			return '-1';
			//return $e->getMessage();
		}

		return $r;
	}

	function loadPaymentTypeIntoCombo($param_cat = '')
	{
		$r = '';

		try {
			$query = "SELECT * 
						FROM tblpaymenttype 
						ORDER BY paymenttype ASC";

			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);
			
			if($count > 0){

				$r .= "<option value = '-1'>Select Payment Type</option>";

				foreach ($rs as $paymenttypes => $paymenttype) {

					if($paymenttype['id'] == $param_cat){
						$r .= "<option value='" . $paymenttype['id'] . "' selected='selected'> ".$paymenttype['paymenttype']."</option>";
						$cat_found = true;
					}else{
						$r .= "<option value='" . $paymenttype['id'] . "'> ".$paymenttype['paymenttype']." </option>";
					}
				}
				
			}else{
				$r .= "<option value = '-1'>No Record Found</option>";
			}
		} catch (Exception $e) {
			return '-1';
			//return $e->getMessage();
		}

		return $r;
	}

	function loadPaymentModeIntoCombo($param_cat = '')
	{
		$r = '';

		try {
			$query = "SELECT * 
						FROM tblpaymentmode 
						ORDER BY paymentmode ASC";

			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);
			
			if($count > 0){

				$r .= "<option value = '-1'>Select Payment Mode</option>";

				foreach ($rs as $paymentmodes => $paymentmode) {

					if($paymentmode['id'] == $param_cat){
						$r .= "<option value='" . $paymentmode['id'] . "' selected='selected'> ".$paymentmode['paymentmode']."</option>";
						$cat_found = true;
					}else{
						$r .= "<option value='" . $paymentmode['id'] . "'> ".$paymentmode['paymentmode']." </option>";
					}
				}
				
			}else{
				$r .= "<option value = '-1'>No Record Found</option>";
			}
		} catch (Exception $e) {
			return '-1';
			//return $e->getMessage();
		}

		return $r;
	}

	function loadYesNoIntoCombo($param_cat = '')
	{
		$r = '';
		switch ($param_cat){
			case 'Yes':
				$r .= "<option value='-1'> Select </option>";
				$r .= "<option value='Yes' selected='selected'> Yes </option>";
				$r .= "<option value='No'> No </option>";
				break;

			case 'No':
				$r .= "<option value='-1'> Select </option>";
				$r .= "<option value='Yes'> Yes </option>";
				$r .= "<option value='No' selected='selected'> No </option>";
				break;

			default:
				$r .= "<option value='-1'> Select </option>";
				$r .= "<option value='Yes'> Yes </option>";
				$r .= "<option value='No'> No </option>";
				break;
		}
		return $r;
	}

	function loadCurrencyIntoCombo($param_cat='')
	{
		$r = '';

		try {
			$query = "SELECT * FROM tblcurrency ORDER BY currencyname ASC";

			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);
			
			if($count > 0){

				$r .= "<option value = '-1'>Select Currency</option>";

				foreach ($rs as $currencies => $currency) {

					if($currency['currencyid'] == $param_cat){
						$r .= "<option value='" . $currency['currencyid'] . "' selected='selected'> ".$currency['currencyname']." (".$currency['accronym'].")</option>";
						$cat_found = true;
					}else{
						$r .= "<option value='" . $currency['currencyid'] . "'> ".$currency['currencyname']." (".$currency['accronym'].")</option>";
					}
				}
				
			}else{
				$r .= "<option value = '-1'>No Record Found</option>";
			}
		} catch (Exception $e) {
			return '-1';
			//return $e->getMessage();
		}

		return $r;
	}

	function loadTransactionTypeIntoCombo($param_cat='')
	{
		$r = '';

		try {
			$query = "SELECT * FROM tbltransactiontype ORDER BY transactionname ASC";

			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);
			
			if($count > 0){

				$r .= "<option value = '-1'>-Select Transaction Type-</option>";

				foreach ($rs as $transactiontypes => $transactiontype) {

					if($transactiontype['transactiontypeid'] == $param_cat){
						$r .= "<option value='" . $transactiontype['transactiontypeid'] . "' selected='selected'> ".$transactiontype['transactionname']."</option>";
						$cat_found = true;
					}else{
						$r .= "<option value='" . $transactiontype['transactiontypeid'] . "'> ".$transactiontype['transactionname']."</option>";
					}
				}
				
			}else{
				$r .= "<option value = '-1'>No Record Found</option>";
			}
		} catch (Exception $e) {
			return '-1';
			//return $e->getMessage();
		}

		return $r;
	}

	function loadRoleIntoCombo($param_cat = '')
	{
		$r = '';

		try {
			$query = "SELECT * 
						FROM tblrole 
						ORDER BY role ASC";

			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);
			
			if($count > 0){
				$r .= "<option value = '-1'>Select Role</option>";
				foreach ($rs as $roles => $role) {
					if($role['roleid'] == $param_cat){
						$r .= "<option value='" . $role['roleid'] . "' selected='selected'> ".$role['role']."</option>";
					}else{
						$r .= "<option value='" . $role['roleid'] . "'> ".$role['role']." </option>";
					}
				}				
			}else{
				$r .= "<option value = '-1'>No Record Found</option>";
			}
		} catch (Exception $e) {
			return '-1';
			//return $e->getMessage();
		}

		return $r;
	}

	function loadYearIntoCombo($param_cat = '')
	{
		$r = '';

		try {
			$query = "SELECT * 
						FROM tblyear 
						ORDER BY year DESC";

			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);
			
			if($count > 0){
				$r .= "<option value = '-1'>Select Year</option>";
				foreach ($rs as $years => $year) {
					if($year['id'] == $param_cat){
						$r .= "<option value='" . $year['id'] . "' selected='selected'> ".$year['year']."</option>";
					}else{
						$r .= "<option value='" . $year['id'] . "'> ".$year['year']." </option>";
					}
				}				
			}else{
				$r .= "<option value = '-1'>No Record Found</option>";
			}
		} catch (Exception $e) {
			return '-1';
			//return $e->getMessage();
		}

		return $r;
	}

	function loadMonthIntoCombo($param_cat = '')
	{
		$r = '';

		try {
			$query = "SELECT * 
						FROM tblmonth
						ORDER BY id ASC";

			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);
			
			if($count > 0){
				$r .= "<option value = '-1'>Select Month</option>";
				foreach ($rs as $months => $month) {
					if($month['id'] == $param_cat){
						$r .= "<option value='" . $month['id'] . "' selected='selected'> ".$month['month']."</option>";
					}else{
						$r .= "<option value='" . $month['id'] . "'> ".$month['month']." </option>";
					}
				}				
			}else{
				$r .= "<option value = '-1'>No Record Found</option>";
			}
		} catch (Exception $e) {
			return '-1';
			//return $e->getMessage();
		}

		return $r;
	}

	function loadStatusIntoCombo($param_cat = '')
	{
		$r = '';
		switch ($param_cat){
			case 'Active':
				$r .= "<option value='-1'> Select Status </option>";
				$r .= "<option value='Active' selected='selected'> Active </option>";
				$r .= "<option value='Disabled'> Disabled </option>";
				break;

			case 'Disabled':
				$r .= "<option value='-1'> Select Status </option>";
				$r .= "<option value='Active'> Active </option>";
				$r .= "<option value='Disabled' selected='selected'> Disabled </option>";
				break;

			default:
				$r .= "<option value='-1'> Select Status </option>";
				$r .= "<option value='Active'> Active </option>";
				$r .= "<option value='Disabled'> Disabled </option>";
				break;
		}
		return $r;
	}

	function loadSalaryTypeIntoCombo($param_cat = '')
	{
		$r = '';
		switch ($param_cat){
			case 'Monthly':
				$r .= "<option value='-1'> Select Salary Type </option>";
				$r .= "<option value='Monthly' selected='selected'> Monthly </option>";
				$r .= "<option value='Advance'> Advance </option>";
				break;

			case 'Advance':
				$r .= "<option value='-1'> Select Salary Type </option>";
				$r .= "<option value='Monthly'> Monthly </option>";
				$r .= "<option value='Advance' selected='selected'> Advance </option>";
				break;

			default:
				$r .= "<option value='-1'> Select Salary Type </option>";
				$r .= "<option value='Monthly'> Monthly </option>";
				$r .= "<option value='Advance'> Advance </option>";
				break;
		}
		return $r;
	}

	function loadSalesIntoCombo($param_cat = '')
	{
		$r = '';

		try {
			$query = "SELECT * 
						FROM tblsales AS s
						INNER JOIN tblcustomer AS c
						ON s.customerid = c.customerid 
						GROUP BY salesref
						ORDER BY s.datecreated ASC";

			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);
			
			if($count > 0){

				$r .= "<option value = '-1'>Select Sales</option>";

				foreach ($rs as $sales => $sale) {

					if($sale['salesid'] == $param_cat){
						$r .= "<option value='" . $sale['salesid'] . "' selected='selected'> ".$sale['salesref']." (".$sale['fullname'].")</option>";
						$cat_found = true;
					}else{
						$r .= "<option value='" . $sale['salesid'] . "'> ".$sale['salesref']." (".$sale['fullname'].")</option>";
					}
				}
				
			}else{
				$r .= "<option value = '-1'>No Record Found</option>";
			}
		} catch (Exception $e) {
			return '-1';
			//return $e->getMessage();
		}

		return $r;
	}

	function loadBankAccountIntoCombo($param_cat = '')
	{
		$r = '';

		try {
			$query = "SELECT * 
						FROM tblbankaccount AS ba
						INNER JOIN tblbank AS b
						ON ba.bankid = b.bankid 
						WHERE ba.datemodified IS NULL
						ORDER BY b.bankname ASC";

			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);
			
			if($count > 0){

				$r .= "<option value = '-1'>Select Bank Account</option>";

				foreach ($rs as $bankaccounts => $bankaccount) {

					if($bankaccount['bankaccountid'] == $param_cat){
						$r .= "<option value='" . $bankaccount['bankaccountid'] . "' selected='selected'> ".$bankaccount['bankname']." (".$bankaccount['accountno'].")</option>";
						$cat_found = true;
					}else{
						$r .= "<option value='" . $bankaccount['bankaccountid'] . "'> ".$bankaccount['bankname']." (".$bankaccount['accountno'].")</option>";
					}
				}
				
			}else{
				$r .= "<option value = '-1'>No Record Found</option>";
			}
		} catch (Exception $e) {
			return '-1';
			//return $e->getMessage();
		}

		return $r;
	}

	/*Customer Module Methods*/

	function isCustomerEmailRegistered($email)
	{
		try {
			$query = "SELECT * FROM tblcustomer WHERE email = '".$email."'";
			//return $query;
			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);

		    if($count > 0){				
				return true;
				
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}

	function hasCustomerMadeTrasaction($customerid)
	{
		try {
			$query = "SELECT * FROM tblsales WHERE customerid = '".$customerid."'";
			//return $query;
			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);

		    if($count > 0){				
				return true;				
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}

	function ViewCustomers()
	{
		try {
			$query = "SELECT * FROM tblcustomer AS c
						INNER JOIN tblcountries AS co
						ON c.countryid = co.id
					";
			//return $query;
			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);

		    $r = ' <table class="table table-hover table-bordered" id="viewCustomerTable">
		                <thead>
		                  <tr>
		                    <th>SN</th>
		                    <th>Full Name</th>
		                    <th>Phone Number</th>
		                    <th>Email Address</th>
		                    <th>Residence Country</th>
		                    <th>Contact Address</th>
		                    <th>Action</th>
		                  </tr>
		                </thead>
	                    <tbody>
                ';
			
			if($count > 0){				
				$sn = 1;
				foreach ($rs as $customers => $customer) {
					$r .= '
							<tr>
								<td>'.$sn.'</td>
	                            <td>'.$customer['fullname'].'</td>
	                            <td>'.$customer['phonenumber'].'</td>
	                            <td>'.$customer['email'].'</td>
	                            <td>'.$customer['name'].'</td>
	                            <td>'.$customer['contactaddress'].'</td>
	                        	<td>
	                            	<a href="javascript:void(0)" id="edit'.$customer['customerid'].'" rel="'.$customer['customerid'].'" class="btnEditCustomer" title="edit"><i class="fa fa-edit"></i>
	                            	</a> &nbsp;&nbsp;&nbsp;&nbsp;
	                            	<a href="javascript:void(0)" id="delete'.$customer['customerid'].'" rel="'.$customer['customerid'].'" class=" btnDeleteCustomer" title="delete"><i class="fa fa-trash"></i>
	                            	</a>
	                            </td>
	                        </tr>';

					$sn++;
				}
				
			}else{
				$r .= '<tr><td colspan="8" class="text-center">No Record Found</td></tr>';
			}

			$r .= '		</tbody>
	                </table>';
			return $r;
		} catch (Exception $e) {
			return '<p class="text-danger">Error encountered while retrieving records</p>';
			//return $e->getMessage();
		}
	}

	function addNewCustomerRecord($fullname, $phone, $email, $country, $address, $edit = false, $id = 0)
	{
		global $dbh;
		$query = '';

		$date = '';
		$d = new DateTime($date);
		$cdate = $d->format('Y-m-d h:i:s');

		$userdata = getUserSessions();
		$loggedinuser = $userdata[0];

		try{
			// prepare sql and bind parameters
			if($edit == true){
				$cArray = array('fullname'=>$fullname, 'phonenumber'=>$phone, 'email'=>$email, 'countryid'=>$country, 'contactaddress'=>$address);
				$wArray = array('customerid'=>$id);
				$rs = $dbh->update('tblcustomer', $cArray, $wArray)->affectedRows();

				if($rs > 0){
					return 'success';
				}else{
					return false;
				}
				//return $query;
			}else{
				$cArray = array('fullname'=>$fullname, 'phonenumber'=>$phone, 'email'=>$email, 'countryid'=>$country, 'contactaddress'=>$address, 'createdby'=>$loggedinuser, 'datecreated'=>$cdate);
				$wArray = '';
				$lastId = $dbh->insert('tblcustomer', $cArray, $wArray)->getLastInsertId();

				if($lastId > 0){
					return 'success';
				}else{
					return false;
				}
			}
		} catch (Exception $e) {
			//return false;
			return $e->getMessage();
		}
	}

	function deleteCustomerRecord($customerid)
	{
		global $dbh;

		$userdata = getUserSessions();
		$loggedinuser = $userdata[0];

		try{
			// prepare sql and bind parameters
			$wArray = array('customerid'=>$customerid);
			$rs = $dbh->delete('tblcustomer', $wArray)->affectedRows();

			if($rs > 0){
				return 'success';
			}else{
				return false;
			}
		} catch (Exception $e) {
			//return false;
			return $e->getMessage();
		}
	}

	function getCustomerRecordById($customerid)
	{
		try {			
			global $dbh;

			$query = "SELECT * FROM tblcustomer WHERE customerid='".$customerid."'";
			$rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);
			//return $query;
			if($count > 0){
				return $rs;
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}


	/*Container Module Methods*/

	function isContainerRefRegistered($containerref)
	{
		try {
			$query = "SELECT * FROM tblcontainer WHERE containerref = '".$containerref."'";
			//return $query;
			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);

		    if($count > 0){				
				return true;
				
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}

	function isContainerWithStock($containerid)
	{
		try {
			$query = "SELECT * FROM tblstock WHERE containerid = '".$containerid."'";
			//return $query;
			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);

		    if($count > 0){				
				return true;				
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}

	function ViewContainers()
	{
		try {
			$query = "SELECT * FROM tblcontainer AS c
						INNER JOIN tblsupplyorder AS so
						INNER JOIN tblsupplier AS s
						ON c.supplyorderid = so.orderid
						AND so.supplierid = s.supplierid
					";
			//return $query;
			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);

		    $r = ' <table class="table table-hover table-bordered" id="viewContainerTable">
		                <thead>
		                  <tr>
		                    <th>SN</th>
		                    <th>Order No.</th>
		                    <th>Container Reference</th>
		                    <th>Buying Price</th>
		                    <th>Expenses</th>
		                    <th>No. of Stocks</th>
		                    <th>Supplier</th>
		                    <th>Action</th>
		                  </tr>
		                </thead>
	                    <tbody>
                ';
			
			if($count > 0){				
				$sn = 1;
				foreach ($rs as $containers => $container) {
					$r .= '
							<tr>
								<td>'.$sn.'</td>
	                            <td>'.$container['orderno'].'</td>
	                            <td>'.$container['containerref'].'</td>
	                            <td>'.$container['buyingprice'].'</td>
	                            <td>'.$container['expenses'].'</td>
	                            <td>'.getContainerStockCount($container['containerid']).'</td>
	                            <td>'.$container['fullname'].'</td>
	                		    <td>
	                            	<a href="javascript:void(0)" id="edit'.$container['containerid'].'" rel="'.$container['containerid'].'" class=" btnEditContainer" title="edit"><i class="fa fa-1x fa-edit"></i>
	                            	</a>&nbsp;&nbsp;
	                            	<a href="javascript:void(0)" id="view'.$container['containerid'].'" rel="'.$container['containerid'].'" class=" btnViewContainer" title="view"><i class="fa fa-1x fa-search"></i>
	                            	</a>&nbsp;&nbsp;
	                            	<a href="javascript:void(0)" id="delete'.$container['containerid'].'" rel="'.$container['containerid'].'" class="btnDeleteContainer" title="delete"><i class="fa fa-1x fa-trash"></i>
	                            	</a>
	                            </td>	                            
                    		</tr>
                    	';
					$sn++;
				}
				
			}else{
				$r .= '<tr><td colspan="9" class="text-center">No Record Found</td></tr>';
			}

			$r .= '		</tbody>
	                </table>';
			return $r;
		} catch (Exception $e) {
			return '<p class="text-danger">Error encountered while retrieving records</p>';
			//return $e->getMessage();
		}
	}

	function addNewContainerRecord($supplyorderid, $description, $hasdeficit, $deficitdesc, $hasoutstanding, $outstandingdesc, $containerref, $shippingdate, $seaportarrivaldate, $clearancedate, $datemovedtowarehouse, $buyingprice, $expenses, $edit = false, $id = 0)
	{
		global $dbh;
		$query = '';

		$date = '';
		$d = new DateTime($date);
		$cdate = $d->format('Y-m-d h:i:s');

		$userdata = getUserSessions();
		$loggedinuser = $userdata[0];

		try{
			// prepare sql and bind parameters
			if($edit == true){
				$cArray = array('supplyorderid'=>$supplyorderid, 
								'description'=>$description, 
								'hasdeficit'=>$hasdeficit, 
								'deficitdesc'=>$deficitdesc, 
								'hasoutstanding'=>$hasoutstanding,
								'outstandingdesc'=>$outstandingdesc,
								'containerref'=>$containerref,
								'shippingdate'=>$shippingdate,
								'seaportarrivaldate'=>$seaportarrivaldate,
								'clearancedate'=>$clearancedate,
								'datemovedtowarehouse'=>$datemovedtowarehouse,
								'buyingprice'=>$buyingprice,
								'expenses'=>$expenses);
				$wArray = array('containerid'=>$id);
				$rs = $dbh->update('tblcontainer', $cArray, $wArray)->affectedRows();

				if($rs > 0){
					return 'success';
				}else{
					return false;
				}
				//return $query;
			}else{
				$cArray = array('supplyorderid'=>$supplyorderid, 
								'description'=>$description, 
								'hasdeficit'=>$hasdeficit, 
								'deficitdesc'=>$deficitdesc, 
								'hasoutstanding'=>$hasoutstanding,
								'outstandingdesc'=>$outstandingdesc,
								'containerref'=>$containerref,
								'shippingdate'=>$shippingdate,
								'seaportarrivaldate'=>$seaportarrivaldate,
								'clearancedate'=>$clearancedate,
								'datemovedtowarehouse'=>$datemovedtowarehouse,
								'buyingprice'=>$buyingprice,
								'expenses'=>$expenses,
								'datecreated'=>$cdate,
								'createdby'=>$loggedinuser);
				$wArray = '';
				$lastId = $dbh->insert('tblcontainer', $cArray, $wArray)->getLastInsertId();

				if($lastId > 0){
					return 'success';
				}else{
					return false;
				}
			}
		} catch (Exception $e) {
			//return false;
			return $e->getMessage();
		}
	}

	function deleteContainerRecord($containerid)
	{
		global $dbh;

		$userdata = getUserSessions();
		$loggedinuser = $userdata[0];

		try{
			// prepare sql and bind parameters
			$wArray = array('containerid'=>$containerid);
			$rs = $dbh->delete('tblcontainer', $wArray)->affectedRows();

			if($rs > 0){
				return 'success';
			}else{
				return false;
			}
		} catch (Exception $e) {
			//return false;
			return $e->getMessage();
		}
	}

	function getContainerRecordById($containerid)
	{
		try {			
			global $dbh;

			$query = "SELECT * FROM tblcontainer AS c
						INNER JOIN tblsupplyorder AS so
						INNER JOIN tblsupplier AS s
						ON c.supplyorderid = so.orderid
						AND so.supplierid = s.supplierid
						WHERE c.containerid = '".$containerid."'
					";
			$rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);
			//return $query;
			if($count > 0){
				return $rs;
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}

	function getContainerStockCount($containerid)
	{
		try {			
			global $dbh;

			$query = "SELECT COUNT(*) AS total FROM tblcontainer WHERE containerid = '".$containerid."'";
			$rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);
			//return $query;
			if($count > 0){
				return $rs[0]['total'];
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}


	/*Employee Module Methods*/

	function isEmployeeEmailRegistered($email)
	{
		try {
			$query = "SELECT * FROM tblemployee WHERE emailaddress = '".$email."'";
			//return $query;
			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);

		    if($count > 0){				
				return true;
				
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}

	function isEmployeePhonenumberRegistered($phonenumber)
	{
		try {
			$query = "SELECT * FROM tblemployee WHERE phonenumber = '".$phonenumber."'";
			//return $query;
			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);

		    if($count > 0){				
				return true;
				
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}

	function isEmployeeUser($employeeid)
	{
		try {
			$query = "SELECT * FROM tbluser WHERE employeeid = '".$employeeid."'";
			//return $query;
			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);

		    if($count > 0){				
				return true;				
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}

	function ViewEmployees()
	{
		try {
			$query = "SELECT * FROM tblemployee";
			//return $query;
			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);

		    $r = ' <table class="table table-hover table-bordered" id="viewEmployeeTable">
		                <thead>
		                  <tr>
		                    <th>SN</th>
		                    <th>Staff ID</th>
		                    <th>Full Name</th>
		                    <th>Phone Number</th>
		                    <th>Email Address</th>
		                    <th>Contact Address</th>
		                    <th>Date of Employment</th>
		                    <th>Action</th>
		                  </tr>
		                </thead>
	                    <tbody>
                ';
			
			if($count > 0){				
				$sn = 1;
				foreach ($rs as $employees => $employee) {
					$r .= '
							<tr>
								<td>'.$sn.'</td>
	                            <td>'.$employee['staffid'].'</td>
	                            <td>'.$employee['fullname'].'</td>
	                            <td>'.$employee['phonenumber'].'</td>
	                            <td>'.$employee['emailaddress'].'</td>	                            
	                            <td>'.$employee['contactaddress'].'</td>
	                            <td>'.$employee['dateemployed'].'</td>
	                        	<td>
	                            	<a href="javascript:void(0)" id="edit'.$employee['employeeid'].'" rel="'.$employee['employeeid'].'" class="btnEditEmployee" title="edit"><i class="fa fa-edit"></i>
	                            	</a> &nbsp;&nbsp;&nbsp;&nbsp;
	                            	<a href="javascript:void(0)" id="delete'.$employee['employeeid'].'" rel="'.$employee['employeeid'].'" class=" btnDeleteEmployee" title="delete"><i class="fa fa-trash"></i>
	                            	</a>
	                            </td>
	                        </tr>';
					$sn++;
				}
				
			}else{
				$r .= '<tr><td colspan="8" class="text-center">No Record Found</td></tr>';
			}

			$r .= '		</tbody>
	                </table>';
			return $r;
		} catch (Exception $e) {
			return '<p class="text-danger">Error encountered while retrieving records</p>';
			//return $e->getMessage();
		}
	}

	function addNewEmployeeRecord($staffid, $fullname, $phone, $email, $address, $employmentdate, $edit = false, $id = 0)
	{
		global $dbh;
		$query = '';

		$date = '';
		$d = new DateTime($date);
		$cdate = $d->format('Y-m-d h:i:s');

		$userdata = getUserSessions();
		$loggedinuser = $userdata[0];

		try{
			// prepare sql and bind parameters
			if($edit == true){
				$cArray = array('staffid'=>$staffid, 'fullname'=>$fullname, 'phonenumber'=>$phone, 'emailaddress'=>$email, 'contactaddress'=>$address, 'dateemployed'=>$employmentdate);
				$wArray = array('employeeid'=>$id);
				$rs = $dbh->update('tblemployee', $cArray, $wArray)->affectedRows();

				if($rs > 0){
					return 'success';
				}else{
					return false;
				}
				//return $query;
			}else{
				$cArray = array('staffid'=>$staffid, 'fullname'=>$fullname, 'phonenumber'=>$phone, 'emailaddress'=>$email, 'contactaddress'=>$address, 'dateemployed'=>$employmentdate, 'password'=>'12345', 'datecreated'=>$cdate);
				$wArray = '';
				$lastId = $dbh->insert('tblemployee', $cArray, $wArray)->getLastInsertId();

				if($lastId > 0){
					return 'success';
				}else{
					return false;
				}
			}
		} catch (Exception $e) {
			//return false;
			return $e->getMessage();
		}
	}

	function deleteEmployeeRecord($employeeid)
	{
		global $dbh;

		try{
			// prepare sql and bind parameters
			$wArray = array('employeeid'=>$employeeid);
			$rs = $dbh->delete('tblemployee', $wArray)->affectedRows();

			if($rs > 0){
				return 'success';
			}else{
				return false;
			}
		} catch (Exception $e) {
			//return false;
			return $e->getMessage();
		}
	}

	function getEmployeeRecordById($employeeid)
	{
		try {			
			global $dbh;

			$query = "SELECT * FROM tblemployee WHERE employeeid='".$employeeid."'";
			$rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);
			//return $query;
			if($count > 0){
				return $rs;
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}

	/*Supplier Module Methods*/

	function isSupplierEmailRegistered($email)
	{
		try {
			$query = "SELECT * FROM tblsupplier WHERE email = '".$email."'";
			//return $query;
			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);

		    if($count > 0){				
				return true;
				
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}

	function hasSupplierMadeTrasaction($supplierid)
	{
		try {
			$query = "SELECT * FROM tblsupplyorder WHERE supplierid = '".$supplierid."'";
			//return $query;
			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);

		    if($count > 0){				
				return true;				
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}

	function ViewSuppliers()
	{
		try {
			$query = "SELECT * FROM tblsupplier AS s
						INNER JOIN tblcountries AS c
						ON s.countryid = c.id
					";
			//return $query;
			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);

		    $r = ' <table class="table table-hover table-bordered" id="viewSupplierTable">
		                <thead>
		                  <tr>
		                    <th>SN</th>
		                    <th>Full Name</th>
		                    <th>Phone Number</th>
		                    <th>Email Address</th>
		                    <th>Residence Country</th>
		                    <th>Contact Address</th>
		                    <th>Action</th>
		                    <th>Manage Account</th>
		                  </tr>
		                </thead>
	                    <tbody>
                ';
			
			if($count > 0){				
				$sn = 1;
				foreach ($rs as $suppliers => $supplier) {
					$r .= '
							<tr>
								<td>'.$sn.'</td>
	                            <td>'.$supplier['fullname'].'</td>
	                            <td>'.$supplier['phonenumber'].'</td>
	                            <td>'.$supplier['email'].'</td>
	                            <td>'.$supplier['name'].'</td>
	                            <td>'.$supplier['contactaddress'].'</td>
	                        	<td>
	                            	<a href="javascript:void(0)" id="edit'.$supplier['supplierid'].'" rel="'.$supplier['supplierid'].'" class="btnEditSupplier" title="edit"><i class="fa fa-edit"></i>
	                            	</a> &nbsp;&nbsp;&nbsp;&nbsp;
	                            	<a href="javascript:void(0)" id="delete'.$supplier['supplierid'].'" rel="'.$supplier['supplierid'].'" class=" btnDeleteSupplier" title="delete"><i class="fa fa-trash"></i>
	                            	</a>
	                            </td>
	                            <td>
	                            	<a href="javascript:void(0)" id="add'.$supplier['supplierid'].'" rel="'.$supplier['supplierid'].'" class=" btnAddTransaction" title="add transaction"><i class="fa fa-plus-square"></i>
	                            	</a> &nbsp;&nbsp;&nbsp;&nbsp;
	                            	<a href="javascript:void(0)" id="view'.$supplier['supplierid'].'" rel="'.$supplier['supplierid'].'" class=" btnViewTransaction" title="view transaction history"><i class="fa fa-search"></i>
	                            	</a>
	                            </td>
	                        </tr>';
					$sn++;
				}
				
			}else{
				$r .= '<tr><td colspan="8" class="text-center">No Record Found</td></tr>';
			}

			$r .= '		</tbody>
	                </table>';
			return $r;
		} catch (Exception $e) {
			return '<p class="text-danger">Error encountered while retrieving records</p>';
			//return $e->getMessage();
		}
	}

	function addNewSupplierRecord($fullname, $phone, $email, $country, $address, $edit = false, $id = 0)
	{
		global $dbh;
		$query = '';

		$date = '';
		$d = new DateTime($date);
		$cdate = $d->format('Y-m-d h:i:s');

		$userdata = getUserSessions();
		$loggedinuser = $userdata[0];

		try{
			// prepare sql and bind parameters
			if($edit == true){
				$cArray = array('fullname'=>$fullname, 'phonenumber'=>$phone, 'email'=>$email, 'countryid'=>$country, 'contactaddress'=>$address);
				$wArray = array('supplierid'=>$id);
				$rs = $dbh->update('tblsupplier', $cArray, $wArray)->affectedRows();

				if($rs > 0){
					return 'success';
				}else{
					return false;
				}
				//return $query;
			}else{
				$cArray = array('fullname'=>$fullname, 'phonenumber'=>$phone, 'email'=>$email, 'countryid'=>$country, 'contactaddress'=>$address, 'createdby'=>$loggedinuser, 'datecreated'=>$cdate);
				$wArray = '';
				$lastId = $dbh->insert('tblsupplier', $cArray, $wArray)->getLastInsertId();

				if($lastId > 0){
					return 'success';
				}else{
					return false;
				}
			}
		} catch (Exception $e) {
			//return false;
			return $e->getMessage();
		}
	}

	function deleteSupplierRecord($supplierid)
	{
		global $dbh;

		$userdata = getUserSessions();
		$loggedinuser = $userdata[0];

		try{
			// prepare sql and bind parameters
			$wArray = array('supplierid'=>$supplierid);
			$rs = $dbh->delete('tblsupplier', $wArray)->affectedRows();

			if($rs > 0){
				return 'success';
			}else{
				return false;
			}
		} catch (Exception $e) {
			//return false;
			return $e->getMessage();
		}
	}

	function getSupplierRecordById($supplierid)
	{
		try {			
			global $dbh;

			$query = "SELECT * FROM tblsupplier WHERE supplierid='".$supplierid."'";
			$rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);
			//return $query;
			if($count > 0){
				return $rs;
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}

	function getSupplierStockListById($stockid)
	{
		try {
			$query = "SELECT * FROM tblsupplierstocklist WHERE stockid = '".$stockid."'";
			//return $query;
			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);

		    if($count > 0){				
				return $rs;
				
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}

	function addNewSupplierTransactionRecord($supplierid, $currency, $amount, $transactiontype, $invoiceref, $comment, $edit = false, $id = 0)
	{
		global $dbh;
		$query = '';

		$date = '';
		$d = new DateTime($date);
		$cdate = $d->format('Y-m-d h:i:s');

		$userdata = getUserSessions();
		$loggedinuser = $userdata[0];

		try{
			// prepare sql and bind parameters
			if($edit == true){
				$cArray = array('supplierid'=>$supplierid, 'currency'=>$currency, 'amount'=>$amount, 'transactiontype'=>$transactiontype, 'invoiceref'=>$invoiceref, 'comment'=>$comment, 'datecreated'=>$cdate, 'capturedby'=>$loggedinuser);
				$wArray = array('supplieraccountid'=>$id);
				$rs = $dbh->update('tblsupplieraccount', $cArray, $wArray)->affectedRows();

				if($rs > 0){
					return 'success';
				}else{
					return false;
				}
				//return $query;
			}else{
				$cArray = array('supplierid'=>$supplierid, 'currency'=>$currency, 'amount'=>$amount, 'transactiontype'=>$transactiontype, 'invoiceref'=>$invoiceref, 'comment'=>$comment, 'datecreated'=>$cdate, 'capturedby'=>$loggedinuser);
				$wArray = '';
				$lastId = $dbh->insert('tblsupplieraccount', $cArray, $wArray)->getLastInsertId();

				if($lastId > 0){
					return 'success';
				}else{
					return false;
				}
			}
		} catch (Exception $e) {
			//return false;
			return $e->getMessage();
		}
	}

	function getSupplierTransactionRecordById($supplierid)
	{
		try {			
			global $dbh;
			$totalcredit = 0;
			$totaldebit = 0;
			$balance = 0;
			$sd = array();

			$queryCredit = "SELECT SUM(amount) AS totalcredit FROM tblsupplieraccount WHERE supplierid='".$supplierid."' AND transactiontype='1'";
			$crs = $dbh->pdoQuery($queryCredit)->results();
		    $countc = count($crs);

		    $queryDebit = "SELECT SUM(amount) AS totaldebit FROM tblsupplieraccount WHERE supplierid='".$supplierid."' AND transactiontype='2'";
			$drs = $dbh->pdoQuery($queryDebit)->results();
		    $countd = count($drs);

		    if ($countc > 0) {
		    	$totalcredit = $crs[0]['totalcredit'];
		    }
		    if ($countd > 0) {
		    	$totaldebit = $drs[0]['totaldebit'];
		    }

		    $balance = $totalcredit - $totaldebit;

		    $query = "SELECT *, s.fullname AS supplier, e.fullname AS employee, sa.datecreated AS datec
		    			FROM tblsupplieraccount AS sa
		    			INNER JOIN tblsupplier AS s
		    			INNER JOIN tblcurrency AS c
		    			INNER JOIN tbltransactiontype AS tt
		    			INNER JOIN tblemployee AS e
		    			ON sa.supplierid = s.supplierid
		    			AND sa.currency = c.currencyid
		    			AND sa.transactiontype = tt.transactiontypeid
		    			AND sa.capturedby = e.employeeid
		    			WHERE sa.supplierid='$supplierid'
		    			ORDER BY sa.datecreated DESC";

			$rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);

		    $sd['balance'] = $balance;
		    $sd['history'] = $rs;
			//return $query;
			if($count > 0){
				return $sd;
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}

	/*Stock Module Methods*/
	function isStockWithSales($stockid)
	{
		try {
			$query = "SELECT * FROM tblsales WHERE stockid = '".$stockid."'";
			//return $query;
			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);

		    if($count > 0){				
				return true;				
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}

	function isStockRefRegistered($stockref)
	{
		try {
			$query = "SELECT * FROM tblstock WHERE stockref = '".$stockref."'";
			//return $query;
			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);

		    if($count > 0){				
				return true;
				
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}

	function ViewStocks()
	{
		try {
			$query = "SELECT *, sil.stockref AS stockreference, s.stockid AS stkid 
						FROM tblstock AS s
						INNER JOIN tblcontainer AS c
						INNER JOIN tblsupplierstocklist AS sil
						ON s.containerid = c.containerid
						AND s.stockref = sil.stockid
						WHERE s.lastmodified IS NULL
						ORDER BY s.containerid
					";
			//return $query;
			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);

		    $r = ' <table class="table table-hover table-bordered" id="viewStockTable">
		                <thead>
		                  <tr>
		                    <th>SN</th>
		                    <th>Container Reference</th>
		                    <th>Stock Reference</th>
		                    <th>Stock Name</th>
		                    <th>Entry Quantity</th>
		                    <th>Cost Price</th>
		                    <th>Unit Price</th>
		                    <th>Date Added</th>
		                    <th>Action</th>
		                  </tr>
		                </thead>
	                    <tbody>
                ';
			
			if($count > 0){				
				$sn = 1;
				foreach ($rs as $stocks => $stock) {
					$r .= '
							<tr>
								<td>'.$sn.'</td>
	                            <td>'.$stock['containerref'].'</td>
	                            <td>'.$stock['stockreference'].'</td>
	                            <td>'.$stock['stockname'].'</td>
	                            <td>'.$stock['quantity'].'</td>
	                            <td>'.$stock['costprice'].'</td>
	                            <td>'.$stock['unitsellingprice'].'</td>
	                            <td>'.$stock['dateadded'].'</td>
	                		    <td>
	                            	<a href="javascript:void(0)" id="edit'.$stock['stkid'].'" rel="'.$stock['stkid'].'" class="btnEditStock" title="edit"><i class="fa fa-edit"></i>
	                            	</a> &nbsp;&nbsp;
	                            	<a href="javascript:void(0)" id="view'.$stock['stkid'].'" rel="'.$stock['stkid'].'" class="btnViewStock" title="view"><i class="fa fa-search"></i>
	                            	</a> &nbsp;&nbsp;
	                            	<a href="javascript:void(0)" id="delete'.$stock['stkid'].'" rel="'.$stock['stkid'].'" class=" btnDeleteStock" title="delete"><i class="fa fa-trash"></i>
	                            	</a>
	                            </td>	                            
                    		</tr>
                    	';
					$sn++;
				}
				
			}else{
				$r .= '<tr><td colspan="9" class="text-center">No Record Found</td></tr>';
			}

			$r .= '		</tbody>
	                </table>';
			return $r;
		} catch (Exception $e) {
			return '<p class="text-danger">Error encountered while retrieving records</p>';
			//return $e->getMessage();
		}
	}

	function addNewStockRecord($containerid, $stockref, $stockname, $weight, $quantity, $buyingprice, $costprice, $unitsellingprice, $edit = false, $id = 0)
	{
		global $dbh;
		$query = '';

		$date = '';
		$d = new DateTime($date);
		$cdate = $d->format('Y-m-d h:i:s');

		$userdata = getUserSessions();
		$loggedinuser = $userdata[0];

		try{
			// prepare sql and bind parameters
			if($edit == true){
				$cArray = array(
								'lastmodified'=>$cdate,
								'modifiedby'=>$loggedinuser
							);
				$wArray = array('stockid'=>$id);
				$rs = $dbh->update('tblstock', $cArray, $wArray)->affectedRows();

				if($rs > 0){
					$cArray = array('containerid'=>$containerid,
							'stockref'=>$stockref,
							'stockname'=>$stockname, 
							'weight'=>$weight, 
							'quantity'=>$quantity, 
							'buyingprice'=>$buyingprice,
							'costprice'=>$costprice,
							'unitsellingprice'=>$unitsellingprice,
							'dateadded'=>$cdate,
							'addedby'=>$loggedinuser
						);
					$wArray = '';
					$lastId = $dbh->insert('tblstock', $cArray, $wArray)->getLastInsertId();

					if($lastId > 0){
						return 'success';
					}else{
						return false;
					}
				}else{
					return false;
				}
				//return $query;
			}else{
				$lastId = 0;
				for ($i=0; $i < count($stockref); $i++) { 
					$cArray = array('containerid'=>$containerid,
								'stockref'=>$stockref[$i],
								'stockname'=>$stockname[$i], 
								'weight'=>$weight[$i], 
								'quantity'=>$quantity[$i], 
								'buyingprice'=>$buyingprice[$i],
								'costprice'=>$costprice[$i],
								'unitsellingprice'=>$unitsellingprice[$i],
								'dateadded'=>$cdate,
								'addedby'=>$loggedinuser
							);
					$wArray = '';
					$lastId = $dbh->insert('tblstock', $cArray, $wArray)->getLastInsertId();
				}

				if($lastId > 0){
					return 'success';
				}else{
					return false;
				}
			}
		} catch (Exception $e) {
			//return false;
			return $e->getMessage();
		}
	}

	function deleteStockRecord($stockid)
	{
		global $dbh;

		try{
			// prepare sql and bind parameters
			$wArray = array('stockid'=>$stockid);
			$rs = $dbh->delete('tblstock', $wArray)->affectedRows();

			if($rs > 0){
				return 'success';
			}else{
				return false;
			}
		} catch (Exception $e) {
			//return false;
			return $e->getMessage();
		}
	}

	function getStockRecordById($stockid)
	{
		//stock ref on stock table = stock id on supplier stock list
		try {			
			global $dbh;

			$query = "SELECT *, s.costprice AS cp, s.unitsellingprice AS sp, 
						s.stockref AS sr, s.buyingprice AS bp 
						FROM tblstock AS s
						INNER JOIN tblcontainer AS c
						INNER JOIN tblsupplierstocklist AS sl
						ON s.containerid = c.containerid
						AND s.stockref = sl.stockid
						WHERE s.stockid = '".$stockid."'
					";
			$rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);
			//return $query;
			if($count > 0){
				return $rs;
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}

	function getStockSalesCount($stockid)
	{
		try {			
			global $dbh;

			$query = "SELECT COUNT(*) AS total FROM tblsales WHERE stockid = '".$stockid."'";
			$rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);
			//return $query;
			if($count > 0){
				return $rs[0]['total'];
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}


	/*Sales Module Methods*/

	function isSupplyOrderReferenceExist($orderref)
	{
		try {
			$query = "SELECT * FROM tblsupplyorder WHERE orderno = '".$orderref."'";
			//return $query;
			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);

		    if($count > 0){				
				return true;
				
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}

	function isSupplyOrderIdExist($orderid)
	{
		try {
			$query = "SELECT * FROM tblsupplyorder WHERE orderid = '".$orderid."'";
			//return $query;
			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);

		    if($count > 0){				
				return true;
				
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}

	function isPaymentMadeForSupplyOrder($supplyorderid)
	{
		try {
			$query = "SELECT * FROM tblsupplyorderpayment WHERE orderid = '".$supplyorderid."'";
			//return $query;
			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);

		    if($count > 0){				
				return true;				
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}

	function ViewSupplyOrders()
	{
		try {
			/*
			$query = "SELECT *, s.fullname AS supplier, e.fullname AS employee FROM tblsupplyorder AS so
						INNER JOIN tblsupplier AS s
						INNER JOIN tblemployee AS e
						INNER JOIN tblpaymentmode AS pm
						INNER JOIN tblpaymenttype AS pt
						ON so.supplierid = s.supplierid
						AND so.freightforwarderid = e.employeeid
						AND so.typeofpayment = pt.id
						AND so.modeofpayment = pm.id
					";*/
			$query = "SELECT *, s.fullname AS supplier FROM tblsupplyorder AS so
						INNER JOIN tblsupplier AS s
						ON so.supplierid = s.supplierid
						ORDER BY so.datecreated DESC
						";
			//return $query;
			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);

		    $r = ' <table class="table table-hover table-bordered" id="viewSupplyOrderTable">
		                <thead>
		                  <tr>
		                    <th>SN</th>
		                    <th>Order Reference</th>
		                    <th>Supplier Name</th>
		                    <th>Total Cost (<span class="double-strikethrough">N</span>)</th>
		                    <th>Date Ordered</th>
		                    <th>Action</th>
		                  </tr>
		                </thead>
	                    <tbody>
                ';
			
			if($count > 0){				
				$sn = 1;
				foreach ($rs as $supplyorders => $supplyorder) {
					$r .= '
							<tr>
								<td>'.$sn.'</td>
	                            <td>'.$supplyorder['orderno'].'</td>
	                            <td>'.$supplyorder['supplier'].'</td>
	                            <td>'.formatAmount($supplyorder['totalcost']).'</td>
	                            <td>'.$supplyorder['dateordered'].'</td>
	                        	<td>
	                            	<a href="javascript:void(0)" id="edit'.$supplyorder['orderid'].'" rel="'.$supplyorder['orderid'].'" class="btnEditSupplyOrder" title="edit"><i class="fa fa-edit"></i>
	                            	</a> &nbsp;&nbsp;&nbsp;&nbsp;
	                            	<a href="javascript:void(0)" id="delete'.$supplyorder['orderid'].'" rel="'.$supplyorder['orderid'].'" class=" btnDeleteSupplyOrder" title="delete"><i class="fa fa-trash"></i>
	                            	</a>
	                            </td>
	                        </tr>';

					$sn++;
				}
				
			}else{
				$r .= '<tr><td colspan="9" class="text-center">No Record Found</td></tr>';
			}

			$r .= '		</tbody>
	                </table>';
			return $r;
		} catch (Exception $e) {
			return '<p class="text-danger">Error encountered while retrieving records</p>';
			//return $e->getMessage();
		}
	}

	function addNewSupplyOrderRecord($orderref, $supplier, $dateordered, $totalcost, $edit = false, $id = 0)
	{
		global $dbh;

		$date = '';
		$d = new DateTime($date);
		$cdate = $d->format('Y-m-d h:i:s');

		$userdata = getUserSessions();
		$loggedinuser = $userdata[0];

		try{
			// prepare sql and bind parameters
			if($edit == true){
				$cArray = array('orderno'=>$orderref, 'supplierid'=>$supplier, 'dateordered'=>$dateordered, 'totalcost'=>$totalcost);
				$wArray = array('orderid'=>$id);
				$rs = $dbh->update('tblsupplyorder', $cArray, $wArray)->affectedRows();

				if($rs > 0){
					return 'success';
				}else{
					return false;
				}
				//return $query;
			}else{
				$cArray = array('orderno'=>$orderref, 'supplierid'=>$supplier, 'dateordered'=>$dateordered, 'totalcost'=>$totalcost, 'capturedby'=>$loggedinuser, 'datecreated'=>$cdate);
				$wArray = '';
				$lastId = $dbh->insert('tblsupplyorder', $cArray, $wArray)->getLastInsertId();

				if($lastId > 0){
					return 'success';
				}else{
					return false;
				}
			}
		} catch (Exception $e) {
			//return false;
			return $e->getMessage();
		}
	}

	function deleteSupplyOrderRecord($supplyorderid)
	{
		global $dbh;

		try{
			// prepare sql and bind parameters
			$wArray = array('orderid'=>$supplyorderid);
			$rs = $dbh->delete('tblsupplyorder', $wArray)->affectedRows();

			if($rs > 0){
				return 'success';
			}else{
				return false;
			}
		} catch (Exception $e) {
			//return false;
			return $e->getMessage();
		}
	}

	function getSupplyOrderRecordById($supplyorderid)
	{
		try {			
			global $dbh;

			$query = "SELECT * FROM tblsupplyorder WHERE orderid='".$supplyorderid."'";
			$rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);
			//return $query;
			if($count > 0){
				return $rs;
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}

	/*Supply Order Payment Module*/
	function isSupplyOrderPaymentReferenceExist($paymentref)
	{
		try {
			$query = "SELECT * FROM tblsupplyorderpayment WHERE paymentref = '".$paymentref."'";
			//return $query;
			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);

		    if($count > 0){				
				return true;
				
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}

	function isSupplyOrderPaymentIdExist($paymentid)
	{
		try {
			$query = "SELECT * FROM tblsupplyorderpayment WHERE paymentid = '".$paymentid."'";
			//return $query;
			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);

		    if($count > 0){				
				return true;
				
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}

	function getSupplyOrderOutstandingPayment($supplyorderid)
	{
		try {			
			global $dbh;
			$query = "SELECT * FROM tblsupplyorderpayment 
			WHERE orderid='$supplyorderid' 
			ORDER BY datepaid 
			DESC LIMIT 1";
			$rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);
			//return $query;
			if($count > 0){
				return $rs;
			}else{
				return "no-record";
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}

	function addNewSupplyOrderPaymentRecord($paymentref, $orderid, $amountpaid, $currency, $duedate, $paymenttype, $paymentmode, $comment, $edit = false, $id = 0)
	{
		global $dbh;
		$date = '';
		$d = new DateTime($date);
		$datepaid = $d->format('Y-m-d h:i:s');

		$userdata = getUserSessions();
		$loggedinuser = $userdata[0];

		$outstandingpaymentrecord = getSupplyOrderOutstandingPayment($orderid);
		$outstanding = 0.0;

		try{
			if ($outstandingpaymentrecord == "no-record") {
				$supplyordertotal = getSupplyOrderRecordById($orderid)[0]['totalcost'];
				$outstanding = $supplyordertotal - $amountpaid;
			} else {
				$prevoutstanding = $outstandingpaymentrecord[0]['outstanding'];
				$outstanding = $prevoutstanding - $amountpaid;
			}

			if ($outstanding < 0) {
				return false;
			} else {
				$outstanding = strval($outstanding);
				$amountpaid = strval($amountpaid);

				// prepare sql and bind parameters
				if($edit == true){
					$cArray = array('amountpaid'=>$amountpaid, 'currencyid'=>$currency, 'outstanding'=>$outstanding, 'duedate'=>$duedate, 'datepaid'=>$datepaid, 'paymentmode'=>$paymentmode, 'paymenttype'=>$paymenttype, 'comment'=>$comment);
					$wArray = array('paymentref'=>$paymentref);
					$rs = $dbh->update('tblsupplyorderpayment', $cArray, $wArray)->affectedRows();

					if($rs > 0){
						return 'success';
					}else{
						return false;
					}
					//return $query;
				}else{
					$cArray = array('paymentref'=>$paymentref, 'orderid'=>$orderid, 'amountpaid'=>$amountpaid, 'currencyid'=>$currency, 'outstanding'=>$outstanding, 'duedate'=>$duedate, 'datepaid'=>$datepaid, 'paymentmode'=>$paymentmode, 'paymenttype'=>$paymenttype, 'comment'=>$comment, 'capturedby'=>$loggedinuser);
					$wArray = '';
					$lastId = $dbh->insert('tblsupplyorderpayment', $cArray, $wArray)->getLastInsertId();

					if($lastId > 0){
						return 'success';
					}else{
						return false;
					}
				}
			}
			
		} catch (Exception $e) {
			//return false;
			return $e->getMessage();
		}		
	}

	function viewSupplyOrderPayments()
	{
		try {
			$query = "SELECT *, s.fullname AS supplier, so.orderno AS orderref 
						FROM tblsupplyorderpayment AS sop
						INNER JOIN tblsupplier AS s
						INNER JOIN tblsupplyorder AS so
						ON sop.orderid = so.orderid
						AND so.supplierid = s.supplierid
						ORDER BY sop.paymentid DESC
						";
			//return $query;
			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);

		    $r = ' <table class="table table-hover table-bordered" id="viewSupplyOrderPaymentsTable">
		                <thead>
		                  <tr>
		                    <th>SN</th>
		                    <th>Payment Reference</th>
		                    <th>Order Reference</th>
		                    <th>Supplier</th>
		                    <!--
		                    <th>Amount Paid (<span class="double-strikethrough">N</span>)</th>
		                    <th>Outstanding (<span class="double-strikethrough">N</span>)</th>
		                    -->
		                    <th>Amount Paid</th>
		                    <th>Outstanding</th>
		                    <th>Date Paid</th>
		                    <th>Action</th>
		                  </tr>
		                </thead>
	                    <tbody>
                ';
			
			if($count > 0){				
				$sn = 1;
				foreach ($rs as $supplyorderpayments => $supplyorderpayment) {
					$r .= '
							<tr>
								<td>'.$sn.'</td>
	                            <td>'.$supplyorderpayment['paymentref'].'</td>
	                            <td>'.$supplyorderpayment['orderref'].'</td>
	                            <td>'.$supplyorderpayment['supplier'].'</td>
	                            <td>'.formatAmount($supplyorderpayment['amountpaid']).'</td>
	                            <td>'.formatAmount($supplyorderpayment['outstanding']).'</td>
	                            <td>'.formatdate($supplyorderpayment['datepaid']).'</td>
	                        	<td>
	                            	<a href="javascript:void(0)" id="edit'.$supplyorderpayment['paymentid'].'" rel="'.$supplyorderpayment['paymentid'].'" class="btnEditSupplyOrderPayment" title="edit"><i class="fa fa-search"></i>
	                            	</a> &nbsp;&nbsp;&nbsp;&nbsp;
	                            	<a href="javascript:void(0)" id="delete'.$supplyorderpayment['paymentid'].'" rel="'.$supplyorderpayment['paymentid'].'" class=" btnDeleteSupplyOrderPayment" title="delete"><i class="fa fa-trash"></i>
	                            	</a>
	                            </td>
	                        </tr>';

					$sn++;
				}
				
			}else{
				$r .= '<tr><td colspan="9" class="text-center">No Record Found</td></tr>';
			}

			$r .= '		</tbody>
	                </table>';
			return $r;
		} catch (Exception $e) {
			return '<p class="text-danger">Error encountered while retrieving records</p>';
			//return $e->getMessage();
		}
	}

	function deleteSupplyOrderPaymentRecord($paymentid)
	{
		global $dbh;

		try{
			// prepare sql and bind parameters
			$wArray = array('paymentid'=>$paymentid);
			$rs = $dbh->delete('tblsupplyorderpayment', $wArray)->affectedRows();

			if($rs > 0){
				return 'success';
			}else{
				return false;
			}
		} catch (Exception $e) {
			//return false;
			return $e->getMessage();
		}
	}

	function getSupplyOrderPaymentRecordById($paymentid)
	{
		try {
			$query = "SELECT * FROM tblsupplyorderpayment WHERE paymentid = '".$paymentid."'";
			//return $query;
			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);

		    if($count > 0){				
				return $rs;
				
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}
	/*End Supply Order Payment Module*/

	/*Supply Expenses Module*/
	function isSupplyExpenseIdExist($expenseid)
	{
		try {
			$query = "SELECT * FROM tblsupplyorderexpenses WHERE expenseid = '".$expenseid."'";
			//return $query;
			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);

		    if($count > 0){				
				return true;
				
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}

	function addNewSupplyExpenseRecord($orderid, $description, $amount, $edit = false, $id = 0)
	{
		global $dbh;
		$date = '';
		$d = new DateTime($date);
		$datecreated = $d->format('Y-m-d h:i:s');

		$userdata = getUserSessions();
		$loggedinuser = $userdata[0];

		try{
			// prepare sql and bind parameters
			if($edit == true){
				$cArray = array('orderid'=>$orderid, 'description'=>$description, 'amount'=>$amount);
				$wArray = array('expenseid'=>$id);
				$rs = $dbh->update('tblsupplyorderexpenses', $cArray, $wArray)->affectedRows();

				if($rs > 0){
					return 'success';
				}else{
					return false;
				}
				//return $query;
			}else{
				$lastId = 0;
				for ($i=0; $i < count($description) ; $i++) { 
					$cArray = array('description'=>cleanInput($description[$i]), 'amount'=>cleanInput($amount[$i]), 'orderid'=>$orderid, 'datecreated'=>$datecreated, 'capturedby'=>$loggedinuser);
					$wArray = '';
					$lastId = $dbh->insert('tblsupplyorderexpenses', $cArray, $wArray)->getLastInsertId();
				}

				if($lastId > 0){
					return 'success';
				}else{
					return false;
				}
			}
			
		} catch (Exception $e) {
			//return false;
			return $e->getMessage();
		}		
	}

	function viewSupplyExpense()
	{
		try {
			/*
			$query = "SELECT *, s.fullname AS supplier, e.fullname AS employee FROM tblsupplyorder AS so
						INNER JOIN tblsupplier AS s
						INNER JOIN tblemployee AS e
						INNER JOIN tblpaymentmode AS pm
						INNER JOIN tblpaymenttype AS pt
						ON so.supplierid = s.supplierid
						AND so.freightforwarderid = e.employeeid
						AND so.typeofpayment = pt.id
						AND so.modeofpayment = pm.id
					";*/
			$query = "SELECT *, so.orderno AS orderref, s.fullname AS supplier, 
						e.fullname AS employee, soe.datecreated AS dc
						FROM tblsupplyorderexpenses AS soe
						INNER JOIN tblsupplier AS s
						INNER JOIN tblsupplyorder AS so
						INNER JOIN tblemployee AS e
						ON soe.orderid = so.orderid
						AND so.supplierid = s.supplierid
						AND soe.capturedby = e.employeeid
						ORDER BY soe.datecreated DESC
						";
			//return $query;
			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);

		    $r = ' <table class="table table-hover table-bordered" id="viewSupplyOrderExpenseTable">
		                <thead>
		                  <tr>
		                    <th>SN</th>
		                    <th>Order Reference</th>
		                    <th>Expense Description</th>
		                    <th>Amount (<span class="double-strikethrough">N</span>)</th>
		                    <th>Supplier</th>
		                    <th>Date Created</th>
		                    <th>Captured By</th>
		                    <th>Action</th>
		                  </tr>
		                </thead>
	                    <tbody>
                ';
			
			if($count > 0){				
				$sn = 1;
				foreach ($rs as $supplyexpenses => $supplyexpense) {
					$r .= '
							<tr>
								<td>'.$sn.'</td>
	                            <td>'.$supplyexpense['orderref'].'</td>
	                            <td>'.$supplyexpense['description'].'</td>
	                            <td>'.formatAmount($supplyexpense['amount']).'</td>
	                            <td>'.$supplyexpense['supplier'].'</td>
	                            <td>'.$supplyexpense['dc'].'</td>
	                            <td>'.$supplyexpense['employee'].'</td>
	                        	<td>
	                            	<a href="javascript:void(0)" id="edit'.$supplyexpense['expenseid'].'" rel="'.$supplyexpense['expenseid'].'" class="btnEditSupplyExpense" title="edit"><i class="fa fa-edit"></i>
	                            	</a> &nbsp;&nbsp;&nbsp;&nbsp;
	                            	<a href="javascript:void(0)" id="delete'.$supplyexpense['expenseid'].'" rel="'.$supplyexpense['expenseid'].'" class="btnDeleteSupplyExpense" title="delete"><i class="fa fa-trash"></i>
	                            	</a>
	                            </td>
	                        </tr>';

					$sn++;
				}
				
			}else{
				$r .= '<tr><td colspan="9" class="text-center">No Record Found</td></tr>';
			}

			$r .= '		</tbody>
	                </table>';
			return $r;
		} catch (Exception $e) {
			return '<p class="text-danger">Error encountered while retrieving records</p>';
			//return $e->getMessage();
		}
	}

	function deleteSupplyExpenseRecord($expenseid)
	{
		global $dbh;

		try{
			// prepare sql and bind parameters
			$wArray = array('expenseid'=>$expenseid);
			$rs = $dbh->delete('tblsupplyorderexpenses', $wArray)->affectedRows();

			if($rs > 0){
				return 'success';
			}else{
				return false;
			}
		} catch (Exception $e) {
			//return false;
			return $e->getMessage();
		}
	}

	function getSupplyExpenseRecordById($expenseid)
	{
		try {
			$query = "SELECT * FROM tblsupplyorderexpenses WHERE expenseid = '".$expenseid."'";
			//return $query;
			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);

		    if($count > 0){				
				return $rs;
				
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}
	/*End Supply Expenses Module*/

	/*Supplier stock List Module*/

	/*End Supplier stock List Module*/

	/*Internal Expense Module*/
	function addNewInternalExpenseRecord($description, $amount, $approvedby, $edit = false, $id = 0)
	{
		global $dbh;
		$date = '';
		$d = new DateTime($date);
		$datecreated = $d->format('Y-m-d h:i:s');

		$userdata = getUserSessions();
		$loggedinuser = $userdata[0];

		try{
			// prepare sql and bind parameters
			if($edit == true){
				$cArray = array('description'=>$description, 'amount'=>$amount, 'approvedby'=>$approvedby, );
				$wArray = array('expenseid'=>$id);
				$rs = $dbh->update('tblinternalexpense', $cArray, $wArray)->affectedRows();

				if($rs > 0){
					return 'success';
				}else{
					return false;
				}
				//return $query;
			}else{
				$lastId = 0;
				for ($i=0; $i < count($description) ; $i++) { 
					$cArray = array('description'=>$description[$i], 'amount'=>$amount[$i], 'approvedby'=>$approvedby[$i], 'datecreated'=>$datecreated, 'capturedby'=>$loggedinuser);
					$wArray = '';
					$lastId = $dbh->insert('tblinternalexpense', $cArray, $wArray)->getLastInsertId();
				}

				if($lastId > 0){
					return 'success';
				}else{
					return false;
				}
			}
			
		} catch (Exception $e) {
			//return false;
			return $e->getMessage();
		}		
	}

	function viewInternalExpense()
	{
		try {
			$query = "SELECT *, e.fullname AS employee, ie.datecreated AS dc
						FROM tblinternalexpense AS ie
						INNER JOIN tblemployee AS e
						ON ie.capturedby = e.employeeid
						ORDER BY ie.datecreated DESC
						";
			//return $query;
			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);

		    $r = ' <table class="table table-hover table-bordered" id="viewInternalExpenseTable">
		                <thead>
		                  <tr>
		                    <th>SN</th>
		                    <th>Date Created</th>
		                    <th>Expense Description</th>
		                    <th>Amount (<span class="double-strikethrough">N</span>)</th>
		                    <th>Approved By</th>
		                    <th>Captured By</th>
		                    <th>Action</th>
		                  </tr>
		                </thead>
	                    <tbody>
                ';
			
			if($count > 0){				
				$sn = 1;
				foreach ($rs as $internalexpenses => $internalexpense) {
					$r .= '
							<tr>
								<td>'.$sn.'</td>
	                            <td>'.formatdate($internalexpense['dc']).'</td>
	                            <td>'.$internalexpense['description'].'</td>
	                            <td>'.formatAmount($internalexpense['amount']).'</td>
	                            <td>'.getEmployeeRecordById($internalexpense['approvedby'])[0]['fullname'].'</td>
	                            <td>'.getEmployeeRecordById($internalexpense['capturedby'])[0]['fullname'].'</td>
	                        	<td>
	                            	<a href="javascript:void(0)" id="edit'.$internalexpense['expenseid'].'" rel="'.$internalexpense['expenseid'].'" class="btnEditInternalExpense" title="edit"><i class="fa fa-edit"></i>
	                            	</a> &nbsp;&nbsp;&nbsp;&nbsp;
	                            	<a href="javascript:void(0)" id="delete'.$internalexpense['expenseid'].'" rel="'.$internalexpense['expenseid'].'" class="btnDeleteInternalExpense" title="delete"><i class="fa fa-trash"></i>
	                            	</a>
	                            </td>
	                        </tr>';

					$sn++;
				}
				
			}else{
				$r .= '<tr><td colspan="9" class="text-center">No Record Found</td></tr>';
			}

			$r .= '		</tbody>
	                </table>';
			return $r;
		} catch (Exception $e) {
			return '<p class="text-danger">Error encountered while retrieving records</p>';
			//return $e->getMessage();
		}
	}

	function deleteInternalExpenseRecord($expenseid)
	{
		global $dbh;

		try{
			// prepare sql and bind parameters
			$wArray = array('expenseid'=>$expenseid);
			$rs = $dbh->delete('tblinternalexpense', $wArray)->affectedRows();

			if($rs > 0){
				return 'success';
			}else{
				return false;
			}
		} catch (Exception $e) {
			//return false;
			return $e->getMessage();
		}
	}

	function getInternalExpenseRecordById($expenseid)
	{
		try {
			$query = "SELECT * FROM tblinternalexpense WHERE expenseid = '".$expenseid."'";
			//return $query;
			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);

		    if($count > 0){				
				return $rs;
				
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}

	function isInternalExpenseIdExist($expenseid)
	{
		try {
			$query = "SELECT * FROM tblinternalexpense WHERE expenseid = '".$expenseid."'";
			//return $query;
			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);

		    if($count > 0){				
				return true;
				
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}
	/*End Internal Expense Module*/

	/*Role Module methods*/

	function ViewRoles()
	{
		try {
			$query = "SELECT * FROM tblrole";
			//return $query;
			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);

		    $r = ' <table class="table" id="viewRoleTable">
		                <thead>
		                  <tr>
		                    <th>SN</th>
		                    <th>Role Name</th>
		                    <th>Action</th>
		                  </tr>
		                </thead>
	                    <tbody>
                ';
			
			if($count > 0){				
				$sn = 1;
				foreach ($rs as $roles => $role) {
					$r .= '
							<tr>
								<td>'.$sn.'</td>
	                            <td>'.$role['role'].'</td>
	                        	<td>
	                            	<a href="javascript:void(0)" id="edit'.$role['roleid'].'" rel="'.$role['roleid'].'" class="btnEditRole" title="edit"><i class="fa fa-edit"></i>
	                            	</a> &nbsp;&nbsp;&nbsp;&nbsp;
	                            	<a href="javascript:void(0)" id="delete'.$role['roleid'].'" rel="'.$role['roleid'].'" class=" btnDeleteRole" title="delete"><i class="fa fa-trash"></i>
	                            	</a>
	                            </td>
                    		</tr>';

					$sn++;
				}
				
			}else{
				$r .= '<tr><td colspan="3" class="text-center">No Record Found</td></tr>';
			}

			$r .= '		</tbody>
	                </table>';
			return $r;
		} catch (Exception $e) {
			return '<p class="text-danger">Error encountered while retrieving records</p>';
			//return $e->getMessage();
		}
	}

	function addNewRoleRecord($rolename, $edit = false, $id = 0)
	{
		global $dbh;
		$query = '';

		$date = '';
		$d = new DateTime($date);
		$cdate = $d->format('Y-m-d h:i:s');

		$userdata = getUserSessions();
		$loggedinuser = $userdata[0];

		try{
			// prepare sql and bind parameters
			if($edit == true){
				$cArray = array('role'=>$rolename);
				$wArray = array('roleid'=>$id);
				$rs = $dbh->update('tblrole', $cArray, $wArray)->affectedRows();

				if($rs > 0){
					return 'success';
				}else{
					return false;
				}
				//return $query;
			}else{
				$cArray = array('role'=>$rolename, 'dateadded'=>$cdate, 'addedby'=>$loggedinuser);
				$wArray = '';
				$lastId = $dbh->insert('tblrole', $cArray, $wArray)->getLastInsertId();

				if($lastId > 0){
					return 'success';
				}else{
					return false;
				}
			}

		} catch (Exception $e) {
			//return false;
			return $e->getMessage();
		}
	}

	function deleteRoleRecord($roleid)
	{
		try{
			global $dbh;

			// prepare sql and bind parameters
			$cArray = '';
			$wArray = array('roleid'=>$roleid);
			$rs = $dbh->delete('tblrole', $wArray)->affectedRows();

			if($rs > 0){
				return 'success';
			}else{
				return false;
			}
		} catch (Exception $e) {
			//return false;
			return $e->getMessage();
		}
	}

	function getRoleDataById($roleid)
	{
		try {			
			global $dbh;

			$query = "SELECT * FROM tblrole WHERE roleid='".$roleid."'";
			$rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);
			//return $query;
			if($count > 0){
				return $rs[0];
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}

	function isRoleWithPrivilege($roleid)
	{
		try {
			$query = "SELECT * FROM tblroleprivilege WHERE roleid = '".$roleid."'";
			//return $query;
			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);

		    if($count > 0){				
				return true;				
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}

	function isRoleRegistered($rolename)
	{
		try {
			$query = "SELECT * FROM tblrole WHERE role = '".$rolename."'";
			//return $query;
			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);

		    if($count > 0){				
				return true;				
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}

	/*End Role Module*/


	/*Role Privilege Module methods*/

	function ViewRolePrivileges()
	{
		try {
			$query = "SELECT * FROM tblroleprivilege GROUP BY roleid";
			//return $query;
			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);

		    $r = ' <table class="table" id="viewRolePrivilegeTable">
		                <thead>
		                  <tr>
		                    <th>SN</th>
		                    <th>Role Name</th>
		                    <th>Privileges</th>
		                    <th>Action</th>
		                  </tr>
		                </thead>
	                    <tbody>
                ';
			
			if($count > 0){				
				$sn = 1;
				foreach ($rs as $roleprivileges => $roleprivilege) {
					$roledata = getRoleDataById($roleprivilege['roleid']);
					$r .= '
							<tr>
								<td>'.$sn.'</td>
	                            <td>'.$roledata['role'].'</td>
	                            <td>'.ucwords(getRolePrivilegeByRoleId($roleprivilege['roleid'])).'</td>
	                        	<td>
	                            	<a href="javascript:void(0)" id="edit'.$roleprivilege['roleid'].'" rel="'.$roleprivilege['roleid'].'" class="btnEditRolePrivilege" title="edit"><i class="fa fa-edit"></i>
	                            	</a>
	                            </td>
                    		</tr>';

					$sn++;
				}
				
			}else{
				$r .= '<tr><td colspan="4" class="text-center">No Record Found</td></tr>';
			}

			$r .= '		</tbody>
	                </table>';
			return $r;
		} catch (Exception $e) {
			return '<p class="text-danger">Error encountered while retrieving records</p>';
			//return $e->getMessage();
		}
	}

	function addNewRolePrivilegeRecord($roleid, $privilege, $edit = false, $id = 0)
	{
		global $dbh;
		$query = '';

		$date = '';
		$d = new DateTime($date);
		$cdate = $d->format('Y-m-d h:i:s');

		$userdata = getUserSessions();
		$loggedinuser = $userdata[0];

		try{
			// prepare sql and bind parameters
			if($edit == true){
				$cArray = '';
				$wArray = array('roleid'=>$id);
				$rs = $dbh->delete('tblroleprivilege', $wArray)->affectedRows();
				//return $query;
			}

			$lastId = 0;
			for ($i=0; $i < count($privilege); $i++) { 
				$cArray = array('roleid'=>$roleid, 'privilegeid'=>$privilege[$i]);
				$wArray = '';
				$lastId = $dbh->insert('tblroleprivilege', $cArray, $wArray)->getLastInsertId();
			}				

			if($lastId > 0){
				return 'success';
			}else{
				return false;
			}

		} catch (Exception $e) {
			//return false;
			return $e->getMessage();
		}
	}

	function deleteRolePrivilegeRecord($id)
	{
		try{
			global $dbh;

			// prepare sql and bind parameters
			$cArray = '';
			$wArray = array('id'=>$id);
			$rs = $dbh->delete('tblroleprivilege', $wArray)->affectedRows();

			if($rs > 0){
				return 'success';
			}else{
				return false;
			}
		} catch (Exception $e) {
			//return false;
			return $e->getMessage();
		}
	}

	function getRolePrivilegeDataById($id)
	{
		try {			
			global $dbh;

			$query = "SELECT * FROM tblroleprivilege WHERE id='".$id."'";
			$rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);
			//return $query;
			if($count > 0){
				return $rs[0];
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}

	function getRolePrivilegeDataByRoleId($roleid)
	{
		try {			
			global $dbh;

			$query = "SELECT * FROM tblroleprivilege WHERE roleid='".$roleid."'";
			$rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);
			//return $query;
			if($count > 0){
				return $rs;
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}

	function getRolePrivilegeByRoleId($roleid)
	{
		try {			
			global $dbh;

			$query = "SELECT * 
						FROM tblroleprivilege AS rp
						INNER JOIN tblprivilege AS p
						ON rp.privilegeid = p.privilegeid
						WHERE rp.roleid='".$roleid."'";
			$rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);
			//return $query;
			if($count > 0){
				$res = '';

				for($i = 0; $i  < count($rs); $i++){
					$res .= " ".$rs[$i]['privilege'].", &nbsp;&nbsp; ";
				}
				return $res;
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}

	function getAllPrivilegeChecklist($roledata = '0')
	{
		$r = '';
		try {			
			global $dbh;

			$query = "SELECT * FROM tblprivilege ORDER BY privilege ASC";
			$rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);
			//return $query;

			$pids = array();

			if($roledata != '0'){
				for ($i=0; $i < count((array)$roledata); $i++) { 
					array_push($pids, $roledata[$i]['privilegeid']);
				}
			}

			if($count > 0){
				$checked = '';				
				for($i = 0; $i < count($rs); $i++){
					$checked = ( in_array($rs[$i]['privilegeid'], $pids) ) ? 'checked' : '' ;
					$r .= '<div class="col-md-4">
	                            <input type="checkbox" class="form-check-input rolepriv" name="privilege[]" value="'.$rs[$i]['privilegeid'].'" '.$checked.' />
	                            <label class="form-check-label"><p>'.ucwords($rs[$i]['privilege']).'</p></label>
	                        </div>';
				}
			}else{
				$r .= "<h3>No Record Found</h3>";
			}
			return $r;
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}

	/*End Role Privilege Module*/



	/*User Module Methods*/

	function isEmployeeAssignedRole($employeeid, $roleid)
	{
		try {
			$query = "SELECT * 
						FROM tbluser 
						WHERE employeeid = '".$employeeid."' AND roleid = '".$roleid."' AND datemodified IS NULL";
			//return $query;
			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);

		    if($count > 0){				
				return true;				
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}

	function hasUserTakenAction($userid)
	{
		try {
			$query = "SELECT * FROM tblsales WHERE customerid = '".$customerid."'";
			//return $query;
			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);

		    if($count > 0){				
				return true;				
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}

	function ViewUsers()
	{
		try {
			$query = "SELECT *, u.status AS accountstatus
						FROM tbluser AS u
						INNER JOIN tblemployee AS e
						INNER JOIN tblrole AS r
						ON u.employeeid = e.employeeid
						AND u.roleid = r.roleid
						WHERE datemodified IS NULL
						ORDER BY fullname ASC
					";
			//return $query;
			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);

		    $r = ' <table class="table table-hover table-bordered" id="viewUserTable">
		                <thead>
		                  <tr>
		                    <th>SN</th>
		                    <th>Employee</th>
		                    <th>Role</th>
		                    <th>Status</th>
		                    <th>Action</th>
		                  </tr>
		                </thead>
	                    <tbody>
                ';
			
			if($count > 0){				
				$sn = 1;
				foreach ($rs as $users => $user) {
					$r .= '
							<tr>
								<td>'.$sn.'</td>
	                            <td>'.$user['fullname'].'</td>
	                            <td>'.$user['role'].'</td>
	                            <td>'.getStatusLabel($user['accountstatus']).'</td>
	                        	<td>
	                            	<a href="javascript:void(0)" id="edit'.$user['userid'].'" rel="'.$user['userid'].'" class="btnEditUser" title="edit"><i class="fa fa-edit"></i>
	                            	</a> &nbsp;&nbsp;&nbsp;&nbsp;
	                            	<a href="javascript:void(0)" id="delete'.$user['userid'].'" rel="'.$user['userid'].'" class=" btnDeleteUser" title="delete"><i class="fa fa-trash"></i>
	                            	</a>
	                            </td>
	                        </tr>';

					$sn++;
				}
				
			}else{
				$r .= '<tr><td colspan="5" class="text-center">No Record Found</td></tr>';
			}

			$r .= '		</tbody>
	                </table>';
			return $r;
		} catch (Exception $e) {
			return '<p class="text-danger">Error encountered while retrieving records</p>';
			//return $e->getMessage();
		}
	}

	function addNewUserRecord($employeeid, $roleid, $status, $edit = false, $id = 0)
	{
		global $dbh;
		$query = '';

		$date = '';
		$d = new DateTime($date);
		$cdate = $d->format('Y-m-d h:i:s');

		$userdata = getUserSessions();
		$loggedinuser = $userdata[0];

		try{
			// prepare sql and bind parameters
			if($edit == true){
				$cArray = array('modifiedby'=>$loggedinuser, 'datemodified'=>$cdate);
				$wArray = array('userid'=>$id);
				$rs = $dbh->update('tbluser', $cArray, $wArray)->affectedRows();
				//return $query;
			}

			$cArray = array('employeeid'=>$employeeid, 'roleid'=>$roleid, 'status'=>$status, 'assignedby'=>$loggedinuser, 'dateassigned'=>$cdate);
			$wArray = '';
			$lastId = $dbh->insert('tbluser', $cArray, $wArray)->getLastInsertId();

			if($lastId > 0){
				return 'success';
			}else{
				return false;
			}
		} catch (Exception $e) {
			//return false;
			return $e->getMessage();
		}
	}

	function deleteUserRecord($userid)
	{
		global $dbh;

		$userdata = getUserSessions();
		$loggedinuser = $userdata[0];

		try{
			// prepare sql and bind parameters
			$wArray = array('userid'=>$userid);
			$rs = $dbh->delete('tbluser', $wArray)->affectedRows();

			if($rs > 0){
				return 'success';
			}else{
				return false;
			}
		} catch (Exception $e) {
			//return false;
			return $e->getMessage();
		}
	}

	function getUserRecordById($userid)
	{
		try {			
			global $dbh;

			$query = "SELECT * FROM tbluser WHERE userid='".$userid."'";
			$rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);
			//return $query;
			if($count > 0){
				return $rs[0];
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}

	/*End Role Privilege Module*/




	/*User Module Methods*/

	function hasSalaryBeenPaid($employeeid, $yearid, $monthid)
	{
		try {
			$query = "SELECT * FROM tblsalary WHERE employeeid = '".$employeeid."' AND yearid = '".$yearid."' AND monthid = '".$monthid."' AND datemodified IS NULL";
			//return $query;
			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);

		    if($count > 0){				
				return true;				
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}

	function ViewSalary()
	{
		try {
			$query = "SELECT *
						FROM tblsalary AS s
						INNER JOIN tblemployee AS e
						INNER JOIN tblyear AS y
						INNER JOIN tblmonth AS m
						ON s.employeeid = e.employeeid
						AND s.yearid = y.id
						AND s.monthid = m.id
						WHERE datemodified IS NULL
						ORDER BY datecreated ASC
					";
			//return $query;
			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);

		    $r = ' <table class="table table-hover table-bordered" id="viewSalaryTable">
		                <thead>
		                  <tr>
		                    <th>SN</th>
		                    <th>Employee</th>
		                    <th>Year</th>
		                    <th>Month</th>
		                    <th>Salary Type</th>
		                    <th>Amount (&#8358;)</th>
		                    <th>Action</th>
		                  </tr>
		                </thead>
	                    <tbody>
                ';
			
			if($count > 0){				
				$sn = 1;
				foreach ($rs as $salaries => $salary) {
					$r .= '
							<tr>
								<td>'.$sn.'</td>
	                            <td>'.$salary['fullname'].'</td>
	                            <td>'.$salary['year'].'</td>
	                            <td>'.$salary['month'].'</td>
	                            <td>'.$salary['salarytype'].'</td>
	                            <td>'.formatAmount($salary['amount']).'</td>
	                        	<td>
	                            	<a href="javascript:void(0)" id="edit'.$salary['salaryid'].'" rel="'.$salary['salaryid'].'" class="btnEditSalary" title="edit"><i class="fa fa-edit"></i>
	                            	</a> &nbsp;&nbsp;&nbsp;&nbsp;
	                            	<a href="javascript:void(0)" id="delete'.$salary['salaryid'].'" rel="'.$salary['salaryid'].'" class=" btnDeleteSalary" title="delete"><i class="fa fa-trash"></i>
	                            	</a>
	                            </td>
	                        </tr>';

					$sn++;
				}
				
			}else{
				$r .= '<tr><td colspan="7" class="text-center">No Record Found</td></tr>';
			}

			$r .= '		</tbody>
	                </table>';
			return $r;
		} catch (Exception $e) {
			return '<p class="text-danger">Error encountered while retrieving records</p>';
			//return $e->getMessage();
		}
	}

	function payEmployeeSalary($employeeid, $yearid, $monthid, $amount, $salarytype, $edit = false, $id = 0)
	{
		global $dbh;
		$query = '';

		$date = '';
		$d = new DateTime($date);
		$cdate = $d->format('Y-m-d h:i:s');

		$userdata = getUserSessions();
		$loggedinuser = $userdata[0];

		try{
			// prepare sql and bind parameters
			if($edit == true){
				$cArray = array('modifiedby'=>$loggedinuser, 'datemodified'=>$cdate);
				$wArray = array('salaryid'=>$id);
				$rs = $dbh->update('tblsalary', $cArray, $wArray)->affectedRows();
				//return $query;
			}

			$cArray = array('employeeid'=>$employeeid, 'yearid'=>$yearid, 'monthid'=>$monthid, 'amount'=>$amount, 'salarytype'=>$salarytype, 'approvedby'=>$loggedinuser, 'datepaid'=>$cdate);
			$wArray = '';
			$lastId = $dbh->insert('tblsalary', $cArray, $wArray)->getLastInsertId();

			if($lastId > 0){
				return 'success';
			}else{
				return false;
			}
		} catch (Exception $e) {
			//return false;
			return $e->getMessage();
		}
	}

	function deleteSalaryRecord($salaryid)
	{
		global $dbh;

		$userdata = getUserSessions();
		$loggedinuser = $userdata[0];

		try{
			// prepare sql and bind parameters
			$wArray = array('salaryid'=>$salaryid);
			$rs = $dbh->delete('tblsalary', $wArray)->affectedRows();

			if($rs > 0){
				return 'success';
			}else{
				return false;
			}
		} catch (Exception $e) {
			//return false;
			return $e->getMessage();
		}
	}

	function getSalaryRecordById($salaryid)
	{
		try {			
			global $dbh;

			$query = "SELECT * FROM tblsalary WHERE salaryid='".$salaryid."' AND datemodified IS NULL";
			$rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);
			//return $query;
			if($count > 0){
				return $rs[0];
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}

	/*End Role Privilege Module*/


	/*Sales Module Methods*/

	function isSalesIdExist($salesid)
	{
		try {
			$query = "SELECT * FROM tblsales WHERE salesid = '".$salesid."'";
			//return $query;
			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);

		    if($count > 0){				
				return true;
				
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}

	function isSalesReferenceExist($salesref)
	{
		try {
			$query = "SELECT * FROM tblsales WHERE salesref = '".$salesref."'";
			//return $query;
			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);

		    if($count > 0){				
				return true;
				
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}

	function isPaymentMadeForSales($salesid)
	{
		try {
			$query = "SELECT * FROM tblsalespayment WHERE salesid = '".$salesid."'";
			//return $query;
			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);

		    if($count > 0){				
				return true;				
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}

	function ViewSales()
	{
		try {
			$query = "SELECT *, SUM(s.quantity) AS qty FROM tblsales AS s
						INNER JOIN tblcustomer AS cu
						INNER JOIN tblstock as st
						ON s.customerid = cu.customerid
						AND s.stockid = st.stockid
						GROUP BY s.salesref
					";
			//return $query;
			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);

		    $r = ' <table class="table table-hover table-bordered" id="viewSalesTable">
		                <thead>
		                  <tr>
		                    <th>SN</th>
		                    <th>Sales Reference</th>
		                    <th>Customer Name</th>
		                    <th>Quantity</th>
		                    <th>Sales Date</th>
		                    <th>Action</th>
		                  </tr>
		                </thead>
	                    <tbody>
                ';
			
			if($count > 0){				
				$sn = 1;
				foreach ($rs as $sales => $sale) {
					$pay = '';
					$total = getSalesTotalCostById($sale['salesref']);
				    $tp = getTotalAmountPaidBySalesId($sale['salesid']);
				    $outstanding = ($total - $tp);
					if($outstanding > 0){
						$pay = '<a href="../../sales-payment/add-new-sales-payment/?token='.$sale['salesref'].'" id="view'.$sale['salesref'].'" rel="'.$sale['salesref'].'" class="btnPaySales" title="make payment"><i class="fa fa-credit-card"></i>
	                            	</a> &nbsp;&nbsp;&nbsp;&nbsp;';
					}
					$r .= '
							<tr>
								<td>'.$sn.'</td>
	                            <td>'.$sale['salesref'].'</td>
	                            <td>'.$sale['fullname'].'</td>
	                            <td>'.$sale['qty'].'</td>
	                            <td>'.$sale['salesdate'].'</td>
	                        	<td>
	                            	<a href="javascript:void(0)" id="edit'.$sale['salesid'].'" rel="'.$sale['salesid'].'" class="btnEditSales" title="edit"><i class="fa fa-edit"></i>
	                            	</a> &nbsp;&nbsp;&nbsp;&nbsp;
	                            	<a href="javascript:void(0)" id="view'.$sale['salesref'].'" rel="'.$sale['salesref'].'" class="btnViewSales" title="view"><i class="fa fa-search-plus"></i>
	                            	</a> &nbsp;&nbsp;&nbsp;&nbsp;
	                            	'.$pay.'
	                            	<a href="javascript:void(0)" id="delete'.$sale['salesid'].'" rel="'.$sale['salesid'].'" class=" btnDeleteSales" title="delete"><i class="fa fa-trash"></i>
	                            	</a>
	                            </td>
	                        </tr>';

					$sn++;
				}
				
			}else{
				$r .= '<tr><td colspan="9" class="text-center">No Record Found</td></tr>';
			}

			$r .= '		</tbody>
	                </table>';
			return $r;
		} catch (Exception $e) {
			return '<p class="text-danger">Error encountered while retrieving records</p>';
			//return $e->getMessage();
		}
	}

	function addNewSalesRecord($salesref, $customer, $stock, $quantity, $salesdate, $edit = false, $id = 0)
	{
		global $dbh;
		$query = '';

		$date = '';
		$d = new DateTime($date);
		$cdate = $d->format('Y-m-d h:i:s');

		$userdata = getUserSessions();
		$loggedinuser = $userdata[0];

		try{
			// prepare sql and bind parameters
			if($edit == true){
				$cArray = array('salesref'=>$salesref, 'customerid'=>$customer, 'stockid'=>$stock, 'quantity'=>$quantity, 'salesdate'=>$salesdate);
				$wArray = array('salesid'=>$id);
				$rs = $dbh->update('tblsales', $cArray, $wArray)->affectedRows();

				if($rs > 0){
					return 'success';
				}else{
					return false;
				}
				//return $query;
			}else{
				$lastId = 0;
				for ($i=0; $i < count($stock); $i++) { 
					$cArray = array('salesref'=>$salesref, 'customerid'=>$customer, 'stockid'=>$stock[$i], 'quantity'=>$quantity[$i], 'salesdate'=>$salesdate, 'receivedby'=>$loggedinuser, 'datecreated'=>$cdate);
					$wArray = '';
					$lastId = $dbh->insert('tblsales', $cArray, $wArray)->getLastInsertId();
				}				

				if($lastId > 0){
					return 'success';
				}else{
					return false;
				}
			}
		} catch (Exception $e) {
			//return false;
			return $e->getMessage();
		}
	}

	function deleteSalesRecord($salesid)
	{
		global $dbh;

		try{
			// prepare sql and bind parameters
			$wArray = array('salesid'=>$salesid);
			$rs = $dbh->delete('tblsales', $wArray)->affectedRows();

			if($rs > 0){
				return 'success';
			}else{
				return false;
			}
		} catch (Exception $e) {
			//return false;
			return $e->getMessage();
		}
	}

	function getSalesRecordById($salesid)
	{
		try {			
			global $dbh;

			$query = "SELECT * FROM tblsales WHERE salesid='".$salesid."'";
			$rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);
			//return $query;
			if($count > 0){
				return $rs;
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}

	function getSalesRecordByReference($salesref)
	{
		try {			
			$query = "SELECT *, s.quantity AS qty FROM tblsales AS s
						INNER JOIN tblcustomer AS cu
						INNER JOIN tblstock as st
						ON s.customerid = cu.customerid
						AND s.stockid = st.stockid
						WHERE s.salesref = '".$salesref."'
					";
			//return $query;
			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);
			//return $query;
			if($count > 0){
				return $rs;
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}

	function getSalesIdByReference($salesref)
	{
		try {			
			global $dbh;

			$query = "SELECT * FROM tblsales WHERE salesref='".$salesref."'";
			$rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);
			//return $query;
			if($count > 0){
				return $rs[0]['salesid'];
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}

	function getTotalAmountPaidBySalesId($salesid)
	{
		try {			
			global $dbh;

			$query = "SELECT *, SUM(amountpaid) AS total FROM tblsalespayment WHERE salesid='".$salesid."'";
			$rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);
			//return $query;
			if($count > 0){
				return $rs[0]['total'];
			}else{
				return 0;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}

	function getSalesTotalCostById($salesref)
	{
		try {			
			global $dbh;

			$query = "SELECT *, s.quantity AS qty FROM tblsales AS s
						INNER JOIN tblcustomer AS cu
						INNER JOIN tblstock as st
						ON s.customerid = cu.customerid
						AND s.stockid = st.stockid
						WHERE s.salesref = '".$salesref."'
					";
			$rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);
			//return $query;
			if($count > 0){
				$total = 0;
				for ($i=0; $i < count($rs); $i++) { 
		          $stotal = ($rs[$i]['unitsellingprice'] * $rs[$i]['qty']);
		          $total += $stotal;
		        }
		        return $total;
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}


	/*Sales Payment Module Methods*/

	function isSalesPaymentReferenceExist($paymentref)
	{
		try {
			$query = "SELECT * FROM tblsalespayment WHERE paymentref = '".$paymentref."'";
			//return $query;
			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);

		    if($count > 0){				
				return true;
				
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}

	function isSalesPaymentIdExist($salespaymentid)
	{
		try {
			$query = "SELECT * FROM tblsalespayment WHERE paymentid = '".$salespaymentid."'";
			//return $query;
			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);

		    if($count > 0){				
				return true;				
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}

	function ViewSalesPayments()
	{
		try {
			$query = "SELECT *, SUM(amountpaid) AS amtpaid,  SUM(s.quantity) AS qty 
						FROM tblsalespayment AS sp
						INNER JOIn tblsales AS s
						INNER JOIN tblcustomer AS cu
						INNER JOIN tblstock as st
						ON sp.salesid = s.salesid
						AND s.customerid = cu.customerid
						AND s.stockid = st.stockid
						GROUP BY sp.paymentref
					";
			//return $query;
			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);

		    $r = ' <table class="table table-hover table-bordered" id="viewSalesPaymentsTable">
		                <thead>
		                  <tr>
		                    <th>SN</th>
		                    <th>Sales Reference</th>
		                    <th>Customer Name</th>
		                    <th>Bank Account</th>
		                    <th>Quantity</th>
		                    <th>Amount Paid (&#8358;)</th>
		                    <th>Outstanding (&#8358;)</th>
		                    <th>Sales Date</th>
		                    <th>Comment</th>
		                    <th></th>
		                  </tr>
		                </thead>
	                    <tbody>
                ';
			
			if($count > 0){				
				$sn = 1;
				foreach ($rs as $salespayments => $salespayment) {					 
					$account = getBankAccountRecordById($salespayment['bankaccountid']);
					$bankdata = getBankRecordById($account['bankid']);
					$outstd = ($salespayment['outstanding'] <= 0) ? '<span class="text-success">'.formatAmount($salespayment['outstanding']).'</span>' : '<span class="text-danger">'.formatAmount($salespayment['outstanding']).'</span>' ;
					$r .= '
							<tr>
								<td>'.$sn.'</td>
	                            <td>'.$salespayment['salesref'].'</td>
	                            <td>'.$salespayment['fullname'].'</td>
	                            <td>'.$bankdata['bankname'].' ('.$account['accountno'].')</td>
	                            <td>'.$salespayment['qty'].'</td>
	                            <td>'.formatAmount($salespayment['amtpaid']).'</td>
	                            <td>'.$outstd.'</td>
	                            <td>'.format_display_date($salespayment['salesdate']).'</td>
	                            <td>'.$salespayment['comment'].'</td>
	                        	<td>
	                            	<a href="../sales-invoice/?token='.$salespayment['salesref'].'" id="view'.$salespayment['salesref'].'" rel="'.$salespayment['paymentid'].'" class="btnPrintInvoice" title="print invoice"><i class="fa fa-print"></i>
	                            	</a>
	                            </td>
	                        </tr>';

					$sn++;
				}
				
			}else{
				$r .= '<tr><td colspan="9" class="text-center">No Record Found</td></tr>';
			}

			$r .= '		</tbody>
	                </table>';
	        /*
				<a href="javascript:void(0)" id="edit'.$salespayment['salesref'].'" rel="'.$salespayment['salesref'].'" class="btnEditSalesPayment" title="edit"><i class="fa fa-edit"></i>
            	</a> &nbsp;&nbsp;&nbsp;&nbsp;
            	<a href="javascript:void(0)" id="view'.$salespayment['salesref'].'" rel="'.$salespayment['salesref'].'" class="btnViewSalesPayment" title="view"><i class="fa fa-search-plus"></i>
            	</a> &nbsp;&nbsp;&nbsp;&nbsp;
	                            	
	        */
			return $r;
		} catch (Exception $e) {
			return '<p class="text-danger">Error encountered while retrieving records</p>';
			//return $e->getMessage();
		}
	}

	function addNewSalesPaymentRecord($paymentref, $salesid, $bankaccountid, $amountpaid, $outstanding, $duedate, $paymenttype, $paymentmode, $comment, $edit = false, $id = 0)
	{
		global $dbh;
		$query = '';

		$date = '';
		$d = new DateTime($date);
		$cdate = $d->format('Y-m-d h:i:s');

		$userdata = getUserSessions();
		$loggedinuser = $userdata[0];

		try{
			// prepare sql and bind parameters
			if($edit == true){
				$cArray = array('paymentref'=>$paymentref, 'bankaccountid'=>$bankaccountid, 'salesid'=>$salesid, 'amountpaid'=>$amountpaid, 'duedate'=>$duedate, 'typeofpayment'=>$paymenttype, 'modeofpayment'=>$paymentmode, 'comment'=>$comment);
				$wArray = array('paymentid'=>$id);
				$rs = $dbh->update('tblsalespayment', $cArray, $wArray)->affectedRows();

				if($rs > 0){
					return 'success';
				}else{
					return false;
				}
				//return $query;
			}else{
				$cArray = array('paymentref'=>$paymentref, 'bankaccountid'=>$bankaccountid, 'salesid'=>$salesid, 'amountpaid'=>$amountpaid, 'outstanding'=>$outstanding, 'duedate'=>$duedate, 'datepaid'=>$cdate, 'typeofpayment'=>$paymenttype, 'modeofpayment'=>$paymentmode, 'comment'=>$comment);
				$wArray = '';
				$lastId = $dbh->insert('tblsalespayment', $cArray, $wArray)->getLastInsertId();

				if($lastId > 0){
					return 'success';
				}else{
					return false;
				}
			}
		} catch (Exception $e) {
			//return false;
			return $e->getMessage();
		}
	}

	function deleteSalesPaymentRecord($salespaymentid)
	{
		global $dbh;

		try{
			// prepare sql and bind parameters
			$wArray = array('paymentid'=>$salespaymentid);
			$rs = $dbh->delete('tblsalespayment', $wArray)->affectedRows();

			if($rs > 0){
				return 'success';
			}else{
				return false;
			}
		} catch (Exception $e) {
			//return false;
			return $e->getMessage();
		}
	}

	function getSalesPaymentRecordById($paymentid)
	{
		try {			
			global $dbh;

			$query = "SELECT * FROM tblsalespayment WHERE paymentid='".$paymentid."'";
			$rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);
			//return $query;
			if($count > 0){
				return $rs;
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}

	function getSalesPaymentRecordByReference($payref)
	{
		try {			
			$query = "SELECT * FROM tblsalespayment AS sp
						INNER JOIN tblsales AS s
						INNER JOIN tblcustomer AS cu
						INNER JOIN tblstock as st
						ON sp.salesid = s.salesid
						AND s.customerid = cu.customerid
						AND s.stockid = st.stockid
						WHERE sp.paymentref = '".$payref."'
					";
			//return $query;
			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);
			//return $query;
			if($count > 0){
				return $rs[0];
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}



	function ViewBankAccounts()
	{
		try {
			$query = "SELECT * FROM tblbank AS b
						INNER JOIN tblbankaccount AS ba
						ON b.bankid = ba.bankid
						WHERE ba.datemodified IS NULL
					";
			//return $query;
			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);

		    $r = ' <table class="table" id="viewBankAccountTable">
		                <thead>
		                  <tr>
		                    <th>SN</th>
		                    <th>Account Name</th>
		                    <th>Account Number</th>
		                    <th>Sortcode</th>
		                    <th>Bank</th>
		                    <th>Action</th>
		                  </tr>
		                </thead>
	                    <tbody>
                ';
			
			if($count > 0){				
				$sn = 1;
				foreach ($rs as $bankaccounts => $bankaccount) {
					$r .= '
							<tr>
								<td>'.$sn.'</td>
	                            <td>'.$bankaccount['accountname'].'</td>
	                            <td>'.$bankaccount['accountno'].'</td>
	                            <td>'.$bankaccount['sortcode'].'</td>
	                            <td>'.$bankaccount['bankname'].'</td>
	                        	<td>
	                            	<a href="javascript:void(0)" id="edit'.$bankaccount['bankaccountid'].'" rel="'.$bankaccount['bankaccountid'].'" class="btnEditBankAccount" title="edit"><i class="fa fa-edit"></i>
	                            	</a> &nbsp;&nbsp;&nbsp;&nbsp;
	                            	<a href="javascript:void(0)" id="delete'.$bankaccount['bankaccountid'].'" rel="'.$bankaccount['bankaccountid'].'" class=" btnDeleteBankAccount" title="delete"><i class="fa fa-trash"></i>
	                            	</a>
	                            </td>
                    		</tr>';

					$sn++;
				}
				
			}else{
				$r .= '<tr><td colspan="8" class="text-center">No Record Found</td></tr>';
			}

			$r .= '		</tbody>
	                </table>';
			return $r;
		} catch (Exception $e) {
			return '<p class="text-danger">Error encountered while retrieving records</p>';
			//return $e->getMessage();
		}
	}

	function addNewBankAccountRecord($bank, $accountname, $accountnumber, $sortcode, $edit = false, $id = 0)
	{
		global $dbh;
		$query = '';

		$date = '';
		$d = new DateTime($date);
		$cdate = $d->format('Y-m-d h:i:s');

		$userdata = getUserSessions();
		$loggedinuser = $userdata[0];

		try{
			// prepare sql and bind parameters
			if($edit == true){
				$cArray = array('bankid'=>$bank, 'accountname'=>$accountname, 'accountno'=>$accountnumber, 'sortcode'=>$sortcode, 'datemodified'=>$cdate, 'modifiedby'=>$loggedinuser);
				$wArray = array('bankaccountid'=>$id);
				$rs = $dbh->update('tblbankaccount', $cArray, $wArray)->affectedRows();

				if($rs > 0){
					$cArray = array('bankid'=>$bank, 'accountname'=>$accountname, 'accountno'=>$accountnumber, 'sortcode'=>$sortcode, 'dateadded'=>$cdate, 'addedby'=>$loggedinuser);
					$wArray = '';
					$lastId = $dbh->insert('tblbankaccount', $cArray, $wArray)->getLastInsertId();

					if($lastId > 0){
						return 'success';
					}else{
						return false;
					}
				}else{
					return false;
				}
				//return $query;
			}else{
				$cArray = array('bankid'=>$bank, 'accountname'=>$accountname, 'accountno'=>$accountnumber, 'sortcode'=>$sortcode, 'dateadded'=>$cdate, 'addedby'=>$loggedinuser);
				$wArray = '';
				$lastId = $dbh->insert('tblbankaccount', $cArray, $wArray)->getLastInsertId();

				if($lastId > 0){
					return 'success';
				}else{
					return false;
				}
			}

		} catch (Exception $e) {
			//return false;
			return $e->getMessage();
		}
	}

	function deleteBankAccountRecord($bankaccountid)
	{
		try{
			global $dbh;

			// prepare sql and bind parameters
			$cArray = '';
			$wArray = array('bankaccountid'=>$bankaccountid);
			$rs = $dbh->delete('tblbankaccount', $wArray)->affectedRows();

			if($rs > 0){
				return 'success';
			}else{
				return false;
			}
		} catch (Exception $e) {
			//return false;
			return $e->getMessage();
		}
	}

	function getBankAccountRecordById($bankaccountid)
	{
		try {			
			global $dbh;

			$query = "SELECT * FROM tblbankaccount WHERE bankaccountid='".$bankaccountid."'";
			$rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);
			//return $query;
			if($count > 0){
				return $rs[0];
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}

	function isBankAccountWithPayment($bankaccountid)
	{
		try {
			$query = "SELECT * FROM tblsalespayment WHERE bankaccountid = '".$bankaccountid."'";
			//return $query;
			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);

		    if($count > 0){				
				return true;				
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}

	function isBankAccountRegistered($accountnumber)
	{
		try {
			$query = "SELECT * FROM tblbankaccount WHERE accountno = '".$accountnumber."' AND datemodified IS NULL";
			//return $query;
			global $dbh;
		    $rs = $dbh->pdoQuery($query)->results();
		    $count = count($rs);

		    if($count > 0){				
				return true;				
			}else{
				return false;
			}
		} catch (Exception $e) {
			return false;
			//return $e->getMessage();
		}
	}

?>