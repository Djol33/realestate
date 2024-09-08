<?php

namespace App\Controller;
use App\Model\ModelInsertRowHeader;

require_once "GeneralFunctions/checkIsSet.php";
class AdminInserRowHeader extends Controller
{
    public static function Page()
    {

        if(isset($_SESSION["id"]) && $_SESSION["role"]>=2){
            if($_SERVER["REQUEST_METHOD"]=="POST"){
                if(checkIfSetPost("title","href_link", "parend_id","logged","role")){
                    $model = new ModelInsertRowHeader($_POST["title"], $_POST["href_link"], $_POST["parend_id"], $_POST["logged"], $_POST["role"]);
                    if(strlen($_POST["title"])<2 || strlen($_POST["href_link"])<2) {
                        echo "Title and link must contain at least 3 characters per field";
                        die();
                    }
                    if($model->Query()){
                        header("Location: adminheader");
                    }
                    else{
                        echo "Error occured, check if all values are correct or contact developer";
                    }
                }
            }
        }
    }

}