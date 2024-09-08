<?php

namespace App\Controller;
use App\Model\ModelWishlist;
require_once "GeneralFunctions/checkIsSet.php";
class Wishlist extends Controller
{
    public static function Page()
    {

        if($_SERVER["REQUEST_METHOD"]=="POST"){

            $dataReceived = json_decode(file_get_contents('php://input'), true);

            if(isset($_SESSION["id"]) && ($_SESSION["role"] >=1) && isset($dataReceived["id_post"])  ){

                $idpost = htmlspecialchars($dataReceived["id_post"]);
                $iduser = $_SESSION["id"];
                $model = new ModelWishlist($idpost, $iduser);
                if($model->Query()){
                    echo "true1";
                }
                else{
                    echo "false1";
                }
            }

        }

    }

}