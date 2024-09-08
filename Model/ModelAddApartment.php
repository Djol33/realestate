<?php

namespace App\Model;
use App\Model\Conn;
use PDO;

class ModelAddApartment extends Model
{
    private $title;
    private $city;
    private $adress;
    private $typeObject;
    private $numberOfRooms;
    private $terrace;
    private $area;
    private $price;
    private $aditionalDescription;
    private $owner;
    private $return = array();
    public function __construct($title,$city,$adress,$typeObject,$numberOfRooms,$terace,$area,$price,$aditionalDescription, $owner){
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
        $this->owner = $owner;
    }
    public function Query()
    {
        $sql = "INSERT INTO realestate(title, city, adress, typeObject,numberOfRooms, terrace, area, price, description, owner) 
                    VALUES (:title, :city, :adress,:typeObject,:numberOfRooms, :terrace, :area,:price,:description, :owner) ";
        $conn = new Conn();

        try {
            if ($conn = $conn->conn()) {
                $conn->beginTransaction();
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
                    $stmt->bindParam(":owner", $this->owner);
                    if ($stmt->execute()) {
                        $return[]=1;
                        $return[] = $conn->lastInsertId();
                        $conn->commit();
                        return $return;
                    }
                    else{
                        $return[]=2;
                        $return[]=NULL;
                        $conn->rollBack();
                        return $return;

                    }
                }
            }
        }catch(\PDOException $e){
            $return[]=0;
            $return[] = NULL;

            echo $e->getMessage();
            $return[]= $return;
            return $return;

        }
    }
}