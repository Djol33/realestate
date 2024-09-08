<?php

namespace App\Controller;
use App\Model\ModelsOwnerRE;
use App\Model\ModelRemoveImages;
class RemoveImagesRE extends Controller
{
    public static function Page()
    {
        if(isset($_SESSION["id"])){
            if($_SERVER["REQUEST_METHOD"]=="POST"){
                $data = json_decode(file_get_contents("php://input"), true);
                if(count($data)){
                    foreach($data as $row){

                        if(isset($row["id"]) && isset($row["location"]) && isset($row["id_post"])){
                            if($_SESSION["role"]>=2){
                                continue;
                            }
                            else if($_SESSION["role"]>=1){
                                $model = new ModelsOwnerRE($_SESSION["id"], $row["id_post"]);
                                if(!$model->Query()){

                                    http_response_code(403);
                                    die();
                                }
                            }

                        }else{
                            die();
                        }

                    }

                    //
                    $model = new ModelRemoveImages($data);
                    if($model->Query()){
                        http_response_code(200);
                    }
                    else{
                        http_response_code(500);
                    }
                }
            }

        }
    }

}