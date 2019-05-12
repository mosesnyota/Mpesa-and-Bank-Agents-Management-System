<?php
/* Database config */
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_database = 'adminlte';

    $connection = new mysqli($db_host, $db_user, $db_pass, $db_database);
    $db = $connection;
   // Check connection
if ($db->connect_error) {
    die("Connection failed: " . $connection->connect_error);
} 

?>