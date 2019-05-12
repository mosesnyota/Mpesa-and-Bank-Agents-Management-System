<?php  
require_once('auth.php');
$user = $_SESSION['SESS_NAME_'];
$usercat = $_SESSION['SESS_CATEGORY_'];

?><?php
//the class responsible for saving all data
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  ) . $ds;

require_once("{$base_dir}dao{$ds}SaveData.php");
require_once("{$base_dir}AuditTrail.php");

class AuditTrail {
    var $today;
    var $saahii;
    /**
     * This Constructor receives the activity
     * and username of the user for saving into the
     * database
     * @param type $activity
     * @param type $username
     * @author Moses Nyota mosesnyota@gmail.com
     * Nov 17 2018
     */
    public function __construct($activity,$username){
        //date_default_timezone_set('Africa/Nairobi');
	$date = new DateTime();
	$date->setTimezone(new DateTimeZone('Africa/Nairobi'));
        $colsAudit = array();
        $colsAudit['uname'] = $username;
        $colsAudit['auditDate'] = $this->now();
        $colsAudit['ipaddress'] = $_SERVER['REMOTE_ADDR'];
        $activity1 = trim($activity);
        $colsAudit['activity'] = addslashes($activity1);
        $record = "insert into tblAudittrail(" . implode(",", array_keys($colsAudit)) . ") values('" . implode("','", $colsAudit) . "')";
        //Save the Record
        include('dao/connect.php');
        $db->query($record);
    }
    
 
    
    function now() {
        $date = new DateTime();
	$date->setTimezone(new DateTimeZone('Africa/Nairobi'));
        return $date->format('Y-m-d H:i:s');
    }
}
