<?php

namespace App\Model;

class ModelAdminSupport extends Model
{
    public function Query()
    {
        try{
            $res =null;
            $sql = "SELECT * FROM support WHERE is_read=0 ORDER BY id DESC";
            $conn = new Conn();
            if($conn = $conn->conn()){
                if($stmt = $conn->prepare($sql)) {
                    if ($stmt->execute()) {
                        $res=$stmt->fetchAll();

                        unset($stmt);
                            unset($conn);
                    }
                }
            }



            foreach($res as &$row){
                if(!isset($row["id_user"])) continue;
                $conn2 = new Conn();
                if($conn2=$conn2->conn()){
                    $sql = "SELECT f_name, l_name, email FROM users WHERE user_id = :id ";
                    if($stmt = $conn2->prepare($sql)){
                        $stmt->bindParam(":id", $row["id_user"]);
                        if($stmt->execute()){
                            $tmp = $stmt->fetch();

                            $row["f_name"]=$tmp["f_name"];
                            $row["l_name"]=$tmp["l_name"];
                            $row["email"]=$tmp["email"];
                            unset($conn2);
                            unset($stmt);
                        }
                    }
                }
            }
            return $res;
        }catch(\PDOException $e){
            echo $e->getMessage();
        }


    }
}