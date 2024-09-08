<?php

namespace App\Controller;
use App\Model\ModelFieldType;
class FieldType extends Controller
{
    public static function Page()
    {
        if(isset($_SESSION["id"]) && $_SESSION["role"]>=2){
            $model = new ModelFieldType();
            $res =  json_encode($model->Query());
            echo $res;
            http_response_code(200);
        }
    }

}