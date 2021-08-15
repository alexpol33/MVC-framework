<?php

namespace application\core;
use application\core\View;
class Router
{
    protected $routes = [];
    protected $params = [];


    public function __construct()
    {
        $arr = require 'application/config/routes.php';
        foreach ($arr as $key => $value){
            $this->add($key, $value);
        }
        //debug($arr);
    }

    public function add($route, $params){
        $route = '#^'.$route.'$#';
        $this->routes[$route] = $params;
    }

    public function match(){
        $url = trim($_SERVER['REQUEST_URI'], '/');
        foreach ($this->routes as $route => $params) {
            if(preg_match($route, $url, $matches)){
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    public function run(){
        if($this->match()){
            $controllerPath = 'application\controllers\\'.ucfirst($this->params['controller']).'Controller';
            if(class_exists($controllerPath)){
                $action = $this->params['action'].'Action';
                if(method_exists($controllerPath, $action)){
                    $controller = new $controllerPath($this->params);
                    $controller->$action();
                }else{
                    View::errorCode(404);
                }
            }else{
                View::errorCode(404);
            }

        }else{
            View::errorCode(404);
        }
    }

}