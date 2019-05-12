<?php
/**
 * This class performs all
 * the inserts into the database
 * @author Moses Nyota
 * mosesnyota@gmail.com
 * Nov 17 2018
 */
class SaveData {
    public function __construct($query){
        include('connect.php');
        try {
            $state = $db->query($query);
            return $state;
           
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        
    }
}
