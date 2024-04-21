<?php

namespace App\controllers;

use App\Request;
use App\Response;

class AdminController
{

    public function getAdmin(Request $req, Response $res){
        if($_SESSION['email'] == 'a@gmail.com'){
            $res->render('admin');

        } else {
            $res->redirect('login');
        }
    }
    public function postAdmin(Request $req, Response $res){

    }

    public function showTable($tablename){

    }
}