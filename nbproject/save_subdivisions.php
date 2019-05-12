<?php
include("audittrail.php");
require_once("dao/SaveData.php");

if (isset($_POST['newunits']) && isset($_POST['newsize']) && isset($_POST['master_id'])) { 
    $units = strip_tags($_POST['newunits']);
$size = strip_tags($_POST['newsize']);
$master_id = $_POST['master_id'];

$set_price = $_POST['defaultprice'];


function getPlotNo() {
    $qry = "SELECT MAX(`plot_num`) AS PLT FROM `plots` ";
    include('dao/connect.php');
    $result = $db->query($qry);
   
    while ($row = $result->fetch_assoc()) {
        $pltno = $row['PLT'];
    }
    if($pltno=='' || $pltno==' ' ){
       $pltno = 0; 
    }
       return  $pltno;
    }
$curr_plotno = getPlotNo();
$num = 1;
for($i = 0; $i<$units; $i++){
    $curr_plotno++;
    
   
    $query = "INSERT INTO `plots`(
             `plot_num`,
             `master_land_id`,
             `size`,
             `set_price`,
             `beacon_no`)
VALUES (
        '$curr_plotno',
        '$master_id',
        '$size',
        '$set_price',
        '$num')";
    $num++;
    
    new SaveData($query);
    
}

echo "<script type= 'text/javascript'>alert('Master Land Subdivided Successfully');</script>";
echo "<script language=javascript>window.location='subdivide_land.php';</script>";
new AuditTrail('Subdivided: Master land id = '.$master_id,'Admin');


}else{
    echo "NO VALUES WERE RECEIVED";
}
