<?php

namespace App\Controller;
use App\View\ViewAllApartments;
class AllRealEstate extends Controller
{
    public static function Page()
    {
        if($_SERVER["REQUEST_METHOD"] == "GET"){

            ViewAllApartments::View();
        }
    }

}