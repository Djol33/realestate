<?php

namespace App\Model;

class ModelAddSurvetFieldsCBR extends Model
{
    private $type;
    private $values;
    private $id_survey;
    public function __construct($type, $values, $id_survey){
        $this->type = $type;
        $this->values = $values;
        $this->id_survey = $id_survey;
    }
    public function Query()
    {

        try{

            foreach($this->values as $row ){
                if(!strlen($row) || strlen($row) <=2) continue;
                $sql ="INSERT INTO ";
                if($this->type==2){
                    $sql.= ' radio ';
                }
                else if ($this->type==3){
                    $sql .= ' checkbox ';
                }
                else throw new \PDOException();
                $sql.= ' (id_survey, value) VALUES ( :id_survey, :value)';
                $conn = new Conn();
                if($conn = $conn->conn()){
                    if($stmt=$conn->prepare($sql)){

                        $stmt->bindParam(":id_survey", $this->id_survey);
                        $stmt->bindParam(":value", $row);

                        if(!$stmt->execute()){
                            throw new \PDOException();
                        }
                    }
                }
            }

        return true;
        }
        catch(\PDOException $e){
            return false;

        }
    }

}