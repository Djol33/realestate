<?php

namespace App\View;

class ViewSupport extends View
{
    private $logged;
    public function __construct(
        $logged
    ){
        $this->logged = $logged ;

    }
    public static function View()
    {
        require_once __DIR__.'/public/html/support.html';
    }
    public function View1(){
        $html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Support</title>
    <link rel="stylesheet" href="View/public/css/style.css" type="text/css"/>
    <script src="View/public/js/header.js" type="application/javascript"></script>
    <script src="https://kit.fontawesome.com/104d21a00f.js" type="application/javascript" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="description" content="Have a problem? Contact our support for help">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Support, Bug, Help, Nekretnine">
        <style>
        body{
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-between;
}
    </style>
</head>
<body>
<div id="support">
    <h1>Support</h1>
    <form action="support" method="POST" id="firstForm">';
        if(!$this->logged){
        $html.= '<label for="fName">First Name</label>
        <input type="text" id="fName" name="fName"/>
        <label for="lName">Last Name</label>
        <input type="text" id="lName" name="lName"/>
        <label for="email">Email</label>
        <input type="email" name="email" id="email"/>';

    };

       $html.=' <label for="titleSupport">Tittle</label>
        <input type="text" name="titleSupport" id="titleSupport"/>
        <label for="contentSupport">Content</label>
        <input type="text" name="contentSupport" id="contentSupport"/>
        <input type="submit" id="submit" name="submit" class="noBorder"/>


    </form></div>
            <script src="View/public/js/regex.js"  type="application/javascript"></script>
    <script src="View/public/js/support.js"  type="application/javascript"></script>

</body>

</html>';
        echo $html;
    }

}