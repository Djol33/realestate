<?php

namespace App\Model;

class ModelDeleteRealEstate extends Model
{
    private $id_user;
    private $id_post;
    public function __construct( $id_post, $id_user=NULL){
        $this->id_user=$id_user;
        $this->id_post = $id_post;

    }
    public function Query()
    {
        $sql = "UPDATE realestate SET is_active = 0 WHERE id = :id ".(($this->id_user!=NULL)?" AND owner = :owner":"");
        $conn=new Conn();
        try{
            if($conn=$conn->conn()){
                if($stmt=$conn->prepare($sql)){
                    if( ($this->id_user!=NULL)){
                        $stmt->bindParam(":owner", $this->id_user);
                    }

                    $stmt->bindParam(":id",$this->id_post);
                    if($stmt->execute()) return true;
                }
            }
            return false;

        }catch(\PDOException $e){
            return false;
        }
    }

}