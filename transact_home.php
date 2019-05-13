<?php date_default_timezone_set("Africa/Nairobi"); 


function getTotalDeposits(){
    include('dao/connect.php');
    $statement = "SELECT SUM(`trans_amount`) AS deposits FROM `transactions` WHERE `trans_type` ='D' and DATE_FORMAT(`trans_date`,'%Y-%m-%d') = CURDATE()";
    $deposits = 0;
    $result = $connection->query($statement);
    while($row = $result->fetch_assoc()) {
           $deposits = $row['deposits'];
      }
    return $deposits;
}

function getTotalTransactions(){
    include('dao/connect.php');
    $statement = "SELECT COUNT(*) AS transactionss FROM `transactions` WHERE  DATE_FORMAT(`trans_date`,'%Y-%m-%d') = CURDATE()";
    $deposits = 0;
    $result = $connection->query($statement);
    while($row = $result->fetch_assoc()) {
           $deposits = $row['transactionss'];
      }
    return $deposits;
}

function getExpectedCash(){
    include('dao/connect.php');
    $statement = "SELECT `cash_amount` FROM `cashsettings` ";
    $deposits = 0;
    $result = $connection->query($statement);
    while($row = $result->fetch_assoc()) {
           $deposits = $row['cash_amount'];
      }
    return $deposits;
}


function getMpesaBalance(){
    include('dao/connect.php');
    $statement = "SELECT SUM(`amount_paid`) AS TOTAL FROM `sales` WHERE `sales_date` = CURDATE() AND `mode_of_pay` = 'mpesa'";
    $deposits = 0;
    $result = $connection->query($statement);
    while($row = $result->fetch_assoc()) {
           $deposits = $row['TOTAL'];
      }
    return $deposits;
}

function getMpesaTillBalance(){
    include('dao/connect.php');
    $statement = "SELECT SUM(`amount_paid`) AS TOTAL FROM `sales` WHERE `sales_date` = CURDATE() AND `mode_of_pay` = 'till'";
    $deposits = 0;
    $result = $connection->query($statement);
    while($row = $result->fetch_assoc()) {
           $deposits = $row['TOTAL'];
      }
    return $deposits;
}

function getTotalWithdrawals(){
    include('dao/connect.php');
    $statement = "SELECT SUM(`trans_amount`) AS deposits FROM `transactions` WHERE `trans_type` ='W' and DATE_FORMAT(`trans_date`,'%Y-%m-%d') = CURDATE()";
    $deposits = 0;
    $result = $connection->query($statement);
    while($row = $result->fetch_assoc()) {
           $deposits = $row['deposits'];
      }
    return $deposits;
}

                    



?>
<style>
    .example-modal .modal {
      position: relative;
      top: auto;
      bottom: auto;
      right: auto;
      left: auto;
      display: block;
      z-index: 1;
    }

    .example-modal .modal {
      background: transparent !important;
    }
  </style>

<section class="content-header">
      <h1>
       Transactions Page
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Transact</li>
      </ol>
    </section> 
