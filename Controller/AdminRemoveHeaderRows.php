<?php

namespace App\Controller;
use App\Model\ModelAdminRemoveHeaderRows;
class AdminRemoveHeaderRows extends Controller
{
    public static function Page()
    {
        if(isset($_SESSION["id"]) && $_SESSION["role"]>=2){
            if($_SERVER["REQUEST_METHOD"]=="POST") {
                if(isset($_POST["delete"])){
                    $model = new ModelAdminRemoveHeaderRows($_POST["delete"]);
                        if($model->Query()){
                            header("Location: adminheader");
                    }else{
                            echo "Error occured please try again";
                        }
                }

            }

        }
    }
}