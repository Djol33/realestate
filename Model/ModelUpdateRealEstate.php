<?php

namespace App\Model;

class ModelUpdateRealEstate extends Model
{
    private $id;
    private $title;
    private $city;
    private $adress;
    private $typeObject;
    private $numberOfRooms;
    private $terrace;
    private $area;
    private $price;
    private $aditionalDescription;
    public function __construct($title,$city,$adress,$typeObject,$numberOfRooms,$terace,$area,$price,$aditionalDescription, $id) {
        $this->title = $title;
        $this->city = $city;
        $this->adress = $adress;
        $this->typeObject=$typeObject;
        $this->numberOfRooms = $numberOfRooms;
        if($terace == "Da"){
            $this->terrace = 1;
        }else {
            $this->terrace = 0;
        }

        $this->area = $area;
        $this->price=$price;
        $this->aditionalDescription = $aditionalDescription;
        $this->id = $id;
    }
    public function Query()
    {
        try{
            $conn = new Conn();
            $sql = "UPDATE realestate SET title = :title, city= :city, adress = :adress, typeObject = :typeObject, numberOfRooms= :numberOfRooms, terrace = :terrace, area = :area, price = :price, description = :description WHERE id = :id";
            if ($conn = $conn->conn()) {
                if ($stmt = $conn->prepare($sql)) {
                    $stmt->bindParam(':title', $this->title);
                    $stmt->bindParam(":city", $this->city);
                    $stmt->bindParam(':adress', $this->adress);
                    $stmt->bindParam(":typeObject", $this->typeObject);
                    $stmt->bindParam(":numberOfRooms", $this->numberOfRooms);
                    $stmt->bindParam(":terrace", $this->terrace);
                    $stmt->bindParam(":area", $this->area);
                    $stmt->bindParam(":price", $this->price);
                    $stmt->bindParam(":description", $this->aditionalDescription);
                    $stmt->bindParam(":id", $this->id);
                    if($stmt->execute()){
                        return true;
                    }
                }
            }
            return false;

        }catch(\PDOException){
            return false;
        }

    }
}