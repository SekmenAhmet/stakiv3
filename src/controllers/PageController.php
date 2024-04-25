<?php

namespace App\controllers;

use App\Database;
use App\MailService;
use App\models\UserModel;
use App\Notifications;
use App\Request;
use App\Response;
use PHPMailer\PHPMailer\Exception;

class PageController {


    public function getProfil(Request $req, Response $res) : void {
        if(isset($_SESSION['email'])){
            $body = $req->bodyParser();
            if(!isset($_SESSION['biographie'])){
                $_SESSION['biographie'] = UserModel::getUser(Database::getInstance(), 'id', $_SESSION['id'])['biographie'];
            }
            $res->setPageTitle('Profil');
            $res->render("profil");
        } else {
            $res->redirect("login");
        }
    }
    public function notifs(Request $req, Response $res) : void {
        $notifs = new Notifications();
        $notifs->showNotif($_SESSION['id']);
        $res->setPageTitle('Notifications');
        $res->render('notifs');
    }

    public function getContact(Request $req, Response $res){
        $res->setPageTitle('Contact');
        $res->render('contact');
    }

    public function contact(Request $req, Response $res) : void{
        $body = $req->bodyParser();
        $mailer = new MailService();
        try {
            $mailer->contact($_SESSION, $body['objet'], $body['message']);
        } catch (Exception $e) {
            echo $e;
        }
        $res->redirect('contact');
    }
    public function getSearchResult(Request $req, Response $res){
        $res->setPageTitle('Résultat');
        $res->render('searchResult');
    }
}