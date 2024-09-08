<?php

namespace App\Model;

class ModelReturnAllApartmentsJS extends  Model
{
    public function Query()
    {
        $sql = "SELECT * FROM realestate ORDER BY id DESC LIMIT 50 ";
        $conn = new Conn();
        try{
            if($conn = $conn->conn()){
                if($stmt = $conn->prepare($sql)){
                    if($stmt->execute()){
                        $res=$stmt->fetchAll();
                        $resreturn = array();
                        foreach($res as $row){
                            $model = new ModelRetriveOneImage($row["id"]);
                            $resreturn[] = [
                                "id"=>$row["id"], "title"=>$row["title"],
                                "adress"=>$row["adress"],
                                "city"=>[
                                "citycode" =>$row["city"],
                                    "cityname"=>ModelCity::nameOfTheCity($row["city"])
                            ],
                                "typeObject"=>[
                                    "typeObject"=>$row["typeObject"],
                                    "typeObjectName" =>ModelTypeOfRealEstate::checkTypeOfObject($row["typeObject"])
                                ],
                                "price"=>$row["price"],
                                "numberOfRooms"=>$row["numberOfRooms"]
                                ,"area"=>$row["area"],
                                "img_url"=>$model->Query()
                            ];

                        }
                        return $resreturn;
                    }
                }
            }
        }catch(\PDOException $e){

            return false;
        }

    }

}