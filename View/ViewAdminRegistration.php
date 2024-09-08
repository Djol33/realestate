<?php

namespace App\View;

class ViewAdminRegistration extends View
{
    private $dataView;
    public function __construct($data){
        $this->dataView = $data;
    }
    public static function View()
    {
        // TODO: Implement View() method.
    }

    public function View1(){
        $html = '
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Apartments</title>
    <link rel="stylesheet" href="View/public/css/style.css" type="text/css"/>
    <script src="View/public/js/header.js" type="application/javascript"></script>
    <script src="https://kit.fontawesome.com/104d21a00f.js" type="application/javascript" crossorigin="anonymous"></script>

        </head>
        <body>
        <h1 id="head">Waiting for Registration </h1>
                <form action="adminRegistration" method="post" id="support1">
        <table>
        <thead>
        <tr>
        <th>check</th>
        <th>First Name</ht>
        <th>Last Name</th>
        <th>Email</th>
        </tr>
        </thead>
        <tbody>

        ';
        foreach($this->dataView as $row){
            $html.="
            <tr>
                        <td>"."<input type='checkbox' name='reg[]' value='".$row['user_id']."' "."</td>
            <td>".$row["f_name"]."</td>
                        <td>".$row["l_name"]."</td>
                                    <td>".$row["email"]."</td>
          
</tr>
            ";
        }
        $html.="</tbody></table><input type='submit' name='submit' value='SUBMIT'/></form> ";
        echo $html;

    }

}