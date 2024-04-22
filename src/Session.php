<?php

namespace App;
use App\models\UserModel;
use PDO;

class Session {
    public function __construct(){
        session_start();
    }
    public function destroy() : void {
        Logs::addToLogs($_SESSION['id'], 'Déconnexion');
        session_unset();
        session_destroy();
    }
    public function setSession(PDO $db , string $email) : void {
        $user = UserModel::getUser($db,"email", $email);
        $_SESSION = [
            'id' => $user['id'],
            'name' => $user['name'],
            'lastname' => $user['lastname'],
            'username' => $user['username'],
            'email' => $user['email'],
            'ddn' => $user['ddn']
        ];
    }
}