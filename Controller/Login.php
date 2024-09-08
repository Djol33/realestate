<?php

namespace App\Controller;
use App\Model\ModelLogin;
use App\View\ViewLogin;
use App\GeneralFunction\RegexValidation;
include_once 'GeneralFunctions/checkIsSet.php';
class Login extends Controller
{
    public static function Page()
    {
        if(!isset($_SESSION["id"])) {

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $dataReceived = json_decode(file_get_contents('php://input'), true);
 
                if(!isset($dataReceived["email"])  && !isset($dataReceived["password"])){

                    http_response_code(403);
                    die();

                }
                    $email = htmlspecialchars($dataReceived["email"], ENT_QUOTES, 'UTF-8');
                    $password = htmlspecialchars($dataReceived["password"], ENT_QUOTES, 'UTF-8');

                    if (RegexValidation::email($email) && RegexValidation::password($password)) {
                        $obj = new ModelLogin($email, $password);

                        if ($session = $obj->Query()) {
 
                            if($session){
                                if(is_string($session) && $session=="code:pwormailnomatch"){
                                    http_response_code(406);
                                    die();
                                }else if(is_string($session) && $session=="srv_down"){
                                    http_response_code(503);
                                    die();
                                }else if(!$session["is_active"]){
                                    http_response_code(401);
                                }else{
                                    $_SESSION["id"]=$session["user_id"];
                                    $_SESSION["role"]=$session["role"];

                                    http_response_code(200);
                                    die();
                                }
                            }else{
                                http_response_code(503);
                            }
                        }
                        }
            }
            else if($_SERVER["REQUEST_METHOD"] == "GET") {
                ViewLogin::View();
            }
        }
        else{
            header("Location: allApartments");
        }


    }
}