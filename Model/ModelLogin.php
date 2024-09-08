<?php

namespace App\Model;
use App\Model\Conn;
use PDO;

class ModelLogin extends Model
{
    private $email;
    private $password;
    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function Query()
    {
 
        try{
            $sql = "SELECT user_id, role, password, is_active FROM users WHERE email = :email ";
            $conn = new Conn();
            if ($conn = $conn->conn()) {
                if ($stmt = $conn->prepare($sql)) {
                    $stmt->bindParam(":email", $this->email);
                    if($stmt->execute()){
                        if($stmt->rowCount()==1){
                            $res = $stmt->fetch();
                            if(password_verify($this->password, $res["password"])){
                                return $res;
                            }
                            else{
                                return 'code:pwormailnomatch';
                            }
                        }
                        else{
                            return 'code:pwormailnomatch';
                        }
                    }else{
                        return "srv_down";
                    }
                }else{
                    return "srv_down";
                }


            }
            else{
                return "srv_down";
            }
        }catch(\PDOException $e){

            return "srv_down";

        }

    }
}
