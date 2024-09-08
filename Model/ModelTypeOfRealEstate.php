<?php

namespace App\Model;
use App\Model\Conn;
use PDO;
class ModelTypeOfRealEstate extends Model
{
    public function Query()
    {
        $sql = "select * from tip_objekta";
        $conn = new Conn();
        $conn = $conn->conn();
        if($stmt = $conn->prepare($sql)){
            if($stmt->execute()){
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $result =[];
                foreach($rows as $row){
                     $result[] = ["id"=> $row["id"], "name"=>$row["naziv"]];
                }
                return $result;
            }

        }
        else{
            return 0;
        }

    }
    public static function checkTypeOfObject($id){
        $sql = "select * from tip_objekta WHERE id = :id";
        $conn = new Conn();
        if($conn = $conn->conn()){
            if($stmt = $conn->prepare($sql)){
                $stmt->bindParam(":id", $id);
                if($stmt->execute()){
                    $res = $stmt->fetch();
                    if( gettype($res) !== "array" ){
                        return false;
                    }else if ($res["id"] == $id){ return $res["naziv"];}
                    else return false;

                }
            }
        }
        return false;

    }
}