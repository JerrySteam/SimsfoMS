<?php

    $path = "../";
	require_once $path.'@core/core.php';
	require_once $path.'@core/helperFunction.php';

	if(isset($_POST)){
		$salesref = cleanInput($_POST['salesref']);

        if( strlen($salesref) < 1){
            $err = 'Unauthorized Request. Process Terminated.';
        }else{
            $salesdata = getSalesRecordByReference($salesref);
            if($salesdata == false){
                $err = 'Error Encountered. Container record not found.';
            }else{
                $err = '
                          <div class="row">
                            <div class="col-md-12">
                              <div class="tile">
                                <div class="tile-body">
                                  <table class="table table-striped" id="salesPaymentRecordTable" width="100%">
                                    <thead>
                                      <tr>
                                        <th colspan="6">Customer: &nbsp;&nbsp;&nbsp; '.$salesdata[0]['fullname'].'</th>
                                      </tr>
                                      <tr>
                                        <th colspan="6">Sales Reference: &nbsp;&nbsp;&nbsp; '.$salesdata[0]['salesref'].'</th>
                                      </tr>
                                      <tr>
                                        <th colspan="6">Sales Date: &nbsp;&nbsp;&nbsp; '.$salesdata[0]['salesdate'].'</th>
                                      </tr>
                                      <tr>
                                        <th><br/><br/> #</th>
                                        <th>Stock Reference</th>
                                        <th>Stock Name</th>
                                        <th>Price (&#8358;)</th>
                                        <th>Qty</th>
                                        <th>Subtotal (&#8358;)</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                        ';
                $sn = 1;
                $total = 0;
                for ($i=0; $i < count($salesdata); $i++) {
                  $stotal = ($salesdata[$i]['unitsellingprice'] * $salesdata[$i]['qty']);
                  $total += $stotal;
                  $err .= '
                                      <tr>
                                        <td>'.$sn.'</td>
                                        <td>'.$salesdata[$i]['stockref'].'</td>
                                        <td>'.$salesdata[$i]['stockname'].'</td>
                                        <td>'.formatAmount($salesdata[$i]['unitsellingprice']).'</td>
                                        <td>'.$salesdata[$i]['qty'].'</td>
                                        <td>'.formatAmount($stotal).'</td>
                                      </tr>                                
                    ';
                  $sn++;
                }

                $err .= '
                                </tbody>
                                <tfoot>
                                  <tr>
                                    <th colspan="6" class="text-right" style="padding-right:10%">
                                      Comment:  '.$salesdata[0]['comment'].'
                                    </th>
                                  </tr>
                                  <tr>
                                    <th colspan="6" class="text-right" style="padding-right:10%">
                                      Total:  '.formatAmount($total).'
                                    </th>
                                  </tr>
                                </tfoot>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                      <script>$("#salesPaymentRecordTable").dataTable();</script>';                
            }            
        }
        echo $err;
	}else{
        echo 'Unauthorized Request. Process Terminated';
	}
?>