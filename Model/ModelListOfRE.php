<?php

namespace App\Model;

class ModelListOfRE extends Model
{
    private $id;
    public function __construct($id){
        $this->id=$id;
    }
    public function Query()
    {
        $sql = "SELECT * FROM realestate WHERE owner = :id AND is_active=1";
        $conn = new Conn();
        try{
            if($conn=$conn->conn()){
                if($stmt = $conn->prepare($sql)){
                    $stmt->bindParam(":id", $this->id);
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