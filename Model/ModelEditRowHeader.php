<?php

namespace App\Model;

class ModelEditRowHeader extends Model
{
    private $id;
    private $title;
    private $href_link;
    private $parend_id;
    private $logged;
    private $role;
    public function __construct($id,$title,$href_link,$parend_id, $logged, $role){
        $this->title=$title;
        $this->id=$id;
        $this->href_link = $href_link;
        if($parend_id != 0){
            $this->parend_id=  $parend_id;
        }else{
            $this->parend_id=NULL;
        }

        if(strlen($logged) && $logged!="0"){
            $this->logged=$logged;}
        else{
            $this->logged=NULL;
        }
        if(strlen($role) && $role!="0"){
            $this->role=$role;
        }
        else{
            $this->role=NULL;
        }


    }
    public function Query()
    {
        try{
            $sql = "UPDATE header SET title = :title, href_link = :href , parend_id=:parend, logged= :log, role= :role WHERE id = :id";
            $conn = new Conn();
            if($conn=$conn->conn()){
                if($stmt = $conn->prepare($sql)){
                    $stmt->bindParam(":id", $this->id);
                    $stmt->bindParam(":title", $this->title);
                    $stmt->bindParam(":href", $this->href_link);
                    $stmt->bindParam(":parend", $this->parend_id);
                    $stmt->bindValue(":log", $this->logged);
                    $stmt->bindParam(":role", $this->role);
                    if($stmt->execute()){
                        return true;
                    }

                }
            }
            return false;
        }catch(\PDOException $e){
            return $e->getMessage();
        }


    }
}