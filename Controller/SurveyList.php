<?php

namespace App\Controller;
use App\Model\ModelSurveyList;
use App\View\ViewSurveyList;
class SurveyList extends Controller
{
    public static function Page()
    {
        if(isset($_SESSION["id"]) && $_SESSION["role"]>=1){
            if($_SERVER["REQUEST_METHOD"]=="GET"){
                $model = new ModelSurveyList($_SESSION["id"], $_SESSION["role"]);
                if($res = $model->Query()){
                    $view = new ViewSurveyList($res);
                    $view->View1();
                }
                else{
                    $view = new ViewSurveyList(null);
                    $view->View1();
                }
            }
        }
    }

}