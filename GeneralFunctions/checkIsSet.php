<?php

function checkIfSetGet(){
    $args = func_get_args();
    foreach($args as $argument){
        if(!isset($_GET[$argument])){
            return false;
        }

    }
    return true;
}
function checkIfSetPost(){
    $args = func_get_args();
    foreach($args as $argument){
        if(!isset($_POST[$argument])){
            return false;
        }

    }
    return true;
}
function checkIfSet (){
    $args = func_get_args();
    foreach($args as $argument){
        if(!isset($argument)){
            return false;
        }

    }
    return true;
}