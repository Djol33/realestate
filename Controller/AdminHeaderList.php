<?php

namespace App\Controller;
use App\Model\ModelAdminHeader;
use App\View\ViewAdminHeader;
class AdminHeaderList extends Controller
{
    public static function Page()
    {
        if(isset($_SESSION["id"]) && $_SESSION["role"]>=2){
            if($_SERVER["REQUEST_METHOD"]=="GET"){
                $model = new ModelAdminHeader();
                if($res = $model->Query()){

                    $view = new ViewAdminHeader($res);
                    $view->View1();
                }
                else{
                    echo "error occured";
                }
            }
        }
        else{
            header("Location: login");
        }
    }
}