<section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        
       
          
       
        
        
        
        
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
            <div class="box-footer clearfix no-border">
              <button type="button" class="btn btn-success btn-lg pull-left"  data-toggle="modal" data-target="#modal-deposit"> DEPOSIT</button>
              <button type="button" class="btn btn-warning btn-lg pull-right" data-toggle="modal" data-target="#modal-withdraw"> WITHDRAW</button>
            </div>

          <!-- TABLE: LATEST ORDERS -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Latest Transactions</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr> 
                    <th>Account</th>
                    <th>Type</th>
                    <th>Amount</th>
                  </tr>
                  </thead>
                  <tbody>
                      
            <?php 
                    include('dao/connect.php');
                    $statement = "SELECT `transactions`.*, `account_name`,account_type FROM `transactions` JOIN `accounts` ON `transactions`.`accnt_id` = accounts.`accnt_id` ORDER BY `trans_date` DESC LIMIT 5";
                    $result = $connection->query($statement);
                    $num = 0;
            while($row = $result->fetch_assoc()) {
                  $num++; 
                  
                  $acct1 = $row['account_type'];
                  $acct = $row['account_name'];
                  $type = $row['trans_type'];
                  $amount = $row['trans_amount'];
                  $trans_code =  $row['trans_code'];
                  if($type =='W'){
                      $type ='Withdraw';
                      $label = 'label label-warning';
                  }else{
                      $type ='Deposit';
                      $label = 'label label-success';
                  }
                  ?>  
            
                      
                      
                <tr>
                    <td><?php echo $acct1.": ".$acct;  ?></td>
                    <td><span class="<?php echo $label;  ?>"><?php echo $type;  ?></span></td>
                    <td align='right'><?php echo number_format($amount,2);  ?></td>
                    
                </tr>
               
                  <?php }  ?>        
                  
                  
                 
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
             
              <a href="alltransactions.php" class="btn btn-sm btn-info btn-flat pull-right">View All Transactions</a>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
 
        </section>
        
        
        
        
        
       
        
        <section class="col-lg-5 connectedSortable">
 
      
      
           <div class="box box-solid  bg-light-blue-gradient">
            <div class="box-header">
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-primary btn-sm daterange pull-right" data-toggle="tooltip"
                        title="Date range">
                  <i class="fa fa-calendar"></i></button>
                <button type="button" class="btn btn-primary btn-sm pull-right" data-widget="collapse"
                        data-toggle="tooltip" title="Collapse" style="margin-right: 5px;">
                  <i class="fa fa-minus"></i></button>
              </div>
              <!-- /. tools -->

              <i class="fa fa-map-marker"></i>

              <h3 class="box-title">
                CURRENT FLOAT
              </h3>
            </div>
            <div class="box-body">
               <div  style="height: 300px; width: 100%;">
                 <table id="example1" class="table table-responsive table-hover">
             <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Amount</th>
                </tr>
            </thead>
                <tbody>
                    <?php 
                    
                    function getWithdrawals($iddd){
                        include('dao/connect.php');
                        $statement = "SELECT SUM(`trans_amount`) AS withdrawals FROM `transactions` WHERE `accnt_id` = '$iddd' AND `trans_type` ='W' and DATE_FORMAT(`trans_date`,'%Y-%m-%d') = CURDATE()";
                        $result = $connection->query($statement);
                        $withdrawals = 0;
                        while($row = $result->fetch_assoc()) {
                            $withdrawals = $row['withdrawals'];
                        }
                        return $withdrawals;
                    }
                    
                    function getDeposits($iddd){
                        include('dao/connect.php');
                        $statement = "SELECT SUM(`trans_amount`) AS deposits FROM `transactions` WHERE `accnt_id` = '$iddd' AND `trans_type` ='D' and DATE_FORMAT(`trans_date`,'%Y-%m-%d') = CURDATE()";
                        $deposits = 0;
                        $result = $connection->query($statement);
                        while($row = $result->fetch_assoc()) {
                            $deposits = $row['deposits'];
                        }
                        return $deposits;
                    }
                    
                    
                    
                    include('dao/connect.php');
                    $statement = "SELECT `accounts`.*,`float_amount` FROM `accounts` JOIN
