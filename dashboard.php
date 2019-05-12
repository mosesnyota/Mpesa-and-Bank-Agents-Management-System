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
        Today's Statistics
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Today's Statistics</li>
      </ol>
    </section> 
<section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        
       <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo number_format(getTotalTransactions(),0) ?></h3>
              <p> TRANSACTIONS</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" data-toggle="modal" data-target="#modal-info" class="small-box-footer">Set Float <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
          
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo number_format(getTotalDeposits(),0) ?></h3>
               <p>TOTAL DEPOSITS</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="alltransactions.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
        
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
               <h3><?php echo number_format(getTotalWithdrawals(),0) ?></h3>
              <p>TOTAL WITHDRAWALS</p>
                
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
              <a href="alltransactions.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
                <h3><?php 

               
                $cashAmount = getStartingCash();
                
                $amountNow = $cashAmount ;
                echo number_format($amountNow,0);
                
                ?></h3>
              <p>EXPECTED CASH</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
              <a href="closing_report.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-8 connectedSortable">
          <div class="box-footer clearfix no-border">
              <button type="button" class="btn btn-warning btn-lg pull-left" data-toggle="modal" data-target="#modal-info"><i class="fa fa-plus"></i> Add External Float</button>
              <button type="button" class="btn btn-info btn-lg pull-right" data-toggle="modal" data-target="#modal-savecash"><i class="fa fa-plus"></i> Add External Cash</button>
        
          </div>
           <div class="box-footer clearfix no-border">
               
              <button type="button" class="btn btn-success pull-left" data-toggle="modal" data-target="#modal-info-addfloat"><i class="fa fa-plus"></i> Add Float [Deposit Cash to Bank] </button>
              <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#modal-savecash-addcash"><i class="fa fa-plus"></i> Add Cash[Withdraw Float to Increase Cash]</button>
              <div class="divider"/> </div>
              </div>
        </section>
          </div>
        </section>
       
  <section class="col-lg-8 connectedSortable">
 
      
      
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
                 </table>
                    
                </div>
            </div>
            <!-- /.box-body-->
            
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
  
  
    
    <div class="modal modal-primary fade" id="modal-info-addfloat">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Float [Deposit Cash to Bank] This reduces cash balance</h4>
              </div>
              <div class="modal-body">
            <form role="form" action="update_float.php" method="post"  enctype="multipart/form-data">
                
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
                <button type="submit" class="btn btn-primary">Save Float</button>
              </div>
            </form>
              </div>
              
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
    </div>
  
  
  
  
  
  
      
    <div class="modal modal-primary fade" id="modal-savecash-addcash">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Cash [ This reduces Float ]</h4>
              </div>
              <div class="modal-body">
             <form role="form" action="update_cash.php" method="post"  enctype="multipart/form-data">
                <div class="form-group">
                  <label for="tdate">Todays Date:</label>
                  <input name="tdate" type="text" disabled="disabled" class="form-control" id="tdate"  value="<?php echo date('d-m-Y'); ?>" >
                </div>
                
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
  