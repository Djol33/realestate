<?php

namespace App\Model;
use App\Model\Conn;
use PDO;
class ModelCity extends Model
{
    public function Query()
    {
        $sql = "SELECT zip, city FROM city ";
        $conn = new Conn();
        $conn = $conn->conn();
        if($stmt = $conn->prepare($sql)){
            if($stmt->execute()){
                $return =[];
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach($rows as $row){
                    $return[] = ["zip"=>$row["zip"], "city"=>$row["city"]];
                }
                return $return;
            }
        }
        return 0;


    }

    public static function checkCityInDB($zip){
        $sql = "SELECT zip FROM city WHERE zip = :zip";

        $conn = new Conn();
        if( $conn = $conn->conn()){
            if($stmt = $conn->prepare($sql)){
                $stmt->bindParam(":zip", $zip);
                if($stmt->execute()){
                    $row = $stmt->fetch();
                    if( isset($row["zip"]) &&  $row["zip"] !== NULL){
                        return true;
                    }
                    else{
                        return false;
                    }
                }
            }
        }
        return false;
    }
    public static function nameOfTheCity($zip){
        $sql = "SELECT city FROM city WHERE zip = :zip";

        $conn = new Conn();
        if( $conn = $conn->conn()){
            if($stmt = $conn->prepare($sql)){
                $stmt->bindParam(":zip", $zip);
                if($stmt->execute()){
                    $row = $stmt->fetch();

                    if(  $stmt->rowCount() == 1 ){
                        return $row["city"];
                    }
                    else{
                        return false;
                    }
                }
            }
        }
        return false;
    }
}