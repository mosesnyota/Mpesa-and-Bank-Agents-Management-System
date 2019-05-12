<?php

if (isset($_POST['neno_siri']) && isset($_POST['mtumiaji'])) {
    
   // echo password_hash("africa", PASSWORD_DEFAULT); 
    
    //Array to store validation errors
    $errmsg_arr = array();

    //Validation error flag
    $errflag = false;

    //Sanitize the POST values prevent sqlinjection
    /* @var $_POST type */
    $username = strip_tags(trim($_POST["mtumiaji"]));
    $password = strip_tags(trim($_POST["neno_siri"]));

    //$username1 = PDO :: quote($username);
   // $password1 = PDO::quote($password);

    $username1 = $username;
   $password1 = $password;
    //Input Validations
    if ($username1 == '') {
        $errmsg_arr[] = 'Username missing ';

        $errflag = true;
    }
    if ($password1 == '') {
        $errmsg_arr[] = 'Password missing';
        $errflag = true;
    }
    //If there are input validations, redirect back to the login form
    if ($errflag) {
        $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
        session_write_close();
        header("location: index.php");
        exit();
    }
    include('dao/connect.php');
    //Create query
    $qry = "SELECT `user_login_id`,`user_password` FROM `users` WHERE `user_login_id` = '$username1'";
    
    $result = $db->prepare($qry);
    // execute the query
    $result->execute();
    //Check whether the query was successful or not
   
    if ($result) {
       
            //Login Successful

            $member = $result->fetch();
            $password2 = $member['user_password'];

            if (true) {
                session_regenerate_id();
                $_SESSION['SESS_ID'] = $member['user_login_id'];
                $_SESSION['SESS_NAME'] = $member['user_login_id'];

                header("location: main_page.php");
                session_write_close();
                exit();
            } else {
                echo "Wrong Password";
                die;
                header("location: login.html");
                exit();
            }
        
    } else {
        header("location: login.html");
            exit();
    }
} else {
    
}
