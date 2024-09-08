<?php

namespace App\Model;

class ModelSurveyStatus extends Model
{
    private $newStatus;
    private $survey_id;
    public function __construct($newStatus, $survey_id){
        $this->survey_id = $survey_id;
        $this->newStatus = $newStatus;
    }
    public function Query()
    {
        try{
            $sql = "UPDATE survey SET is_active = :value WHERE id = :idsur";
            $conn = new Conn();
            if($conn = $conn->conn()){
                if($stmt=$conn->prepare($sql)){
                    $stmt->bindParam(":value", $this->newStatus);
                    $stmt->bindParam(":idsur", $this->survey_id);
                    if($stmt->execute()){
                        return true;
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