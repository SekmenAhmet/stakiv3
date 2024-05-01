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
            $request = "SELECT logs.user_id, logs.action, logs.time, users.username FROM logs INNER JOIN users ON logs.user_id = users.id;";
            $res->render('adminLogs', [
                "logs" => Database::getInstance()->executeQuery($request)->fetchAll()
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
            $request = "SELECT notifications.user_id, notifications.sender_id, notifications.message, notifications.created_at, receiver.username AS receiver_username, sender.username AS sender_username
                        FROM notifications
                        LEFT JOIN users AS receiver ON notifications.user_id = receiver.id
                        LEFT JOIN users AS sender ON notifications.sender_id = sender.id;";
            $res->render('adminNotifs', [
                "notifs" => Database::getInstance()->executeQuery($request)->fetchAll()
            ]);
        } else {
            $res->redirect('notAdmin');
        }
    }
    public function getAdminFriendRequests(Request $req, Response $res) : void {
        if($_SESSION['email'] == 'a@gmail.com'){
            $res->setPageTitle('AdminFriendRequests');
            $request = "SELECT demande_ami.user_id, demande_ami.addedUser_id, sender.username AS sender_username, receiver.username AS receiver_username
                        FROM demande_ami
                        INNER JOIN users AS sender ON demande_ami.user_id = sender.id
                        INNER JOIN users AS receiver ON demande_ami.addedUser_id = receiver.id;
";
            $res->render('adminFriendRequests',[
                "demande_amis" => Database::getInstance()->executeQuery($request)->fetchAll()
            ]);
        } else {
            $res->redirect('notAdmin');
        }
    }
    public function getAdminFriends(Request $req, Response $res): void {
        if($_SESSION['email'] == 'a@gmail.com'){
            $res->setPageTitle('AdminFriends');
            $request = "SELECT amis.user_id, amis.ami_id, ami1.username as user_username, ami2.username as ami_username
                        FROM amis
                        INNER JOIN users as ami1 ON amis.user_id = ami1.id
                        INNER JOIN users as ami2 ON amis.ami_id = ami2.id";
            $res->render('adminFriends', [
                "amis" => Database::getInstance()->executeQuery($request)->fetchAll()
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