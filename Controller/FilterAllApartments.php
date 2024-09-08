<?php

namespace App\Controller;
use App\Model\ModelFilterAllApartments;
use App\Model\ModelCity;
use App\Model\ModelRetriveOneImage;
use App\Model\ModelTypeOfRealEstate;

require_once "GeneralFunctions/checkIsSet.php";
class FilterAllApartments extends Controller
{
    public static function Page()
    {
        try{
            $page = NULL;
            $city =NULL;
            $search = NULL;
            $typeObject = NULL;
            if(isset($_GET["city"]))
            {
                if(strlen($_GET["city"])>0){
                    $city = is_array($_GET["city"])
                        ? explode(",", $_GET["city"])
                        : $_GET["city"];
                    if (is_array($city)) {
                        foreach ($city as $row) {
                            if (!ModelCity::checkCityInDB($row)) continue;
                        }
                    } else {
                        if (!ModelCity::checkCityInDB($city)) {

                         }
                    }
                }

            }
            if(isset($_GET["typeOfObject"])){
                if (
                    ModelTypeOfRealEstate::checkTypeOfObject($_GET["typeOfObject"])
                ) {
                    $typeObject = $_GET["typeOfObject"];
                 };
            }
            if(isset($_GET["search"])){
                $search = htmlspecialchars($_GET["search"]);
            }
            if(isset($_GET["page"])){
                $page=$_GET["page"];
            }
            else{
                $page=0;
            }

            $model = new ModelFilterAllApartments(
                $city,
                $typeObject,
                $search, $page
            );
            $num_pages = $model->numbRows();
            $model = $model->Query();
            if ($model) {
                foreach ($model as &$row) {
                    $row["city_name"] = ModelCity::nameOfTheCity($row["city"]);
                    $modelImage = new ModelRetriveOneImage($row["id"]);
                    $row["img_url"] = $modelImage->Query();
                }
            }

            http_response_code(200);

            echo(json_encode(["pages" => $model, 'num_pages'=> ceil($num_pages/20 )]));

        }
        catch(\Exception $e){
            echo ["error "=>$e];
        }



    }
}
