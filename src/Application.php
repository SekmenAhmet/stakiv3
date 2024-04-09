<?php

namespace App;

class Application {
    public Database $database;
    public Router $router;
    public static Application $instance;
    public function __construct(){
        self::$instance = $this;
        $this->database = new Database();
        $this->router = new Router();
    }
}