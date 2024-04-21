<?php

namespace App;

class Application {
    public Router $router;
    public static Application $instance;
    public function __construct(){
        self::$instance = $this;
        $this->router = new Router();
    }
}