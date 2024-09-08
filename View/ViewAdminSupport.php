<?php

namespace App\View;

class ViewAdminSupport extends View
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
        $html='        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Apartments</title>
    <link rel="stylesheet" href="View/public/css/style.css"  type="text/css"/>
    <script src="View/public/js/header.js"  type="application/javascript"></script>
    <script src="https://kit.fontawesome.com/104d21a00f.js" type="application/javascript" crossorigin="anonymous"></script>

        </head>
        <body>
        <h1  id="head">Support Tickets</h1>
                <form action="adminSupport" method="POST" id="support1">
        <table>
        <thead>
        <tr>
        <th>check</th>
        <th>First Name</ht>
        <th>Last Name</th>
        <th>Email</th>
        <th>Title</th>
        <th>Content</th>
        </tr>
        </thead>
        <tbody>
';
        foreach ($this->data as $row){
            $html.= "<tr><td><input type='checkbox' name='answered[]' value='".$row["id"]."'/></td>
                    <td>".$row["f_name"]."</td>
                                        <td>".$row["l_name"]."</td>
                                       <td>".$row["email"]."</td>
                                                           <td>".$row["title"]."</td>
 
 
                                        <td>".$row["content"]."</td>

</tr>";

        }
        $html.="</tbody></table>        <input type='submit' name='submit'/></form></body></html>";
        echo $html;




    }
}