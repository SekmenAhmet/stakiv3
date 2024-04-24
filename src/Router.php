<?php
namespace App;

use AltoRouter;
use Exception;


class Router{
    private AltoRouter $router;
    public Response $response;
    public Request $request;
    public function __construct(){
        $this->router = new AltoRouter();
        $this->response = new Response();
        $this->request  = new Request();
    }
    public function matchRoute() : void {
        $match = $this->router->match();
        if ($match){    
            if (is_callable($match['target'])){
                call_user_func_array($match['target'], $match['params']);
            } else if (is_string($match['target'])) {
                $this->response->render($match['target']);
            } else if (is_array($match['target'])) {
                $controller =new $match["target"][0]();
                $method = $match["target"][1]; 
                call_user_func([$controller,$method], $this->request, $this->response);
            }
        } else {
             $this->response->render("404");
        } 
    }
    public function get(string $route, $target) : self {
        try {
            $this->router->map('GET', $route, $target);
        } catch (Exception $e) {
            echo $e;
        }
        return $this;
    }
    public function post(string $route, $target) : self {
        try {
            $this->router->map('POST', $route, $target);
        } catch (Exception $e) {
            echo $e;
        }
        return $this;
    }
}