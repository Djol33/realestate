<?php

namespace App\Controller;
use App\Model\ModelCity;
class City extends Controller
{

    public static function Page()
    {
        $model = new ModelCity();
 

        if($res = $model->Query()){
            echo json_encode($res);

        }
        else{
            http_response_code(503);
        }

    }
}