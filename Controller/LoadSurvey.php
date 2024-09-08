<?php

namespace App\Controller;
use App\Model\ModelFieldType;
use App\Model\ModelLoadSurvey;
use App\Model\ModelSurveyLoadCBR; // Fields
use App\View\ViewLoadSurvey;
use App\Model\ModelInsertSurveyResponse;
require_once 'GeneralFunctions/checkIsSet.php';
class LoadSurvey extends Controller
{
    public static function Page()
    {
        if(isset($_SESSION["id"]) && $_SESSION["role"]>=1){
            if($_SERVER['REQUEST_METHOD']=="GET"){

                if(!isset($_GET["id"])) die();
                $id = $_GET["id"];
                if(ModelInsertSurveyResponse::canAnswerSurvey($_SESSION["id"], $id)){
                   header("Location: surveylist");
                }
                $model = new ModelLoadSurvey($id);
                 if($res = $model->Query()){

                     $modelFields = new ModelSurveyLoadCBR($res["id"], $res["field_id"]);
                    if($resFields = $modelFields->Query()){
                        if(!$resFields){

                        }
                        else if($resFields=="text"){
                            $view = new ViewLoadSurvey("text", $res, "text");
                            $view->View1();
                        }
                        else{

                            $view = new ViewLoadSurvey( ModelFieldType::type($res["field_id"]), $res, $resFields);
                            $view->View1();
                        }

                    }

                }
            }
            else if($_SERVER["REQUEST_METHOD"]=="POST"){
                if(checkIfSetPost('answers', 'id_survey')){
                    if(ModelInsertSurveyResponse::canAnswerSurvey($_SESSION["id"], $_POST["id_survey"])){
                        header("Location: allApartments");
                    }
                    $model = new ModelInsertSurveyResponse($_SESSION["id"], $_POST["id_survey"], $_POST["answers"]);
                    if($model->Query()){
                        header("Location: allApartments");

                    }
                    else{
                        echo "error";
                    }
                }

            }

        }
    }

}