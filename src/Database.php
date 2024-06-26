<?php

namespace App;

use PDO;
use PDOException;

class Database extends PDO {
    public static ?Database $dbinstance = null;
    public function __construct(){
        try {
            $dbname = "staki";
            $user = "root";
            $passwd = "";
            parent::__construct("mysql:host=localhost;dbname=$dbname", $user, $passwd);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            echo "Erreur : " . $e;
        }
    }
    public static function getInstance() : self {
        if(self::$dbinstance === null){
            self::$dbinstance = new self();
        }
        return self::$dbinstance;
    }
    public function executeQuery(string $query, array $params = []){
        $connexion = $this->prepare($query);
        $connexion->execute($params);
        return $connexion;
    }
}