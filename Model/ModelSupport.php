<?php

namespace App\Model;

class ModelSupport extends Model
{
    private $fname;
    private $lname;
    private $email;
    private $title;
    private $content;
    private $userid;
    private $constructor;
    public function __construct(...$args){
        $count = count($args);
        match($count){
            5=> $this->notLogged(...$args),
            3=>$this->logged(...$args)
        };

    }
    private function notLogged($fname, $lname, $email, $title, $content){
        $this->fname = $fname;
        $this->lname = $lname;
        $this->email=$email;
        $this->title = $title;
        $this->content = $content;
        $this->constructor=1;
    }
    private function logged($userid, $title, $content){
        $this->userid = $userid;
        $this->title = $title;
        $this->content = $content;
        $this->constructor = 2;
    }
    public function Query()
    {
        $sql = null;
        if($this->constructor==1){
            $sql = "INSERT INTO support(f_name, l_name, email, title, content) VALUES (:fname, :lname, :email, :title, :content)";
        }
        else if($this->constructor==2){
            $sql = "INSERT INTO support (id_user, title, content) values (:iduser, :title, :content)";
        }else{
            die();
        }
        try{
            $conn = new Conn();
            if($conn = $conn->conn()){
                if($stmt = $conn->prepare($sql)){
                    if($this->constructor==1){
                        $stmt->bindParam(":fname", $this->fname);
                        $stmt->bindParam(":lname", $this->lname);
                        $stmt->bindParam(":email", $this->email);
                        $stmt->bindParam(":title", $this->title);
                        $stmt->bindParam(":content", $this->content);
                    }
                    else if($this->constructor==2){
                        $stmt->bindParam(":iduser", $this->userid);
                        $stmt->bindParam(":title", $this->title);
                        $stmt->bindParam(":content", $this->content);
                    }
                    if($stmt->execute()){
                        return true;
                    }
                }
            }
            return false;
        }catch(\PDOException $e){
            echo $e->getMessage();
            return false;

        }



        // TODO: Implement Query() method.
    }
}