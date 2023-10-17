<?php

class BaseClass {
    
    /**
     * Function to execute the query to DB
     * @param String $query Query need to execute in DB
     * 
     * @return List List of Data
     */
    public function executeQuery($query){
        include('./../db_config.php');
        try{
            $result = $conn->query($query);
            $conn->close();
            return $result;
        }
        catch(Exception $e){
            $conn->close();
            throw new Exception($e);
        }
    }
}