`float_settings` ON ACCOUNTS.`accnt_id` = `float_settings`.`accnt_id` 
ORDER BY `float_amount` DESC";
                    $result = $connection->query($statement);
                    $num = 0;
            while($row = $result->fetch_assoc()) {
                  $num++; 
                  $withdrawals = getWithdrawals($row['accnt_id']);
                  $deposits    = getDeposits($row['accnt_id']);
                  $opngfloat   = $row['float_amount'];
                  $currfloat   = $opngfloat;
                  ?>
                <tr>
                  <td> <?php echo $num; ?></td>
                  <td> <?php echo $row['account_type']." : ".$row['account_name']; ?> </td>
                  <td> <?php echo "Ksh. ".number_format($currfloat,2); ?></td>
                </tr>
            <?php }  ?>   
                </tbody>
                
                <tfoot>
                    <tr>
                       
                    <th>Cash + Mpesa Till </th>
                     <th><?php echo "Ksh. ".number_format(getExpectedCash(),2); ?></th>
                      <th></th>
                    
                    </tr>
                   
                    
                <td></td>
                  <td></td>
                    <td></td>
                </tfoot>
                 </table>
                    
                </div>
                
            </div>
            <!-- /.box-body-->
            
          </div>
          
      </section>  
        <!-- right col -->
      </div>
      

    </section>
    
  
  <!-- /.content -->
  
  
   
  <div class="modal modal-primary fade" id="modal-deposit">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">DEPOSIT</h4>
              </div>
              <div class="modal-body">
            <form role="form" action="save_deposit.php" method="post"  enctype="multipart/form-data">
                
                
                <div class="form-group">
                  <label>Select Account [ BY Defaul MPESA is selected ]</label>
                  <select class="form-control" name="accountT" required>
                  
                    <?php  
                    include('dao/connect.php');
                     $statement = "SELECT accounts.`accnt_id`,`account_name`,account_type FROM `accounts`";
                     $result = $db->query($statement);
                      while($row = $result->fetch_assoc()) {
                          $accnid = $row['accnt_id'];
                          $account_name = $row['account_type']." : ".$row['account_name'];
                          if($row['account_type'] == 'MPESA'){
                             echo "<option value =\"$accnid\" selected><p><font size=\"6\" color=\"Green\">$account_name</font></p></option>";
                       
                          }else{
                           echo "<option value =\"$accnid\"><p><font size=\"6\" color=\"Green\">$account_name</font></p></option>";
                          }}
                    
                    ?>
                   
                  </select>
                </div>
                
                <div class="form-group">
                  <label for="depoamount">Deposit Amount:</label>
                  <input name="depoamount" type="number" autocomplete="off" class="form-control" id="depoamount" required autofocus>
                </div>
                
                
                <div class="form-group">
                  <label for="phoneaccnt">Phone No. / Accnt No.:</label>
                  <input name="phoneaccnt" type="number" autocomplete="off" class="form-control" id="phoneaccnt" required autofocus="yes">
                </div>
                <div class="form-group">
                  <label for="custname">Customer Name:</label>
                  <input name="custname" type="text" autocomplete="off" class="form-control" id="custname" required autofocus="yes">
                </div>
                <div class="form-group">
                  <label for="idno">ID No.:</label>
                  <input name="idno" type="text" autocomplete="off" class="form-control" id="idno" required autofocus="yes">
                </div>
                <div class="form-group">
                  <label for="transcode">Transaction Code:</label>
                  <input name="transcode" type="text" autocomplete="off" class="form-control" id="transcode" required autofocus="yes">
                </div>
                <div class="form-group">
                  <label for="tdate">Todays Date:</label>
                  <input name="tdate" type="text" disabled="disabled" class="form-control" id="tdate"  value="<?php echo date('d-m-Y'); ?>" >
                </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Settings</button>
              </div>
            </form>
              </div>
              
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
    </div>
  
  
  <div class="modal modal-primary fade" id="modal-withdraw">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">WITHDRAW</h4>
              </div>
              <div class="modal-body">
            <form role="form" action="save_withdraw.php" method="post"  enctype="multipart/form-data">
                
                
                <div class="form-group">
                  <label>Select Account [ BY Defaul MPESA is selected ]</label>
                  <select class="form-control" name="accountT" required>
                  
                    <?php  
                    include('dao/connect.php');
                     $statement = "SELECT accounts.`accnt_id`,`account_name`,account_type FROM `accounts`";
                     $result = $db->query($statement);
                      while($row = $result->fetch_assoc()) {
                          $accnid = $row['accnt_id'];
                          $account_name = $row['account_type']." : ".$row['account_name'];
                          if($row['account_type'] == 'MPESA'){
                             echo "<option value =\"$accnid\" selected><p><font size=\"6\" color=\"Green\">$account_name</font></p></option>";
                       
                          }else{
                           echo "<option value =\"$accnid\"><p><font size=\"6\" color=\"Green\">$account_name</font></p></option>";
                          }}
                    
                    ?>
                   
                  </select>
                </div>
                
                <div class="form-group">
                  <label for="depoamount">Withdrawal Amount:</label>
                  <input name="depoamount" type="number" autocomplete="off" class="form-control" id="depoamount" required autofocus>
                </div>
                
                
                <div class="form-group">
                  <label for="phoneaccnt">Phone No. / Accnt No.:</label>
                  <input name="phoneaccnt" type="number" autocomplete="off" class="form-control" id="phoneaccnt" required autofocus="yes">
                </div>
                <div class="form-group">
                  <label for="custname">Customer Name:</label>
                  <input name="custname" type="text" autocomplete="off" class="form-control" id="custname" required autofocus="yes">
                </div>
                <div class="form-group">
                  <label for="idno">ID No.:</label>
                  <input name="idno" type="text" autocomplete="off" class="form-control" id="idno" required autofocus="yes">
                </div>
                <div class="form-group">
                  <label for="transcode">Transaction Code:</label>
                  <input name="transcode" type="text" autocomplete="off" class="form-control" id="transcode" required autofocus="yes">
                </div>
                <div class="form-group">
                  <label for="tdate">Todays Date:</label>
                  <input name="tdate" type="text" disabled="disabled" class="form-control" id="tdate"  value="<?php echo date('d-m-Y'); ?>" >
                </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Settings</button>
              </div>
            </form>
              </div>
              
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
    </div>
  
  <!-- ./wrapper -->

