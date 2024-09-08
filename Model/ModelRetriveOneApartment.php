<?php

namespace App\Model;
use App\Model\Conn;
use App\Model\ModelTypeOfRealEstate;
class ModelRetriveOneApartment extends Model
{
    private $id;
    public function __construct($id){
        $this->id = $id;
    }
    public function Query()
    {
        $sql = "SELECT r.id,r.is_active, u.user_id, u.f_name, u.l_name, u.email, r.title, r.city, r.adress, r.typeObject, r.numberOfRooms, r.terrace, r.area, r.price, r.description, r.owner FROM realestate r INNER JOIN users u ON u.user_id = r.owner WHERE r.id=:id ";

        $conn= new Conn();
        if($conn = $conn->conn()){
            if($stmt=$conn->prepare($sql)){
                $stmt->bindParam(":id", $this->id);

                if($stmt->execute()){
                    $result = $stmt->fetch();
                    if ($result){
                        $sql_images = "SELECT location, alt FROM realestate_image WHERE id_post = :id_post";
                        $conn = new Conn();
                        if($conn = $conn->conn()){
                            if($stmt = $conn->prepare($sql_images)){
                                $stmt->bindParam(":id_post", $this->id);
                                if($stmt->execute()){
                                    $image_res = $stmt->fetchAll();
                                    foreach($image_res as $row){
                                        $result["images"][] = ["location" => $row["location"], "alt"=>$row["alt"]];


                                    }
                                    if(ModelTypeOfRealEstate::checkTypeOfObject($result["typeObject"])){
                                        $result["typeOfObjectName"]  =ModelTypeOfRealEstate::checkTypeOfObject($result["typeObject"]);
                                    }

                                    return $result;
                                }

                            }
                        }
                        return false;

                    }
                    else return 0;
                }
            }
        }
        return false;
    }

}