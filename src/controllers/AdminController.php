<?php

namespace App\controllers;

use App\Database;
use App\models\UserModel;
use App\Request;
use App\Response;

class AdminController {
    public function getAdmin(Request $req, Response $res) : void {
        if($_SESSION['email'] == 'a@gmail.com'){
            $res->setPageTitle('Admin');
            $res->render('admin');
        } else {
            $res->redirect('notAdmin');
        }
    }
    public function getAdminLogs(Request $req, Response $res) : void {
        if($_SESSION['email'] == 'a@gmail.com'){
            $res->setPageTitle('AdminLogs');
            $res->render('adminLogs', [
                "logs" => UserModel::showTable('logs')
            ]);
        } else {
            $res->redirect('notAdmin');
        }
    }
    public function getAdminUsers(Request $req, Response $res) : void{
        if($_SESSION['email'] == 'a@gmail.com'){
            $res->setPageTitle('AdminUsers');
            $res->render('adminUsers', [
                'users' => UserModel::showTable('users')
            ]);
        } else {
            $res->redirect('notAdmin');
        }
    }
    public function getAdminNotifs(Request $req, Response $res) : void{
        if($_SESSION['email'] == 'a@gmail.com'){
            $res->setPageTitle('AdminNotifs');
            $res->render('adminNotifs', [
                "notifs" => UserModel::showTable('notifications')
            ]);
        } else {
            $res->redirect('notAdmin');
        }
    }
    public function getAdminFriendRequests(Request $req, Response $res) : void {
        if($_SESSION['email'] == 'a@gmail.com'){
            $res->setPageTitle('AdminFriendRequests');
            $res->render('adminFriendRequests',[
                "demande_amis" => UserModel::showTable("demande_ami")
            ]);
        } else {
            $res->redirect('notAdmin');
        }
    }
    public function getAdminFriends(Request $req, Response $res): void {
        if($_SESSION['email'] == 'a@gmail.com'){
            $res->setPageTitle('AdminFriends');
            $res->render('adminFriends', [
                "amis" => UserModel::showTable('amis')
            ]);
        } else {
            $res->redirect('notAdmin');
        }
    }
    public function notAdmin(Request $req, Response $res){
        $res->setPageTitle("Oh eh !");
        $res->render('notAdmin');
    }
}