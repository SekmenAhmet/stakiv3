<?php

namespace App\controllers;

use App\Database;
use App\Logs;
use App\models\UserModel;
use App\Notifications;
use App\Request;
use App\Response;

class UserController{
    private Notifications $notif;
    public function __construct(){
        $this->notif = new Notifications();
    }
    public function isExists(string $email) : bool {
        return !empty(UserModel::getUser(Database::getInstance(), "email", $email));
    }

    public function getRegister(Request $req, Response $res){
        $res->setPageTitle('Inscription');
        $res->render('register');
    }

    public function register(Request $req, Response $res) : void {
        $body = $req->bodyParser();
        if(!$this->isExists($body['email'])) {
            $model = new UserModel(
                trim($body['name']),
                trim($body['lastname']),
                trim($body['username']),
                trim($body['email']),
                trim($body['passwd']),
                trim($body['ddn'])
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
    public function getLogin(Request $req, Response $res){
        $res->setPageTitle('Connexion');
        $res->render('login');
    }
    public function login(Request $req, Response $res) : void {
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
    public function logout(Request $req,Response $res) : void {
        $req->session->destroy();
        $res->redirect("login");
    }
    public function profilmodif(Request $req, Response $res) : void {
        $body = $req->bodyParser();
        if (!empty($body['username'])) {
            if (empty(UserModel::getUser(Database::getInstance(), "username", $body['username']) && $body['username'] != $_SESSION['username'])) {
                UserModel::modifyInfo(Database::getInstance(), 'username', $body['username'], $_SESSION['id']);
                $_SESSION['username'] = $body['username'];
            } else {
                $_SESSION['infoError'] = "Ce nom d'utilisateur est déjà utilisé";
            }
        }
        if (!empty($body['email'])) {
            if (filter_var($body['email'], FILTER_VALIDATE_EMAIL)) {
                if (empty(UserModel::getUser(Database::getInstance(), 'email', $body['email']) && $body['email'] != $_SESSION['email'])) {
                    UserModel::modifyInfo(Database::getInstance(), 'email', $body['email'], $_SESSION['id']);
                    $_SESSION['email'] = $body['email'];
                } else {
                    $_SESSION['infoError'] = "Cet email est déjà utilisé";
                }
            } else {
                $_SESSION['infoError'] = "L'adresse email est invalide";
            }
        }
        if (isset($body['biographie'])) {
            UserModel::modifyInfo(Database::getInstance(), 'biographie', $body['biographie'], $_SESSION['id']);
            $_SESSION['biographie'] = $body['biographie'];
        }
        $res->redirect('profil');
    }
    public function changemdp(Request $req, Response $res) : void {
        $body = $req->bodyParser();
        $hashrequest = "select password(:oldpaswd)";
        $hashedOldPasswd = Database::getInstance()->executeQuery($hashrequest, ['oldpasswd' => $body['oldpasswd']]);
        $getOldPasswd = UserModel::getUser(Database::getInstance(), 'passwd', $hashedOldPasswd) ;
        if($hashedOldPasswd == $getOldPasswd){
            $_SESSION['fakepasswd'] = "c carré";
        }
    }
    public function getProfilModif(Request $req, Response $res){
        $res->setPageTitle('Modifications');
        $res->render('profilmodif');
    }
}