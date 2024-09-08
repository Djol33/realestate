<?php

namespace App\Model;

class ModelFieldType extends Model
{
    public function Query()
    {
        try{
            $sql = "SELECT * FROM fields_type";
            $conn = new Conn();
            if($conn = $conn->conn()){
                if($stmt=$conn->prepare($sql)){
                    if($stmt->execute()){
                        return $stmt->fetchAll();
                    }
                }
            }
            return ["err"=>"err"];
        }
        catch (\PDOException $e){
            return ["err"=>"pdo"];
        }
    }
    public static function type($id){
        try{
            $sql = "SELECT type FROM fields_type WHERE id=:id ";
            $conn = new Conn();
            if($conn=$conn->conn()){
                if($stmt=$conn->prepare($sql)){
                    $stmt->bindParam(":id", $id);
                    if($stmt->execute()){
                        return $stmt->fetch();
                    }
                }
            }
            throw new \PDOException("ne postoji taj id");
        }
        catch(\PDOException $e){
            echo "ne postoji";
        }

    }



}