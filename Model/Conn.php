<?php

namespace App\Model;
use \PDO;
class Conn
{
public $servername = "localhost";
    public $username = "korisnik";
    public $password = "korisnik";
    public $dbname = "phpapp";

    public function conn(){

        try {
            $pdo = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            return $pdo;
        } catch (\PDOException $e) {

        }
    }
}