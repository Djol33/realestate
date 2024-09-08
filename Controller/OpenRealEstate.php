<?php

namespace App\Controller;
use App\Model\ModelRetriveOneApartment;
use App\View\ViewOpenRealEstate;
use App\Model\ModelWishlist;
use App\Model\ModelCity;
include_once "GeneralFunctions/checkIsSet.php";

class OpenRealEstate extends Controller
{
    public static function Page()
    {
            if(checkIfSet($_GET["id"])){
                $model = new ModelRetriveOneApartment($_GET["id"]);
                $model = $model->Query();
                if($model){
                    extract($model);
                }else{
                    echo "error 404";
                    http_response_code(404);
                    die();
                }

                $wishlisted = false;
                if(isset($_SESSION["id"])){
                    $modelWishList = new ModelWishlist($id, $_SESSION["id"]);
                    $wishlisted = $modelWishList->isWishlisted();
                }



                $city = ModelCity::nameOfTheCity($city);
                if($model != false){
                    if($is_active){
                        $view = new ViewOpenRealEstate($id, $wishlisted, $title, $city, $adress, $typeObject, $numberOfRooms, $terrace, $area, $price, $description, $owner,$typeOfObjectName, $f_name, $l_name, $email,  $images??NULL);

                        echo $view->View1();
                    }else{
                        echo "error 404";
                        http_response_code(404);
                    }

                }

            }




    }
}