<?php

namespace App\View;

class ViewSurveyList extends View
{
    private $data;
    public function __construct($data){
        $this->data=$data;
    }
    public static function View()
    {
        // TODO: Implement View() method.
    }
    public function View1(){
        $html="<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Survey List</title>
    <script src='https://kit.fontawesome.com/104d21a00f.js' type='application/javascript' crossorigin='anonymous'></script>
    <meta charset='UTF-8'>

    <meta name='keywords' content='survey, questions, nekretnine'>

     <script src = 'View/public/js/header.js' type='application/javascript'></script>
         <link rel='stylesheet' href='View/public/css/style.css' type='text/css'>
</head>
<body><h1 id='head'>List of Active Surveys</h1>

";        if($this->data==NULL){
            $html.="<p style='margin-left:20px;margin-bottom:20px'>There are no active Surveys</p>";
        }else {
    $html.="<form id='support1'>
<table ><thead><tr><th>Title</th>".($_SESSION["role"]>=2?"<th>Statistics</th>":"")."</tr></thead><tbody>";
            foreach ($this->data as $row) {
                $html .= "<tr><td><a href='loadsurvey?id=" . $row['id'] . "'>" . $row['title'] . "</a></td>";
                if ($_SESSION["role"] >= 2) {
                    $html .= "<td><a href='surveystatistics?id=" . $row["id"] . "'/>Statistics</a></td>";

                }
                $html .= "</td>";
            }
        }

        $html.="</tbody></table></form></body></html>";
        echo $html;




    }
}