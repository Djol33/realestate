<?php

namespace App\Model;

class ModelAdminRemoveUserPOST extends Model
{
    private $data;
    public function __construct($data){
        $this->data = $data;
    }
    public function Query()
    {
        try{


            for($i = 0; $i<count($this->data); $i++){
                $conn = new Conn();
                $sql = "UPDATE users SET is_active = 0 WHERE user_id = :id ";
                if($conn=$conn->conn()){
                    if($stmt=$conn->prepare($sql)){
                        $id =(int)$this->data[$i];
                        $stmt->bindParam(":id", $id);
                        if($stmt->execute()){
                            continue;
                        }
                        else{
                            die();
                        }
                    }
                }
            }
            return true;
        }catch(\PDOException $e){
            echo $e->getMessage();
            return false;
        }

    }
}