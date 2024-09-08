<?php

namespace App\Model;

class ModelInsertSurveyResponse extends Model
{
    private $id_usr;
    private $surv_id;
    private $value;
    public function __construct($id_usr, $surv_id, $value){
        $this->value = $value;
        $this->id_usr = $id_usr;
        $this->surv_id = $surv_id;
    }
    public function Query()
    {
        try{
            foreach( $this->value as $row){
                $sql = "INSERT INTO survey_answers (user_id, survey_id, value) VALUES (:usrid, :survey_id, :value)";
                $conn = new Conn();
                if($conn=$conn->conn()){
                    if($stmt=$conn->prepare($sql)){
                        $stmt->bindParam(":usrid", $this->id_usr);
                        $stmt->bindParam(":survey_id", $this->surv_id);
                        $stmt->bindParam(":value", $row);
                        if($stmt->execute()){

                        }
                        else{
                            return false;
                        }
                    }
                }
            }

            return true;
        }
        catch (\PDOException $e){
            return false;
        }
    }

    public static function canAnswerSurvey($id_user, $id_survey ){
        try{
            $sql = "SELECT * FROM survey_answers WHERE user_id = :usrid AND survey_id = :surid";
            $conn = new Conn();
            if($conn = $conn->conn()){
                if($stmt = $conn->prepare($sql)){
                    $stmt->bindParam(":usrid", $id_user);
                    $stmt->bindParam(":surid", $id_survey);
                    if($stmt->execute()){
                        return $stmt->rowCount();
                    }
                }
            }
            return 1;
        }
        catch(\PDOException $e){
            return 1;
        }
    }
}