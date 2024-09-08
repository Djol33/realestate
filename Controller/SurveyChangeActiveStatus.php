<?php

namespace App\Controller;
use App\Model\ModelSurveyStatus;
class SurveyChangeActiveStatus extends Controller
{
    public static function Page()
    {
        if(isset($_SESSION["id"]) && $_SESSION["role"]>=2){
            if($_SERVER["REQUEST_METHOD"]=="POST"){
                if(isset($_POST["survey_id"]) && isset($_POST["status"])){
                    $model = new ModelSurveyStatus($_POST["status"], $_POST["survey_id"]);
                    if($model->Query()){
                        $id=$_POST["survey_id"];
                        header("Location: surveystatistics?id=$id");
                    }
                    else{
                        echo "Error occured please contact developers";
                    }
                }
            }
        }
    }

}