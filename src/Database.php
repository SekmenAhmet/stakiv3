<?php

namespace App;

use PDO;

class Database extends PDO {
    public function __construct(){
        try {
            $dbname = "stakiv3";
            $user = "root";
            $passwd = "";
            parent::__construct("mysql:host=localhost;dbname=$dbname", $user, $passwd);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e){
            echo "Erreur : " . $e;
        }
    }

    public function executeQuery($query, $params = []) {
        $connexion = $this->prepare($query);
        $connexion->execute($params);
        return $connexion;
    }
    public function getConnection(): PDO
        {
            return $this;
        }
}
