<?php

namespace App\Model;
use App\Model\Conn;
class ModelWishlist extends Model
{
    private $iduser;
    private $idpost;
    public function __construct($idpost, $iduser){
        $this->idpost= $idpost;
        $this->iduser = $iduser;
    }
    public function Query()
    {
        $sql = "INSERT INTO WISHLIST (user_id, realestate_id) VALUES( :iduser,:idpost) ";
        $conn = new Conn();
        try{
            if($conn = $conn->conn()){
                if($stmt= $conn->prepare($sql)){
                    $stmt->bindParam(":idpost", $this->idpost);
                    $stmt->bindParam(":iduser", $this->iduser);
                    if($stmt->execute()){
                        return array("done"=>"added");

                    }else{
                        $conn = NULL;
                    }
                }
            }
            return array("done"=>"contact developers");
        }
        catch(\PDOException $e){
            $errorCode = $e->getCode();
            if($errorCode == "23000"){
                $sql = "DELETE FROM wishlist WHERE user_id = :iduser AND realestate_id = :idpost";
                $conn2 = new Conn();
                if($conn2 = $conn2->conn()){
                    if($stmt= $conn2->prepare($sql)){
                        $stmt->bindParam(":idpost", $this->idpost);
                        $stmt->bindParam(":iduser", $this->iduser);
                        if($stmt->execute()){
                            return "Obrisan";

                        }
                    }
                }
                return false;
            }
        }


    }
    public function isWishlisted(){
        $sql = "SELECT * FROM wishlist WHERE realestate_id = :idpost and user_id = :userid";
        try{
            $conn = new Conn();
            if($conn = $conn->conn()){
                if($stmt = $conn->prepare($sql)){
                    $stmt->bindParam(":idpost", $this->idpost);
                    $stmt->bindParam(":userid",$this->iduser);
                    if($stmt->execute()){

                            return $stmt->rowCount()==1;


                    }
                }
            }

        }catch(\PDOException $e){
            return false;
        }

    }


}