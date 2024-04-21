<?php

namespace App\Controllers;

use App\Database;
use App\Logs;
use App\models\UserModel;
use App\Notifications;
use App\Request;
use App\Response;
use PDO;

class UserController{
    private Notifications $notif;
    public function __construct(){
        $this->notif = new Notifications();
    }
    public function isExists(string $email) : bool {
        return !empty(UserModel::getUser(Database::getInstance(), "email", $email));
    }
    public function register(Request $req, Response $res): void {
        $body = $req->bodyParser();
        if(!$this->isExists($body['email'])) {
            $model = new UserModel(
                $body['name'],
                $body['lastname'],
                $body['username'],
                $body['email'],
                $body['passwd'],
                $body['ddn']
            );
            $model->save(Database::getInstance());
            $req->session->setSession(Database::getInstance() ,$body['email']);
            $user = UserModel::getUser(Database::getInstance(), "email", $body['email']);
            $this->notif->welcomNotif($user['id']);
            Logs::addToLogs($_SESSION['id'], 'Inscription');
            $res->redirect('profil');
        } else {
            $_SESSION['email-error'] = "Email déjà utilisé";
        }
    }
    public function login(Request $req, Response $res) : void
    {
        $body = $req->bodyParser();
        if (isset($body['email']) &&
            isset($body['passwd']) &&
            $this->isExists($body['email'])
        ){

            $request = "SELECT email, passwd FROM users WHERE email = :email and passwd = password(:passwd)";
            $query = Database::getInstance()->executeQuery($request, [':email' => $body['email'], ':passwd' => $body['passwd']]);
            $result = $query->fetch();
            if($result){
                $req->session->setSession(Database::getInstance(), $body['email']);
                Logs::addToLogs($_SESSION['id'], "Connexion");
                $res->redirect("profil");
            } else {
                $_SESSION['error'] = "Identifiants incorrects.";
                $res->redirect("login");
            }
        } else {
            $_SESSION['error'] = "Identifiants incorrects.";
            $res->redirect("login");
        }
    }
    public function logout(Request $req,Response $res)
    {
        $req->session->destroy();
        $res->redirect("login");
    }
    public function deleteAccount(Request $req, Response $res)
    {
        $body = $req->bodyParser();
        if ($this->isExists($body['email'])) {
            $request = "DELETE FROM users WHERE email = :email";
            Database::getInstance()->executeQuery($request, [':email' => $body['email']]);
            $req->session->destroy();
            $res->redirect("deleteAccount");
        }
    }
    public function profilmodif(Request $req, Response $res){
        $body = $req->bodyParser();
        if(!empty($body['username'])){
            UserModel::modifyUsername(Database::getInstance(), $body['username'], $_SESSION['id']);
            $_SESSION['username'] = $body['username'];
        }
        if(!empty($body['email'])){
            UserModel::modifyEmail(Database::getInstance(), $body['email'], $_SESSION['id']);
            $_SESSION['email'] = $body['email'];
        }
        if (isset($body['biographie'])){
            UserModel::modifyBio(Database::getInstance(), $body['biographie'], $_SESSION['id']);
            $_SESSION['biographie'] = $body['biographie'];
        }
        $res->redirect('profil');
    }

    public function changemdp(Request $req, Response $res){
        $body = $req->bodyParser();
        $hashrequest = "select password(:oldpaswd)";
        $hashedOldPasswd = Database::getInstance()->executeQuery($hashrequest, ['oldpasswd' => $body['oldpasswd']]);
        $getOldPasswd = UserModel::getUser(Database::getInstance(), 'passwd', $hashedOldPasswd) ;
        if($hashedOldPasswd == $getOldPasswd){
            $_SESSION['fakepasswd'] = "c carré";
        }
    }
}