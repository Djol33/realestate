<?php

namespace App\Model;
use \PDO;
use App\Model\Conn;

class ModelRegister extends Model
{
    private $firstName;
    private $lastName;
    private $email;
    private $password;
    public function __construct($fname,$lname, $email,$pw){
        $this->firstName = $fname;
        $this->lastName = $lname;
        $this->email = $email;
        $this->password = password_hash($pw,PASSWORD_ARGON2ID);
    }
    public function Query()
    {

        $sql = "INSERT INTO users(f_name, l_name,email,password) Values (:fname,:lname,:email,:password)";
        $conn = new Conn();
        if($conn = $conn->conn()){
            if($stmt = $conn->prepare($sql)){
                $stmt->bindParam(':fname',$this->firstName,PDO::PARAM_STR);
                $stmt->bindParam(':lname',$this->lastName,PDO::PARAM_STR);
                $stmt->bindParam(":email", $this->email, PDO::PARAM_STR);
                $stmt->bindParam(":password",$this->password, PDO::PARAM_STR);
               try{ if($stmt->execute()) {
                    return true;
                }
                else{
                    return "failure";
                }
               }
               catch(\PDOException){
                   return "failure";
               }
            }

        }


        return false;
    }
}