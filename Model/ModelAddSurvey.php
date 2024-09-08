<?php

namespace App\Model;

class ModelAddSurvey extends Model
{
    private $title;
    private $question;
    private $field_id;
    public function __construct($title, $question, $field_id){
    $this->title=$title;
    $this->question=$question;
    $this->field_id=$field_id;
    }
    public function Query()
    {
        try{
            $sql ="INSERT INTO survey (title, question, field_id) VALUES (:title, :question, :fieldid)";
            $conn = new Conn();
            if($conn=$conn->conn()){
                if($stmt=$conn->prepare($sql)){
                    $stmt->bindParam(":title", $this->title);
                    $stmt->bindParam(":question", $this->question);
                    $stmt->bindParam(":fieldid", $this->field_id);
                    if($stmt->execute()){
                        return $conn->lastInsertId();
                    }
                }
            }
            return false;
        }
        catch (\PDOException $e){
            return false;
        }
    }
}