<?php

namespace App\Model;

class ModelsOwnerRE extends Model
{
    private $id_user;
    private $id_re;
    public function __construct($id_user, $id_re){
        $this->id_user=$id_user;
        $this->id_re = $id_re;
    }
    public function Query()
    {
        try{
            $sql = "SELECT id FROM realestate WHERE owner = :owner AND id = :id";
            $conn = new Conn();
            if($conn=$conn->conn()){
                if($stmt= $conn->prepare($sql)){
                    $stmt->bindParam(":owner", $this->id_user);
                    $stmt->bindParam(":id", $this->id_re);
                    if($stmt->execute()){
                        $res=$stmt->fetchAll();
                        if($stmt->rowCount()==1){
                            return true;
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