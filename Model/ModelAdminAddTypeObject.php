<?php

namespace App\Model;

class ModelAdminAddTypeObject extends Model
{
    private $name;
    public function __construct($name){
        $this->name = $name;
    }
    public function Query()
    {
        $sql ="INSERT INTO tip_objekta (naziv) VALUES ( :naziv )";
        $conn=new Conn();
        try{
            if($conn=$conn->conn()){
                if($stmt=$conn->prepare($sql)){
                    $stmt->bindParam(":naziv", $this->name);
                    if($stmt->execute()){
                        return true;
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