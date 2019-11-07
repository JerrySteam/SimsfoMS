<?php

    $path = "../";
  require_once $path.'@core/core.php';
  require_once $path.'@core/helperFunction.php';

  if(isset($_POST)){
    $supplierid = cleanInput($_POST['supplierid']);

        if($supplierid < 1){
            $err = 'Unauthorized Request. Process Terminated.';
        }else{
            $supplierdata = getSupplierTransactionRecordById($supplierid);
            if($supplierdata == false){
                $err = 'No transaction record found.';
            }else{
                $supplierbalance = $supplierdata['balance'];
                $supplierhistory = $supplierdata['history'];
                $err = '
                      <div class="col-md-12">
                        <h3 class="tile-title">Supplier Transaction History</h3>
                        <div class="tile-body">
                          <span><b>Supplier</b>: '.$supplierhistory[0]['supplier'].'</span><br>
                          <span><b>Account Balance</b>: '.formatAmount($supplierbalance).' '.$supplierhistory[0]['accronym'].'</span><br><br>

                          <table class="table table-hover table-bordered" id="viewSupplierTransactionTable">
                            <thead>
                              <tr>
                                <th>SN</th>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Amount('.$supplierhistory[0]['accronym'].')</th>
                                <th>Transaction</th>
                                <!--<th>Action</th>-->
                              </tr>
                            </thead>
                            <tbody>';
                              $sn = 1;
                              foreach ($supplierhistory as $shs => $sh) {
                                $err .= '
                                    <tr>
                                      <td>'.$sn.'</td>
                                      <td>'.formatdate($sh['datec']).'</td>
                                      <td>'.$sh['invoiceref'].'</td>
                                      <td>'.formatAmount($sh['amount']).'</td>
                                      <td>'.$sh['transactionname'].'</td>
                                      <!--
                                      <td>
                                        <a href="javascript:void(0)" id="edit'.$sh['supplieraccountid'].'" rel="'.$sh['supplieraccountid'].'" class="" title="edit"><i class="fa fa-edit"></i>
                                        </a> &nbsp;&nbsp;&nbsp;&nbsp;
                                        <a href="javascript:void(0)" id="delete'.$sh['supplieraccountid'].'" rel="'.$sh['supplieraccountid'].'" class="" title="delete"><i class="fa fa-trash"></i>
                                        </a>
                                      </td>
                                      -->
                                    </tr>';
                                $sn++;
                              }
                    $err .='</tbody>
                          </table>
                        </div>
                      </div>
                      <script type="text/javascript">$("#viewSupplierTransactionTable").DataTable({
                        dom: "Bfrtip",
                        buttons: [
                          "print"
                        ]
                      });</script>
                    ';
            }            
        }
        echo $err;
  }else{
        echo 'Unauthorized Request. Process Terminated';
  }

?>