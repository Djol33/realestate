<?php

namespace App\Model;
use App\Model\Conn;
use PDO;
class ModelHeader extends  Model
{

    public function Query()
    {
        $sql = 'SELECT * FROM header';
        $conn = new Conn();
        $conn =$conn->conn();
        $stmt = $conn->prepare($sql);
        if($stmt->execute()){
            $array = [];
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row) {

                if($row["parend_id"]===NULL){
                    if($row["logged"] == NULL){

                    }else if( !isset($_SESSION["id"]) && $row["logged"] == 1){
                        continue;
                    }else if(isset ($_SESSION["id"]) && $row["logged"]==2){
                        continue;
                    }
                    if($row["role"] == NULL){

                    }else if(isset($_SESSION["role"]) &&  $row["role"] <= $_SESSION["role"]){

                    }
                    else {
                        continue;
                    }
                    $array[$row["id"]][] = ["title" => $row["title"], "href" => $row["href_link"]];

                  /*  if(isset($_SESSION["id"])){
                        continue;
                    }
                    else {

                    }*/
                }
                else{
                    if($row["logged"] == NULL){

                    }else if( !isset($_SESSION["id"]) && $row["logged"] == 1){
                        continue;
                    }else if(isset ($_SESSION["id"]) && $row["logged"]==2){
                        continue;
                    }
                    if($row["role"] == NULL){

                    }else if(isset($_SESSION["role"]) &&  $row["role"] <= $_SESSION["role"]){

                    }
                    else {
                        continue;
                    }
                    $array['child'.$row["parend_id"]][] =   ["title" =>$row["title"], "href"=>$row["href_link"]];
                }

            }
            return $array;

        }
        return 0;
    }
    public static function singleRow($id){
        try{
            $sql = "SELECT * FROM header WHERE id = :id";
            $conn = new Conn();
            if($conn = $conn->conn()){
                if($stmt=$conn->prepare($sql)){
                    $stmt->bindParam(":id", $id);
                    if($stmt->execute()  ){
                        return $stmt->fetch();
                    }

                }

            }
            return false;
        }catch(\PDOException $e){
            return false;
        }
    }
}