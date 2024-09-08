<?php

namespace App\Controller;
use App\View\ViewAdminAddTypeObject;
use App\Model\ModelAdminAddTypeObject;
class AdminAddTypeObject extends Controller
{
    public static function Page()
    {
        if($_SERVER["REQUEST_METHOD"]=="GET"){
            ViewAdminAddTypeObject::View();
        }
        else if($_SERVER["REQUEST_METHOD"]=="POST"){
            $name = $_POST['nameTypeObject'];
            $model = new ModelAdminAddTypeObject($name);
            if($model->Query()){
                header("Location: AdminAddTypeObject");
            }else{
                echo "Error occured, check if there already exists object type with the same name";
            }
        }
    }
}