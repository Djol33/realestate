<?php

namespace App\Model;

class ModelAllWishlist extends Model
{
    private $iduser;

    public function __construct(  $iduser){

        $this->iduser = $iduser;
    }
    public function Query()
    {
        $sql = "SELECT * FROM wishlist w INNER JOIN realestate r ON w.realestate_id = r.id  WHERE w.user_id = :id AND r.is_active=1";
        $conn = new Conn();
        try{
            if($conn = $conn->conn()){
                if($stmt=$conn->prepare($sql)){
                    $stmt->bindParam(":id", $this->iduser);
                    if($stmt->execute()){
                        return $stmt->fetchAll();
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