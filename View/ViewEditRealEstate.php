<?php

namespace App\View;

class ViewEditRealEstate extends View
{
    private $data;
    private $cities;
    private $typeObject;
    public function __construct($typeObject,$cities, $data){
        $this->data = $data;
        $this->typeObject=$typeObject;
        $this->cities = $cities;
    }
    public static function View()
    {
        // TODO: Implement View() method.
    }
    public function View1(){
        $html="<!DOCTYPE html>
<html lang='en'>
<head>
    <link rel='stylesheet' href='View/public/css/style.css' type='text/css'/>
    <script src='https://kit.fontawesome.com/104d21a00f.js' type='application/javascript' crossorigin='anonymous'></script>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta name='description' content='Find the best house/apartment/cottage for living or going for a weekend, enjoy infinite opportunities'>
    
    <meta name='keywords' content='Sell Apartment,Sell, house, flat  , Nekretnine'>
    
    <script  src='View/public/js/regex.js'  type='application/javascript'></script>
     <link rel='icon' type='image/png' href='/images/logonekretnine.png'>
    <script src='View/public/js/header.js' type='application/javascript'></script>
    <script src='View/public/js/error.js' type='application/javascript'></script>
    <script src='View/public/js/editValidateApartment.js' type='application/javascript'></script>
    <meta charset='UTF-8'>
    <title>Edit Real Estate</title>
</head>
<body>
    <form id='method' enctype='multipart/form-data' action='editRealEstate' method='POST' >
        <label for='title1'>Title</label>
        <input type='text' id='title1' name='title' value='".$this->data["title"]."' placeholder='Title' required='required' error='Enter valid title'/>
        <label for='select' >Select city</label>
        <select name='city' id='city' required='required' error='Select a city' >
        ";

        foreach($this->cities as $city){
            $html.="<option ".($city["zip"]==$this->data["city"]?"select":"")." value='".$city['zip']."'>".$city["city"]."</option>";
        }

            $html.="
            
        </select>
        <label for='adresa'>Adress</label>
        <input type='text' id='adresa' name='adresa' required='required' value='".$this->data["adress"]."'  error='Enter adress (ex. Ruzveltova 12)'/>
        <label for='tipObjekta'>Type Of Building</label>
        <select name='tipObjekta' id='tipObjekta' required='required' error='Select type of real estate'>
            ";
            foreach ($this->typeObject as $row){
                $html.= "<option ".($row["id"]==$this->data["typeObject"]?"select":"")." value='".$row["id"]."'>".$row["name"]."</option>";
            }
        $html.="
        </select>
        <label for='numberrooms'>Number of rooms</label>
        <input type='number' id='numberrooms' value='".$this->data["numberOfRooms"]."' error='Enter number of rooms (ex 2.5)' name='numberrooms' min='0.5' step='0.5' max='10' required='required'/>
        <label for='terasa'>Does it have a terrace/balcony</label>
        <div id='terasa'>
            <div>            <input type='radio' ".($this->data["terrace"]?"checked":"")." name='terasa' id='prvi' value='Da' placeholder='Da' data-error = 'Select one of the values'/> <label for='prvi'>Yes</label>
            </div>
<div>
    <input type='radio' name='terasa' ".($this->data["terrace"]?"":"checked")." id='drugi' value='Ne'/> <label for='prvi'>No</label>

</div>

        </div>
        <label for='kvadratura' >Area</label>
        <input type='number' id='kvadratura' value='".$this->data["area"]."' error='Enter area of building' name='kvadratura' required='required' min='1'/>

        <label for='cena'>Total price</label>
        <input type='number' id='cena' name='cena' value='".$this->data["price"]."' error='Enter price' required='required' min='0' >
        <label for='dodatniopis'>Description</label>
        <input type='text' value='".$this->data["description"]."' id='dodatniopis' error='Add additional description' name='dodatniopis'>
        <input type='file' multiple='multiple' id='images' name ='images[]'  accept='image/jpeg, image/png, image/jpg'/>
        <label for='images' id='file''>Add new images</label>
        <p  data-id='".$this->data["id"]."'  id='img_db'  >Edit Existing Images</p>
        <input type='hidden' name='id' value='".$this->data['id']."'/>
        <input type='submit' id='predaj' type='button' value='Submit'/>
    </form>

</body>

    <script src='View/public/js/updateImages.js' type='application/javascript'></script>

</html>
";
        return $html;

    }

}