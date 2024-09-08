<?php

namespace App\Model;

class ModelSurveyLoadCBR extends Model
{
    private $id_survey;
    private $type;
    public function __construct($id_survey, $type){
        $this->id_survey=$id_survey;
        $this->type=$type;
    }
    public function Query()
    {
        try{
            if(in_array($this->type, [2,3])){
                $sql ="SELECT * FROM";
                if($this->type==2){
                    $sql.= ' radio ';
                }
                else if ($this->type==3){
                    $sql .= ' checkbox ';
                }

                $sql .= ' WHERE id_survey = :idsur ';

                $conn = new Conn();
                if($conn = $conn->conn()){
                    if($stmt = $conn->prepare($sql)){
                        $stmt->bindParam(":idsur", $this->id_survey);
                        if($stmt->execute()){
                            return $stmt->fetchAll();
                        }
                    }
                }

            }
            else{
                return "text";
            }
        return false;
        }

        catch(\PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

}