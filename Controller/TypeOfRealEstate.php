<?php

namespace App\Controller;
use App\Model\ModelTypeOfRealEstate;
class TypeOfRealEstate extends  Controller
{

    public static function Page()
    {
        $model = new ModelTypeOfRealEstate();
        $res = $model->Query();
        if($res){
            http_response_code(200);
            echo json_encode($res);
        }
        else{
            http_response_code(503);
            echo "error";
        }

    }
}