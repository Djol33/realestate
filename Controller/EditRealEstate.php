<?php

namespace App\Controller;
use App\Model\ModelsOwnerRE;
use App\Model\ModelRetriveOneApartment;
use App\View\ViewEditRealEstate;
use App\Model\ModelCity;
use App\Model\ModelTypeOfRealEstate;
use App\Model\ModelUpdateRealEstate;
use App\GeneralFunction\RegexValidation;
use App\Model\ModelAddImagesApartment;
require_once 'GeneralFunctions/checkIsSet.php';
class EditRealEstate extends Controller
{
    public static function Page()
    {
        if(isset($_SESSION["id"])){
            if($_SERVER["REQUEST_METHOD"]=="GET"){

                if(isset($_GET["id"])){
                    $modelCity = new ModelCity();
                    $cities = $modelCity->Query();
                    $modelType = new ModelTypeOfRealEstate();
                    $typeObject = $modelType->Query();
                    if($_SESSION["role"]>=2){
                        $modelData = new ModelRetriveOneApartment($_GET["id"]);
                        $res  =$modelData->Query();
                        $view = new ViewEditRealEstate($typeObject,$cities, $res);
                        echo $view->View1();
                    }
                    else{
                        $modelOwner = new ModelsOwnerRE($_SESSION["id"], $_GET["id"]);

                        if($modelOwner->Query()){
                            $modelData = new ModelRetriveOneApartment($_GET["id"]);
                            $res  =$modelData->Query();
                            $view = new ViewEditRealEstate($typeObject,$cities, $res);
                            echo $view->View1();
                        }
                    }
                }
            }
            else if ($_SERVER["REQUEST_METHOD"]=="POST"){
                if(isset($_SESSION["id"])){
                    if($_SESSION["role"]>=2){
                        $errors = 0;
                        extract($_POST);
                        if (!checkIfSet($city, $title, $dodatniopis, $tipObjekta, $adresa, $kvadratura, $cena, $terasa, $id)) {
                            http_response_code(403);
                            return;
                        }


                        if (!ModelCity::checkCityInDB($city) && RegexValidation::minlen($title, 3) && RegexValidation::minlen($dodatniopis, 15) &&
                            ModelTypeOfRealEstate::checkTypeOfObject($objectType) && RegexValidation::minlen($adresa, 3) && RegexValidation::minnumber($kvadratura, 0) &&
                            RegexValidation::minnumber($cena, 0) && ($terasa == "Da" || $terasa == "Ne")) {
                            $errors++;
                        }

                        if (!$errors) {
                            $title = htmlspecialchars($_POST['title']);
                            $city = htmlspecialchars($_POST['city']);
                            $adresa = htmlspecialchars($_POST['adresa']);
                            $objectType = htmlspecialchars($_POST['tipObjekta']);
                            $numberrooms = htmlspecialchars($_POST['numberrooms']);
                            $terasa = htmlspecialchars($_POST['terasa']);
                            $kvadratura = htmlspecialchars($_POST['kvadratura']);
                            $cena = htmlspecialchars($_POST['cena']);
                            $dodatniopis = htmlspecialchars($_POST['dodatniopis']);
                            $model = new ModelUpdateRealEstate($title,$city,$adresa,$objectType,$numberrooms,$terasa,$kvadratura,$cena,$dodatniopis, $id);
                            if($model->Query()){
                                $modelimages = new ModelAddImagesApartment($id, $_FILES);

                                if($modelimages->Query()){
                                    header("Location: openApartment?id=".$id);
                                }
                                else{
                                    echo "Couldnt upload images, but content of Post is updated";
                                }

                            }
                            else{
                                echo "Error Occured";
                            }

                        }
                    }
                    else if($_SESSION["role"]==1){
                        $modelOwner = new ModelsOwnerRE($_SESSION["id"], $_POST["id"]);

                        if($modelOwner->Query()){
                            $errors = 0;
                            extract($_POST);
                            if (!checkIfSet($city, $title, $dodatniopis, $tipObjekta, $adresa, $kvadratura, $cena, $terasa, $id)) {
                                http_response_code(403);
                                return;
                            }


                            if (!ModelCity::checkCityInDB($city) && RegexValidation::minlen($title, 3) && RegexValidation::minlen($dodatniopis, 15) &&
                                ModelTypeOfRealEstate::checkTypeOfObject($objectType) && RegexValidation::minlen($adresa, 3) && RegexValidation::minnumber($kvadratura, 0) &&
                                RegexValidation::minnumber($cena, 0) && ($terasa == "Da" || $terasa == "Ne")) {
                                $errors++;
                            }

                            if (!$errors) {
                                $title = htmlspecialchars($_POST['title']);
                                $city = htmlspecialchars($_POST['city']);
                                $adresa = htmlspecialchars($_POST['adresa']);
                                $objectType = htmlspecialchars($_POST['tipObjekta']);
                                $numberrooms = htmlspecialchars($_POST['numberrooms']);
                                $terasa = htmlspecialchars($_POST['terasa']);
                                $kvadratura = htmlspecialchars($_POST['kvadratura']);
                                $cena = htmlspecialchars($_POST['cena']);
                                $dodatniopis = htmlspecialchars($_POST['dodatniopis']);
                                $model = new ModelUpdateRealEstate($title,$city,$adresa,$objectType,$numberrooms,$terasa,$kvadratura,$cena,$dodatniopis, $id);
                                if($model->Query()){
                                    $modelimages = new ModelAddImagesApartment($id, $_FILES);

                                    if($modelimages->Query()){
                                        header("Location: openApartment?id=".$id);
                                    }
                                    else{
                                        echo "Couldnt upload images, but content of Post is updated";
                                    }

                                }
                                else{
                                    echo "Error Occured";
                                }

                            }
                        }
                    }
                }

            }

        }

    }

}