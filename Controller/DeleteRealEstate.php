<?php

namespace App\Controller;
use App\Model\ModelDeleteRealEstate;
use App\Model\ModelsOwnerRE;
class DeleteRealEstate extends Controller
{
    public static function Page()
    {
        if(isset($_SESSION["id"])){
            if($_SERVER["REQUEST_METHOD"]=="POST"){
                if(isset($_POST["id_post"])){
                    if($_SESSION["role"]>=2){
                        $model = new ModelDeleteRealEstate($_POST["id_post"]);
                        if($model->Query()){
                            header("Location: allApartments");
                        }
                        else{
                            echo "error occured1";
                        }
                    }
                    else if($_SESSION["role"]==1){
                        echo "2";
                        $modelOwner = new ModelsOwnerRE($_SESSION["id"], $_POST["id_post"]);
                        if($modelOwner->Query()){
                            echo "3";
                            $model = new ModelDeleteRealEstate($_POST["id_post"] , $_SESSION["id"]);
                            if($model->Query()){
                                header("Location: allApartments");
                            }
                            else{
                                echo "error occured2";
                            }
                        }

                    }


                    else{
                        echo "Error occured3";
                    }

                }
                else{
                    echo "1";
                }
            }
        }
    }

}