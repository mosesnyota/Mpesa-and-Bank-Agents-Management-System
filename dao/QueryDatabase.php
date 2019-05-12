<?php


/**
 * The class performs all the 
 * Select actions to get data
 * from the database
 *
 * @author Administrator
 */
class QueryDatabase {
    public function __construct($query){
        include('connect.php');
        try {
           $result = $db->query($query);
           return $result;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
