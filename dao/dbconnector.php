<?php
/* 
 CONNECT-DB.PHP
 Allows PHP to connect to your database
*/

 // Database Variables (edit with your own server information)
 $server = 'localhost';
 $user = 'root';
 $pass = '';
 $db = 'property';
 
 
 
 // Connect to Database
 $connection = mysqli_connect($server, $user, $pass, $db) ;
 
if ($connection->connect_error) {
    die('Connect Error (' . $connection->connect_errno . ') '
            . $connection->connect_error);
}



?>