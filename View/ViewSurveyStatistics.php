<?php

namespace App\View;

class ViewSurveyStatistics extends View
{
    private $data;
    public function __construct($data){
        $this->data = $data;
    }

    public static function View()
    {
        // TODO: Implement View() method.
    }


    public function View1()
    {
        $html = '<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Support</title>
    <link rel="stylesheet" href="View/public/css/style.css" type="text/css"/>
    <script src="View/public/js/header.js" type="application/javascript"></script>
    <script src="https://kit.fontawesome.com/104d21a00f.js" type="application/javascript" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <style>
    h1,p{
    margin-left:25px;
    margin-bottom: 7px;
    }
</style>
 
</head>
<body>';
        $html.= "<h1 id='head'>".$this->data["surveyData"]["title"]."</h1>";
        $html.= "<p>Question: ".$this->data["surveyData"]["question"]."</p>";
        $html.="<p>Is active:" . ($this->data["surveyData"]["is_active"]?"Yes":"No")."</p>";
        $html.="<form method='POST' action='surveystatus' style='width:fit-content; margin-left: 25px'>
                <input type ='hidden' name='survey_id' value='".$this->data["surveyData"]["id"]."'/>
                <input type='hidden' name='status' value='".(int)!$this->data["surveyData"]["is_active"]."' />
                <input type='submit' name='submit' value='Change status'/></form>

";

    foreach($this->data["options"] as $row){
        $check = 0;
        $html.= "<p>Ime Polja: ".$row["value"];
        foreach($this->data["answers"] as $ans){

            if($ans["value"] == $row["id"]){

                $html.=" Broj selekcija  ".$ans["number"]."</p>";
                $check=1;
                break;
            }


        }
        if($check){
            continue;
        }
        $html.= " no one selected this </p>";
        $html.="<br/>";
    }

    echo $html;
    }

}