<?php

namespace App\Model;

class ModelAdminHeader extends Model
{
    public function Query()
    {
        try{
            $sql = "SELECT * FROM header";
            $conn = new Conn();
            if($conn = $conn->conn()){
                if($stmt=$conn->prepare($sql)){
                    if($stmt->execute()){
                        return $stmt->fetchAll();
                    }
                }
            }
            return false;
        }catch(\PDOException $e){
            return false;
        }
    }

}