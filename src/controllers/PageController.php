<?php

namespace App\controllers;

use App\MailService;
use App\Notifications;
use App\Request;
use App\Response;
use PHPMailer\PHPMailer\Exception;

class PageController {
    public function profil(Request $req, Response $res) : void {
        isset($_SESSION['email']) ? $res->redirect("profil") : $res->redirect("login");
    }
    public function notifs(Request $req, Response $res) : void {
        $notifs = new Notifications();
        $notifs->showNotif($_SESSION['id']);
        $res->render('notifs');
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
}