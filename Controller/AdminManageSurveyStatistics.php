<?php

namespace App\Controller;
use App\Model\ModelAdminSurveyStatistics;
use App\View\ViewSurveyStatistics;
class AdminManageSurveyStatistics extends Controller
{
    public static function Page()
    {
        if(isset($_SESSION["id"]) && $_SESSION["role"]>=2){

            if($_SERVER["REQUEST_METHOD"]=="GET"){
                $model = new ModelAdminSurveyStatistics($_GET["id"]);

                if($res = $model->Query()){

                    $view=new ViewSurveyStatistics($res);
                    $view->View1();
                }else{
                    echo "Error occured";
                }
            }
        }

    }

}