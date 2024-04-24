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
//        \App\models\UserModel::getUser(\App\Database::getInstance(), 'id', $row['user_id'])['username'];
//        foreach($staks as $array){
//            $user = UserModel::getUser(\App\Database::getInstance(), 'id', $array['user_id'])['username'];
//        }

        $res->render('home', [
            'staks' => $staks,
//            'user' => $user
        ]);
    }

    public function postStaks(Request $req, Response $res){
        $body = $req->bodyParser();
        $request = "INSERT INTO staks (user_id, text) VALUES (:user_id, :text)";
        Database::getInstance()->executeQuery($request, ['user_id' => $_SESSION['id'], 'text' => $body['stak']]);
        $res->redirect('');
    }
}