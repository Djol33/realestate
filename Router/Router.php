<?php

namespace App\Router;

class Router
{
    public static $validRoute = array();
    public static function  set($route, $method){
        self::$validRoute = $route;
        if(isset($_GET["url"])) {
            if ($_GET["url"] == $route) {
                $method->__invoke();


            }
        }else{
            if( $route == "allApartments"){
                $method->__invoke();

            }
        }




    }
}