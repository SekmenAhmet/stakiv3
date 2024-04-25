<?php

namespace App\controllers;

use App\Database;
use App\models\UserModel;
use App\Request;
use App\Response;
use mysql_xdevapi\Result;

class StaksController {
    public function getStaks(Request $req, Response $res) {
        $staks = UserModel::showTable('staks');
        $res->setPageTitle('Staki');
        $res->render('home', [
            'staks' => $staks,
        ]);
    }

    public function postStaks(Request $req, Response $res){
        $body = $req->bodyParser();
        if(!empty($body['stak'])){
            $request = "INSERT INTO staks (user_id, text) VALUES (:user_id, :text)";
            Database::getInstance()->executeQuery($request, ['user_id' => $_SESSION['id'], 'text' => $body['stak']]);
        } else {
            $_SESSION['stakError'] = "Poster un stak vide ? T'as pas trouver plus con ?";
        }
        $res->redirect('');
    }
}