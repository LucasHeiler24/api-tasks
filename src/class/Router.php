<?php
namespace src\class;

class Router {

    private array $routes = [];
    private string $path;

    private function instance(array $variables = [], string $path = ""){
        if(strlen($path) > 0) $this->path = $path;
        $route = $this->routes[$this->path];
        [$controller, $method] = explode('@', $route);

        if(str_contains($method, ':')){
            [$method] = explode(':', $method);
            
            [, $token] = explode(' ', $_SERVER['HTTP_AUTHORIZATION']);
            if(!$token){
                Response::response(['message' => 'User anauthorized'], 401);
                exit;
            }
            $decode = Jwt::decode($token);
            if(!$decode){
                Response::response(['message' => 'User anauthorized'], 401);
                exit;
            }
            array_push($variables, $decode);
        }

        $controllerInstance = "src\\controllers\\$controller";
        if(!class_exists($controllerInstance)){
            Response::response(['message' => "Route doesn't found"], 404);
            exit;
        }

        $controller = new $controllerInstance;
        if(!method_exists($controller, $method)){
            Response::response(['message' => "Route doesn't found"], 404);
            exit;
        }
        $controller->$method($variables);
    }

    private function find(){
        return array_find_key($this->routes, function($route, $key){
            $regex = str_replace('/', '\/', $key);
            return preg_match("/$regex/", $this->path);
        });
    }

    public function route(){
        $this->routes = getRoutes();
        $this->path = getPath();

        if(array_key_exists($this->path, $this->routes))
            return $this->instance();
        
        $found = $this->find();
        if(!$found){
            Response::response(['message' => "Route doesn't found"], 404);
            exit;
        }
            
        $variables = [...array_diff(explode('/', $this->path), explode('/', $found))];
        $this->instance($variables, $found);
    }

}

