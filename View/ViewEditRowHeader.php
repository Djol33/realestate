<?php

namespace App\View;

class ViewEditRowHeader extends View
{
    private $data;
    private $allData;
    public function __construct($data, $allData){
        $this->data=$data;
        $this->allData=$allData;

    }
    public static function View()
    {

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
        <body>';
        $html.="<h1 id='head'>Edit row</h1>";
        $html.='    <form action="AdminEditRowHeader" method="POST" id="support1">
        <table>
        <thead>
        <tr>
 
        <th>title</ht>
        <th>href_link</th>
        <th>parent_id</th>
        <th>Logged</th>
                <th>Role</th>
 
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><input type="text" name="title" value="'.$this->data["title"].'" /></td>
            <td><input type="text" name="href_link" value="'.$this->data["href_link"].'" /></td>';


        $html.="<td><select id='sel' name='parend_id'><option value='0'>No Parent</option>";
        foreach($this->allData as $row){
            if($row["parend_id"] == NULL && $row["id"]!==1   ){

                $html.="<option   ".($this->data['parend_id'] == $row["id"]?"selected":"")." value='".$row["id"]."'>".$row["title"]."</option>";
            }

        }
        $html.="</select>";

        $html.='        <td><input type="text" name="logged" value="'.$this->data["logged"].'" /></td>
            <td><input type="text" name="role" value="'.$this->data["role"].'"  /></td>
        </tr>
        </tbody>
        </table>
        <input type="hidden" name="survey_id" value="'.$this->data["id"].'"/>
        <input type="submit"/>
        </form></tbody></table></body></html>
        ';

        echo $html;



    }

}