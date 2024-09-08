<?php

namespace App\Controller;
use App\Model\ModelAdminRegistration;
use App\Model\ModelAdminRegistrationPOST;
use App\View\ViewAdminRegistration;
class AdminRegistration extends Controller
{
    public static function Page()
    {
        if(isset($_SESSION["id"]) && $_SESSION["role"]>=2){
            if($_SERVER["REQUEST_METHOD"] == "GET"){
                $model = new ModelAdminRegistration();
                $model = $model->Query();
                $view = new ViewAdminRegistration($model);
                $view->View1();
            }
            else if($_SERVER["REQUEST_METHOD"] == "POST"){
                if(!isset($_POST["reg"])) header("Location: adminRegistration");
                $data = $_POST["reg"];

                $model = new ModelAdminRegistrationPOST($data);
                if($model->Query()){
                    echo "Uspesno";
                }
                else{
                    echo "doslo je do greske";
                }

            }
        }

    }
}