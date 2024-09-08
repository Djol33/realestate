<?php

namespace App\Controller;
use App\Model\ModelReturnAllApartmentsJS;
class ReturnAllApartmentsJS extends Controller
{
    public static function Page()
    {
        if($_SERVER["REQUEST_METHOD"]=="GET"){
            $model = new ModelReturnAllApartmentsJS();
            echo json_encode($model->Query());
        }
        else{
            die();
        }
    }

}