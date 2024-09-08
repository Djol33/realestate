<?php

namespace App\Model;

class ModelLoadImages extends Model
{
    private $id;
    public function __construct($id){
        $this->id=(int)$id;
    }
    public function Query()
    {
        try{
            $sql = "SELECT * FROM realestate_image WHERE id_post = :id";
            $conn = new Conn();
            if($conn = $conn->conn()){
                if($stmt = $conn->prepare($sql)){
                    $stmt->bindParam(":id", $this->id);

                    if($stmt->execute()){
                        return $stmt->fetchAll();
                    }
                }
            }
            return false;
        }

        catch (\PDOException $e){
            return false;
        }
    }
}