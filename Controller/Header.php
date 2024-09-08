<?php

namespace App\Controller;
use App\Model\ModelHeader;

class Header extends Controller
{

    public static function Page()
    {

        $model = new ModelHeader();

        if($res = $model->Query()) {

            echo json_encode($res);
            http_response_code(200);
        }
        else{
            echo "error";
            http_response_code(400);
        }
    }
}