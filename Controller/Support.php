<?php

namespace App\Controller;
use App\View\ViewSupport;
use App\Model\ModelSupport;
require_once "GeneralFunctions/checkIsSet.php";
class Support extends Controller
{

    public static function Page()
    {
        if($_SERVER["REQUEST_METHOD"] =="GET"){

            $view = new ViewSupport(isset($_SESSION["id"]));
            $view->View1();
        }
        else if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(checkIfSetPost("titleSupport", "contentSupport")){
                $title = htmlspecialchars($_POST["titleSupport"]);
                $content = htmlspecialchars($_POST["contentSupport"]);
                $model = NULL;
                if(isset($_SESSION["id"]) ){
                    $logged = $_SESSION["id"];
                    $model =  new ModelSupport($logged, $title, $content);


                }
                else{
                    if(checkIfSetPost("fName", "lName", "email")){
                        $fname = htmlspecialchars($_POST["fName"]);
                        $lname = htmlspecialchars($_POST["lName"]);
                        $email = htmlspecialchars($_POST["email"]);
                        $model = new ModelSupport($fname, $lname, $email, $title, $content);

                    }else{
                        echo "not succesful";
                        die();
                    }

                }
                if(
                $model->Query()){
                    echo "success";
                }
                else{
                    echo "error";
                }
            }
            else{
                header("Location: home");
                die();
            }

        }
    }
}