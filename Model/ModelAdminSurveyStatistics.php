<?php

namespace App\Model;

class ModelAdminSurveyStatistics extends Model
{
    private $idsur;

    public  function __construct($idsur){
        $this->idsur = $idsur;
    }
    public function Query()
    {
        try{
            $res =NULL;
            $sql = "SELECT * FROM survey WHERE id = :idsur";
            $conn = new Conn();
            if($conn = $conn->conn()){
                if($stmt=$conn->prepare($sql)){
                    $stmt->bindParam(":idsur", $this->idsur);
                    if($stmt->execute()){

                        $res["surveyData"] = $stmt->fetch();
                        if($res["surveyData"]==NULL){
                            echo "no such survey";
                            die();
                        }
                        $sqlFields = "SELECT * FROM ".($res["surveyData"]["field_id"] == 2 ? " radio ": " checkbox ")." WHERE id_survey = :idsurv";
                        $conn2 = new Conn();
                        if($conn2 = $conn2->conn()){
                            if($stmt2 = $conn2->prepare($sqlFields)){
                                $stmt2->bindParam(":idsurv", $this->idsur);
                                if($stmt2->execute()){
                                    $res["options"] = $stmt2->fetchAll();
                                    $sqlAnswers = "SELECT value, COUNT(*) as number FROM survey_answers WHERE survey_id = :surid GROUP BY value";
                                    $conn3 = new Conn();
                                    if($conn3=$conn3->conn()){
                                        if($stmt3=$conn3->prepare($sqlAnswers)){
                                            $stmt3->bindParam(":surid", $this->idsur);
                                            if($stmt3->execute()){
                                                $res["answers"] = $stmt3->fetchAll();
                                                return $res;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }

                }
            }

            return false;
        }catch(\PDOException){
            return false;

        }
    }
}