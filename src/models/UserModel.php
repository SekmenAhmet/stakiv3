<?php

namespace App\models;

use App\Database;
use PDO;

class UserModel
{
    private string $name;
    private string $lastname;
    private string $email;
    private string $username;
    private string $passwd;
    private string $ddn;
    public function __construct(string $name, string $lastname, string $username, string $email, string $passwd, string $ddn)
    {
        $this->name = $name;
        $this->lastname = $lastname;
        $this->username = $username;
        $this->email = $email;
        $this->passwd = $passwd;
        $this->ddn = $ddn;
    }
    public function save(PDO $db) : void {
        $request = "INSERT INTO users (name, lastname, email, username, passwd, ddn) VALUES (:name, :lastname, :email, :username, password(:passwd), :ddn)";
        $params = [
            ':name' => $this->name,
            ':lastname' => $this->lastname,
            ':username' => $this->username,
            ':email' => $this->email,
            ':passwd' => $this->passwd,
            ':ddn' => $this->ddn
        ];
        $db->executeQuery($request, $params);
    }
    public static function getUser(PDO $db, string $key, string $element){
        $request = "SELECT * FROM users WHERE $key= :$key";
        $bindParamKey = ":$key";
        $statement = $db->executeQuery($request, [$bindParamKey => $element]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
    public static function modifyInfo(PDO $db, string $element, $info, $id){
        $request = "UPDATE users SET $element = :info WHERE id = :id";
        $db->executeQuery($request, ['info' => $info, 'id' => $id]);
    }
    public static function showTable(string $tablename) : array {
        $request = "SELECT * FROM  $tablename";
        return Database::getInstance()->executeQuery($request)->fetchAll(PDO::FETCH_ASSOC);
    }
}