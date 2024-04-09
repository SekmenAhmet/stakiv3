<?php

namespace App\Controllers;

use App\Database;
use App\models\UserModel;
use App\Notifications;
use App\Request;
use App\Response;
use PDO;

class FriendsController{
    private Database $db;
    private Notifications $notifications;
    public function __construct()
    {
        $this->db = new Database();
        $this->notifications = new Notifications();
    }
    private function executeQuery($query, $params = []) {
        return $this->db->executeQuery($query, $params);
    }
    public function friends(Request $req, Response $res) : void{
        $_SESSION['usersToAdd'] = $this->userToAdd();
        $res->render('friends');
    }
    public function postfriends(Request $req, Response $res) : void{
        $body = $req->bodyParser();
        $_SESSION['searchedUser'] = UserModel::getUser($this->db, "username", $body['search']);

        if (!empty($_SESSION['searchedUser'])) {
             $res->redirect('searchResult');
        } else {
            $_SESSION['inexistantUser'] = "Utilisateurs inexistant ! ";
            $res->redirect('friends');
        }
    }
    public function postSearchResult(Request $req, Response $res) : void{
        $body = $req->bodyParser();
        if(isset($body['ajouter'])){
            $this->addFriends($_SESSION['id'], $_SESSION['searchedUser']['id']);
            $this->notifications->friendNotification( $_SESSION['searchedUser']['id'], $_SESSION['id']);
        }
        $res->redirect('searchResult');
    }
    public function addFriends($user, $ami) : void{
        $request = "INSERT INTO demande_ami (user_id, addedUser_id) VALUES (:user_id, :ami_id);";
        $this->executeQuery($request, [':user_id' => $user, ':ami_id' => $ami]);
    }
    public function friendslist(Request $req, Response $res){
        $friends = $this->getFriends($_SESSION['id']);
        $amis = [];
        foreach ($friends as $friend) {
            $ami_info = UserModel::getUser($this->db, 'id', $friend['ami_id']);
            $amis[] = [
                'id' => $ami_info['id'],
                'username' => $ami_info['username']
            ];
        }
        $_SESSION['amis'] = $amis;
        $res->render('friendslist');
    }
    public function postfriendslist(Request $req, Response $res){
        $body = $req->bodyParser();
        if(isset($body['supprimer'])){
            $this->deleteFriend($_SESSION['id'], $body['friend_id']);
            $res->redirect('friendslist');
        }
    }
    public function getFriends($id){
        $request = "SELECT ami_id FROM amis WHERE user_id = :id 
                UNION 
                SELECT user_id FROM amis WHERE ami_id = :id";
        return $this->executeQuery($request, [':id' => $id])->fetchAll(PDO::FETCH_ASSOC);
    }
    public function userToAdd(){
        $request = "SELECT username FROM users";
        return $this->executeQuery($request)->fetchAll(PDO::FETCH_ASSOC);
    }
    public function acceptFriend(Request $req, Response $res)
    {
        $body = $req->bodyParser();
        $notif_id = $body['notification_id'];
        $request = "SELECT user_id, sender_id FROM notifications WHERE id = :id";
        $result = $this->executeQuery($request, [':id' => $notif_id])->fetch(PDO::FETCH_ASSOC);
        if (isset($body['accepter'])) {
            $requestAdd = "INSERT INTO amis (user_id, ami_id) VALUES (:user_id, :ami_id)";
            $this->executeQuery($requestAdd, [
                ':user_id' => $result['user_id'],
                ':ami_id' => $result['sender_id']
            ]);
            $this->deleteFriendsNotifs($notif_id);
            $this->deleteDemande($result['user_id'], $result['sender_id']);
        } elseif (isset($body['refuser'])) {
            $this->deleteFriendsNotifs($notif_id);
            $this->deleteDemande($result['user_id'], $result['sender_id']);
        }
        $res->redirect('notifs');
    }
    public function deleteFriendsNotifs($notif_id) {
        $request = 'DELETE FROM notifications WHERE id = :notif_id';
        $this->db->executeQuery($request, ['notif_id' => $notif_id]);
    }
    public function deleteDemande($user_id, $addedUser_id)
    {
        $request = "DELETE FROM demande_ami WHERE user_id = :user_id AND addedUser_id = :addedUser_id";
        $this->db->executeQuery($request, ['user_id' => $user_id, 'addedUser_id' => $addedUser_id]);
    }
    public function deleteFriend($user_id, $ami_id){
        $request = "DELETE FROM amis WHERE user_id = :user_id AND ami_id = :ami_id";
        $this->db->executeQuery($request, ["user_id" => $user_id, "ami_id" => $ami_id]);
    }
}
