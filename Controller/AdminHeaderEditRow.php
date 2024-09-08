<?php

namespace App\Controller;

class AdminHeaderEditRow extends Controller
{
    public static function Page()
    {
        if(isset($_SESSION["id"]) && $_SESSION["role"]>=2){
            if($_SERVER["REQUEST_METHOD"]=="GET"){

            }
            else if($_SERVER["REQUEST_METHOD"]=="POST"){

            }
        }
    }


}