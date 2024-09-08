<?php

namespace App\Model;

class ModelUserProfile extends Model
{
    private $id;
    public function __construct($id)
    {
        $this->id = $id;
    }
    public function Query()
    {
        $sql = "SELECT f_name, l_name, email FROM users WHERE user_id=:id";
        $conn = new Conn();
        try{
            if($conn=$conn->conn()){
                if($stmt=$conn->prepare($sql)){
                    $stmt->bindParam(":id", $this->id);
                    if($stmt->execute()){
                        return $stmt->fetch();
                    }

                }
            }
            return false;
        }
        catch(\PDOException $e){
            return false;
        }

    }
}