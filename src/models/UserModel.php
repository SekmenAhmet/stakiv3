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
    public function save(PDO $db) : void
    {
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
    public static function getUser(PDO $db, string $key, string $element)
    {
        $request = "SELECT * FROM users WHERE {$key}= :{$key}";
        $bindParamKey = ":{$key}";
        $statement = $db->executeQuery($request, [$bindParamKey => $element]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
    public static function modifyEmail(PDO $db, $email, $id) : void{
        $request = "UPDATE users SET email = :email WHERE id = :id";
        $db->executeQuery($request, ['email' => $email, 'id' => $id]);
    }

    public static function modifyUsername(PDO $db, $username, $id) : void{
        $request = "UPDATE users SET username = :username WHERE id = :id";
        $db->executeQuery($request, ['username' => $username, 'id' => $id]);
    }

    public static function modifyBio(PDO $db, $bio, $id){
        $request = "UPDATE users SET biographie = :bio WHERE id = :id";
        $db->executeQuery($request, ['bio' => $bio, 'id' => $id]);
    }

}