<?php

namespace App\Controller;
use App\Model\ModelHeader;
use App\Model\ModelAdminHeader;
use App\Model\ModelEditRowHeader;
 use App\View\ViewEditRowHeader;
 require_once 'GeneralFunctions/checkIsSet.php';
class AdminEditRowHeader extends Controller
{
    public static function Page()
    {
        if(isset($_SESSION["id"]) && $_SESSION["role"]>=2){
            if($_SERVER["REQUEST_METHOD"]=="GET"){
                if(isset($_GET["id"])){
                    if($row = ModelHeader::singleRow($_GET["id"]) ){

                        $allRow = new ModelAdminHeader();
                        $allRow=$allRow->Query();
                        $view= new ViewEditRowHeader($row, $allRow);
                        $view->View1();

                    }

                }
            }else if($_SERVER["REQUEST_METHOD"]=="POST"){
                if(checkIfSetPost("survey_id", "title", "href_link","parend_id", "logged","role" )){
                    extract($_POST);
                    if(strlen($title)<2 || strlen($href_link<2)){
                        echo "Title and link must contain at least 3 characters";
                        die();
                    }
                    $model = new ModelEditRowHeader($survey_id, $title, $href_link, $parend_id, $logged,$role);
                    if($e = $model->Query()){
                        header("Location: adminheader");
                    }
                    else{
                        echo $e;
                    }


                }
                else die();

            }
        }

    }
}