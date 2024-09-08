<?php

namespace App\Model;

class ModelRemoveImages extends Model
{
    private $data;
    public function __construct($data){
        $this->data =$data;
    }
    public function Query()
    {
        try{
            foreach ($this->data as $row){
                $sql = "DELETE FROM realestate_image WHERE id_post = :id_post AND id = :id";
                $conn = new Conn();
                if($conn = $conn->conn()){
                    if($stmt=$conn->prepare($sql)){
                        $stmt->bindParam(":id_post", $row["id_post"]);
                        $stmt->bindParam(":id", $row["id"]);
                        if(!$stmt->execute()) return false;
                    }
                }
            }
            return true;
        }
        catch(\PDOException){
            return false;
        }
    }

}