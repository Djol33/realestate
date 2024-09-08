<?php

namespace App\Model;

class ModelUser extends Model
{
    private $id;
    public function __construct($id)
    {
        $this->id = $id;
    }
    public function Query()
    {
        try{
            $sql = "SELECT user_id, f_name, l_name, email FROM users WHERE  user_id = :id";
            $conn = new Conn();
            if($conn = $conn->conn()) {
                if ($stmt = $conn->prepare(($sql))) {
                    $stmt->bindParam(":id", $this->id);
                    if( $stmt->execute()){
                        if($stmt->rowCount()==1){
                            return $stmt->fetch();
                        }
                    }
                }
            }
            return false;

        }catch (\PDOException){
            return false;
        }

    }

}