<?php

namespace App;

class Logs {
    public static function addToLogs(int $user_id, string $action) : void {
        $request = "INSERT INTO logs (action, user_id) VALUES (:action, :user_id)";
        Database::getInstance()->executeQuery($request, ['action' => $action, 'user_id' => $user_id]);
    }
}
