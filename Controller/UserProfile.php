<?php

namespace App\Controller;
use App\Model\ModelUserProfile;
use App\Model\ModelListOfRE;
use App\Model\ModelAllWishlist;
use App\View\ViewUserProfile;
class UserProfile extends Controller
{

    public static function Page()
    {
        if($_SERVER["REQUEST_METHOD"]=="GET" ){
            if(!isset($_SESSION["id"])){
                header("Location: login");
            }
            $id = null;
            $model = null;
            $res = [];
            if(isset($_GET["id"])){
                $id = (($_GET["id"]));
            }
            else if(isset($_SESSION["id"])){
                $id = $_SESSION["id"];
            }
            else{
                die();
            }
            $model = new ModelUserProfile($id);
            $res["basic_info"] = $model->Query();
            $modelApartmentList = new ModelListOfRE($id);
            $res["list_apartments"] = $modelApartmentList->Query();

            if($_SESSION["id"] == $id){
                $modelWishlist = new ModelAllWishlist($id);
                $res["wishlist"] = $modelWishlist->Query();

            }
            $view = new ViewUserProfile($res);
            $view->View1();
/*
            echo "<pre>";
            var_dump($res);
            echo "</pre>";*/

        }
    }
}