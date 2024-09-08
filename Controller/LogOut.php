<?php

namespace App\Controller;

class LogOut extends Controller
{
    public static function Page()
    {
        if(isset($_SESSION["id"])){
            unset($_SESSION["id"]);
        }
        header("Location: login");
    }
}