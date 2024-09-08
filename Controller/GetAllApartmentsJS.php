<?php

namespace App\Controller;
use App\View\ViewGetAllApartmentsJS;

class GetAllApartmentsJS extends Controller
{
    public static function Page()
    {
        try{


        ViewGetAllApartmentsJS::View();



        }
        catch(\Exception $e){
            echo "error";
        }



    }
}