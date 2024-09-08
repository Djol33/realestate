<?php

namespace App\Controller;
use App\View\ViewRegister;
use App\GeneralFunction\RegexValidation;
use App\Model\ModelRegister;
include_once 'GeneralFunctions/checkIsSet.php';


class Register extends Controller
{
    public static function Page()
    {
        if (isset($_SESSION["id"])) {
            header("Location: login");
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $dataReceived = json_decode(file_get_contents("php://input"), true);
            if(!checkIfSet($dataReceived["fname"],$dataReceived["lname"], $dataReceived["email"], $dataReceived["password"],$dataReceived["passwordConf"] )){
                http_response_code(403);
                return;
            }
            $fname = htmlspecialchars(
                $dataReceived["fname"],
                ENT_QUOTES,
                "UTF-8"
            );
            $lname = htmlspecialchars(
                $dataReceived["lname"],
                ENT_QUOTES,
                "UTF-8"
            );
            $email = htmlspecialchars(
                $dataReceived["email"],
                ENT_QUOTES,
                "UTF-8"
            );
            $password = htmlspecialchars(
                $dataReceived["password"],
                ENT_QUOTES,
                "UTF-8"
            );
            $password_conf = htmlspecialchars(
                $dataReceived["passwordConf"],
                ENT_QUOTES,
                "UTF-8"
            );

            if (
                RegexValidation::email($email) &&
                RegexValidation::ime($fname) &&
                RegexValidation::ime($lname) &&
                RegexValidation::password($password, $password_conf)
            ) {
                $obj = new ModelRegister($fname, $lname, $email, $password);
                $res = $obj->Query();
                var_dump($res);
                if ($res === true) {
                    http_response_code(201);
                } elseif ($res === false) {
                    http_response_code(503);
                } else {
                    http_response_code(409);
                }
            } else {
                http_response_code(406);
            }
        }
        else if ($_SERVER["REQUEST_METHOD"] == "GET"){
            ViewRegister::View();
        }
    }
}
