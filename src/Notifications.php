<?php

namespace App;

use App\models\UserModel;
use PDO;

class Notifications {
    public function showNotif(int $id): array {
        $request = "SELECT n.*, u.username AS sender_username FROM notifications n LEFT JOIN users u ON n.sender_id = u.id WHERE n.user_id = :id";
        $results = Database::getInstance()->executeQuery($request, ['id' => $id])->fetchAll(PDO::FETCH_ASSOC);
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
    public function friendNotification(int $user_id, int $sender) : void{
        $request = "INSERT INTO notifications(user_id, sender_id, message) VALUES (:user_id, :sender, 'Voudrais-tu être mon ami ?')";
        Database::getInstance()->executeQuery($request, ['user_id' => $user_id, 'sender' => $sender]);
    }
    public function welcomNotif(int $id) : void{
        $username = UserModel::getUser(Database::getInstance(), 'id', $id);
        $request = "INSERT INTO notifications (user_id, message) VALUES (:user_id, 'Oh, un nouveau ! Bienvenue à toi " . $username['username'] . "')";
        Database::getInstance()->executeQuery($request, ['user_id' => $id]);
    }
}