<?php

namespace App\Controller;
use App\Model\ModelLoadImages;
use App\Model\ModelsOwnerRE;
class LoadImages extends Controller
{
    public static function Page()
    {
        if(isset($_SESSION["id"])){
            if($_SERVER["REQUEST_METHOD"]=='GET'){
                if(isset($_GET["id"])){
                    if($_SESSION["role"]>=2){
                        $model = new ModelLoadImages($_GET["id"]);
                        if($res = $model->Query()){
                            echo json_encode($res);
                        }
                        else{
                            echo json_encode([]);
                        }
                    }else if($_SESSION["role"]==1){
                        $checkOwner = new ModelsOwnerRE($_SESSION["id"], $_GET["id"]);
                        if($checkOwner->Query()){
                            $model = new ModelLoadImages($_GET["id"]);
                            if($res = $model->Query()){
                                echo json_encode($res);
                            }
                            else{
                                echo json_encode([]);
                            }
                        }
                    }


                }
            }
        }
    }
}