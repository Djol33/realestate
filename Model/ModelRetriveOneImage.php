<?php

namespace App\Model;

class ModelRetriveOneImage extends Model
{
    private $id ;
    public function __construct($id){
        $this->id  = $id;
    }
    public function Query()
    {
        $sql = "SELECT location from realestate_image WHERE id_post = :id LIMIT 1";
        try{
            $conn = new Conn();
            if($conn = $conn->conn()){
                if($stmt = $conn->prepare($sql)){
                    $stmt->bindParam(":id", $this->id);
                    if($stmt->execute()){
                        if($stmt->rowCount()){
                            $res =  $stmt->fetch();
                            return $res["location"];
                        }
                        else{
                            return 'images/no_image.jpg';
                        }

                    }
                }

            }
            return false;
        }
        catch(\PDOException){
            return false;
        }

    }
}