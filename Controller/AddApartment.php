<?php

namespace App\Controller;
use App\View\ViewAddApartment;
use App\Model\ModelAddApartment;
use App\Model\ModelCity;
use App\GeneralFunction\RegexValidation;
use App\Model\ModelTypeOfRealEstate;
use App\Model\ModelAddImagesApartment;

include_once 'GeneralFunctions/checkIsSet.php';
class AddApartment extends Controller
{
    public static function Page()
    {
        if(isset($_SESSION["id"])) {
            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                ViewAddApartment::View();

            } else if ($_SERVER["REQUEST_METHOD"] == "POST") {

                //var_dump($_POST);

                $errors = 0;
                extract($_POST);
                if (!checkIfSet($city, $title, $dodatniopis, $objectType, $adresa, $kvadratura, $cena, $terasa)) {
                    http_response_code(403);
                    return;
                }


                if (isset($_SESSION["id"])) {
                    if (!ModelCity::checkCityInDB($city) && RegexValidation::minlen($title, 3) && RegexValidation::minlen($dodatniopis, 15) &&
                        ModelTypeOfRealEstate::checkTypeOfObject($objectType) && RegexValidation::minlen($adresa, 3) && RegexValidation::minnumber($kvadratura, 0) &&
                        RegexValidation::minnumber($cena, 0) && ($terasa == "Da" || $terasa == "Ne")) {
                        $errors++;
                    }

                    if (!$errors) {
                        $title = htmlspecialchars($_POST['title']);
                        $city = htmlspecialchars($_POST['city']);
                        $adresa = htmlspecialchars($_POST['adresa']);
                        $objectType = htmlspecialchars($_POST['objectType']);
                        $numberrooms = htmlspecialchars($_POST['numberrooms']);
                        $terasa = htmlspecialchars($_POST['terasa']);
                        $kvadratura = htmlspecialchars($_POST['kvadratura']);
                        $cena = htmlspecialchars($_POST['cena']);
                        $dodatniopis = htmlspecialchars($_POST['dodatniopis']);

                        $model = new ModelAddApartment($title, $city, $adresa, $objectType, $numberrooms, $terasa, $kvadratura, $cena, $dodatniopis, $_SESSION["id"]);
                        $res = $model->Query();

                        if ($res[0] == 1) {
                            $modelimages = new ModelAddImagesApartment((int)$res[1], $_FILES);
                            $modelimages->Query();

                            http_response_code(200);


                        } else if ($res[0] == 2 || $res[0] == 0) {

                            http_response_code(503);
                        }

                    }


                } else {
                    http_response_code(420);
                }

            }

        }
        else{
            header("Location: login");
        }

    }
}