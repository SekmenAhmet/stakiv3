<?php

namespace App;
class Request {
    public Session $session;
    public function __construct(){
        $this->session = new Session();
    }
    public function getMethod() : string {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
    public function bodyParser() : array {
        $body = [];
        $method = ($this->getMethod() === 'post') ? $_POST : $_GET;
        $input = ($this->getMethod() === 'post') ? INPUT_POST : INPUT_GET;
        foreach ($method as $key => $value) {
            $body[$key] = filter_input($input, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }
        return $body;
    }
}