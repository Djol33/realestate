<?php

namespace App\Model;

class ModelSurveyList extends Model
{
    private $id;
    private $role;
    public function __construct($id, $role){
        $this->role=$role;
        $this->id=$id;
    }
    public function Query()
    {
        try {
            $sql = "SELECT id, title FROM survey ";
            if(!$this->role==2){
                $sql.=  " WHERE is_active = :isa ";
            }
            $conn = new Conn();
            if($conn=$conn->conn()){
                if($stmt=$conn->prepare($sql)){
                    $isa = 1;
                    if(!$this->role==2) {
                        $stmt->bindParam(":isa", $isa);
                    }
                    if($stmt->execute()){
                        $res = $stmt->fetchAll();
                        if($res!= NULL && $res!=false){
                            $resnew = [];
                            foreach($res as $row){
                                if(!ModelInsertSurveyResponse::canAnswerSurvey($this->id, $row["id"]) || $this->role==2){
                                    $resnew[] = $row;
                                }
                            }
                            return $resnew;
                        }
                        else{
                            return false;
                        }

                    }
                }
            }
            return false;
        }catch(\PDOException $e){
            return false;
        }
    }
}