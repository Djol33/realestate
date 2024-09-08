<?php

namespace App\View;

class ViewAdminHeader extends View
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
        <h1 id="head">Header Elemenents</h1>
                <form action="AdminRemoveHeaderRows" method="POST" id="support1">
        <table>
        <thead>
        <tr>
        <th>Delete</th>
        <th>title</ht>
        <th>href_link</th>
        <th>parent_id</th>
        <th>Logged</th>
                <th>Role</th>
                        <th>izmeni</th>
        </tr>
        </thead>
        <tbody>
';

    foreach($this->data as $row){
        $html.="<tr><td><input type='checkbox' id='cb' name='delete[]' value='".$row["id"]."'/></td>";
        $html.="<td>".$row["title"] ."</td>";
        $html.="<td>".$row["href_link"] ."</td>";
        $html.="<td>".$row["parend_id"] ."</td>";
        $html.="<td>".$row["logged"] ."</td>";
        $html.="<td>".$row["role"] ."</td>";
        $html.="<td>".'<a href="AdminEditRowHeader?id='.$row["id"].'"/>Edit'."</a></td></tr>";

    }
    $html.="</tbody></table><input type='submit' value='Delete'></form>";


    $html.="<h1 id='head'>Insert row</h1>";
    $html.='    <form action="AdminInserRowHeader" method="POST" id="support1">
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
            <td><input type="text" name="title" /></td>
            <td><input type="text" name="href_link" /></td>';

            //<td><input type="text" name="parend_id" /></td>
        $html.="<td><select id='sel' name='parend_id'><option value='0'>No Parent</option>";
        foreach($this->data as $row){
            if($row["parend_id"] ==NULL && $row["id"]!==1){
                $html.="<option value='".$row["id"]."'>".$row["title"]."</option>";
            }

        }
        $html.="</select>";

    $html.='        <td><input type="text" name="logged" /></td>
            <td><input type="text" name="role" /></td>
        </tr>
        </tbody>
        </table>
        <input type="submit"/>
        </form>
        ';





    echo $html;


    }

}

