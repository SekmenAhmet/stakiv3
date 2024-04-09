<?php

namespace App\Controllers;

use App\Database;
use App\models\UserModel;
use App\Notifications;
use App\Request;
use App\Response;
use PDO;

class UserController{
    private Database $db;
    private Notifications $notif;
    public function __construct(){
        $this->db = new Database();
        $this->notif = new Notifications();
    }
    private function executeQuery($query, $params = []) {
        return $this->db->executeQuery($query, $params);
    }
    public function isExists(string $email) : bool {
        return !empty(UserModel::getUser($this->db, "email", $email));
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
            $model->save($this->db);
            $req->session->setSession($this->db ,$body['email']);
            $user = UserModel::getUser($this->db, "email", $body['email']);
            $this->notif->welcomNotif($user['id']);
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
            $query = $this->executeQuery($request, [':email' => $body['email'], ':passwd' => $body['passwd']]);
            $result = $query->fetch(PDO::FETCH_ASSOC);
            if($result){
                $req->session->setSession($this->db, $body['email']);
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
            $this->executeQuery($request, [':email' => $body['email']]);
            $req->session->destroy();
            $res->redirect("deleteAccount");
        }
    }
    public function profilmodif(Request $req, Response $res){
        $body = $req->bodyParser();
        if(!empty($body['username'])){
            UserModel::modifyUsername($this->db, $body['username'], $_SESSION['id']);
            $_SESSION['username'] = $body['username'];
        }
        if(!empty($body['email'])){
            UserModel::modifyEmail($this->db, $body['email'], $_SESSION['id']);
            $_SESSION['email'] = $body['email'];
        }
        if (isset($body['biographie'])){
            UserModel::modifyBio($this->db, $body['biographie'], $_SESSION['id']);
            $_SESSION['biographie'] = $body['biographie'];
        }
        $res->redirect('profil');
    }
}