<?php

namespace App\controllers;

use App\Database;
use App\models\UserModel;
use App\Notifications;
use App\Request;
use App\Response;
use PDO;

class FriendsController{
    private Notifications $notifications;
    public function __construct(){
        $this->notifications = new Notifications();
    }
    public function alreadyFriend(int $id, int $ami_id) : bool {
        $requestAmis = "SELECT * FROM amis WHERE user_id = :user_id AND ami_id = :ami_id";
        return !empty(Database::getInstance()->executeQuery($requestAmis, [':user_id' => $id, ':ami_id' => $ami_id])->fetchAll(PDO::FETCH_ASSOC));
    }
    public function alreadyAsked(int $id, int $ami_id) : bool {
        $requestDemandes = "SELECT * FROM demande_ami WHERE user_id = :user_id AND addedUser_id = :ami_id";
        return !empty(Database::getInstance()->executeQuery($requestDemandes, [':user_id' => $id, ':ami_id' => $ami_id])->fetchAll(PDO::FETCH_ASSOC));
    }
    public function friends(Request $req, Response $res) : void {
        $res->render('friends', [
            'usersToAdd' => $this->userToAdd()
        ]);
    }
    public function postfriends(Request $req, Response $res) : void {
        $body = $req->bodyParser();
        $_SESSION['searchedUser'] = UserModel::getUser(Database::getInstance(), "username", $body['search']);

        if (!empty($_SESSION['searchedUser'])) {
             $res->redirect('searchResult');
        } else {
            $_SESSION['inexistantUser'] = "Utilisateurs inexistant ! ";
            $res->redirect('friends');
        }
    }
    public function postSearchResult(Request $req, Response $res) : void {
        $body = $req->bodyParser();
        if (isset($body['ajouter'])) {
            if (!$this->alreadyAsked($_SESSION['id'], $_SESSION['searchedUser']['id'])) {
                if (!$this->alreadyFriend($_SESSION['id'], $_SESSION['searchedUser']['id'])) {
                    $this->addFriends($_SESSION['id'], $_SESSION['searchedUser']['id']);
                    $this->notifications->friendNotification($_SESSION['searchedUser']['id'], $_SESSION['id']);
                } else {
                    $_SESSION['alreadyFriend'] = "Cette utilisateur est déjà votre ami";
                }
            } else {
                $_SESSION['alreadyFriend'] = "Vous avez déjà envoyé une demande d'ami à cet utilisateur";
            }
        }
        $res->redirect('searchResult');
    }
    public function addFriends(int $user, int $ami) : void {
        $request = "INSERT INTO demande_ami (user_id, addedUser_id) VALUES (:user_id, :ami_id);";
        Database::getInstance()->executeQuery($request, [':user_id' => $user, ':ami_id' => $ami]);
    }
    public function friendslist(Request $req, Response $res) : void {
        $friends = $this->getFriends($_SESSION['id']);
        $amis = [];
        foreach ($friends as $friend) {
            $ami_info = UserModel::getUser(Database::getInstance(), 'id', $friend['ami_id']);
            $amis[] = [
                'id' => $ami_info['id'],
                'username' => $ami_info['username']
            ];
        }
        $res->render('friendslist', [
            "amis" => $amis
        ]);
    }
    public function postfriendslist(Request $req, Response $res) : void {
        $body = $req->bodyParser();
        if(isset($body['supprimer'])){
            $this->deleteFriend($_SESSION['id'], $body['friend_id']);
            $res->redirect('friendslist');
        }
    }
    public function getFriends(int $id) : array {
        $request = "SELECT ami_id FROM amis WHERE user_id = :id UNION SELECT user_id FROM amis WHERE ami_id = :id";
        return Database::getInstance()->executeQuery($request, [':id' => $id])->fetchAll(PDO::FETCH_ASSOC);
    }
    public function userToAdd() : array {
        $request = "SELECT username FROM users";
        return Database::getInstance()->executeQuery($request)->fetchAll(PDO::FETCH_ASSOC);
    }
    public function acceptFriend(Request $req, Response $res) : void {
        $body = $req->bodyParser();
        $notif_id = $body['notification_id'];
        $request = "SELECT user_id, sender_id FROM notifications WHERE id = :id";
        $result = Database::getInstance()->executeQuery($request, [':id' => $notif_id])->fetch(PDO::FETCH_ASSOC);
        if (isset($body['accepter'])) {
            $requestAdd = "INSERT INTO amis (user_id, ami_id) VALUES (:user_id, :ami_id)";
            Database::getInstance()->executeQuery($requestAdd, [
                ':user_id' => $result['user_id'],
                ':ami_id' => $result['sender_id']
            ]);
            $this->deleteDemande($_SESSION['id'], $result['sender_id']);
            $this->deleteFriendsNotifs($notif_id);
        } elseif (isset($body['refuser'])) {
            $this->deleteDemande($_SESSION['id'], $result['sender_id']);
            $this->deleteFriendsNotifs($notif_id);
        }
        $res->redirect('notifs');
    }
    public function deleteFriendsNotifs(int $notif_id) : void {
        $request = 'DELETE FROM notifications WHERE id = :notif_id';
        Database::getInstance()->executeQuery($request, ['notif_id' => $notif_id]);
    }
    public function deleteDemande($user_id, $addedUser_id) : void {
        $request = "DELETE FROM demande_ami WHERE user_id = :user_id AND addedUser_id = :addedUser_id";
        Database::getInstance()->executeQuery($request, ['user_id' => $user_id, 'addedUser_id' => $addedUser_id]);
    }
    public function deleteFriend($user_id, $ami_id) : void {
        $request = "DELETE FROM amis WHERE user_id = :user_id AND ami_id = :ami_id";
        Database::getInstance()->executeQuery($request, ["user_id" => $user_id, "ami_id" => $ami_id]);
    }
}