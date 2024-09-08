<?php
namespace App\GeneralFunction;
class RegexValidation
{
    public  static function  ime(string $ime):bool{

        $ime_reg = "/^[A-Z]{1}[a-z]{1,9}$/";
        return preg_match($ime_reg, $ime);
    }
    public static function  email(string $mail):bool{

        $email_reg = "/[\w\d\_\-\+\.]\@[\w\.]+$/";
        return preg_match($email_reg, $mail);
    }

    public static function password($pw1, $pw2 = null):bool{

        $pw_reg1 = "/[\d]/";
        $pw_reg2 = "/[\w]/";
        $len = (strlen($pw1)>8) ? true :false;
        if($len && preg_match($pw_reg1, $pw1) && preg_match($pw_reg2,$pw1)){
            if($pw2 == NULL || $pw1 ==$pw2) {
                return true;
            }
        }
        return false;



    }

    public static function minlen($var, $len):bool{
        if(strlen($var) >$len){
            return true;
        }
        return false;
    }

    public static function minnumber($var, $minimum,$maximum = NULL):bool{
        if($var>$minimum) return true;
        return false;
    }
}