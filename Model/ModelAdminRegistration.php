<?php

namespace App\Model;

class ModelAdminRegistration extends Model
{
    public function Query()
    {

        $notActive=0;
        $conn= new Conn();
        $sql= "SELECT user_id, f_name, l_name, email FROM users WHERE is_active=:act";
        if($conn=$conn->conn()){
            if($stmt=$conn->prepare($sql)){
                $stmt->bindParam(":act", $notActive);
                if($stmt->execute()){
                    return $stmt->fetchAll();
                }
            }
        }
    }

}