<?php

namespace App\controllers;

use App\Database;
use App\models\UserModel;
use App\Request;
use App\Response;
use mysql_xdevapi\Result;

class StaksController {
    public function getStaks(Request $req, Response $res) {
        $request = "select staks.user_id, staks.text, staks.time, users.username from staks inner join users ON staks.user_id = users.id";
        $staks = Database::getInstance()->executeQuery($request)->fetchAll(\PDO::FETCH_ASSOC);
        $res->setPageTitle('Staki');
        $res->render('home', [
            'staks' => $staks,
        ]);
    }
    public function postStaks(Request $req, Response $res){
        $body = $req->bodyParser();
        $stakText = trim($body['stak']);
        if(!empty($stakText)){
            $request = "INSERT INTO staks (user_id, text) VALUES (:user_id, :text)";
            Database::getInstance()->executeQuery($request, ['user_id' => $_SESSION['id'], 'text' => $stakText]);
        } else {
            $_SESSION['stakError'] = "Poster un stak vide ? T'as pas trouver plus con ?";
        }
        $res->redirect('');
    }
}