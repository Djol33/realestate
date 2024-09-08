<?php

namespace App\Controller;
use App\Model\ModelUser;

class HeaderUser extends Controller
{
    public static function Page()
    {
        if($_SERVER["REQUEST_METHOD"]=="GET"){
            try {
                if(isset($_SESSION["id"])){
                    $userModel = new ModelUser($_SESSION["id"]);

                    http_response_code(200);
                    echo json_encode($userModel->Query());
                }
                else{
                    echo json_encode(["err"=>"err"]);
                    http_response_code(425);
                }
            }catch(\Error $e) {
                echo $e->getMessage();
            }

        }
        http_response_code(425);

    }
}