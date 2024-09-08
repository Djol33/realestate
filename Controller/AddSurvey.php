<?php

namespace App\Controller;
use App\View\ViewAddSurvey;
use App\Model\ModelAddSurvey;
use App\Model\ModelAddSurvetFieldsCBR;
require_once "GeneralFunctions/checkIsSet.php";
class AddSurvey extends Controller
{
    public static function Page()
    {
        if(isset($_SESSION["id"]) && $_SESSION["role"]>=2){
            if($_SERVER["REQUEST_METHOD"]=="GET"){
                ViewAddSurvey::View();
            }
            else if($_SERVER["REQUEST_METHOD"] =="POST"){
                if(checkIfSetPost("typeResp", "title", "question")){
                    $type= htmlspecialchars($_POST["typeResp"]);
                    $title = htmlspecialchars($_POST["title"]);
                    $question = htmlspecialchars($_POST["question"]);
                    $model = new ModelAddSurvey($title, $question, $type);

                    if(isset($_POST["answers"])) {

                        $idSurvey = NULL;
                        $answer = $_POST["answers"];


                             $j = 0;
                            for($i=0 ;$i < count($answer) ; $i++){


                                if(strlen($answer[$i]) <=2) continue;
                                else $j++;

                            }
                            if($j<=1){
                                echo "Survey must have at least 2 fields, with value longer than 2 characters";
                                die();
                            }


                        if($idSurvey = $model->Query()){

                            if($_POST["typeResp"] == 2 || $type==3){
                                var_dump($_POST);

                                $modelRadio = new ModelAddSurvetFieldsCBR($type,$answer,$idSurvey);
                                if($modelRadio->Query()){
                                    header("Location: surveylist");
                                }else{
                                    echo "error occured";
                                }

                            }
                            else {
                                echo "err type resp";
                                die();
                            }




                        }
                    }

                }
            }
            }
            else{
                header("Location: allApartments");
            }
    }

}