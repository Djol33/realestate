<?php

namespace App\View;

class ViewLoadSurvey extends View
{
    private $type;
    private $data;
    private $fields;
    public function __construct($type, $data, $fields){
        $this->type = $type;
        $this->fields = $fields;
        $this->data = $data;
    }
    public static function View()
    {
        // TODO: Implement View() method.
    }
    public function View1(){
        $html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey</title>
    <script src="View/public/js/header.js"></script>
        <link rel="stylesheet" href="View/public/css/style.css" type="text/css">
</head>
<body>
<form action="loadsurvey" method="post">
    <h1 id="head">
    '.$this->data["title"].'
</h1>
<p><b>'.$this->data["question"].'</b></p>
<div>
';
        var_dump($this->data);
        if($this->type!=="text"){
            for($i = 0; $i<count($this->fields) ; $i++){
                $html.= "<div>
                <input id='$i' type='".$this->type["type"]."' value = '".$this->fields[$i]["id"]."' name='answers[]'/>
                 <label for='$i' >".$this->fields[$i]["value"]."</label>

</div>";
        }


        }
        else{
            $html.= "<label for='response'>Leave answer</label>";
            $html.= "<input type='text' id='response' name = 'response'/>";

        }

$html.= "<input type='hidden' name='id_survey' value='".$this->data["id"]."' /> ";

  $html.=      '

<input type="submit" class="border"/>
</div></form>
    
</body>
</html>';
        echo $html;
    }

}