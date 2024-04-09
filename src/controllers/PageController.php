<?php

namespace App\Controllers;

use App\Notifications;
use App\Request;
use App\Response;

class PageController {
    public function profil(Request $req, Response $res) : void{
        isset($_SESSION['email']) ? $res->redirect("profil") : $res->redirect("login");
    }

    public function notifs(Request $req, Response $res) : void
    {
        $notifs = new Notifications();
        $notifs->showNotif($_SESSION['id']);
        $res->render('notifs');
    }
}