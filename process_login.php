
<?php
    header('Content-Type: application/json');

    $aResult = array();


    if (!isset($aResult['error'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    include('dao/connect.php');
    $statement = "SELECT  `user_id`,`username`,`passwrd`, `first_name`,`middle_name`,`role`,`role_id` FROM  `sys_users` 
JOIN `staff` ON sys_users.`member_id` = staff.`member_id`
JOIN `staff_category` ON staff.`category` = `staff_category`.`role_id` WHERE username = '$username' AND passwrd ='$password'";
    $result = $db->query($statement);
    $count = mysqli_num_rows($result);
    if ($count > 0) {
        
        
         while($row = $result->fetch_assoc()) {
             $staffname = $row['first_name']." ".$row['middle_name'];
             $role_id = $row['role_id'];
             $role = $row['role'];
         }
         
        $aResult['result'] = 'Success';
        
    
    
    
    if (session_id() =='') {
    session_start();
}

                session_regenerate_id();
		$sessionname=$_POST['username'];
		//$sessionname=$usename;
		$_SESSION['SESS_MEMBER_ID_'] = $sessionname;
		$_SESSION['SESS_NAME_'] = $staffname;
		$_SESSION['SESS_CATEGORY_'] = $role_id;
		$_SESSION['lastactivity'] = time();
                $_SESSION['SESS_ROLE'] = $role;
		session_write_close();
       
    }else{
      $aResult['error'] = 'Login Error';
    }

    }

    echo json_encode($aResult);
