<?php

namespace App\Controller;
use App\Model\ModelAdminAllActiveUsers;
use App\View\ViewAdminRemoveActiveUsers;
use App\Model\ModelAdminRemoveUserPOST;
class AdminRemoveUser extends Controller
{
    public static function Page()
    {
        if(isset($_SESSION["id"]) && $_SESSION["role"]>=2) {
            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                $model = new ModelAdminAllActiveUsers();
                $res = $model->Query();
                $view = new ViewAdminRemoveActiveUsers($res);
                $view->View1();

            }
            else if($_SERVER["REQUEST_METHOD"]=="POST"){
                if(!isset($_POST["reg"])){
                    header("Location: AdminRemoveUsers");
                    die();
                }
                $model = new ModelAdminRemoveUserPOST($_POST["reg"]);
                if($model->Query()) {
                    header("Location: AdminRemoveUsers");
                }
                else{
                    echo "doslo je do greske";
                }
            }
        }
    }
}