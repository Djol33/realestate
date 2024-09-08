<?php

namespace App\Model;

class ModelAdminRemoveHeaderRows extends Model
{
    private $header_ids;
    public function __construct($header_ids){
        $this->header_ids=$header_ids;
    }
    public function Query()
    {
        try{
            foreach($this->header_ids  as $row){
                $sql = "DELETE FROM header WHERE id = :id";
                $conn = new Conn();
                if($conn=$conn->conn()){
                    if($stmt=$conn->prepare($sql)){
                        $stmt->bindParam(":id", $row);
                        if($stmt->execute()){
                            continue;
                        }
                        return false;

                    }
                }
            }
            return true;
        }catch(\PDOException $e){
            return false;
        }
    }

}