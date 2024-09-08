<?php

namespace App\View;

class ViewOpenRealEstate extends View
{
    private $id;
    private $wishlisted;
    private $title;
    private $city;
    private $adress;
    private $typeObject;
    private $numberOfRooms;
    private $terrace;
    private $area;
    private $price;

    private $description;
    private $owner;
    private $images;
    private $typeOfObjectName;
    private $f_name;
    private  $l_name;
    private $email;
    private $logged;

    public function __construct($id,$wishlisted, $title, $city, $adress, $typeObject, $numberOfRooms, $terace, $area, $price, $description, $owner,$typeOfObjectName, $f_name, $l_name, $email, $images=NULL)
    {
        $this->f_name=$f_name;
        $this->l_name = $l_name;
        if(isset($_SESSION["id"])){
            $this->email=$email;
            $this->logged = true;
        }
        else{
            $start = substr($email,0,3);
            $stars = strpos($email, "@");
            $this->email = $start."***".substr($email, $stars);
            $this->logged=false;
        }
        if($wishlisted  ){
            $this->wishlisted = ' fa-solid active   ';

        }
        else{
            $this->wishlisted = " fa-regular ";
        }

        $this->id = $id;
        $this->title = $title;
        $this->city = $city;
        $this->adress = $adress;
        $this->typeObject = $typeObject;
        $this->numberOfRooms = $numberOfRooms;
        $this->typeOfObjectName=$typeOfObjectName;

        $this->terrace = ($terace === 1) ? "Yes" : "No";

        $this->area = $area;
        $this->price = $price;
        $this->description = $description;
        $this->owner = $owner;
        if($images){
            foreach ($images as $row) {
                $this->images[] = $row;
            }
        }

    }

    public static function View()
    {
    }

    public function View1()
    {
        $html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    ';
        $html .= "<meta name='keywords' content='$this->adress, $this->title, $this->typeOfObjectName, $this->city, nekretnine'/>";
        $html .= "  <meta name='description' content='$this->typeOfObjectName in $this->city, with area of $this->area square meters, on $this->adress street 
                        Check best apartments on Nekretnine.
  '/>";
        $html .= '
    <link rel="stylesheet" href="View/public/css/style.css" type="text/css"/>
    <script src="View/public/js/regex.js" type="application/javascript"></script>
    <script src="View/public/js/lastClicked.js" type="application/javascript"></script>
 <script src="https://kit.fontawesome.com/104d21a00f.js" type="application/javascript" crossorigin="anonymous"></script>
    <script src="View/public/js/header.js" type="application/javascript"></script>
        <script src="View/public/js/imageCarousel.js" type="application/javascript"></script>
                <script src="View/public/js/addToWishlist.js" type="application/javascript"></script>
    <script></script>
    <title>' . $this->title . '</title>
</head>
<body>
<div id="realestatepost">
    <h1 id="title1">' . $this->title . ($this->logged ? "<i id = 'wishlist' data-id = '$this->id' class=' " . ($this->wishlisted) . " fa-heart icon-heart' > </i>" : "") . '</h1>
    <h2 id="adress">Adress: ' . $this->adress . '</h2>
    <!-- Image block goes here -->
    <div id="images">';
        $i = 0;
        if ($this->images !== null && count($this->images)) {
            foreach ($this->images as $row) {
                //$html .= '<img src="' . $row["location"] . '" alt ="' . $row["alt"] . '" class="' .(!$i? 'main':'sidebar'.$i) . ($i>3? " d-none":"").'" '."image-id='$i'".' />';
                //$html .="<div style='background-image:url(".$row['location'].")" . "'" ."class='".($i>3? " class=' d-none ' ":"") .(!$i? ' main ':' sidebar'.$i)."'"."image-id='$i'"."></div>";
                $html .= "<div style='background-image:url(" . $row['location'] . ")' class='" . ($i > 3 ? 'd-none' : '') . ' ' . (!$i ? 'main' : 'sidebar' . $i) . "' image-id='$i'></div>";


                $i++;
            }
        } else {
            $html .= "<div style=\"background-image: url('/images/no_image.jpg')\" class='main' image-id='0'></div>";

        }
        $html .= '
    </div>
    <h2 id="price"><div id="textprice">' . $this->price . ' &euro;</div></h2>
    <div id="basic_info">
        <span><span class="header">Area</span><span class="value"> ' . $this->area . '<sup>2</sup></span></span>
        <span><span class="header">Balcony</span><span class="value">' . $this->terrace . '</span></span>
        <span><span class="header">Rooms</span><span class="value">' . $this->numberOfRooms . '</span></span>
        <span><span class="header">Type</span><span class="value">' . $this->typeOfObjectName . '</span></span>
    </div>
    <div id="aditionalDescription">
        <h2>Aditional Informations</h2>
        <p>' . $this->description . '</p>
    </div>
    
        <div id="owner">
    <h1><a href="userProfile?id=' . $this->owner . '">' . $this->f_name . ' ' . $this->l_name . '</a></h1>
   ';
        ($this->logged) ? $html .= ' <p>Email: <a href="mailto:' . $this->email . '">' . $this->email . '</a></p>' : $html .= "<p>Email :$this->email<br/><a style='color:blue' href='login'>Login</a> to see whole mail</p>" . '
        </div>
    </div>';

   $html.='
 
</body>
</html>';


        if (isset($_SESSION["id"]) && ($_SESSION["id"] == $this->owner)) {


            $html .= '<div id="holder_edit">';
            $html .= '
<form action ="deleteRealEstate" method="POST">
    <input type="hidden" name="id_post" value="' . $this->id . '" >
    <input type="submit" id="submit" value="DELETE" />
</form>
';
            $html.="<a href='editRealEstate?id=".$this->id."'>EDIT</a></div>";
        }

        return $html;
    }
}
