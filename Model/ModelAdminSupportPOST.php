<?php

namespace App\Model;

class ModelAdminSupportPOST extends Model
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
                $sql = "UPDATE support  SET is_read = 1 WHERE  id = :id ";
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