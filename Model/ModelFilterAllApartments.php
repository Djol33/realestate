<?php

namespace App\Model;
use App\Model\Conn;


class ModelFilterAllApartments extends Model
{
    private $city;
    private $typeOfObject;
    private $search;
    private $page;
    public function __construct($city =NULL, $typeOfObject =NULL, $search =NULL, $page = 0){
        if(is_array($city)){
            $this->city = implode(",", $city);
        }
        else if(is_string($city) && strlen($city)>1){
            $this->city = $city;
        }
        else{
            $this->city =NULL;
        }
        if(isset($typeOfObject)){
            $this->typeOfObject = $typeOfObject;
        }else{
            $this->typeOfObject = NULL;
        }

        if(isset($search) && strlen($search)>0){
            $this->search = $search;
        }else{
            $this->search =NULL;
        }

        if(isset($page)){
            $this->page = $page * 20;
        }else{
            $this->page = 20 ;
        }


    }
    public function Query()
    {
        try {
            $sql = "SELECT * FROM realestate\n";

            if (isset($this->city) && strlen($this->city) > 2) {
                $sql .= " WHERE city IN ($this->city)\n";
            }
            if (isset($this->typeOfObject)) {
                if (isset($this->city) && ($this->typeOfObject < 4 && $this->typeOfObject > 0)) {
                    $sql .= " AND  typeObject = $this->typeOfObject\n";
                } else if (($this->typeOfObject < 4 && $this->typeOfObject > 0)) {
                    $sql .= " WHERE typeObject = $this->typeOfObject\n";
                }

            }
            if (isset($this->search) && strlen($this->search) > 0) {
                if (((isset($this->city) && strlen($this->city) > 2) || (isset($this->typeOfObject)) && ($this->typeOfObject < 4 && $this->typeOfObject > 0))) {
                    $sql .= "AND title LIKE '%$this->search%'\n";
                } else if (isset($this->search)) {
                    $sql .= "WHERE title LIKE '%$this->search%'";
                }

            }
            if( (isset($this->search) && strlen($this->search) > 0) || isset($this->typeOfObject) || isset($this->city) && strlen($this->city) > 2){
                $sql.= ' AND is_active = 1 ';
            }
            else{
                $sql.= ' WHERE is_active = 1 ';
            }

            $sql .= " ORDER BY id DESC LIMIT 20 OFFSET $this->page";
            $conn = new Conn();
            if ($conn = $conn->conn()) {
                if ($stmt = $conn->prepare($sql)) {
                    if ($stmt->execute()) {
                        $res = $stmt->fetchAll();

                        return $res;
                    }
                }

            }

        }
        catch(\PDOException $e){
            echo $e->getMessage();
        }

    }
    public function numbRows(){
        $sql = "SELECT * FROM realestate \n";

        if (isset($this->city) && strlen($this->city) > 2) {
            $sql .= " WHERE city IN ($this->city)\n";
        }
        if (isset($this->typeOfObject)) {
            if (isset($this->city) && ($this->typeOfObject < 4 && $this->typeOfObject > 0)) {
                $sql .= " AND  typeObject = $this->typeOfObject\n";
            } else if (($this->typeOfObject < 4 && $this->typeOfObject > 0)) {
                $sql .= " WHERE typeObject = $this->typeOfObject\n";
            }

        }
        if (isset($this->search) && strlen($this->search) > 0) {
            if (((isset($this->city) && strlen($this->city) > 2) || (isset($this->typeOfObject)) && ($this->typeOfObject < 4 && $this->typeOfObject > 0))) {
                $sql .= "AND title LIKE '%$this->search%'\n";
            } else if (isset($this->search)) {
                $sql .= "WHERE title LIKE '%$this->search%'";
            }

        }
        if( (isset($this->search) && strlen($this->search) > 0) || isset($this->typeOfObject) || isset($this->city) && strlen($this->city) > 2){
            $sql.= ' AND is_active = 1 ';
        }
        else{
            $sql.= ' WHERE is_active = 1 ';
        }

        $conn = new Conn();
        if($conn = $conn->conn()){
            if($stmt=$conn->prepare($sql)){
                if($stmt->execute()){

                    return $stmt->rowCount();
                }
            }

        }
    }
}