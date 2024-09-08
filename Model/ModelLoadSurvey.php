<?php

namespace App\Model;

class ModelLoadSurvey extends Model
{
    private $id;


    public function __construct($id)
    {
        $this->id = $id;
    }
    public function Query()
    {
        try{
            $sql = "SELECT * FROM survey WHERE id = :id AND is_active = :isa";
            $conn = new Conn();
            if($conn = $conn->conn()){
                if($stmt = $conn->prepare($sql)){
                    $stmt->bindParam(":id", $this->id);
                    $isa= 1;
                    $stmt->bindParam(":isa", $isa);

                    if($stmt->execute()){
                        return $stmt->fetch();
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