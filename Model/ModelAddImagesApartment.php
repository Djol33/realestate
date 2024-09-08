<?php

namespace App\Model;
use PDO;
use App\Model\Conn;
class ModelAddImagesApartment extends Model
{

    private static $alowedTypeOfFiles =["image/png","image/jpeg","image/jpg"];
    private static $imageFolder = "images/";
    private $id;
    private $array_images_names=[];
    private $array_tmp_location=[];
    private $array_tmp_extension=[];
    private $array_errors=[];
    public function __construct($id, $assoc_array_images){
        $this->id = $id;
        $count = count($assoc_array_images["images"]["name"]);
        for($i = 0; $i<$count;$i++){
            if($assoc_array_images["images"]["error"][$i] === 0 && in_array($assoc_array_images["images"]["type"][$i], ModelAddImagesApartment::$alowedTypeOfFiles)){

                $newName ="";
                for($x =0; $x <strlen( $assoc_array_images["images"]["name"][$i]);$x++ ){
                    $character = substr($assoc_array_images["images"]["name"][$i], $x, 1);
                    if($character!=="\n" && $character!== "\t" && $character!==" " && $character!=="(" && $character!==")" && $character!=="."){
                        $newName.=$character;
                    }
                    else{
                        continue;
                    }
                }
                $this->array_images_names[] =$newName;
                $this->array_tmp_location[]=$assoc_array_images["images"]["tmp_name"][$i];

            }

        }
    }
    public function Query()
    {
        $sql = "INSERT INTO realestate_image(location, id_post,alt) VALUES (:name, :id_post, :alt)";

        $conn = new Conn();
        try{
            if($conn = $conn->conn()){
                for($i = 0; $i<count($this->array_images_names);$i++){
                    $alt = "Image_Of_Apartment_".($i+1);
                    if (!file_exists(ModelAddImagesApartment::$imageFolder)) {
                        mkdir(ModelAddImagesApartment::$imageFolder, 0777, true);
                    }
                    if($stmt=$conn->prepare($sql)){
                        $newName = uniqid('', true) . '_' . time() . $this->array_images_names[$i];
                        $fullPathNewName = ModelAddImagesApartment::$imageFolder.$newName;
                        $stmt->bindParam(":name", $fullPathNewName);
                        $stmt->bindParam(":id_post", $this->id);
                        $stmt->bindParam(":alt", $alt);
                        if($stmt->execute()){
                            move_uploaded_file($this->array_tmp_location[$i], $fullPathNewName);
                        }
                        else{
                            return false;
                        }

                        $stmt=NULL;

                    }
                }
            }
            return true;
        }catch ( \PDOException $e){
            return false;
        }



    }

}