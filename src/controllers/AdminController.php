<?php

namespace App\controllers;

use App\Database;
use App\Request;
use App\Response;

class AdminController
{
    public function getAdmin(Request $req, Response $res){
        if($_SESSION['email'] == 'a@gmail.com'){
            $res->render('admin');
        } else {
            $res->redirect('notAdmin');
        }
    }
    public function showTable($tablename){
        $request = "SELECT * FROM  $tablename";
        return Database::getInstance()->executeQuery($request)->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function getAdminNotifs(Request $req, Response $res){
        if($_SESSION['email'] == 'a@gmail.com'){
            $res->render('getAdminNotifs');
        } else {
            $res->redirect('notAdmin');
        }
    }
    public function getAdminFriendRequests(Request $req, Response $res){
        if($_SESSION['email'] == 'a@gmail.com'){
            $res->render('adminFriendRequests');
        } else {
            $res->redirect('notAdmin');
        }
    }
    public function getAdminFriends(Request $req, Response $res){
        if($_SESSION['email'] == 'a@gmail.com'){
            $res->render('adminFriends');
        } else {
            $res->redirect('notAdmin');
        }
    }
    public function getAdminUsers(Request $req, Response $res){
        if($_SESSION['email'] == 'a@gmail.com'){
            $res->render('adminUsers');
        } else {
            $res->redirect('notAdmin');
        }
    }
    public function getAdminLogs(Request $req, Response $res){
        if($_SESSION['email'] == 'a@gmail.com'){
            $res->render('adminLogs');
        } else {
            $res->redirect('notAdmin');
        }
    }
}