<?php

namespace App;

use App\models\UserModel;

class Notifications
{
    private Database $db;
    public function __construct()
    {
        $this->db = new Database();

    }
    public function showNotif($id): array
    {
        $request = "SELECT n.*, u.username AS sender_username FROM notifications n LEFT JOIN users u ON n.sender_id = u.id WHERE n.user_id = :id";
        $connexion = $this->db->getConnection()->prepare($request);
        $connexion->execute([':id' => $id]);
        $results = $connexion->fetchAll(\PDO::FETCH_ASSOC);
        $_SESSION['notifAmi'] = [];
        $_SESSION['notifsResult'] = [];

        foreach ($results as $result) {
            if (!is_null($result['sender_id'])) {
                $_SESSION['notifAmi'][] = $result;
            } else {
                $_SESSION['notifsResult'][] = $result;
            }
        }
        return $_SESSION;
    }

    public function friendNotification($user_id, $sender){
        $request = "INSERT INTO notifications(user_id, sender_id, message) VALUES (:user_id, :sender, 'Voudrais-tu être mon ami ?')";
        $connexion = $this->db->getConnection()->prepare($request);
        $connexion->execute([':user_id' => $user_id, ':sender' => $sender]);
    }
    public function getSenderUsername($id){
        $request = "SELECT username FROM users WHERE id = :id ";
        $connexion = $this->db->getConnection()->prepare($request);
        $connexion->execute([':id' => $id]);
        return $connexion->fetch(PDO::FETCH_ASSOC);
    }
    public function welcomNotif($id){
        $username = UserModel::getUser($this->db, 'id', $id);
        $request = "INSERT INTO notifications (user_id, message) VALUES (:user_id, 'Oh, un nouveau ! Bienvenue à toi " . $username['username'] . "')";
        $this->db->executeQuery($request, ['user_id' => $id]);
    }

}