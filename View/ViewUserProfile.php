<?php

namespace App\View;

class ViewUserProfile extends View
{
    private $res;
    public function __construct($res)
    {
        $this->res = $res;
    }
    public static function View()
    {

    }


    public function View1()
    {
        $html = " <!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>User Profile - ". $this->res["basic_info"]["f_name"] ."</title>
    <script src='https://kit.fontawesome.com/104d21a00f.js' type='application/javascript' crossorigin='anonymous'></script>
    <meta charset='UTF-8'>
     
    <meta name='keywords' content='Beograd, Novi Sad,Flat, Cottage , Nekretnine'>
    
     <script src = 'View/public/js/header.js' type='application/javascript'></script>
         <link rel='stylesheet' href='View/public/css/style.css' type='text/css'>
</head>
<body>
<div id='holder'>
 <div id='basicInfo'>
 
";
        $html.="<h1 id='heade'>".$this->res["basic_info"]["f_name"]." ".$this->res["basic_info"]["l_name"] ."</h1>";
        $html.="<p id='email'> ".$this->res["basic_info"]["email"]."</p></div>";
        $html.="<h2>List Of Real Estates</h2>";
        //real estate add
        $html .= "<div id='realestate'>";
        foreach($this->res["list_apartments"] as $row){
            $html.="<a class='blockApartmentUserProfile' href='openApartment?id=".$row["id"]."'><h2>".$row["title"]."</h2>
        <p class='adress'>Adress: ".$row["adress"]."</p>
        <p class='price'>".$row["price"]."&euro;</p>

</a>";

        }
        $html.="</div>";
        if(isset($this->res["wishlist"]) && count($this->res["wishlist"]) ){
            $html.="<h2>Wishlist</h2>";
            $html .= "<div id='wishlist'>";
            var_dump($this->res["wishlist"]);
            foreach ($this->res["wishlist"] as $row) {
                $html .= "<a class='blockApartmentUserProfile' href='openApartment?id=" . $row["id"] . "'>" . $row["title"] . "</a>";
            }
        } 


$html.="</div></div></body></html>";
    echo $html;

    }
}