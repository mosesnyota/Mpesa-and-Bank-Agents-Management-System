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

function getStartingCash(){
    include('dao/connect.php');
    $statement = "SELECT `cash_amount` FROM `cashsettings` ";
    $deposits = 0;
    $result = $connection->query($statement);
    while($row = $result->fetch_assoc()) {
           $deposits = $row['cash_amount'];
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
        Adjust Float or Cash
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Adjust</li>
      </ol>
    </section> 
  
  
  
  
  
  

  
  
  
  
  
  
  
       <section class="col-lg-8 connectedSortable">
    <div class="box-footer clearfix no-border">
         <p> NOTE: Reducing float does not affect cash, and withdrawing cash does not affect float</p>
             <button type="button" class="btn btn-warning btn-lg pull-left" data-toggle="modal" data-target="#modal-reduce_float"><i class="fa fa-minus-circle"></i> Reduce Float</button>
             <button type="button" class="btn btn-info btn-lg pull-right" data-toggle="modal" data-target="#modal-reduce_cash"><i class="fa fa-minus-circle"></i> Withdraw Cash</button>
    </div>
   </section>
  
  
  
  
  <!-- /.content -->
    
    <div class="modal modal-primary fade" id="modal-info">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Float</h4>
              </div>
              <div class="modal-body">
            <form role="form" action="save_float.php" method="post"  enctype="multipart/form-data">
                
                <div class="form-group">
                  <label>Select Account</label>
                  <select class="form-control" name="accountT" required="true" autofocus="true">
                   <option style="color:green" value ="">---------Select Account-----------</option>
                    <?php  
                    include('dao/connect.php');
                     $statement = "SELECT accounts.`accnt_id`,`account_name`,account_type FROM `accounts`";
                     $result = $db->query($statement);
                      while($row = $result->fetch_assoc()) {
                          $accnid = $row['accnt_id'];
                          $account_name = $row['account_type']." : ".$row['account_name'];
                          echo "<option value =\"$accnid\"><p><font size=\"6\" color=\"Green\">$account_name</font></p></option>";
                      }
                    
                    ?>
                   
                  </select>
                </div>
                
                <div class="form-group">
                  <label for="floatAmnt">Float Amount:</label>
                  <input name="floatAmnt" type="number" autocomplete="off" class="form-control" id="floatAmnt" required autofocus="true">
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
  
  
  
  
  
  
      
    <div class="modal modal-primary fade" id="modal-savecash">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Cash</h4>
              </div>
              <div class="modal-body">
            <form role="form" action="save_cash.php" method="post"  enctype="multipart/form-data">
                
                <div class="form-group">
                  <label for="tdate">Todays Date:</label>
                  <input name="tdate" type="text" disabled="disabled" class="form-control" id="tdate"  value="<?php echo date('d-m-Y'); ?>" >
                </div>
                
                <div class="form-group">
                  <label for="floatAmnt">Cash Amount:</label>
                  <input name="floatAmnt" type="number" autocomplete="off" class="form-control" id="floatAmnt" required autofocus="true">
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
                  <label>Select Account [ BY Default MPESA is selected ]</label>
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
  
  
  
  
  
  
  
  
  
  
    
    <div class="modal modal-primary fade" id="modal-reduce_float">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Reduce Float</h4>
              </div>
              <div class="modal-body">
            <form role="form" action="save_reduce_float.php" method="post"  enctype="multipart/form-data">
                
                <div class="form-group">
                  <label>Select Account</label>
                  <select class="form-control" name="accountT" required="true" autofocus="true">
                   <option style="color:green" value ="">---------Select Account-----------</option>
                    <?php  
                    include('dao/connect.php');
                     $statement = "SELECT accounts.`accnt_id`,`account_name`,account_type FROM `accounts`";
                     $result = $db->query($statement);
                      while($row = $result->fetch_assoc()) {
                          $accnid = $row['accnt_id'];
                          $account_name = $row['account_type']." : ".$row['account_name'];
                          echo "<option value =\"$accnid\"><p><font size=\"6\" color=\"Green\">$account_name</font></p></option>";
                      }
                    
                    ?>
                   
                  </select>
                </div>
                <div class="form-group">
                  <label for="tdate">Todays Date:</label>
                  <input name="tdate" type="text" disabled="disabled" class="form-control" id="tdate"  value="<?php echo date('d-m-Y'); ?>" >
                </div>
                <div class="form-group">
                  <label for="floatAmnt">Float Amount:</label>
                  <input name="floatAmnt" type="number" autocomplete="off" class="form-control" id="floatAmnt" required autofocus="true">
                </div>
                
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save </button>
              </div>
            </form>
              </div>
              
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
    </div>
  
  
  
  
  
  
      
    <div class="modal modal-primary fade" id="modal-reduce_cash">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Cash</h4>
              </div>
              <div class="modal-body">
                  <form role="form" action="save_reduce_cash.php" method="post"  enctype="multipart/form-data">
                
                <div class="form-group">
                  <label for="tdate">Todays Date:</label>
                  <input name="tdate" type="text" disabled="disabled" class="form-control" id="tdate"  value="<?php echo date('d-m-Y'); ?>" >
                </div>
                
                <div class="form-group">
                  <label for="floatAmnt">Cash Amount:</label>
                  <input name="floatAmnt" type="number" autocomplete="off" class="form-control" id="floatAmnt" required autofocus="true">
                </div>
                
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
            </form>
              </div>
              
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
    </div>
  