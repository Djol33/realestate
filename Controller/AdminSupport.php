<?php

namespace App\Controller;
use App\Model\ModelAdminSupport;
use App\View\ViewAdminSupport;
use App\Model\ModelAdminSupportPOST;
class AdminSupport extends  Controller
{
    public static function Page()
    {
        if($_SERVER["REQUEST_METHOD"]=="GET"){
            $model = new ModelAdminSupport();
            $res = $model->Query();
            $view = new ViewAdminSupport($res);
            $view->View1();
        }else if($_SERVER["REQUEST_METHOD"]=="POST"){
            $answered = null;
            if(isset($_POST["answered"])) $answered=$_POST["answered"];
                else die();
            $model = new ModelAdminSupportPOST($answered);
            if($model->Query()){
                header("Location: adminSupport");
            }else{
                echo "there might be a mistake";
            }
        }
    }
}