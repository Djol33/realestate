<?php

namespace App\Model;

class ModelAdminAllActiveUsers extends Model
{
    public function Query()
    {
        try{
            $sql = "SELECT * FROM users WHERE is_active = 1";
            $conn = new Conn();
            if($conn = $conn->conn()){
                if($stmt=$conn->prepare($sql)){
                    if($stmt->execute()){
                        return $stmt->fetchAll();
                    }
                }
            }
            return false;
        }
        catch(\PDOException){
            return false;
        }
    }

}